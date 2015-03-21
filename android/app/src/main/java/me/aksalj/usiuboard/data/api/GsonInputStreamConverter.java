package me.aksalj.usiuboard.data.api;

import com.google.gson.Gson;

import java.io.IOException;
import java.lang.reflect.Type;

import retrofit.converter.ConversionException;
import retrofit.converter.GsonConverter;
import retrofit.mime.TypedInput;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.usiuboard.data.api.GsonInputStreamConverter
 * Date : Mar, 21 2015 6:28 PM
 * Description : Convert json as well as InputStream targets.
 */
public class GsonInputStreamConverter extends GsonConverter {


    public GsonInputStreamConverter() {
        super(new Gson());
    }


    @Override
    public Object fromBody(TypedInput body, Type type) throws ConversionException {

        // can be extended to accept more targets like String
        boolean targetInputStream = String.valueOf(type).contentEquals("class java.io.InputStream");

        if(targetInputStream) {
            try {
                return body.in();
            } catch (IOException e) {
                e.printStackTrace();
                return null;
            }
        }

        return super.fromBody(body, type);
    }
}