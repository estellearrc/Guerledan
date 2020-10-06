#!/usr/bin/python

import time
import numpy as np
import sys
import arduino_driver_py3 as ardudrv
import tst_compass as cmps
# from roblib import *


def sawtooth(x):
    return (x+pi) % (2*pi)-pi   # or equivalently   2*arctan(tan(x/2))


def compute_command():
    y0 = 0
    x, y, z = cmps.read_compass_values()
    e = y-y0
    M = np.array([1, -1], [1, 1])
    b = np.array([[sawtooth(e)], [1]])
    M_1 = np.linalg.pinv(M)
    u = M_1*b
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
    cmdl = u[0, 0]
    cmdr = u[1, 0]
    if y > 0:
        cmdl = 40
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
