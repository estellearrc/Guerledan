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
        # print(three_values)
        time.sleep(dt)
    fichier.close()


def retrieve_compass_values():
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


def tranform_compass_data(x, y, z):
    point = np.array([x, y, z])
    center = np.array([[413.], [-2209.], [3626.5]])
    point_trans = translate(point, center)
    point_norm = normalize(point_trans)
    return point_norm


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


def display_compass_values(points, center=np.array([[0], [0], [0]])):
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
    #print([minX, minY, minZ])
    #print([maxX, maxY, maxZ])
    center = np.array(
        [[(maxX+minX)/2], [(maxY+minY)/2], [(maxZ+minZ)/2]])
    return center


def translate(points, p):
    return points - p


def normalize(points):
    X = points[0, :]
    Y = points[1, :]
    Z = points[2, :]
    minX, minY, minZ = min(X), min(Y), min(Z)
    maxX, maxY, maxZ = max(X), max(Y), max(Z)
    #print([minX, minY, minZ])
    #print([maxX, maxY, maxZ])
    a, b, c = (maxX-minX)/2, (maxY-minY)/2, (maxZ-minZ)/2
    X_sphere = 3000*X/a
    Y_sphere = 3000*Y/b
    Z_sphere = 3000*Z/c
    minX, minY, minZ = min(X_sphere), min(Y_sphere), min(Z_sphere)
    maxX, maxY, maxZ = max(X_sphere), max(Y_sphere), max(Z_sphere)
    #print([minX, minY, minZ])
    #print([maxX, maxY, maxZ])
    return np.array([X_sphere, Y_sphere, Z_sphere])


def calibrate():
    write_compass_values()
    X, Y, Z = read_compass_values()
    points = np.array([X, Y, Z])
    # display_compass_values(points)
    center = computer_ellipse_center(X, Y, Z)
    points_trans = translate(points, center)
    # display_compass_values(points_trans, center)
    points_norm = normalize(points_trans)
    display_compass_values(points_norm, center)


def test():
    x, y, z = retrieve_compass_values()
    print("Bx = %d G, By = %d G, Bz = %d G", x, y, z)
    time.sleep(1)


def correct_manually(Bx, By, Bz):
    b = np.array([[-261], [2105], [-1350]])
    A = np.array(
        [[-6789, 926, -402], [-680, -3446, -1742], [5326, 3904, 11426]])
    B = np.array([[Bx], [By], [Bz]])
    B_corrected = np.linalg.pinv(A).dot(B + b)
    return B_corrected


def calibrate_manually():
    X, Y, Z = read_compass_values()
    B = np.array([X, Y, Z])
    points = correct_manually(B[0, 0], B[1, 0], B[2, 0])
    display_compass_values(points)


if __name__ == "__main__":
    # calibrate()
    # retrieve_compass_values()
    calibrate_manually()
    # retrieve_compass_values()
    # while(1):
    #     test()
