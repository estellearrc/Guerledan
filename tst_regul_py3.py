import time
import encoders_driver_py3 as encodrv
import arduino_driver_py3 as ardudrv
import sys


try:
    spd = int(sys.argv[1])
except:
    pass
try:
    cmdl = int(sys.argv[2])
    cmdr = cmdl
except:
    pass
try:
    cmdr = int(sys.argv[3])
except:
    pass
try:
    duration = float(sys.argv[4])
except:
    pass

# speed control at 150 ticks/s

def delta_odo (odo1,odo0):
    dodo = odo1-odo0
    if dodo > 32767:
        dodo -= 65536
    if dodo < -32767:
        dodo += 65536
    return dodo



def regulation(serial_arduino,spd,cmdl,cmdr):
    tloop = 1.0 # 1 Hz control
    timeout = 1.0
    # cmdl = 40
    # cmdr = 40
    # duration = 20.0
    # spd = 200  # ticks/s
    
    # speed control 

    encodrv.set_baudrate(baudrate=115200)

    # print ("init arduino ...")
    # serial_arduino, data_arduino = ardudrv.init_arduino_line()
    # print ("data:",data_arduino[0:-1])
    ardudrv.send_arduino_cmd_motor(serial_arduino,cmdl,cmdr)
    sync0, timeAcq0, sensLeft0, sensRight0, posLeft0, posRight0 =  encodrv.read_single_packet(debug=False)
    # print ("set motors to L=%d R=%d"%(cmdl,cmdr))
    # ardudrv.send_arduino_cmd_motor(serial_arduino,cmdl,cmdr)
    # print ("loop for {:.1f} seconds ...".format(duration))
    # t0 = time.time()  
    # while (time.time()-t0) < duration:
    time.sleep (tloop)
    # ardudrv.send_arduino_cmd_motor(serial_arduino,cmdl,cmdr)
    sync1, timeAcq1, sensLeft1, sensRight1, posLeft1, posRight1 =  encodrv.read_single_packet(debug=False)
    #print sync1, timeAcq1, sensLeft1, sensRight1, posLeft1, posRight1
    # print ("dTime",timeAcq0,timeAcq1,timeAcq1-timeAcq0)
    # print ("dOdoL",posLeft0,posLeft1,posLeft1-posLeft0)
    # print ("dOdoR",posRight0,posRight1,posRight1-posRight0)

    dOdoL = abs(delta_odo(posLeft1,posLeft0))
    dOdoR = abs(delta_odo(posRight1,posRight0))

    errL = spd-dOdoL
    print("errl",errL)
    errR = spd-dOdoR
    print("eerR",errR)
    kp = 0.1
    cmdl = abs(cmdl + kp*errL)
    cmdr = abs(cmdr + kp*errR)
    if cmdl>255:
        cmdl=255
    if cmdr>255:
        cmdr=255

    print ("set motors to L=%d R=%d"%(cmdl,cmdr))
    ardudrv.send_arduino_cmd_motor(serial_arduino,cmdl,cmdr)

    timeAcq0 = timeAcq1
    posRight0 = posRight1
    posLeft0 = posLeft1
    # print ("set motors to L=0 R=0 ...")
    # cmdl = 0
    # cmdr = 0
    # ardudrv.send_arduino_cmd_motor(serial_arduino,cmdl,cmdr)



