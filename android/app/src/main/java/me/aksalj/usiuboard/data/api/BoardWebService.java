package me.aksalj.usiuboard.data.api;

import java.io.InputStream;
import java.util.ArrayList;

import me.aksalj.usiuboard.data.BoardFeed;
import retrofit.Callback;
import retrofit.http.Field;
import retrofit.http.FormUrlEncoded;
import retrofit.http.GET;
import retrofit.http.POST;
import retrofit.http.Path;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.usiuboard.data.api.BoardWebService
 * Date : Feb, 04 2015 4:21 PM
 * Description :
 */
public interface BoardWebService {

    public static final String ENDPOINT = "http://usiu.aksalj.me";
    public static final String ENDPOINT_DEBUG = "http://board.usiu.local";

    @GET("/api/feeds")
    public ArrayList<BoardFeed> getFeeds();

    @GET("/api/feed/{slug}")
    public InputStream getRSS(@Path("slug") String feedSlug);

    @FormUrlEncoded
    @POST("/api/register")
    public Object register(@Field("uuid") String gcmId, @Field("phone") String phoneNumber, @Field("type") String type);

    @FormUrlEncoded
    @POST("/api/unregister")
    public Object unregister(@Field("uuid") String gcmId);
}
