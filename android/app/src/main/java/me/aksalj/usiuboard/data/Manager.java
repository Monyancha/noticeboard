package me.aksalj.usiuboard.data;

import android.content.Context;

import java.util.ArrayList;
import java.util.Collections;
import java.util.Comparator;
import java.util.HashMap;
import java.util.Set;

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

    public static final int DEFAULT_FEED = -1;

    private Context mCxt;

    private ArrayList<BoardFeed> mFeeds = new ArrayList<>();
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

    /**
     * Get a feed by position
     * @param position
     * @return
     */
    public BoardFeed getFeed(int position) {
        return mFeeds.get(position);
    }

    /**
     *
     * @param feedId
     * @return
     */
    public BoardFeed getFeedById(int feedId) {
        for (BoardFeed feed:mFeeds) {
            if(feed.id == feedId) return feed;
        }
        return null;
    }

    /**
     *
     * @return
     */
    public int countFeeds() {
        return mFeeds.size();
    }

    /**
     *
     * @param feedId
     * @return
     */
    public int countItems(int feedId) {
        if (mFeedsItems.containsKey(feedId)) {
            return mFeedsItems.get(feedId).size();
        }
        return 0;
    }

    /**
     *
     * @param feed
     * @param positionInFeed
     * @return
     */
    public BoardItem getItem(int feed, int positionInFeed) {
        if (mFeedsItems.containsKey(feed)) {
            return mFeedsItems.get(feed).get(positionInFeed); // HUH!!!
        }
        return null;
    }

    /**
     *
     * @param id
     * @return
     */
    public BoardItem getItem(String id) {
        for (Integer integer : mFeedsItems.keySet()) {
            ArrayList<BoardItem> next = mFeedsItems.get(integer);
            for (BoardItem item : next) {
                if (item.id.contentEquals(id)) return item;
            }
        }
        return null;
    }

    /**
     * Fetch feed items
     * @param feedId
     * @param callback
     */
    public void fetchItems(final int feedId, final ICallback callback) {

        if(feedId == DEFAULT_FEED) {
            fetchItems(callback);
        } else {

            BoardFeed feed = getFeedById(feedId);
            if (feed != null) {

                new FeedItemsFetcher(feed.url, new IResultCallback<ArrayList<BoardItem>>() {
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
    }

    /**
     * Fetch all feeds' items
     * @param callback
     */
    private void fetchItems(final ICallback callback) {
        for(int i = 0; i < mFeeds.size(); i++) {

            final boolean isLastFeed = (i >= (mFeeds.size() - 1));
            final BoardFeed feed = mFeeds.get(i);

            new FeedItemsFetcher(feed.url, new IResultCallback<ArrayList<BoardItem>>() {
                @Override
                public void onResult(ArrayList<BoardItem> result) {
                    mFeedsItems.put(feed.id, result); // Overwrite if already there!

                    if(isLastFeed) {
                        // TODO: Pick every first of every feed to make default feed

                        ArrayList<BoardItem> defaultItems = new ArrayList<BoardItem>();
                        Set<Integer> keys = mFeedsItems.keySet();
                        for (Integer key:keys) {
                            ArrayList<BoardItem> items = mFeedsItems.get(key);
                            if(items.size() > 0) {
                                defaultItems.add(items.get(0));
                            }
                        }

                        Collections.sort(defaultItems, new Comparator<BoardItem>() { // Sort by date
                            @Override
                            public int compare(BoardItem lhs, BoardItem rhs) {
                                if (lhs._date_ms < rhs._date_ms) {
                                    return 1;
                                } else if (lhs._date_ms > rhs._date_ms) {
                                    return -1;
                                } else {
                                    return 0;
                                }
                            }
                        });

                        mFeedsItems.put(DEFAULT_FEED, defaultItems);

                        callback.onSuccess();

                    }
                }

                @Override
                public void onError(String message) {
                    if(isLastFeed) { callback.onError(message); }
                }
            }).execute();
        }
    }

    /**
     * Fetch board feeds
     * @param callback
     */
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
