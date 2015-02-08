package me.aksalj.usiuboard.activity;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.support.v7.app.ActionBarActivity;
import android.widget.Toast;

import me.aksalj.usiuboard.R;
import me.aksalj.usiuboard.data.Manager;
import me.aksalj.usiuboard.data.gcm.GCMHelper;
import me.aksalj.usiuboard.data.iface.ICallback;
import me.aksalj.usiuboard.data.iface.IResultCallback;

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

    String mRegId;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);


        // TODO: Show TOS?


        // Check device for Play Services APK.
        if (GCMHelper.checkPlayServices(this)) {

            // TODO: Register if first time load
            mRegId = GCMHelper.getRegistrationId(this);

            if (mRegId.isEmpty()) {
                GCMHelper.registerInBackground(this, new IResultCallback<String>() {
                    @Override
                    public void onResult(String regId) {
                        mRegId = regId;
                        startSplashWork();
                    }

                    @Override
                    public void onError(String message) {
                        Toast.makeText(SplashActivity.this, message, Toast.LENGTH_LONG).show();
                        finish();
                    }
                });
            } else {
                startSplashWork();
            }


        } else {
            // prompt user to get valid Play Services APK.
            Toast.makeText(SplashActivity.this, "Get valid Play Services APK!!", Toast.LENGTH_LONG).show();
            finish();
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
                startActivity(new Intent(SplashActivity.this, MainActivity.class));
                finish();
            }

            @Override
            public void onProgress(float percent) { }

            @Override
            public void onError(String message) {
                Toast.makeText(SplashActivity.this, message, Toast.LENGTH_LONG).show();
                finish();
            }
        });



    }

}
