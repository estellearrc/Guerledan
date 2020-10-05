#!/usr/bin/python

# import smbus
import time
import numpy as np
from roblib import *


def merge(lower_byte, upper_byte):
    """merge 2 bytes (2*8 bits) to form a 16-bit long binary integer"""
    res = lower_byte + upper_byte*256
    return res


def bin2decs(x):
    """Convert a binary string into a signed decimal integer"""
    if x > 32767:
        x = x - 65536
    return x


def convert(tab):
    """ convert a table of 6 bytes into 3 decimal integers"""
    three_values = [0, 0, 0]
    for i in range(0, 6, 2):
        two_bytes = merge(tab[i], tab[i+1])
        three_values[int(i/2)] = bin2decs(two_bytes)
    return three_values


def write_compass_values():
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
    dt = 0.1
    fichier = open("data_compass.csv", "w")
    for t in range(1000):
        six_values = bus.read_i2c_block_data(DEVICE_ADDRESS, OUT_X_L, 6)
        # print(six_values)
        three_values = convert(six_values)
        fichier.write(
            str(three_values[0])+";"+str(three_values[1])+";"+str(three_values[2]) + "\n")
        print(three_values)
        time.sleep(dt)
    fichier.close()


def read_compass_values():
    # 0 = /dev/i2c-0 (port I2C0), 1 = /dev/i2c-1 (port I2C1)
    bus = smbus.SMBus(1)

    # 7 bit address (will be left shifted to add the read write bit)
    DEVICE_ADDRESS = 0x1e
    CTRL_REG3 = 0x22
    OUT_X_L = 0x28  # first data register to read

    # Write a single register
    # Set continuous-conversion mode to (MD1=0,MD0=0)
    bus.write_byte_data(DEVICE_ADDRESS, CTRL_REG3, 0b00000000)
    six_values = bus.read_i2c_block_data(DEVICE_ADDRESS, OUT_X_L, 6)
    x, y, z = convert(six_values)
    return x, y, z


def read_compass_values():
    X = []
    Y = []
    Z = []
    fichier = open("data_compass.csv", "r")
    for elt in fichier.readlines():
        line = elt.strip("\n").split(";")
        X.append(int(line[0]))
        Y.append(int(line[1]))
        Z.append(int(line[2]))
    return X, Y, Z


def display_compass_values(points, center=array([[0], [0], [0]])):
    fig = figure()
    ax = Axes3D(fig)
    plot3D(ax, points)
    R = eye(3, 3)
    draw_axis3D(ax, 0, 0, 0, R, zoom=50)
    # draw_axis3D(ax, center[0, 0], center[1, 0], center[2, 0], R, zoom=50)
    show()


def computer_ellipse_center(X, Y, Z):
    minX, minY, minZ = min(X), min(Y), min(Z)
    maxX, maxY, maxZ = max(X), max(Y), max(Z)
    center = array(
        [[(maxX+minX)/2], [(maxY+minY)/2], [(maxZ+minZ)/2]])
    return center


def translate(points, p):
    return points - p


def normalize(points, center):
    X = points[0, :]
    Y = points[1, :]
    Z = points[2, :]
    xs, ys, zs = center[0, 0], center[1, 0], center[2, 0]
    minX, minY, minZ = min(X), min(Y), min(Z)
    maxX, maxY, maxZ = max(X), max(Y), max(Z)
    a, b, c = (maxX-minX)/2, (maxY-minY)/2, (maxZ-minZ)/2
    X_sphere = (X - xs)/(a*a) + xs
    Y_sphere = (Y - ys)/(b*b) + ys
    Z_sphere = (Z - zs)/(c*c) + zs
    print(array([X_sphere, Y_sphere, Z_sphere]))
    return array([X_sphere, Y_sphere, Z_sphere])


if __name__ == "__main__":
    # write_compass_values()
    X, Y, Z = read_compass_values()
    points = array([X, Y, Z])
    # display_compass_values(points)
    center = computer_ellipse_center(X, Y, Z)
    points_trans = translate(points, center)
    # display_compass_values(points_trans, center)
    points_norm = normalize(points_trans, center)
    display_compass_values(points_norm, center)
