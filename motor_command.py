#!/usr/bin/python

import time
import numpy as np
import sys
import arduino_driver_py3 as ardudrv
import tst_compass as cmps


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
    x, y, z = cmps.read_compass_values()
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
