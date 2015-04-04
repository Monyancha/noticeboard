package me.aksalj.utils;

import android.content.Context;
import android.content.pm.PackageInfo;
import android.content.pm.PackageManager;
import android.content.res.Configuration;
import android.os.Build;
import android.telephony.TelephonyManager;

import java.io.File;

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

    public static boolean isChromeOS() {
        return false; //Build.BRAND.equalsIgnoreCase("chromium") && Build.MANUFACTURER.equalsIgnoreCase("chromium");
    }

    public static long cacheSize(Context context) {
        File cacheDirectory = context.getCacheDir();
        long size = 0;
        File[] files = cacheDirectory.listFiles();
        for (File f:files) {
            size = size+f.length();
        }
        return size;
    }

    public static String cacheSizeInBytes(Context context) {
        return String.format("%d Bytes", DeviceHelper.cacheSize(context));
    }

    public static String cacheSizeInMB(Context context) {
        return String.format("%.2f MB", DeviceHelper.cacheSize(context) / 1024.0f / 1024.0f);
    }

    public static void clearCache(final Context context, final Runnable callback) {

        new Thread(new Runnable() {
            @Override
            public void run() {
                File dir = context.getCacheDir();
                if (dir != null && dir.isDirectory()) {
                    deleteDir(dir);
                }

                callback.run();
            }
        }).start();
    }

    public static boolean deleteDir(File dir) {
        if (dir != null && dir.isDirectory()) {
            String[] children = dir.list();
            for (int i = 0; i < children.length; i++) {
                boolean success = deleteDir(new File(dir, children[i]));
                if (!success) {
                    return false;
                }
            }
        }
        return dir.delete();
    }
}
