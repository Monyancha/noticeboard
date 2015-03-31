package me.aksalj.view;

import android.app.Dialog;
import android.content.Context;
import android.os.Bundle;

import me.aksalj.usiuboard.R;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.view.AboutDialogView
 * Date : Mar, 31 2015 11:57 AM
 * Description :
 */
public class AboutDialogView extends Dialog {

    private static Context mContext = null;

    public AboutDialogView(Context context) {
        super(context);
        mContext = context;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        setContentView(R.layout.dialog_about);
    }

}