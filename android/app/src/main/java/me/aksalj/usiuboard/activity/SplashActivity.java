package me.aksalj.usiuboard.activity;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.support.v7.app.ActionBarActivity;
import android.util.Log;
import android.widget.ImageView;
import android.widget.Toast;

import com.google.android.gms.gcm.GoogleCloudMessaging;

import butterknife.ButterKnife;
import butterknife.InjectView;
import me.aksalj.usiuboard.R;
import me.aksalj.usiuboard.data.Manager;
import me.aksalj.usiuboard.data.gcm.GCMHelper;
import me.aksalj.usiuboard.data.iface.ICallback;
import me.aksalj.usiuboard.data.iface.IResultCallback;
import me.aksalj.utils.DialogHelper;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.usiuboard.activity.SplashActivity
 * Date : Feb, 05 2015 12:03 PM
 * Description :
 */
public class SplashActivity extends ActionBarActivity {

    private String mRegId;
    private int mRegAttempts = 5;


    @InjectView(R.id.image)
    ImageView mImage;


    IResultCallback<String> mGcmRegistrationCallback = new IResultCallback<String>() {

        @Override
        public void onResult(String regId) {
            mRegId = regId;
            startSplashWork();
        }

        @Override
        public void onError(String message) {
            if (GoogleCloudMessaging.ERROR_SERVICE_NOT_AVAILABLE.contentEquals(message)) {
                if(mRegAttempts <= 0) {
                    Toast.makeText(SplashActivity.this, R.string.check_network, Toast.LENGTH_LONG).show();
                    finish();
                } else {
                    mRegAttempts--;
                    GCMHelper.registerInBackground(SplashActivity.this, mGcmRegistrationCallback);
                }
            } else {
                Log.e("Splash", message);
                Toast.makeText(SplashActivity.this, R.string.server_error, Toast.LENGTH_LONG).show();
                finish();
            }
        }

    };

    Runnable mInitGCMRegistrations = new Runnable() {
        @Override
        public void run() {

            // Check device for Play Services APK.
            if (GCMHelper.checkPlayServices(SplashActivity.this)) {

                // TODO: Register if first time load
                mRegId = GCMHelper.getRegistrationId(SplashActivity.this);

                if (mRegId.isEmpty()) {
                    GCMHelper.registerInBackground(SplashActivity.this, mGcmRegistrationCallback);
                } else {
                    startSplashWork();
                }

            } else {
                // prompt user to get valid Play Services APK.
                Toast.makeText(SplashActivity.this, R.string.check_play_services, Toast.LENGTH_LONG).show();
                finish();
            }
        }
    };

    Runnable mInitSplashWork = new Runnable() {
        @Override
        public void run() {
            startSplashWork();
        }
    };

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);

        ButterKnife.inject(this);

        if(SettingsActivity.isFirstLaunch(this)) {
            // TODO: Show TOS?


            // TODO: Ask for permission to notify
            new Handler().postDelayed(new Runnable() {
                @Override
                public void run() {
                    DialogHelper.questionDialog(SplashActivity.this,
                            getString(R.string.notifications),
                            getString(R.string.notifs_questions_),
                            new Runnable() {
                                @Override
                                public void run() {
                                    SettingsActivity.allowNotifications(SplashActivity.this, true, true);
                                    mInitGCMRegistrations.run();
                                }
                            }, mInitSplashWork);
                }
            }, 3000);

        } else if(SettingsActivity.notificationsAllowed(this)) {
            // FIXME: Must register gcm only, phone only or both!!
            mInitGCMRegistrations.run();
        } else {
            mInitSplashWork.run();
        }

    }


    // You need to do the Play Services APK check here too.
    @Override
    protected void onResume() {
        super.onResume();
        GCMHelper.checkPlayServices(this);
    }


    private void startSplashWork() {
        // TODO: Load categories then start main activity
        Manager.getInstance().fetchFeeds(new ICallback() {
            @Override
            public void onSuccess() {
                // TODO: Animate image bg (USIU blue) to fill activity before close
                startActivity(new Intent(SplashActivity.this, MainActivity.class));
                finish();
            }

            @Override
            public void onProgress(float percent) { }

            @Override
            public void onError(String message) {
                Toast.makeText(SplashActivity.this, R.string.check_network, Toast.LENGTH_LONG).show();
                finish();
            }
        });
    }

}
