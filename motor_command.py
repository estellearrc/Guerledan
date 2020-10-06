#!/usr/bin/python

import time
import numpy as np
import sys
import arduino_driver_py3 as ardudrv
import tst_compass as cmps
# from roblib import *


def sawtooth(x):
    return (x+np.pi) % (2*np.pi)-np.pi   # or equivalently   2*arctan(tan(x/2))


def compute_command(cap, cap0):
    e = cap-cap0  # erreur
    M = np.array([1, -1], [1, 1])
    b = np.array([[sawtooth(e)], [1]])
    M_1 = np.linalg.pinv(M)  # resolution of the system
    u = M_1*b  # command motor array
    return u


if __name__ == "__main__":
    print("init arduino ...")
    serial_arduino, data_arduino = ardudrv.init_arduino_line()
    print("data:", data_arduino[0:-1])
    print("... done")

    print("get status ...")
    timeout = 1.0
    data_arduino = ardudrv.get_arduino_status(serial_arduino, timeout)
    print("data:", data_arduino[0:-1])
    print("... done")

    # test simple sur les moteurs
    y0 = 0
    coord = cmps.read_compass_values()
    x, y, z = coord[0, 0], coord[1, 0], coord[2, 0]
    u = compute_command(y, y0)
    cmdl = u[0, 0]  # left ou right ?
    cmdr = u[1, 0]
    if y > 0:
        cmdl = 40  # angle velocity
        cmdr = 0
        print("set motors to L=%d R=%d ..." % (cmdl, cmdr))
        ardudrv.send_arduino_cmd_motor(serial_arduino, cmdl, cmdr)
        print("... done")
    else:
        cmdl = 0
        cmdr = 40
        print("set motors to L=%d R=%d ..." % (cmdl, cmdr))
        ardudrv.send_arduino_cmd_motor(serial_arduino, cmdl, cmdr)
        print("... done")

    print("get decoded data (debug) ...")
    timeout = 1.0
    data_arduino = ardudrv.get_arduino_decode_cmd(serial_arduino, timeout)
    print("data:", data_arduino[0:-1])
    print("... done")
