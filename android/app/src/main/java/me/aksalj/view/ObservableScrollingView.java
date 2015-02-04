package me.aksalj.view;

import java.util.ArrayList;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.view.ObservableScrollingView
 * Date : Feb, 04 2015 1:52 PM
 * Description :
 */
public interface ObservableScrollingView {
    ArrayList<IScrollCallback> mCallbacks = new ArrayList<IScrollCallback>();

    /**
     * Add a scroll callback
     * @param callback
     */
    public void addScrollCallback(IScrollCallback callback);

    /**
     *
     * @param callback
     */
    public void removeScrollCallback(IScrollCallback callback);

}