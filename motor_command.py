#!/usr/bin/python

import time
import numpy as np
import sys
# import arduino_driver_py3 as ardudrv
# import tst_compass as cmps
# from encoders_driver_py3 import*
# from tst_accelero import *
# from tst_regul_py3 import *
# from roblib import *
import matplotlib.pyplot as plt

# cmdl = 40
# cmdr = 40
# duration = 2.0
# try:
#     cmdl = int(sys.argv[1])
#     cmdr = cmdl
# except:
#     pass
# try:
#     cmdr = int(sys.argv[2])
# except:
#     pass
# try:
#     duration = float(sys.argv[3])
# except:
#     pass


def sawtooth(x):
    # x in radians
    return (x + np.pi) % (2*np.pi)-np.pi


def compute_command(e):
    print(e)
    M = np.array([[1, -1], [1, 1]])
    b = np.array([[sawtooth(e)], [1]])
    M_1 = np.linalg.pinv(M)  # resolution of the system
    u = M_1.dot(b)  # command motor array
    # print("u = ", u)
    return 50*u


def retrieve_motor_vit():
    """
    Calcul of the boat velocity thanks to encoder
    """
    dt = 0.1
    data = read_single_packet()  # first reading data
    posLeft, posRight = data[4], data[5]
    time.sleep(dt)
    data = read_single_packet()  # seconde reading data
    next_posLeft, next_posRight = data[4], data[5]
    dOdoL = abs(delta_odo(next_posLeft, posLeft))
    dOdoR = abs(delta_odo(next_posRight, posRight))
    vLeft, vRight = dOdoL/dt, dOdoR/dt  # derivation
    print("vLeft=", vLeft)
    print("vRight=", vRight)
    return vLeft, vRight


def compute_velocity_reg(u):
    """
    Attention manque la conversion increment/vitesse
    Motor regulated by velocity
    """
    err_velocity = np.array([[0], [0]])
    vLeft, vRight = retrieve_motor_vit()
    cmdl = u[0, 0]  # command left motor
    cmdr = u[1, 0]
    # velocity error
    err_velocity[0, 0] = cmdl - vLeft
    err_velocity[1, 0] = cmdr - vRight
    # print("err-velocity", err_velocity)
    u_regul = u + err_velocity  # regulation velocity motor
    return u_regul


def compute_heading(Bx, By):
    return np.arctan2(By, Bx)  # + np.pi


def compute_spd(cmd):
    return 200*cmd/40


def turn_around_pool(cmd):
    """
    Turn around a pool by a,b,c,d cap
    Trigo sens = turn alway on left
    """
    # initialisation
    serial_arduino, data_arduino = ardudrv.init_arduino_line()
    ACC_ADDRESS = 0x6b
    bus = smbus.SMBus(1)
    init_accelero(bus, ACC_ADDRESS)
    timeout = 1.0
    coef_motor_l = 1.1
    nb_ech = 0
    sum_x = 0
    sum_y = 0
    cmdl = cmd
    cmdr = cmd
    cap0 = np.pi/3
    while(1):
        print("cap=", retrieve_heading())
        #  output accelerometre
        data_brut_accelero = read_data(bus, ACC_ADDRESS)
        #print("data =", data_brut_accelero)
        status, nb_ech, sum_x, sum_y = process(data_brut_accelero, nb_ech,
                                               sum_x, sum_y)  # data processing
        #print("status =", status)
        if status == 1:  # if we detect a choc
            # First, we set motors to 0
            ardudrv.send_arduino_cmd_motor(
                serial_arduino, 0, 0)  # velocity motor
            time.sleep(0.5)
            # Then, we switch on the right motor
            # turn_left(serial_arduino, 150)
            cap0 = sawtooth(cap0 + np.pi/2)  # cap between -pi and pi
            follow(cap0, serial_arduino)
            nb_ech = 0
            sum_x = 0
            sum_y = 0
        else:
            # without choc we keep the same velocity on left and right motor
            # ardudrv.send_arduino_cmd_motor(
            #     serial_arduino, coef_motor_l*50, 50)  # velocity motor u_regul[1, 0]
            # speed regulation uneffective
            # spd = compute_spd(cmd)  #velocity
            # regulation(serial_arduino,spd,cmdl,cmdr)
            follow(cap0, serial_arduino)


def turn_left(serial_arduino, vit):
    ardudrv.send_arduino_cmd_motor(serial_arduino, 0, vit)  # velocity motor
    time.sleep(2)


def retrieve_heading():
    Bx, By, Bz = cmps.retrieve_compass_values()  # retrieve brut values
    coord = cmps.tranform_compass_data(Bx, By, Bz)  # correct brut values
    Bx, By, Bz = coord[0, 0], coord[1, 0], coord[2, 0]
    cap = compute_heading(Bx, By)  # compute the wanted heading
    return cap


def follow(cap0, serial_arduino):
    """
    Follow cap cap0
    """
    # status messages
    # print("init arduino ...")
    # serial_arduino, data_arduino = ardudrv.init_arduino_line()
    # print("data:", data_arduino[0:-1])
    # print("... done")
    # print("get status ...")
    # timeout = 1.0
    # data_arduino = ardudrv.get_arduino_status(serial_arduino, timeout)
    # print("data:", data_arduino[0:-1])
    # print("... done")

    # motor regulation to follow a given heading
    coef_left_motor = 1.1  # WWARNING : to modif when use fonction u_regul
    cap = retrieve_heading()
    print("cap = ", cap)
    e = 0.5*(cap-cap0)  # error of heading
    print("error cap =", e)
    while(abs(e) > 0.02):
        cap = retrieve_heading()
        #print("cap = ", cap)
        e = 0.5*(cap-cap0)  # error of heading
        u = np.abs(compute_command(e))
        #u_regu = compute_velocity_reg(e,u)

        # command left motor #WARNING a modifier  par u_regul si vitessse regulee
        cmdl = coef_left_motor*u[0, 0]
        cmdr = u[1, 0]  # command right motor
        print("set motors to L=%d R=%d ..." % (cmdl, cmdr))
        ardudrv.send_arduino_cmd_motor(serial_arduino, cmdl, cmdr)


