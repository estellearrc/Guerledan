#!/usr/bin/python

import smbus
import time
import numpy as np
from tst_compass import convert
import matplotlib.pyplot as plt



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

def write_data():
    """
    FILTRAGE
    Write data in a csv doc
    """
    fichier = open("data_compass.csv", "w")
    for i in np.arange(0,100,0.1):
        three_values = read_data()
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
    n = np.linspace(0,len(X),1) #doute sur le pas
    X_fft = np.fft.fft(X,n)
    Y_fft = np.fft.fft(Y,n)
    plt.figure()
    plt.plot(n,X)
    plt.plot(n,Y)
    plt.show()

def filtrage():
    """
    """
    pass


if __name__ == "__main__":
    write_data()
    display_frequencies()
    