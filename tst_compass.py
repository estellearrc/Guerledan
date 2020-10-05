#!/usr/bin/python

import smbus
import time
import numpy as np


def merge(lower_byte, higher_byte):
    higher_byte << 8  # 8-bit shift
    res = lower_byte | higher_byte  # sum of low and high bytes
    # res = int(str(res), 2)
    print(res)
    return res


def bin2decs(C):
    """bin2decs(C): Conversion chaine binaire signee de longueur quelconque -> nombre entier signe"""
    print(C)
    if C[0] == "0":
        # le 1er chiffre est un '0' => le resultat sera positif
        return int(C, 2)
    else:
        # le 1er chiffre est un '1' => le resultat sera negatif
        return int(C, 2)-(1 << len(C))


def convert(tab):
    three_values = [0, 0, 0]
    for i in range(0, 6, 2):
        two_bytes = merge(six_values[i], six_values[i+1])
        str_two_bytes = str(two_bytes)
        three_values[i/2] = bin2decs(str_two_bytes)
    return three_values


if __name__ == "__main__":
    # 0 = /dev/i2c-0 (port I2C0), 1 = /dev/i2c-1 (port I2C1)
    bus = smbus.SMBus(1)

    # 7 bit address (will be left shifted to add the read write bit)
    DEVICE_ADDRESS = 0x1e
    CTRL_REG3 = 0x22
    OUT_X_L = 0x28  # first data register to read

    # Write a single register
    # Set continuous-conversion mode to (MD1=0,MD0=0)
    bus.write_byte_data(DEVICE_ADDRESS, CTRL_REG3, 0b00000000)

    # Read an array of registers
    six_values = [0xff, 0xff, 0xff, 0xff, 0xff, 0xff]
    three_values = [0, 0, 0]
    dt = 1
    for t in range(1000):
        six_values = bus.read_i2c_block_data(DEVICE_ADDRESS, OUT_X_L, 6)
        print(six_values)
        three_values = convert(six_values)
        print(three_values)
        time.sleep(dt)
