package me.aksalj.usiuboard.data;

import android.content.Context;

import java.util.ArrayList;
import java.util.HashMap;

import me.aksalj.usiuboard.data.iface.ICallback;
import me.aksalj.usiuboard.data.iface.IResultCallback;
import me.aksalj.usiuboard.data.worker.FeedItemsFetcher;
import me.aksalj.usiuboard.data.worker.FeedsFetcher;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.usiuboard.data.Manager
 * Date : Feb, 04 2015 1:57 PM
 * Description :
 */
public class Manager {
    private static Manager sInstance;

    private Context mCxt;

    private ArrayList<BoardFeed> mFeeds;
    private HashMap<Integer, ArrayList<BoardItem>> mFeedsItems = new HashMap<>();


    public static Manager getInstance() {
        if (sInstance == null) {
            throw new IllegalStateException("Manager needs to be init!");
        }

        return sInstance;
    }

    public static boolean init(Context cxt) {
        sInstance = new Manager(cxt);
        return true;
    }

    private Manager(Context cxt) {
        mCxt = cxt;
    }

    public BoardFeed getFeed(int feedId) {
        for(BoardFeed feed:mFeeds) {
            if(feed.id == feedId) return feed;
        }

        return null;
    }

    public int countItems(int feedId) {
        if (mFeedsItems.containsKey(feedId)) {
            return mFeedsItems.get(feedId).size();
        }
        return 0;
    }

    public BoardItem getItem(int feed, int positionInFeed) {

        if (mFeedsItems.containsKey(feed)) {
            return mFeedsItems.get(feed).get(positionInFeed); // HUH!!!
        }

        return null;

    }

    public BoardItem getItem(String id) {
        for (Integer integer : mFeedsItems.keySet()) {
            ArrayList<BoardItem> next = mFeedsItems.get(integer);
            for (BoardItem item : next) {
                if (item.id.contentEquals(id)) return item;
            }
        }
        return null;
    }

    public void fetchItems(final int feedId, final ICallback callback) {

        BoardFeed feed = getFeed(feedId);
        if(feed != null) {

            new FeedItemsFetcher("", new IResultCallback<ArrayList<BoardItem>>() {
                @Override
                public void onResult(ArrayList<BoardItem> result) {
                    mFeedsItems.put(feedId, result);
                    callback.onSuccess();
                }

                @Override
                public void onError(String message) {
                    callback.onError(message);
                }
            }).execute();
        } else {
            callback.onError("Feed not found");
        }
    }

    public void fetchFeeds(final ICallback callback) {
        new FeedsFetcher(new IResultCallback<ArrayList<BoardFeed>>() {
            @Override
            public void onResult(ArrayList<BoardFeed> result) {
                mFeeds = result;
                callback.onSuccess();
            }

            @Override
            public void onError(String message) {
                callback.onError(message);
            }
        }).execute();

    }



}
