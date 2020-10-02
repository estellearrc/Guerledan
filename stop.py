
import serial
import time
import signal
import sys

def signal_handler(sig, frame):
    print('You pressed Ctrl+C!')
    serial_arduino = serial.Serial('/dev/ttyACM0',115200,timeout=1.0)
    data_arduino = send_arduino_cmd_motor(serial_arduino,0,0)
    sys.exit(0)


def init_arduino_line():
    arduino = serial.Serial('/dev/ttyACM0',115200,timeout=1.0)
    #arduino = serial.Serial('/dev/ttyACM1',115200,timeout=1.0)
    time.sleep(1.0) # wait for arduino serial line to me ready ...
    data = arduino.readline()
    print data
    #arduino.close()
    return arduino,data

def clip_cmd (cmd,cmdmax):
    if cmd > cmdmax:
        cmd = cmdmax
    if cmd < -cmdmax:
        cmd = -cmdmax
    return int(round(cmd))

def send_arduino_cmd_motor(arduino,cmdl0,cmdr0):
    cmdl = -cmdl0
    cmdr = -cmdr0
    dirl = ' '
    if cmdl < 0:     
        dirl = '-'
    dirr = ' '
    if cmdr < 0:
        dirr = '-'    
    strcmd = "M%c%3.3d%c%3.3d;"%(dirl,abs(cmdl),dirr,abs(cmdr))
    print strcmd
    #arduino.open()
    arduino.write(strcmd)
    #arduino.close()

def get_arduino_status(arduino,timeout):
    strcmd = "P;"
    #arduino.open()
    arduino.write(strcmd)
    t0 = time.time()
    while True:
        data = arduino.readline()
        if data:
            #print data.rstrip('\n')
            break
        if (time.time()-t0) > timeout:
            break
    #arduino.close()
    return data

def get_arduino_decode_cmd (arduino,timeout):
    strcmd = "D;"
    #arduino.open()
    arduino.write(strcmd)
    t0 = time.time()
    while True:
        data = arduino.readline()
        if data:
            #print data.rstrip('\n')
            break
        if (time.time()-t0) > timeout:
            break
    #arduino.close()
    return data

serial_arduino, data_arduino = init_arduino_line()
data_arduino = send_arduino_cmd_motor(serial_arduino,0,0)
