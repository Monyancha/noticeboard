package me.aksalj.usiuboard.data.gcm;

import android.app.IntentService;
import android.app.Notification;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.content.Context;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.drawable.BitmapDrawable;
import android.os.Bundle;
import android.support.v4.app.NotificationCompat;
import android.util.Log;

import com.google.android.gms.gcm.GoogleCloudMessaging;

import java.util.Random;

import me.aksalj.usiuboard.R;
import me.aksalj.usiuboard.activity.MainActivity;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.usiuboard.data.gcm.GcmIntentService
 * Date : Feb, 08 2015 11:21 AM
 * Description :
 * See https://developer.android.com/google/gcm/client.html
 */
public class GcmIntentService extends IntentService {

    public static final String PUSH_KEY_ID = "id";
    public static final String PUSH_KEY_TITLE = "title";
    public static final String PUSH_KEY_CONTENT = "content";
    public static final String PUSH_KEY_IMAGE = "image";

    public GcmIntentService() {
        super("GcmIntentService");
    }

    @Override
    protected void onHandleIntent(Intent intent) {

        Bundle extras = intent.getExtras();
        GoogleCloudMessaging gcm = GoogleCloudMessaging.getInstance(this);

        String messageType = gcm.getMessageType(intent);

        if (!extras.isEmpty()) {

            if (GoogleCloudMessaging.
                    MESSAGE_TYPE_SEND_ERROR.equals(messageType)) {
                Log.e("GCM", extras.toString());

            } else if (GoogleCloudMessaging.
                    MESSAGE_TYPE_DELETED.equals(messageType)) {
                Log.e("GCM", extras.toString());

                // If it's a regular GCM message, do some work
            } else if (GoogleCloudMessaging.
                    MESSAGE_TYPE_MESSAGE.equals(messageType)) {

                // Post notification of received message.
                showNotification(extras.getString(PUSH_KEY_ID), extras.getString(PUSH_KEY_TITLE),
                        extras.getString(PUSH_KEY_CONTENT), extras.getString(PUSH_KEY_IMAGE));
            }
        }

        // Release the wake lock provided by the WakefulBroadcastReceiver.
        GcmBroadcastReceiver.completeWakefulIntent(intent);
    }

    private void showNotification(String id, String title, String message, String image) {
        NotificationManager mNotificationManager = (NotificationManager)
                this.getSystemService(Context.NOTIFICATION_SERVICE);

        Intent intent = new Intent(this, MainActivity.class);
        intent.putExtra("NotifItem", id); // So that item detail can be opened?
        PendingIntent contentIntent = PendingIntent.getActivity(this, 0, intent, 0);

        NotificationCompat.Builder mBuilder =
                new NotificationCompat.Builder(this)
                        .setSmallIcon(R.drawable.ic_launcher)
                        .setDefaults(Notification.DEFAULT_ALL)
                        .setOnlyAlertOnce(true)
                        .setAutoCancel(true)
                        .setContentTitle(title)
                        .setContentText(message);

        // TODO: Add Big Picture Notification Style
        NotificationCompat.Style style = null;
        //if(image != null) {
        //    style = new NotificationCompat.BigPictureStyle();
        //} else {
            style = new NotificationCompat.BigTextStyle();
            ((NotificationCompat.BigTextStyle) style).setBigContentTitle(title);
            ((NotificationCompat.BigTextStyle) style).bigText(message);
        //}

        mBuilder.setStyle(style);

        mBuilder.addAction (0, "Open", contentIntent);
        mBuilder.addAction (0, "Dismiss", null);
        mBuilder.setContentIntent(contentIntent);
        mNotificationManager.notify(new Random().nextInt(), mBuilder.build());
    }
}
