import numpy as np
from roblib import *

p1,p2,p3 = 0.714,0.5,0.1    #~pi/4,voir cours, exp


def f(X,u):
    u1,u2 = u.flatten()
    x1,x2,x3,x4 = X.flatten()
    x1dot = x4*np.cos(x3)
    x2dot = x4*np.sin(x3)
    x3dot = p1*(u1-u2)
    x4dot = p2*(u1+u2) - p3*x4*abs(x4)
    return array([[x1dot],[x2dot],[x3dot],[x4dot]])    
    

def compute_command(e):
    M = array([[1, -1], [1, 1]])
    b = array([[sawtooth(e)], [1]])
    M_1 = np.linalg.pinv(M)  # resolution of the system
    u = M_1.dot(b)  # command motor array
    return u

def simul():
    ax=init_figure(-5,60,-5,60)
    u = array([[255],[255]])
    X= array([[0],[0],[0],[20]])
    dt = 0.01
    cap0 = pi/2 #Cap consigne
    for t in arange(0,10,dt):
        clear(ax)
        draw_box(ax,-5,40,-5,50,"cyan") #draw pool
        cap = X[2,0] #Cap réel
        err = cap0 - cap #error
        u = compute_command(err) #new u         
        X = X + dt*f(X,u) 
        draw_tank(X) #draw boat
        pause(0.01)

if __name__ == "__main__":
    simul()    