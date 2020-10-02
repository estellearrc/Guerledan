import serial
import os
import time
import struct

# encoder frame
#  0     : sync 0xFF
#  1     : sync 0x0D
#  2-5   : timer MSByte first
#  6     : direction 1 (left)
#  7     : direction 2 (right)
#  8-9   : encoder 1 (left)
#  10-11 : encoder 2 (right)
#  12-13 : Hall voltage 1 (left)
#  14-15 : Hall voltage 2 (right)
#  16    : sync 0xAA

# data = [timer,dirLeft,dirRight,encLeft,encRight,voltLeft,voltRight]

def set_baudrate(baudrate=115200):
    st = os.system ("stty -F /dev/ttyUSB0 %d"%(baudrate))
    print (st)
    st = os.system ("stty -F /dev/ttyUSB0")
    print (st)

def init_line():
    ser = serial.Serial('/dev/ttyUSB0',115200,timeout=1.0)
    time.sleep(1.0)
    print (ser)
    return ser

def convertHexToString(char):
    return "\\x" + str(hex(ord(char)))[2:]

def sync(ser):
  while True:
    c1 = ser.read(1)
    c1 = struct.unpack('B',c1)[0]
    if c1 == 0xff:
      c2 = ser.read(1)
      c2 = struct.unpack('B',c2)[0]
      #print (c2)
      if c2 == 0x0d:
        v = ser.read(15)
        break

def read_packet(ser,debug=True):
    sync = True
    data = []
    v=ser.read(17)
    #print (type(v))
    #st=""
    #for i in range(len(v)):
    #  st += "%2.2x"%(ord(v[i]))
    #print st
    c1 = v[0]
    c2 = v[1]
    if (c1 != 0xff) or (c2 != 0x0d):
      if debug:
          print ("sync lost, exit")
      sync = False
    else:
      timer = (v[2] << 32)
      timer += (v[3] << 16)
      timer += (v[4] << 8)
      timer += v[5]
      sensLeft = v[6]
      sensRight= v[7]
      posLeft = v[8] << 8
      posLeft += v[9]
      posRight = v[10] << 8
      posRight += v[11]
      voltLeft = v[12] << 8
      voltLeft += v[13]
      voltRight = v[14] << 8
      voltRight += v[15]
      c3 = v[16]
      stc3 = "%2.2X"%(c3)
      data.append(timer)
      data.append(sensLeft)
      data.append(sensRight)
      data.append(posLeft)
      data.append(posRight)
      data.append(voltLeft)
      data.append(voltRight)
      if debug:
          print (timer,sensLeft,sensRight,posLeft,posRight,voltLeft,voltRight,stc3)
    return sync,data

    
