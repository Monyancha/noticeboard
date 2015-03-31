package me.aksalj.usiuboard.activity;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.os.Handler;
import android.preference.CheckBoxPreference;
import android.preference.Preference;
import android.preference.PreferenceActivity;
import android.util.Log;

import com.squareup.picasso.Picasso;

import me.aksalj.usiuboard.R;
import me.aksalj.utils.DeviceHelper;

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
    public static String PREF_EULA_AGREED = "eula";
    public static String PREF_GCM_NOTIFICATIONS = "gcm_notifs";
    public static String PREF_PHONE_NOTIFICATIONS = "phone_notifs";
    public static String PREF_LIMITED_DATA_CONSUMPTION = "wifi_only";


    Handler mHandler;

    /**
     *
     * @param cxt
     * @return
     */
    public static boolean isFirstLaunch(Context cxt) {
        SharedPreferences pref = cxt.getSharedPreferences(APP_PREF, Context.MODE_PRIVATE);
        return pref.getBoolean(PREF_FIRST_LAUNCH, true);
    }

    /**
     *
     * @param cxt
     */
    public static void hasFirstLaunched(Context cxt) {
        SharedPreferences pref = cxt.getSharedPreferences(APP_PREF, Context.MODE_PRIVATE);
        pref.edit().putBoolean(PREF_FIRST_LAUNCH, false).apply();
    }

    /**
     *
     * @param cxt
     * @return
     */
    public static boolean hasAgreedToEULA(Context cxt) {
        SharedPreferences pref = cxt.getSharedPreferences(APP_PREF, Context.MODE_PRIVATE);
        return pref.getBoolean(PREF_EULA_AGREED, false);
    }

    /**
     *
     * @param cxt
     */
    public static void agreeToEULA(Context cxt) {
        SharedPreferences pref = cxt.getSharedPreferences(APP_PREF, Context.MODE_PRIVATE);
        pref.edit().putBoolean(PREF_EULA_AGREED, true).apply();
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
     *
     * @param cxt
     * @return
     */
    public static boolean dataConsumptionLimited(Context cxt) {
        SharedPreferences pref = cxt.getSharedPreferences(APP_PREF, Context.MODE_PRIVATE);
        return pref.getBoolean(PREF_LIMITED_DATA_CONSUMPTION, false);
    }

    /**
     *
     * @param cxt
     */
    public static void toggleDataConsumption(Context cxt) {
        SharedPreferences pref = cxt.getSharedPreferences(APP_PREF, Context.MODE_PRIVATE);
        pref.edit().putBoolean(PREF_LIMITED_DATA_CONSUMPTION, !dataConsumptionLimited(cxt)).apply();
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

        mHandler = new Handler();

        addPreferencesFromResource(R.xml.settings);


        // notifications
        final CheckBoxPreference notifs = (CheckBoxPreference) findPreference("notifs");
        notifs.setChecked(notificationsAllowed(this));
        notifs.setOnPreferenceChangeListener(new Preference.OnPreferenceChangeListener() {
            @Override
            public boolean onPreferenceChange(Preference preference, Object newValue) {
                boolean allow = (boolean) newValue;

                if(!allow) {
                    allowNotifications(SettingsActivity.this, false, false);
                    // TODO: Unregister device from server
                    fakeWork(notifs, "Unsubscribing from server...", getString(R.string.notifs_statement_));
                } else {
                    allowNotifications(SettingsActivity.this, true, true);
                    // TODO: Register device to server
                    fakeWork(notifs, "Subscribing to notifications from server...", getString(R.string.notifs_statement_));
                }

                return true;
            }
        });

        CheckBoxPreference push = (CheckBoxPreference) findPreference("gcm_notifs");
        push.setChecked(gcmNotificationsAllowed(this));

        CheckBoxPreference phone = (CheckBoxPreference) findPreference("phone_notifs");
        phone.setChecked(phoneNotificationsAllowed(this));
        //phone.setSummary(DeviceHelper.getPhoneNumber(this));


        // Wifi Only
        CheckBoxPreference data = (CheckBoxPreference) findPreference("img_dld");
        data.setChecked(dataConsumptionLimited(this));
        data.setOnPreferenceChangeListener(new Preference.OnPreferenceChangeListener() {
            @Override
            public boolean onPreferenceChange(Preference preference, Object newValue) {
                toggleDataConsumption(SettingsActivity.this);
                return true;
            }
        });


        // cache
        final Preference clearCache = findPreference("cache_clear");
        clearCache.setSummary(DeviceHelper.cacheSizeInMB(this));
        clearCache.setOnPreferenceClickListener(new Preference.OnPreferenceClickListener() {
            @Override
            public boolean onPreferenceClick(Preference preference) {
                clearCache.setSummary("Clearing...");
                DeviceHelper.clearCache(SettingsActivity.this, new Runnable() {
                    @Override
                    public void run() {

                        mHandler.postDelayed(new Runnable() {
                            @Override
                            public void run() {
                                clearCache.setSummary(DeviceHelper.cacheSizeInMB(SettingsActivity.this));
                            }
                        }, 1030);
                    }
                });

                return true;
            }
        });


        // bug report
        // TODO: crashlytics.com

    }

    // FIXME: DELETE ME OHHH
    void fakeWork(final Preference pref, String before, final String after) {
        pref.setSummary(before);
        mHandler.postDelayed(new Runnable() {
            @Override
            public void run() {
                pref.setSummary(after);
            }
        }, 3000);
    }


}
