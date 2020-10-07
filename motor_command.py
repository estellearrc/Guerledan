#!/usr/bin/python

import time
import numpy as np
import sys
import arduino_driver_py3 as ardudrv
import tst_compass as cmps
from encoders_driver_py3 import*
from tst_accelero import read_data
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
    return 40*u


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
    return np.arctan2(By, Bx) + np.pi


def turn_around_pool():
    """
    Turn around a pool by a,b,c,d cap
    """
    # output accelerometre
    # test acceleration
    #cap = a
    # if acceleration:
    #new_cap = b
    # if acceleration:
    #new_cap = c
    # if acceleration:
    #new_cap = d
    pass


def motor_com(cap0):
    """
    Follow cap cap0
    """
    # status messages
    print("init arduino ...")
    serial_arduino, data_arduino = ardudrv.init_arduino_line()
    print("data:", data_arduino[0:-1])
    print("... done")
    print("get status ...")
    timeout = 1.0
    data_arduino = ardudrv.get_arduino_status(serial_arduino, timeout)
    print("data:", data_arduino[0:-1])
    print("... done")

    # motor regulation to follow a given heading
    # coef_left_motor = 1.75  # WWARNING : to modif when use fonction u_regul
    while(1):
        Bx, By, Bz = cmps.retrieve_compass_values()  # retrieve brut values
        coord = cmps.tranform_compass_data(Bx, By, Bz)  # correct brut values
        #print("Bx = %d G, By = %d G, Bz = %d G" % (Bx, By, Bz))
        # print(coord)
        Bx, By, Bz = coord[0, 0], coord[1, 0], coord[2, 0]
        cap = compute_heading(Bx, By)  # compute the wanted heading
        #print("cap = ", cap)
        e = cap0-cap  # error of heading
        u = compute_command(e)
        #u_regu = compute_velocity_reg(e,u)

        # command left motor #WARNING a modifier  par u_regul si vitessse regulee
        cmdl = u[0, 0]
        cmdr = u[1, 0]  # command right motor
        print("set motors to L=%d R=%d ..." % (cmdl, cmdr))
        ardudrv.send_arduino_cmd_motor(serial_arduino, cmdl, cmdr)
        print("... done")
        data = read_data()  # test choc for tst_accelero
        print(data)
        print("get decoded data (debug) ...")
        timeout = 1.0
        data_arduino = ardudrv.get_arduino_decode_cmd(serial_arduino, timeout)
        print("data:", data_arduino[0:-1])
        print("... done")


if __name__ == "__main__":
    cap0 = 0  # North heading in degrees
    # motor_com(cap0)
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
