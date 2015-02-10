package me.aksalj.usiuboard.activity;

import android.app.Activity;
import android.content.Intent;
import android.content.pm.ActivityInfo;
import android.os.Bundle;
import android.support.v4.app.ActivityCompat;
import android.support.v4.app.ActivityOptionsCompat;
import android.support.v4.view.ViewCompat;
import android.support.v7.app.ActionBar;
import android.support.v7.app.ActionBarActivity;
import android.support.v7.widget.Toolbar;
import android.text.Html;
import android.text.method.LinkMovementMethod;
import android.view.MenuItem;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;

import com.nirhart.parallaxscroll.views.ParallaxScrollView;
import com.squareup.picasso.Picasso;

import butterknife.ButterKnife;
import butterknife.InjectView;
import butterknife.OnClick;
import me.aksalj.usiuboard.R;
import me.aksalj.usiuboard.data.BoardItem;
import me.aksalj.usiuboard.data.Manager;
import me.aksalj.utils.DeviceHelper;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.usiuboard.activity.DetailActivity
 * Date : Feb, 04 2015 3:18 PM
 * Description :
 */
public class DetailActivity extends ActionBarActivity {

    public static final String EXTRA_ITEM_ID = "ItemDetail:id";
    public static final String EXTRA_TRANSITION_IMAGE = "ItemDetail:img";

    @InjectView(R.id.scrollView)
    ParallaxScrollView mScrollView;

    @InjectView(R.id.toolbar)
    Toolbar mToolbar;

    @InjectView(R.id.image)
    ImageView mImage;

    @InjectView(R.id.title)
    TextView mTitle;

    @InjectView(R.id.date)
    TextView mDate;

    @InjectView(R.id.content)
    TextView mContent;

    @InjectView(R.id.source)
    TextView mSource;

    BoardItem mItem;

    @Override
    public void onCreate(Bundle savedInstanceState) {

        if(DeviceHelper.isTablet(this)) {
            setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_LANDSCAPE);
        }

        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_detail);

        ButterKnife.inject(this);

        Intent intent = getIntent();

        mItem = Manager.getInstance().getItem(intent.getStringExtra(EXTRA_ITEM_ID));

        ViewCompat.setTransitionName(mImage, EXTRA_TRANSITION_IMAGE);

        setupActionBar();
        setContent();

    }

    private void setupActionBar(){
        setSupportActionBar(mToolbar);
        ActionBar bar = getSupportActionBar();
        bar.setDisplayHomeAsUpEnabled(true);
    }

    private void setContent() {

        Picasso.with(this)
                //.placeholder(R.drawable.newsy_placeholder)
                .load(mItem.imageUrl)
                .into(mImage);

        mTitle.setText(mItem.title);
        mDate.setText(mItem.date);
        mSource.setText(mItem.source);

        String content = mItem.content;
        if(content == null || content.isEmpty()) content = mItem.summary;
        if(content == null || content.isEmpty()) content = getString(R.string.no_content);

        mContent.setText(Html.fromHtml(content));
        mContent.setMovementMethod(LinkMovementMethod.getInstance()); // Follow anchor tags


    }

    @OnClick(R.id.image)
    public void viewImage() {
        ImageActivity.launch(this, mImage, mItem);
    }


    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case android.R.id.home:
                finish();
                break;
        }

        return super.onOptionsItemSelected(item);
    }

    public static void launch(Activity activity, View transitionView, BoardItem item) {
        ActivityOptionsCompat options = ActivityOptionsCompat.makeSceneTransitionAnimation(
                activity, transitionView, EXTRA_TRANSITION_IMAGE);
        Intent intent = new Intent(activity, DetailActivity.class);
        intent.putExtra(EXTRA_ITEM_ID, item.id);
        ActivityCompat.startActivity(activity, intent, options.toBundle());
    }

}
