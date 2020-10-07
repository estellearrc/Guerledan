#!/usr/bin/python

import smbus
import time
import numpy as np
from tst_compass import convert



def read_data():
    """
    Read data from accelero by I2C
    """
    # 0 = /dev/i2c-0 (port I2C0), 1 = /dev/i2c-1 (port I2C1)
    bus = smbus.SMBus(1)
    # 7 bit address (will be left shifted to add the read write bit)
    DEVICE_ADDRESS = 0x6b
    CTRL1_XL = 0x10
    OUT_X_L = 0x28  # first data register to read
    # Set continuous-conversion mode to (MD1=0,MD0=0)
    bus.write_byte_data(DEVICE_ADDRESS, CTRL1_XL, 0b01001000)
    #read values
    six_values = bus.read_i2c_block_data(DEVICE_ADDRESS, OUT_X_L, 6)
    three_values = convert(six_values)
    return three_values

def test_acceleration(three_values):
    """
    Test if the data shown an acceleration
    """
    value_pass = 0
    status = np.array([[0],[0],[0]]) #status of accelero, 1: accelero positifs, -1 negativ
    if three_values[0] >= value_pass:
        status[0,0] = 1
    elif three_values[0] <= -value_pass:
        status[0,0] = -1
    if three_values[1] >= value_pass:
        status[1,0] = 1
    elif three_values[1] <= -value_pass:
        status[1,0] = -1
    return  status


if __name__ == "__main__":
    while(1):
        three_values = read_data()
        print(three_values)
        time.sleep(0.5)