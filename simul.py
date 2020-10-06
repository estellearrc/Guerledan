import numpy as np
from roblib import *

p1,p2,p3 = 1,1,2    


def f(X,u):
    u1,u2 = u
    x1,x2,x3,x4 = X.flatten()
    x1dot = x4*np.cos(x3)
    x2dot = x4*np.sin(x3)
    x3dot = p1*(u1-u2)
    x4dot = p2*(u1+u2) - p3*x4*abs(x4)
    return np.array([[x1dot],[x2dot],[x3dot],[x4dot]])    

def draw_boat(X):
    draw_tank(X)


if __name__ == "__main__":
    ax=init_figure(-5,60,-5,60)
    u = [50,50]
    X= array([[0],[0],[45],[50]])
    dt = 0.01
    for t in arange(0,10,dt):
        clear(ax)
        if t>=2:
            print("Coucou je suis a 0"+str(t)+"," +str(X[3,0]))
            u = [0,0]
        draw_box(ax,-5,40,-5,50,"cyan")
        X = X + dt*f(X,u)
        draw_boat(X)
        pause(0.01)