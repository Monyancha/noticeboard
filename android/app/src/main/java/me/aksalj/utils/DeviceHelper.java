package me.aksalj.utils;

import android.content.Context;
import android.content.res.Configuration;
import android.os.Build;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.utils.DeviceHelper
 * Date : Feb, 04 2015 1:45 PM
 * Description :
 */
public class DeviceHelper {

    public static int getSdkVersion() {
        return Build.VERSION.SDK_INT;
    }


    public static boolean isTablet(Context cxt) {
        return (cxt.getResources().getConfiguration().screenLayout
                & Configuration.SCREENLAYOUT_SIZE_MASK)
                >= Configuration.SCREENLAYOUT_SIZE_LARGE;
    }

    public static boolean isLandscape(Context cxt) {
        return cxt.getResources().getConfiguration().orientation == Configuration.ORIENTATION_LANDSCAPE;
    }

    public static boolean isPortrait(Context cxt) {
        return cxt.getResources().getConfiguration().orientation == Configuration.ORIENTATION_PORTRAIT;
    }
}
