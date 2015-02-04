package me.aksalj.usiuboard.activity.adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import butterknife.ButterKnife;
import butterknife.InjectView;
import me.aksalj.usiuboard.data.BoardFeed;
import me.aksalj.usiuboard.data.Manager;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.usiuboard.activity.adapter.NavigationAdapter
 * Date : Feb, 04 2015 6:04 PM
 * Description :
 */
public class NavigationAdapter extends BaseAdapter {

    Context mCxt;
    Manager mManager;


    public NavigationAdapter(Context cxt) {
        mManager = Manager.getInstance();
        mCxt = cxt;
    }

    @Override
    public int getCount() {
        return mManager.countFeeds();
    }

    @Override
    public Object getItem(int position) {
        return mManager.getFeed(position);
    }

    @Override
    public long getItemId(int position) {
        BoardFeed feed = (BoardFeed) getItem(position);
        return feed.id;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        final ViewHolder holder;

        if (convertView == null) {
            convertView = LayoutInflater.from(mCxt).inflate(android.R.layout.simple_list_item_1, null);
            holder = new ViewHolder(convertView);
            convertView.setTag(holder);
        } else {
            holder = (ViewHolder) convertView.getTag();
        }

        BoardFeed feed = (BoardFeed) getItem(position);
        holder.title.setText(feed.title);
        //holder.description.setText(feed.description);

        return convertView;
    }

    static class ViewHolder {
        @InjectView(android.R.id.text1)
        TextView title;

        //@InjectView(android.R.id.text2)
        //TextView description;

        ViewHolder(View root) {
            ButterKnife.inject(this, root);
        }
    }
}