def test_motor_with_compass():
    print("init arduino ...")
    serial_arduino, data_arduino = ardudrv.init_arduino_line()
    print("data:", data_arduino[0:-1])
    print("... done")
    print("get status ...")
    timeout = 1.0
    data_arduino = ardudrv.get_arduino_status(serial_arduino, timeout)
    print("data:", data_arduino[0:-1])
    print("... done")
    cap0 = 0
    coef_motor_l = 1.75
    while(1):
        Bx, By, Bz = cmps.retrieve_compass_values()  # retrieve brut values
        coord = cmps.tranform_compass_data(Bx, By, Bz)  # correct brut values
        #print("Bx = %d G, By = %d G, Bz = %d G" % (Bx, By, Bz))
        # print(coord)
        Bx, By, Bz = coord[0, 0], coord[1, 0], coord[2, 0]
        cap = compute_heading(Bx, By)  # compute the wanted heading
        print("cap = ", cap)
        e = cap-cap0  # error of heading
        if(e > 0):
            cmdl = coef_motor_l*40
            cmdr = 0  # command right motor
            print("set motors to L=%d R=%d ..." % (cmdl, cmdr))
            ardudrv.send_arduino_cmd_motor(serial_arduino, cmdl, cmdr)
        else:
            cmdl = coef_motor_l*0
            cmdr = 40  # command right motor
            print("set motors to L=%d R=%d ..." % (cmdl, cmdr))
            ardudrv.send_arduino_cmd_motor(serial_arduino, cmdl, cmdr)


def test_motor_speed():
    print("init arduino ...")
    serial_arduino, data_arduino = ardudrv.init_arduino_line()
    print("data:", data_arduino[0:-1])
    print("... done")
    print("get status ...")
    timeout = 1.0
    data_arduino = ardudrv.get_arduino_cmd_motor(serial_arduino, timeout)
    print("data:", data_arduino[0:-1])
    print("... done")
    cmdl = 50
    cmdr = 50  # command right motor
    print("set motors to L=%d R=%d ..." % (cmdl, cmdr))
    ardudrv.send_arduino_cmd_motor(serial_arduino, cmdl, cmdr)
    fichier = open("diff_vit_2_motors.csv", "w")
    for i in np.arange(0, 100, 0.1):
        vLeft, vRight = retrieve_motor_vit()
        fichier.write(str(vLeft)+";"+str(vRight)+"\n")
        time.sleep(0.1)
    fichier.close()


def display_test_motor_speed():
    vL = []
    vR = []
    fichier = open("diff_vit_2_motors.csv", "r")
    for elt in fichier.readlines():
        line = elt.strip("\n").split(";")
        vL.append(int(line[0]))
        vR.append(int(line[1]))
    fichier.close()
    n = np.arange(0, len(vR), 1)
    plt.figure()
    plt.plot(n, vR, label="speed right motor (tick/sec), cmdr=50")
    plt.plot(n, vL, label="speed left motor (tick/sec), cmdr=50")
    plt.legend()
    plt.show()


if __name__ == "__main__":
    # cap0 = 1.5  # North heading in degrees
    # follow(cap0)
    # test_motor_speed()
    display_test_motor_speed()

    # # 0 = /dev/i2c-0 (port I2C0), 1 = /dev/i2c-1 (port I2C1)
    # bus = smbus.SMBus(1)
    # # 7 bit address (will be left shifted to add the read write bit)
    # ACC_ADDRESS = 0x6b
    # init_accelero(bus, ACC_ADDRESS)
    # serial_arduino, data_arduino = ardudrv.init_arduino_line()
    # timeout = 1.0
    # data_arduino = ardudrv.get_arduino_status(serial_arduino, timeout)
    # ardudrv.send_arduino_cmd_motor(serial_arduino, 50, 50)
    # write_data(bus, ACC_ADDRESS,
    #            "data_accelero_filtre_motor_on.csv")
    # turn_around_pool(150)


"""
Test angles heading
while(1):
        Bx, By, Bz = cmps.retrieve_compass_values()  # retrieve brut values
        coord = cmps.tranform_compass_data(Bx, By, Bz)  # correct brut values
        #print("Bx = %d G, By = %d G, Bz = %d G" % (Bx, By, Bz))
        # print(coord)
        Bx, By, Bz = coord[0, 0], coord[1, 0], coord[2, 0]
        print("Bx By Bz", (Bx, By, Bz))
        cap_rad = compute_heading(Bx, By)
        cap = cap_rad*180/np.pi
        time.sleep(0.5)
        print(cap)
"""
"""
Get plot accelero
# cap0 = 1.5  # North heading in degrees
    # follow(cap0)
    # test_motor()
    # 0 = /dev/i2c-0 (port I2C0), 1 = /dev/i2c-1 (port I2C1)
    bus = smbus.SMBus(1)
    # 7 bit address (will be left shifted to add the read write bit)
    ACC_ADDRESS = 0x6b
    init_accelero(bus, ACC_ADDRESS)
    serial_arduino, data_arduino = ardudrv.init_arduino_line()
    timeout = 1.0
    data_arduino = ardudrv.get_arduino_status(serial_arduino, timeout)
    ardudrv.send_arduino_cmd_motor(serial_arduino, 200, 200)
    write_data(bus, ACC_ADDRESS,
               "data_accelero_filtre_piscine5.csv")
"""
