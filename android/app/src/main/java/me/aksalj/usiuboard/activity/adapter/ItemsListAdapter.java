package me.aksalj.usiuboard.activity.adapter;

import android.content.Context;
import android.text.Html;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.squareup.picasso.Callback;
import com.squareup.picasso.Picasso;

import java.util.ArrayList;
import java.util.List;

import butterknife.ButterKnife;
import butterknife.InjectView;
import me.aksalj.usiuboard.R;
import me.aksalj.usiuboard.data.BoardItem;
import me.aksalj.usiuboard.data.Manager;
import me.aksalj.usiuboard.data.iface.ICallback;
import me.aksalj.utils.ImageViewHelper;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.usiuboard.activity.adapter.ItemsListAdapter
 * Date : Feb, 04 2015 3:16 PM
 * Description :
 */
public class ItemsListAdapter extends BaseAdapter {

    private Context mCxt;
    private Manager mManager;
    private int mFeed;

    private int mScrollUpAnim = R.anim.up_from_bottom; // G+ Style anim by default
    private int mScrollDownAnim = R.anim.down_from_top;
    private int mLastPosition = -1;


    public ItemsListAdapter(Context cxt, int feed) {
        mCxt = cxt;
        mManager = Manager.getInstance();
        mFeed = feed;
    }

    public void setAnimations(int scrollUpAnim, int scrollDownAnim) {
        mScrollUpAnim = scrollUpAnim;
        mScrollDownAnim = scrollDownAnim;
    }

    /**
     * Refresh data
     *
     * @param callback
     */
    public void refreshData(ICallback callback) {
        refreshData(mFeed, callback);
    }

    /**
     * Refresh category data
     *
     * @param feed
     * @param callback
     */
    public void refreshData(int feed, final ICallback callback) {
        mFeed = feed;

        mManager.fetchItems(mFeed, new ICallback() {
            @Override
            public void onSuccess() {
                notifyDataSetChanged();
                callback.onSuccess();
            }

            @Override
            public void onProgress(float percent) {
                callback.onProgress(percent);
            }

            @Override
            public void onError(String message) {
                callback.onError(message);
            }
        });


    }

    public int getFeedId() {
        return mFeed;
    }


    @Override
    public int getCount() {
        return mManager.countItems(mFeed);
    }

    @Override
    public Object getItem(int position) {
        return mManager.getItem(mFeed, position);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(final int position, View convertView, ViewGroup parent) {
        final ViewHolder holder;

        if (convertView == null) {
            convertView = LayoutInflater.from(mCxt).inflate(R.layout.item_card, null);
            holder = new ViewHolder(convertView);
            convertView.setTag(holder);
        } else {
            holder = (ViewHolder) convertView.getTag();
        }

        final BoardItem item = (BoardItem) getItem(position);
        if (item != null) { // FIXME: Scroll when list just about to finish update is causing null exception

            Picasso.with(mCxt)
                    .load(item.imageUrl)
                    .placeholder(R.drawable.ic_launcher)
                            //.error(R.drawable.ic_launcher)
                    .into(holder.image, new Callback() {
                        @Override
                        public void onSuccess() {
                            holder.image.setVisibility(View.VISIBLE);

                            if (item.read) {
                                ImageViewHelper.setBlackAndWhite(holder.image);
                            }
                        }

                        @Override
                        public void onError() {
                            holder.image.setVisibility(View.GONE);
                        }
                    });


            holder.title.setText(item.title);
            String str = item.summary;
            if (str.isEmpty()) {
                str = item.content;
            }
            holder.content.setText(Html.fromHtml(str)); // Assume html
            holder.source.setText(item.source);
            holder.date.setText(item.date);
        }

        // Animation
        Animation animation = AnimationUtils.loadAnimation(mCxt,
                (position > mLastPosition) ? mScrollUpAnim : mScrollDownAnim);
        convertView.startAnimation(animation);
        mLastPosition = position;

        return convertView;
    }

    public static class ViewHolder {

        @InjectView(R.id.image)
        public ImageView image;

        @InjectView(R.id.title)
        public TextView title;

        @InjectView(R.id.content)
        public TextView content;

        @InjectView(R.id.source)
        public TextView source;

        @InjectView(R.id.date)
        public TextView date;

        ViewHolder(View root) {
            ButterKnife.inject(this, root);
        }


    }

}