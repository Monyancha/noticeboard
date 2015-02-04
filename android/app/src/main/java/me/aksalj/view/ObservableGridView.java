package me.aksalj.view;

import android.content.Context;
import android.util.AttributeSet;
import android.view.View;
import android.widget.AbsListView;
import android.widget.GridView;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.view.ObservableGridView
 * Date : Feb, 04 2015 1:51 PM
 * Description :
 */
public class ObservableGridView extends GridView implements ObservableScrollingView, AbsListView.OnScrollListener {

    int listTopPadding = 0;

    public ObservableGridView(Context context) {
        super(context);
        init();
    }

    public ObservableGridView(Context context, AttributeSet attrs) {
        super(context, attrs);
        init();
    }

    public ObservableGridView(Context context, AttributeSet attrs, int defStyleAttr) {
        super(context, attrs, defStyleAttr);
        init();
    }

    public ObservableGridView(Context context, AttributeSet attrs, int defStyleAttr, int defStyleRes) {
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
        View firstChild = getChildAt(0);
        if(firstChild != null) {
            int scrollY = (- firstChild.getTop() + getFirstVisiblePosition() * firstChild.getHeight());
            scrollY += listTopPadding;
            for (IScrollCallback c : mCallbacks) {
                c.onScrollChanged(getScrollX(), scrollY, 0, 0);
            }
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