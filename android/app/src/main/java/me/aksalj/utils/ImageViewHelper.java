package me.aksalj.utils;

import android.graphics.ColorFilter;
import android.graphics.ColorMatrixColorFilter;
import android.widget.ImageView;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.utils.ImageViewHelper
 * Date : Feb, 04 2015 1:46 PM
 * Description :
 */
public class ImageViewHelper {
    private static final float DEFAULT_BRIGHTNESS = 25.0f;

    public static void setBlackAndWhite(ImageView imageView, float brightness){

        float[] colorMatrix = {
                0.33f, 0.33f, 0.33f, 0, brightness, //red
                0.33f, 0.33f, 0.33f, 0, brightness, //green
                0.33f, 0.33f, 0.33f, 0, brightness, //blue
                0, 0, 0, 1, 0    //alpha
        };

        ColorFilter colorFilter = new ColorMatrixColorFilter(colorMatrix);
        imageView.setColorFilter(colorFilter);

    }

    public static void setBlackAndWhite(ImageView imageView){
        setBlackAndWhite(imageView, DEFAULT_BRIGHTNESS);
    }
}
