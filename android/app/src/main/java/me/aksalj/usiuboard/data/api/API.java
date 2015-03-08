package me.aksalj.usiuboard.data.api;

import me.aksalj.usiuboard.BuildConfig;
import retrofit.RestAdapter;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.usiuboard.data.api.API
 * Date : Feb, 04 2015 4:33 PM
 * Description :
 */
public abstract class API {

    private static BoardWebService sService;


    public static BoardWebService getService() {
        if(sService == null) {
            //String endpoint = BuildConfig.DEBUG ? BoardWebService.ENDPOINT_DEBUG : BoardWebService.ENDPOINT;
            String endpoint = BoardWebService.ENDPOINT;
            RestAdapter restAdapter = new RestAdapter.Builder()
                    .setEndpoint(endpoint)
                    .setLogLevel(RestAdapter.LogLevel.BASIC) // Dev only!!!
                    .build();

            sService = restAdapter.create(BoardWebService.class);
        }
        return sService;
    }
}
