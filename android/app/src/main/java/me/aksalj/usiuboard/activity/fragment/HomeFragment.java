package me.aksalj.usiuboard.activity.fragment;

import android.content.Context;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v7.app.ActionBar;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.FrameLayout;
import android.widget.ImageView;
import android.widget.Toast;

import butterknife.ButterKnife;
import butterknife.InjectView;
import me.aksalj.usiuboard.R;
import me.aksalj.usiuboard.activity.DetailActivity;
import me.aksalj.usiuboard.activity.MainActivity;
import me.aksalj.usiuboard.activity.adapter.ItemsListAdapter;
import me.aksalj.usiuboard.data.BoardItem;
import me.aksalj.usiuboard.data.Manager;
import me.aksalj.usiuboard.data.iface.ICallback;
import me.aksalj.utils.DeviceHelper;
import me.aksalj.utils.MeasuresHelper;
import me.aksalj.view.IScrollCallback;
import me.aksalj.view.ObservableGridView;
import me.aksalj.view.ObservableListView;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.usiuboard.activity.fragment.HomeFragment
 * Date : Feb, 04 2015 3:14 PM
 * Description :
 */
public class HomeFragment extends BaseFragment implements IScrollCallback,
        AdapterView.OnItemClickListener, AdapterView.OnItemLongClickListener {


    @InjectView(R.id.feature)
    FrameLayout mFeature;

    @InjectView(R.id.featureImage)
    ImageView mFeatureSlides; // TODO: Slide show featured images

    @InjectView(R.id.swipe_container)
    SwipeRefreshLayout mSwipeLayout;

    //@InjectView(R.id.empty_view)
    //LinearLayout mEmptyView;

    ItemsListAdapter mItemsAdapter;
    ICallback mItemsRefreshCallback;

    ActionBar mActionBar;
    int mParallaxRate = 3;
    int mPrimaryColor;


    public static HomeFragment newInstance(Context cxt) {
        HomeFragment instance = new HomeFragment();
        instance.mCxt = cxt;
        return instance;
    }

    @Override
    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View root = inflater.inflate(R.layout.fragment_home, null);

        ButterKnife.inject(this, root);

        return root;
    }

    @Override
    public void onActivityCreated(@Nullable Bundle savedInstanceState) {
        super.onActivityCreated(savedInstanceState);

        mActionBar = ((MainActivity) mActivity).getSupportActionBar();
        mPrimaryColor = mActivity.getResources().getColor(R.color.primary);

        setupItemsAdapter(savedInstanceState);

        setupItemsList();


        if (savedInstanceState == null) { // TODO: Refresh only if first load and not activity recreated
            mSwipeLayout.setRefreshing(true);
            Manager.getInstance().fetchFeeds(new ICallback() {
                @Override
                public void onSuccess() {
                    mItemsAdapter.refreshData(mItemsRefreshCallback);
                }

                @Override
                public void onProgress(float percent) { }

                @Override
                public void onError(String message) {

                }
            });

        }
    }


    private void setupItemsAdapter(Bundle savedInstanceState) {
        int feed = (savedInstanceState == null) ? Manager.DEFAULT_FEED : savedInstanceState.getInt("feed", Manager.DEFAULT_FEED);
        mItemsAdapter = new ItemsListAdapter(mActivity, feed);
        mItemsRefreshCallback = new ICallback() {
            @Override
            public void onSuccess() {
                mSwipeLayout.setRefreshing(false);
            }

            @Override
            public void onProgress(float percent) {

            }

            @Override
            public void onError(String message) {
                Toast.makeText(mActivity, message + "", Toast.LENGTH_SHORT).show();
                mSwipeLayout.setRefreshing(false);
            }
        };
    }

    private void setupItemsList() {

        // Swipe down to refresh
        mSwipeLayout.setEnabled(true);
        mSwipeLayout.setProgressViewOffset(true, MeasuresHelper.dpToPx(mActivity, 5),
                MeasuresHelper.dpToPx(mActivity, 75));
        mSwipeLayout.setSize(SwipeRefreshLayout.LARGE);
        mSwipeLayout.setColorSchemeResources(
                R.color.holo_blue_bright,
                R.color.holo_green_light,
                R.color.holo_orange_light,
                R.color.holo_red_light);

        mSwipeLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                mItemsAdapter.refreshData(mItemsRefreshCallback);
            }
        });

        if (DeviceHelper.isLandscape(mActivity)) {

            mItemsAdapter.setAnimations(android.R.anim.fade_in, android.R.anim.fade_in);

            ObservableGridView grid = (ObservableGridView) mActivity.findViewById(R.id.grid);
            grid.addScrollCallback(this);
            grid.setOnItemClickListener(this);
            grid.setOnItemLongClickListener(this);
            grid.setAdapter(mItemsAdapter);
            //grid.setEmptyView(mEmptyView);

        } else if (DeviceHelper.isPortrait(mActivity)) {
            ObservableListView list = (ObservableListView) mActivity.findViewById(R.id.list);
            list.addScrollCallback(this);
            list.setOnItemClickListener(this);
            list.setOnItemLongClickListener(this);
            list.setAdapter(mItemsAdapter);
            //list.setEmptyView(mEmptyView);
        } else {
            // WTF??
            Log.e("WTF", "Invalid device orientation!");
        }
    }

    @Override
    public void onSaveInstanceState(Bundle outState) {
        super.onSaveInstanceState(outState);
        outState.putInt("feed", mItemsAdapter.getFeedId());
    }

    @Override
    public String getTitle() {
        return mCxt.getString(R.string.app_name);
    }

    @Override
    public String getSubTitle() {
        return null;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {

        return true;
    }

    @Override
    public void onScrollChanged(int scrollX, int scrollY, int deltaX, int deltaY) {

        // inspired by http://flavienlaurent.com/blog/2013/11/20/making-your-action-bar-not-boring/
        final int red = Color.red(mPrimaryColor);
        final int green = Color.green(mPrimaryColor);
        final int blue = Color.blue(mPrimaryColor);

        int alpha = Math.round(MeasuresHelper.clamp((scrollY * 25 / 100), 0.0f, 255.0f));
        //float a = alpha / 255.0f; //TODO: for actionbar TextView
        mActionBar.setBackgroundDrawable(new ColorDrawable(Color.argb(alpha, red, green, blue)));

        mFeature.scrollTo(scrollX, scrollY / mParallaxRate);

        // Swipe refresh active only when list/grid is at 1st item
        if (scrollY == 0) {
            mSwipeLayout.setEnabled(true);
        } else {
            mSwipeLayout.setEnabled(false);
        }
    }

    @Override
    public void onBottomReached() {
    }

    @Override
    public void onTopReached() {
    }

    @Override
    public void onOverScroll() {
    }

    @Override
    public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
        BoardItem item = (BoardItem) mItemsAdapter.getItem(position);

        ImageView transitionView = ((ItemsListAdapter.ViewHolder) view.getTag()).image;
        DetailActivity.launch(mActivity, transitionView, item);


        /*
        FIXME: Messing up who to gray out!!!
        if(!item.read) {
            item.read = true;
            ImageViewHelper.setBlackAndWhite(transitionView);
        }*/

    }

    @Override
    public boolean onItemLongClick(AdapterView<?> parent, View view, int position, long id) {
        return false;
    }
}