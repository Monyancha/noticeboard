package me.aksalj.usiuboard.activity;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceActivity;

import me.aksalj.usiuboard.R;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.usiuboard.activity.SettingsActivity
 * Date : Feb, 20 2015 10:36 AM
 * Description :
 */
public class SettingsActivity extends PreferenceActivity {

    public static String APP_PREF = "app_prefs";
    public static String PREF_FIRST_LAUNCH = "fl";
    public static String PREF_GCM_NOTIFICATIONS = "gcm_notifs";
    public static String PREF_PHONE_NOTIFICATIONS = "phone_notifs";


    /**
     *
     * @param cxt
     * @return
     */
    public static boolean isFirstLaunch(Context cxt) {
        SharedPreferences pref = cxt.getSharedPreferences(APP_PREF, Context.MODE_PRIVATE);
        boolean fl = pref.getBoolean(PREF_FIRST_LAUNCH, true);
        if(fl) {
            pref.edit().putBoolean(PREF_FIRST_LAUNCH, false).apply();
        }
        return fl;
    }

    /**
     *
     * @param cxt
     * @return
     */
    public static boolean notificationsAllowed(Context cxt) {
        SharedPreferences pref = cxt.getSharedPreferences(APP_PREF, Context.MODE_PRIVATE);
        return pref.getBoolean(PREF_GCM_NOTIFICATIONS, false) || pref.getBoolean(PREF_PHONE_NOTIFICATIONS, false);
    }

    /**
     *
     * @param cxt
     * @return
     */
    public static boolean phoneNotificationsAllowed(Context cxt) {
        SharedPreferences pref = cxt.getSharedPreferences(APP_PREF, Context.MODE_PRIVATE);
        return pref.getBoolean(PREF_PHONE_NOTIFICATIONS, false);
    }

    /**
     *
     * @param cxt
     * @return
     */
    public static boolean gcmNotificationsAllowed(Context cxt) {
        SharedPreferences pref = cxt.getSharedPreferences(APP_PREF, Context.MODE_PRIVATE);
        return pref.getBoolean(PREF_GCM_NOTIFICATIONS, false);
    }


    /**
     * Save notification preferences. Must register if allowed and not registered ;)
     * @param cxt
     * @param phone
     * @param gcm
     */
    public static void allowNotifications(Context cxt, boolean phone, boolean gcm) {
        SharedPreferences pref = cxt.getSharedPreferences(APP_PREF, Context.MODE_PRIVATE);
        pref
            .edit()
                .putBoolean(PREF_GCM_NOTIFICATIONS, gcm)
                .putBoolean(PREF_PHONE_NOTIFICATIONS, phone)
            .apply();
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        addPreferencesFromResource(R.xml.settings);
    }


}
