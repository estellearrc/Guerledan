#!/usr/bin/python

import smbus
import time
import numpy as np
from tst_compass import convert
# import matplotlib.pyplot as plt


def init_accelero(bus, DEVICE_ADDRESS):
    CTRL1_XL = 0x10
    CTRL2_G = 0x11
    CTRL3_C = 0x12
    CTRL4_C = 0x13
    CTRL5_C = 0x14
    CTRL6_C = 0x15
    CTRL7_G = 0x16
    CTRL8_XL = 0x17
    CTRL9_XL = 0x18
    CTRL10_C = 0x19
    config_CTRL1 = 0b01010111
    config_CTRL2 = 0b01010000
    config_CTRL5 = 0b01100100
    config_CTRL6 = 0b00100000
    config_CTRL7 = 0b00000000
    config_CTRL8 = 0b10100101
    config_CTRL9 = 0b00111000
    config_CTRL10 = 0b00111101
    bus.write_byte_data(DEVICE_ADDRESS, CTRL1_XL, config_CTRL1)
    bus.write_byte_data(DEVICE_ADDRESS, CTRL1_XL, config_CTRL2)
    bus.write_byte_data(DEVICE_ADDRESS, CTRL1_XL, config_CTRL5)
    bus.write_byte_data(DEVICE_ADDRESS, CTRL1_XL, config_CTRL6)
    bus.write_byte_data(DEVICE_ADDRESS, CTRL1_XL, config_CTRL7)
    bus.write_byte_data(DEVICE_ADDRESS, CTRL1_XL, config_CTRL8)
    bus.write_byte_data(DEVICE_ADDRESS, CTRL1_XL, config_CTRL9)
    bus.write_byte_data(DEVICE_ADDRESS, CTRL1_XL, config_CTRL10)


def read_data(bus, DEVICE_ADDRESS):
    """
    Read data from accelero by I2C
    """
    OUT_X_L = 0x28  # first data register to read
    # read values
    six_values = bus.read_i2c_block_data(DEVICE_ADDRESS, OUT_X_L, 6)
    three_values = convert(six_values)
    return three_values


def write_data(bus, DEVICE_ADDRESS):
    """
    FILTRAGE
    Write data in a csv doc
    """
    fichier = open("data_accelero.csv", "w")
    for i in np.arange(0, 100, 0.1):
        three_values = read_data(bus, DEVICE_ADDRESS)
        fichier = open("data_accelero.csv", "w")
        fichier.write(
            str(three_values[0])+";"+str(three_values[1])+";"+str(three_values[2]) + "\n")
        time.sleep(0.1)
    fichier.close()


def test_acceleration(three_values):
    """
    Test if the data shown an acceleration
    """
    value_pass = 0
    # status of accelero, 1: accelero positifs, -1 negativ
    status = np.array([[0], [0], [0]])
    if three_values[0] >= value_pass:
        status[0, 0] = 1
    elif three_values[0] <= -value_pass:
        status[0, 0] = -1
    if three_values[1] >= value_pass:
        status[1, 0] = 1
    elif three_values[1] <= -value_pass:
        status[1, 0] = -1
    return status


def display_frequencies():
    """
    Open a csv doc, read data show the data/frequencies
    """
    X = []
    Y = []
    Z = []
    fichier = open("data_accelero.csv", "r")
    for elt in fichier.readlines():
        line = elt.strip("\n").split(";")
        X.append(int(line[0]))
        Y.append(int(line[1]))
        Z.append(int(line[2]))
    fichier.close()
    n = np.arange(0, len(X), 1)  # doute sur le pas
    # X = np.transpose(np.array(X))
    # print(X)
    X_fft = np.fft.fft(X)
    Y_fft = np.fft.fft(Y)
    plt.figure()
    plt.plot(n, X_fft)
    plt.plot(n, Y_fft)
    plt.show()


def filtrage():
    """
    """
    pass


if __name__ == "__main__":
    # 0 = /dev/i2c-0 (port I2C0), 1 = /dev/i2c-1 (port I2C1)
    bus = smbus.SMBus(1)
    # 7 bit address (will be left shifted to add the read write bit)
    DEVICE_ADDRESS = 0x6b
    init_accelero(bus, DEVICE_ADDRESS)
    # write_data(bus, DEVICE_ADDRESS)
    display_frequencies()
