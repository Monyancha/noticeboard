package me.aksalj.usiuboard.activity;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.ActivityCompat;
import android.support.v4.app.ActivityOptionsCompat;
import android.support.v4.view.ViewCompat;
import android.support.v7.app.ActionBarActivity;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.ImageView;

import com.squareup.picasso.Picasso;

import butterknife.ButterKnife;
import butterknife.InjectView;
import me.aksalj.usiuboard.R;
import me.aksalj.usiuboard.data.BoardItem;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.usiuboard.activity.ImageActivity
 * Date : Feb, 04 2015 3:19 PM
 * Description :
 */
public class ImageActivity extends ActionBarActivity {

    public static final String EXTRA_TRANSITION_IMAGE = "ImageActivity:img";

    @InjectView(R.id.image)
    ImageView mImage;

    @Override
    public void onCreate(Bundle savedInstanceState) {

        supportRequestWindowFeature(Window.FEATURE_NO_TITLE);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);

        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_image);

        ButterKnife.inject(this);

        Intent intent = getIntent();

        ViewCompat.setTransitionName(mImage, EXTRA_TRANSITION_IMAGE);
        Picasso.with(this)
                .load(intent.getStringExtra(EXTRA_TRANSITION_IMAGE))
                        //.centerInside()
                .into(mImage);

    }



    public static void launch(Activity activity, View transitionView, BoardItem item) {
        ActivityOptionsCompat options = ActivityOptionsCompat.makeSceneTransitionAnimation(
                activity, transitionView, EXTRA_TRANSITION_IMAGE);
        Intent intent = new Intent(activity, ImageActivity.class);
        intent.putExtra(EXTRA_TRANSITION_IMAGE, item.imageUrl);
        ActivityCompat.startActivity(activity, intent, options.toBundle());
    }
}