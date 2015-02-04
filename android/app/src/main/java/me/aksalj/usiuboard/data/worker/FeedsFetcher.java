package me.aksalj.usiuboard.data.worker;

import android.os.AsyncTask;

import java.util.ArrayList;

import me.aksalj.usiuboard.data.BoardFeed;
import me.aksalj.usiuboard.data.api.API;
import me.aksalj.usiuboard.data.iface.IResultCallback;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.usiuboard.data.worker.FeedsFetcher
 * Date : Feb, 04 2015 2:09 PM
 * Description :
 */
public class FeedsFetcher extends AsyncTask<Void, Void, ArrayList<BoardFeed>> {

    IResultCallback<ArrayList<BoardFeed>> cb;
    String error = null;

    public FeedsFetcher(IResultCallback<ArrayList<BoardFeed>> callback) {
        this.cb = callback;
    }

    @Override
    protected void onPostExecute(ArrayList<BoardFeed> boardFeeds) {
        super.onPostExecute(boardFeeds);

        if(boardFeeds != null) {
            cb.onResult(boardFeeds);
        } else {
            cb.onError(error);
        }
    }

    @Override
    protected ArrayList<BoardFeed> doInBackground(Void... params) {
        try {
            return API.getService().getFeeds();
        } catch (Exception ex) {
            ex.printStackTrace();
            error = ex.getMessage();
        }

        return null;
    }
}
