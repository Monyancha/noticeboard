package me.aksalj.view;

import android.content.Context;
import android.util.AttributeSet;
import android.view.View;
import android.widget.AbsListView;
import android.widget.ListView;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.view.ObservableListView
 * Date : Feb, 04 2015 1:53 PM
 * Description :
 */
public class ObservableListView extends ListView implements AbsListView.OnScrollListener, ObservableScrollingView {

    int listTopPadding = 0;

    public ObservableListView(Context context) {
        super(context);
        init();
    }

    public ObservableListView(Context context, AttributeSet attrs) {
        super(context, attrs);
        init();
    }

    public ObservableListView(Context context, AttributeSet attrs, int defStyleAttr) {
        super(context, attrs, defStyleAttr);
        init();
    }

    public ObservableListView(Context context, AttributeSet attrs, int defStyleAttr, int defStyleRes) {
        super(context, attrs, defStyleAttr, defStyleRes);
        init();
    }

    private void init() {
        setOnScrollListener(this);
        listTopPadding = getPaddingTop();
    }

    @Override
    public void onScrollStateChanged(AbsListView view, int scrollState) { }

    @Override
    public void onScroll(AbsListView view, int firstVisibleItem, int visibleItemCount, int totalItemCount) {
        //Thanks to http://stackoverflow.com/questions/10808387/android-getting-exact-scroll-position-in-listview
        View firstChild = getChildAt(0);
        if(firstChild != null) {
            int scrollY = (- firstChild.getTop() + getFirstVisiblePosition() * firstChild.getHeight());
            scrollY += listTopPadding;

            //View lastChild = getChildAt(getChildCount() - 1);
            boolean isBottom = false;
            /*if(lastChild != null) {
                // if diff is zero, then the bottom has been reached
                int diff = (view.getBottom() - (getHeight() + getScrollY()));
                isBottom = diff == 0;
            }*/

            boolean isTop = false;//firstChild.getTop() == listTopPadding; // FIXME!!


            for (IScrollCallback c : mCallbacks) {
                c.onScrollChanged(getScrollX(), scrollY, 0, 0);
                if(isBottom){ c.onBottomReached(); }
                if(isTop) { c.onTopReached(); }
            }

            // TODO: Detect over scroll
        }

    }

    @Override
    public void addScrollCallback(IScrollCallback callback) {
        if(!mCallbacks.contains(callback)) {
            mCallbacks.add(callback);
        }
    }

    @Override
    public void removeScrollCallback(IScrollCallback callback) {
        if(mCallbacks.contains(callback)) {
            mCallbacks.remove(callback);
        }
    }
}
