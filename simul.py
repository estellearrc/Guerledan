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
    ax = init_figure(-5,60,-5,60)
    coords_wall = array([[0,0],[40,50]])
    dt = 0.1
    X = array([[1],[1],[0],[20]])
    u = array([[255],[255]]) #motor velocity
    for t in arange(0,10,dt):
        clear(ax)
        draw_box(ax,-5,40,-5,50,"cyan") #draw pool
        if dectection_choc(X,coords_wall):
            print("Choc mamene !")
            #u = array([[0],[0]]) #motor velocity
            X[3,0] = 0
        else:
            u = array([[255],[255]]) #motor velocity
        X = X + dt*f(X,u) 
        draw_tank(X) #draw boat
        pause(0.01)


def creation_pool(coords_wall):
    size_x = abs(coords_wall[0,0] - coords_wall[1,0])
    size_y = abs(coords_wall[0,1] - coords_wall[1,1])
    wall = zeros((size_x,size_y))
    for i in range(0,size_x):
        wall[i,0] = 1
        wall[i,size_y-1] = 1
    for j in range(0,size_y):
        wall[0,j] = 1
        wall[size_x-1,j] = 1
    return wall


def dectection_choc(X,coords_wall):
    x1,y1,x2,y2 = coords_wall.flatten()
    x1,y1,x2,y2 = x1,y1,x2,y2
    print(x1,x2,y1,y2)
    posx, posy = X[0,0],X[1,0]
    if posx >= x2 or posx <= x1 or posy >= y2 or posy <= y1: 
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
        cap = X[2,0] #Cap ré
        
        
        el
        err = cap0 - cap #error
        u = compute_command(err) #new u         
        X = X + dt*f(X,u) 
        draw_tank(X) #draw boat
        pause(0.01)

if __name__ == "__main__":
    turn_around_pool()    