package me.aksalj.usiuboard.data.iface;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.usiuboard.data.iface.ICallback
 * Date : Feb, 04 2015 1:59 PM
 * Description :
 */
public interface ICallback {
    public void onSuccess();
    public void onProgress(float percent);
    public void onError(String message);
}