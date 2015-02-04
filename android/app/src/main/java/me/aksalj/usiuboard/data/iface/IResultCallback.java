package me.aksalj.usiuboard.data.iface;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.usiuboard.data.iface.IResultCallback
 * Date : Feb, 04 2015 2:14 PM
 * Description :
 */
public interface IResultCallback<T> {
    public void onResult(T result);
    public void onError(String message);
}
