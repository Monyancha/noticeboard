package me.aksalj.usiuboard.data;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.usiuboard.data.BoardFeed
 * Date : Feb, 04 2015 2:01 PM
 * Description :
 */
public class BoardFeed {
    public int id;
    public String title;
    public String description;
    public String url;
    public String slug;

    public BoardFeed(int id, String title, String description, String url) {
        this.id = id;
        this.title = title;
        this.description = description;
        this.url = url;
    }
}
