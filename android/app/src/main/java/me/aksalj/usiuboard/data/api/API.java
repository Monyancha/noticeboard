package me.aksalj.usiuboard.data.api;

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
            RestAdapter restAdapter = new RestAdapter.Builder()
                    .setEndpoint(BoardWebService.ENDPOINT)
                    .build();

            sService = restAdapter.create(BoardWebService.class);
        }
        return sService;
    }
}
