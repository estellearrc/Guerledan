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

def turn_around_pool():
    ax=init_figure(-5,60,-5,60)
    coords_wall = array([[-6,-6],[40,50]])
    dt = 0.1
    X= array([[0],[0],[0],[20]])
    u = array([[255],[255]]) #motor velocity
    for t in arange(0,10,dt):
        clear(ax)
        draw_box(ax,-5,40,-5,50,"cyan") #draw pool
        if dectection_choc(X,coords_wall):
            u = array([[0],[0]]) #motor velocity
        else:
            u = array([[255],[255]]) #motor velocity
        X = X + dt*f(X,u) 
        draw_tank(X) #draw boat
        pause(0.01)


def creation_pool(coords_wall):
    wall_x = []
    for i in range(coords_wall[0,0],coords_wall[1,0]):
        wall_x.append(i)
    wall_y = []
    for i in range(coords_wall[0,1],coords_wall[1,1]):
        wall_y.append(i)
    return wall_y,wall_x


def dectection_choc(X,coords_wall):
    wall_y,wall_x = creation_pool(coords_wall)
    a = meshgrid(wall_x,wall_y)
    print(a)
    if X[0,0] in wall_x:
        return 1
    if X[1,0] in wall_y:
        return 1
    return 0

def simul():
    ax=init_figure(-5,60,-5,60)
    u = array([[255],[255]]) #motor velocity
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
    turn_around_pool()    