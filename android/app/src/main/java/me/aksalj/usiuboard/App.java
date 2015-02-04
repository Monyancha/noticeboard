package me.aksalj.usiuboard;

import android.app.Application;

import me.aksalj.usiuboard.data.Manager;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.usiuboard.App
 * Date : Feb, 04 2015 1:56 PM
 * Description :
 */
public class App extends Application {

    @Override
    public void onCreate() {
        super.onCreate();

        Manager.init(this);
    }
}
