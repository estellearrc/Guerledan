#!/usr/bin/python

import smbus
import time
import numpy as np
import math
from tst_compass import convert
# import matplotlib.pyplot as plt


def init_accelero(bus, DEVICE_ADDRESS):
    CTRL1_XL = 0x10
    CTRL2_G = 0x11
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
    bus.write_byte_data(DEVICE_ADDRESS, CTRL2_G, config_CTRL2)
    bus.write_byte_data(DEVICE_ADDRESS, CTRL5_C, config_CTRL5)
    bus.write_byte_data(DEVICE_ADDRESS, CTRL6_C, config_CTRL6)
    bus.write_byte_data(DEVICE_ADDRESS, CTRL7_G, config_CTRL7)
    bus.write_byte_data(DEVICE_ADDRESS, CTRL8_XL, config_CTRL8)
    bus.write_byte_data(DEVICE_ADDRESS, CTRL9_XL, config_CTRL9)
    bus.write_byte_data(DEVICE_ADDRESS, CTRL10_C, config_CTRL10)


def read_data(bus, DEVICE_ADDRESS):
    """
    Read data from accelero by I2C
    """
    OUT_X_L = 0x28  # first data register to read
    # read values
    six_values = bus.read_i2c_block_data(DEVICE_ADDRESS, OUT_X_L, 6)
    three_values = convert(six_values)
    return three_values


def write_data(bus, DEVICE_ADDRESS, file_name):
    """
    FILTRAGE
    Write data in a csv doc
    """
    fichier = open(file_name, "w")
    for i in np.arange(0, 100, 0.1):
        three_values = read_data(bus, DEVICE_ADDRESS)
        fichier.write(
            str(three_values[0])+";"+str(three_values[1])+";"+str(three_values[2]) + "\n")
        time.sleep(0.1)
    fichier.close()


def test_acceleration(value, nb_ech, sum_x, sum_y):
    """
    Test if the data shown an acceleration
    """
    # value_pass_y = 500
    # value_pass_x = 500
    # first we dont do the diff btw x and y
    # status of accelero,y: 1: accelero positifs (droite) , -1 negativ (gauche)
    # status = np.array([[0], [0], [0]])
    # if three_values[0] >= value_pass_x or three_values[0] <= -value_pass_x :
    #     status[0, 0] = 1 #we dont diff positif or negatif on x, y
    # if three_values[1] >= value_pass_y or three_values[1] <= -value_pass_y:
    #     status[1, 0] = 1 #we dont diff positif or negatif on x, y

    value_pass = 2*(abs(sum_x/nb_ech) + abs(sum_y/nb_ech))
    print("value_pass = ", value_pass)
    status = 0
    if value >= value_pass:
        status = 1
    return status


def read_csv(file_name):
    """
    Open a csv doc, read data and return them
    """
    X = []
    Y = []
    Z = []
    fichier = open(file_name, "r")
    for elt in fichier.readlines():
        line = elt.strip("\n").split(";")
        X.append(int(line[0]))
        Y.append(int(line[1]))
        Z.append(int(line[2]))
    fichier.close()
    return X, Y, Z


def display_frequencies(file_name):
    X, Y, Z = read_csv(file_name)
    n = np.arange(0, len(X), 1)
    X_fft = np.fft.fft(X)
    Y_fft = np.fft.fft(Y)
    plt.figure()
    plt.plot(n, X_fft)
    plt.plot(n, Y_fft)
    plt.show()


def sign(num):
    return -1 if num < 0 else 1


def correct(x):
    if abs(x) > 0 and abs(x) < 300:
        x = x - sign(x)*250
    return x


def process(data_brut, nb_ech, sum_x, sum_y):
    x, y, z = data_brut[0], data_brut[1], data_brut[2]
    nb_ech += 1
    sum_x += x
    sum_y += y
    mean_x = sum_x/nb_ech
    mean_y = sum_y/nb_ech
    # print(mean_x)
    # print(mean_y)
    # x = correct(x)
    # y = correct(y)
    # sum = x**2 + y**2
    res = abs(y - mean_y) + abs(x - mean_x)
    return res, nb_ech, sum_x, sum_y


def display_graph(file_name):
    X, Y, Z = read_csv(file_name)
    # print(np.mean(X))
    # print(np.mean(Y))
    n = np.arange(0, len(X), 1)
    plt.figure()
    S = []
    nb_ech, sum_x, sum_y = 0, 0, 0
    for i in range(min(len(X), len(Y))):
        s, nb_ech, sum_x, sum_y = process(
            [X[i], Y[i], 0], nb_ech, sum_x, sum_y)
        S.append(s)
    mean_x, mean_y = sum_x/nb_ech, sum_y/nb_ech
    print(1.5*mean_x)
    print(1.5*mean_y)
    print(1.5*abs(mean_x)+1.5*abs(mean_y))

    plt.plot(n, abs(np.array(X)-mean_x), "blue", label="Acc X")
    plt.plot(n, abs(np.array(Y)-mean_y), "green", label="Acc Y")
    plt.plot(n, S, "magenta", label="abs(X) + abs(Y)")
    # plt.plot(n, Z, "red", label="Acc Z")
    plt.legend()
    plt.show()


if __name__ == "__main__":
    # bus = smbus.SMBus(1)=
    # DEVICE_ADDRESS = 0x6b
    # init_accelero(bus, DEVICE_ADDRESS)
    # write_data(bus, DEVICE_ADDRESS, "data_accelero_filtre.csv")
    file_name = "data_accelero_filtre.csv"
    # display_frequencies(file_name)
    # display_graph(file_name)
    # file_name = "data_accelero_filtre_avec_choc.csv"
    # display_frequencies(file_name)
    # display_graph(file_name)
    # file_name = "data_accelero_filtre_avec_choc_5ypos_5yneg_5x.csv"
    # display_graph(file_name)
    file_name = "data_accelero_filtre_piscine.csv"
    display_graph(file_name)
    file_name = "data_accelero_filtre_piscine2.csv"
    display_graph(file_name)
    file_name = "data_accelero_filtre_piscine3.csv"
    display_graph(file_name)
    file_name = "data_accelero_filtre_piscine4.csv"
    display_graph(file_name)
    file_name = "data_accelero_filtre_piscine5.csv"
    display_graph(file_name)
    # file_name = "data_accelero_filtre_motor_on.csv"
    # display_graph(file_name)
