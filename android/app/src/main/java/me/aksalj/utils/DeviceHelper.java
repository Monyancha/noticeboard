package me.aksalj.utils;

import android.content.Context;
import android.content.pm.PackageInfo;
import android.content.pm.PackageManager;
import android.content.res.Configuration;
import android.os.Build;
import android.telephony.TelephonyManager;

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

    public static String getPhoneNumber(Context cxt) {
        TelephonyManager manager = (TelephonyManager)cxt.getSystemService(Context.TELEPHONY_SERVICE);
        return manager.getLine1Number();
    }

    public static int getAppVersion(Context context) {
        try {
            PackageInfo packageInfo = context.getPackageManager()
                    .getPackageInfo(context.getPackageName(), 0);
            return packageInfo.versionCode;
        } catch (PackageManager.NameNotFoundException e) {
            // should never happen
            throw new RuntimeException("Could not get package name: " + e);
        }
    }
}
