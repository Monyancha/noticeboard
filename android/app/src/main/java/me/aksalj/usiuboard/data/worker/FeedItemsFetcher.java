package me.aksalj.usiuboard.data.worker;

import android.os.AsyncTask;

import org.mcsoxford.rss.RSSFeed;
import org.mcsoxford.rss.RSSItem;
import org.mcsoxford.rss.RSSReader;

import java.util.ArrayList;
import java.util.Collections;
import java.util.Comparator;
import java.util.List;

import me.aksalj.usiuboard.data.BoardItem;
import me.aksalj.usiuboard.data.iface.IResultCallback;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.usiuboard.data.worker.FeedItemsFetcher
 * Date : Feb, 04 2015 2:09 PM
 * Description :
 */
public class FeedItemsFetcher extends AsyncTask<Void, Void, ArrayList<BoardItem>> {

    private String feedUrl;
    private IResultCallback<ArrayList<BoardItem>> cb;

    private String error = null;

    public FeedItemsFetcher(String feedUrl, IResultCallback<ArrayList<BoardItem>> callback) {
        this.feedUrl = feedUrl;
        cb = callback;
    }


    @Override
    protected void onPostExecute(ArrayList<BoardItem> result) {
        super.onPostExecute(result);

        if (result != null && error == null) {
            cb.onResult(result);
        } else {
            cb.onError(error);
        }
    }

    @Override
    protected ArrayList<BoardItem> doInBackground(Void... params) {

        try {

            RSSReader reader = new RSSReader();
            RSSFeed feed = reader.load(feedUrl);
            String source = feed.getTitle();
            List<RSSItem> items = feed.getItems();

            ArrayList<BoardItem> boardItems = new ArrayList<>();
            for (RSSItem item : items) {
                boardItems.add(new BoardItem(item, source));
            }
            Collections.sort(boardItems, new Comparator<BoardItem>() { // Sort by date
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

            return boardItems;

        } catch (Exception ex) {
            ex.printStackTrace();
            error = ex.getMessage();
        }


        return null;
    }
}