package me.aksalj.utils;

import android.content.Context;
import android.content.res.Resources;
import android.util.TypedValue;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.utils.MeasuresHelper
 * Date : Feb, 04 2015 1:46 PM
 * Description :
 */
public class MeasuresHelper {

    public static int dpToPx(Context context, int dp) {
        Resources r = context.getResources();
        return (int) TypedValue.applyDimension(TypedValue.COMPLEX_UNIT_DIP, dp, r.getDisplayMetrics());
    }

    /**
     * In computer graphics, clamping is the process of limiting a position to an area.
     * Unlike wrapping, clamping merely moves the point to the nearest available value.
     * See http://en.wikipedia.org/wiki/Clamping_(graphics)
     * @param value
     * @param max
     * @param min
     * @return
     */
    public static float clamp(float value, float max, float min) {
        return Math.max(Math.min(value, min), max);
    }
}
