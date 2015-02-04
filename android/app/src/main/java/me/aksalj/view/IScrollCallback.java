package me.aksalj.view;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.view.IScrollCallback
 * Date : Feb, 04 2015 1:49 PM
 * Description :
 */
public interface IScrollCallback {
    public void onScrollChanged(int scrollX, int scrollY, int deltaX, int deltaY);
    public void onBottomReached();
    public void onTopReached();
    public void onOverScroll();
}
