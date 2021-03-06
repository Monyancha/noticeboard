package me.aksalj.utils;

import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.webkit.WebView;

import me.aksalj.usiuboard.R;
import me.aksalj.usiuboard.activity.SplashActivity;


/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.utils.DialogHelper
 * Date : Feb, 20 2015 10:53 AM
 * Description :
 */
public abstract class DialogHelper {

    /**
     *
     * @param context
     * @param title
     * @param question
     * @param onAnswerYes
     * @param onAnswerNo
     * @return
     */
    public static AlertDialog questionDialog(Context context, String title, String question,
                                      final Runnable onAnswerYes, final Runnable onAnswerNo) {
        AlertDialog.Builder builder = new AlertDialog.Builder(context);
        builder.setMessage(question);
        builder.setTitle(title);
        builder.setPositiveButton("Yes", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                if(onAnswerYes != null) {
                    onAnswerYes.run();
                }
            }
        });

        builder.setNegativeButton("No", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                if(onAnswerNo != null) {
                    onAnswerNo.run();
                }
            }
        });

        return builder.show();
    }

    public static AlertDialog showEULADialog(final SplashActivity mContext, final Runnable onAnswerYes, final Runnable onAnswerNo) {
        AlertDialog.Builder builder = new AlertDialog.Builder(mContext);
        builder.setCancelable(false);
        builder.setTitle(R.string.eula_title);

        WebView view = new WebView(mContext);
        view.loadUrl("file:///android_asset/html/eula.html");
        builder.setView(view);


        builder.setPositiveButton(R.string.agree, new DialogInterface.OnClickListener() {

            @Override
            public void onClick(DialogInterface arg0, int arg1) {
                if(onAnswerYes != null) {
                    onAnswerYes.run();
                }
            }
        });

        builder.setNegativeButton(R.string.no_agree, new DialogInterface.OnClickListener() {

            @Override
            public void onClick(DialogInterface diag, int which) {
                diag.dismiss();
                //Kill app
                if(onAnswerNo != null) {
                    onAnswerNo.run();
                }
            }
        });

        return builder.show();
    }

}
