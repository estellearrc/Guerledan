#!/usr/bin/python

import time
import numpy as np
import sys
import arduino_driver_py3 as ardudrv
import tst_compass as cmps
from encoders_driver_py3 import*
from tst_accelero import *
# from roblib import *

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
    print("u = ", u)
    return 50*u


def compute_velocity_reg(e, u):
    """
    Attention manque la conversion increment/vitesse
    Motor regulated by velocity
    """
    err_velocity = np.array([[0], [0]])
    posLeft, posRight = read_single_packet()[3], read_single_packet()[
        4]  # output encoder, count nb tic
    vLeft, vRight = posLeft, posRight  # velocity encoder in nb tic/sec
    cmdl = u[1, 0]  # command left motor
    cmdr = u[0, 0]
    # velocity error
    err_velocity[0, 0] = cmdr - vRight
    err_velocity[1, 0] = cmdl - vLeft
    u_regul = u + err_velocity  # regulation velocity motor
    return u_regul


def compute_heading(Bx, By):
    return np.arctan2(By, Bx)  # + np.pi


def turn_around_pool():
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
    coef_motor_l = 1.75
    nb_ech = 0
    sum_x = 0
    sum_y = 0
    while(1):
        #  output accelerometre
        data_brut_accelero = read_data(bus, ACC_ADDRESS)
        #print("data =", data_brut_accelero)
        data_process, nb_ech, sum_x, sum_y = process(data_brut_accelero, nb_ech,
                                                     sum_x, sum_y)  # data processing
        print("data_process = ", data_process)
        status = test_acceleration(data_process, nb_ech,
                                   sum_x, sum_y)  # status acelero
        #print("status =", status)
        timeout = 0.5
        if status == 1:  # if we detect a choc
            # First, we set motors to 0
            data_arduino = ardudrv.get_arduino_status(serial_arduino, timeout)
            ardudrv.send_arduino_cmd_motor(
                serial_arduino, 0, 0)  # velocity motor
            time.sleep(1)
            # Then, we switch on the right motor
            data_arduino = ardudrv.get_arduino_status(serial_arduino, timeout)
            ardudrv.send_arduino_cmd_motor(
                serial_arduino, 0, 50)  # velocity motor
            time.sleep(2)
            nb_ech = 0
            sum_x = 0
            sum_y = 0
        else:
            # without choc we keep the same velocity on left and right motor
            data_arduino = ardudrv.get_arduino_status(serial_arduino, timeout)
            ardudrv.send_arduino_cmd_motor(
                serial_arduino, 50, 50)  # velocity motor


def motor_com(cap0):
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
    coef_left_motor = 1.75  # WWARNING : to modif when use fonction u_regul
    while(1):
        Bx, By, Bz = cmps.retrieve_compass_values()  # retrieve brut values
        coord = cmps.tranform_compass_data(Bx, By, Bz)  # correct brut values
        #print("Bx = %d G, By = %d G, Bz = %d G" % (Bx, By, Bz))
        # print(coord)
        Bx, By, Bz = coord[0, 0], coord[1, 0], coord[2, 0]
        cap = compute_heading(Bx, By)  # compute the wanted heading
        #print("cap = ", cap)
        e = 0.5*(cap-cap0)  # error of heading
        u = np.abs(compute_command(e))
        #u_regu = compute_velocity_reg(e,u)

        # command left motor #WARNING a modifier  par u_regul si vitessse regulee
        cmdl = coef_left_motor*u[0, 0]
        cmdr = u[1, 0]  # command right motor
        print("set motors to L=%d R=%d ..." % (cmdl, cmdr))
        ardudrv.send_arduino_cmd_motor(serial_arduino, cmdl, cmdr)
        # print("... done")
        # data = read_data()  # test choc for tst_accelero
        # print(data)
        # print("get decoded data (debug) ...")
        timeout = 1.0
        data_arduino = ardudrv.get_arduino_decode_cmd(serial_arduino, timeout)
        # print("data:", data_arduino[0:-1])
        # print("... done")


def test_motor():
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


if __name__ == "__main__":
    # cap0 = 1.5  # North heading in degrees
    # motor_com(cap0)
    # test_motor()
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
    turn_around_pool()


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
    # motor_com(cap0)
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
