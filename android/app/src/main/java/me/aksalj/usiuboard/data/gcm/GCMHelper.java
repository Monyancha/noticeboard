package me.aksalj.usiuboard.data.gcm;

import android.app.Activity;
import android.content.Context;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.util.Log;

import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.GooglePlayServicesUtil;
import com.google.android.gms.gcm.GoogleCloudMessaging;

import java.io.IOException;

import me.aksalj.usiuboard.data.api.API;
import me.aksalj.usiuboard.data.iface.IResultCallback;
import me.aksalj.utils.DeviceHelper;
import retrofit.Callback;
import retrofit.RetrofitError;
import retrofit.client.Response;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.usiuboard.data.gcm.GCM
 * Date : Feb, 08 2015 11:33 AM
 * Description : GCM Helper
 * See https://developer.android.com/google/gcm/client.html
 */
public abstract class GCMHelper {

    private static final String TAG = "GCMHelper";

    public static final String SENDER_ID = "951069704808"; // Google Project ID

    private final static int PLAY_SERVICES_RESOLUTION_REQUEST = 0x2334;


    private static final String PREF_GCM = "gcmPrefs";
    public static final String PROPERTY_REG_ID = "registration_id";
    private static final String PROPERTY_APP_VERSION = "appVersion";




    /**
     * Check the device to make sure it has the Google Play Services APK. If
     * it doesn't, display a dialog that allows users to download the APK from
     * the Google Play Store or enable it in the device's system settings.
     * @param activity
     * @return boolean
     */
    public static boolean checkPlayServices(Activity activity) {
        int resultCode = GooglePlayServicesUtil.isGooglePlayServicesAvailable(activity);
        if (resultCode != ConnectionResult.SUCCESS) {
            if (GooglePlayServicesUtil.isUserRecoverableError(resultCode)) {
                GooglePlayServicesUtil.getErrorDialog(resultCode, activity,
                        PLAY_SERVICES_RESOLUTION_REQUEST).show();
            } else {
                Log.i(TAG, "This device is not supported.");
                activity.finish();
            }
            return false;
        }
        return true;
    }


    public static String getRegistrationId(Context context) {
        final SharedPreferences prefs = getGCMPreferences(context);
        String registrationId = prefs.getString(PROPERTY_REG_ID, "");
        if (registrationId.isEmpty()) {
            return "";
        }
        // Clear registration for app version update
        int registeredVersion = prefs.getInt(PROPERTY_APP_VERSION, Integer.MIN_VALUE);
        int currentVersion = DeviceHelper.getAppVersion(context);
        if (registeredVersion != currentVersion) {
            return "";
        }
        return registrationId;
    }

    private static boolean saveRegistrationId(Context context, String regId) {
        final SharedPreferences prefs = getGCMPreferences(context);
        int appVersion = DeviceHelper.getAppVersion(context);
        SharedPreferences.Editor editor = prefs.edit();
        editor.putString(PROPERTY_REG_ID, regId);
        editor.putInt(PROPERTY_APP_VERSION, appVersion);
        return editor.commit();
    }

    private static SharedPreferences getGCMPreferences(Context context) {
        return context.getSharedPreferences(PREF_GCM, Context.MODE_PRIVATE);
    }


    public static void registerInBackground(final Context context, final IResultCallback<String> callback) {

        new AsyncTask<Void, String, String>() {
            String error = null;

            @Override
            protected String doInBackground(Void... params) {
                try {
                    GoogleCloudMessaging gcm = GoogleCloudMessaging.getInstance(context);
                    String regId = gcm.register(SENDER_ID);

                    // Send the registration ID to backend
                    API.getService().register(regId, DeviceHelper.getPhoneNumber(context));

                    // Persist the regID - no need to register again.
                    saveRegistrationId(context, regId);

                    return regId;

                } catch (Exception err) {
                    err.printStackTrace();
                    error = err.getMessage();
                }

                return null;
            }

            @Override
            protected void onPostExecute(String regId) {
                if(error != null) {
                    callback.onError(error);
                } else {
                    callback.onResult(regId);
                }
            }
        }.execute(null, null, null);

    }


}
