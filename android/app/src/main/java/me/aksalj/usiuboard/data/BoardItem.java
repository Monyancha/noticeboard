package me.aksalj.usiuboard.data;

import android.text.format.DateUtils;

import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.select.Elements;
import org.mcsoxford.rss.MediaThumbnail;
import org.mcsoxford.rss.RSSItem;

import java.util.List;

/**
 * Copyright (c) 2015 Salama AB
 * All rights reserved
 * Contact: aksalj@aksalj.me
 * Website: http://www.aksalj.me
 * <p/>
 * Project : USIU Board
 * File : me.aksalj.usiuboard.data.BoardItem
 * Date : Feb, 04 2015 1:58 PM
 * Description :
 */
public class BoardItem {

    public String id; // or long ?
    public String title;
    public String date;
    public long _date_ms;
    public String summary;
    public String content;
    public String webUrl;
    public String imageUrl;
    public String source;
    public boolean read = false; // Has user read this item?

    public BoardItem() {}

    public BoardItem(RSSItem entry, String author) {

        id = entry.getLink().toString(); // HUH!
        title = entry.getTitle();
        _date_ms = entry.getPubDate().getTime();
        date = DateUtils.getRelativeTimeSpanString(
                _date_ms,
                System.currentTimeMillis(),
                DateUtils.MINUTE_IN_MILLIS,
                DateUtils.FORMAT_ABBREV_ALL).toString();

        summary = entry.getDescription();
        if(summary == null) { summary = ""; }

        content = entry.getContent(); // Assume HTML
        if(content == null) { content = ""; }


        List<MediaThumbnail> thumbnails = entry.getThumbnails();
        if(thumbnails != null && thumbnails.size() > 0) {
            imageUrl = thumbnails.get(0).getUrl().toString();
        }

        if(imageUrl == null) { // Try to get image from content ( first img tag )
            String html = content.isEmpty() ? summary : content;
            Document doc = Jsoup.parse(html);
            Elements eles = doc.select("img");
            if(eles.size() > 0) {
                imageUrl = eles.get(0).attr("src");
            }
        }

        // Remove image tags from summary/content
        summary = stripTag("img", summary);
        content = stripTag("img", content);

        webUrl = entry.getLink().toString();
        source = author;
    }

    private String stripTag(String tag, String html) {
        if(html != null && !html.isEmpty()) {
            Document doc = Jsoup.parse(html);
            doc.select(tag).remove();
            html = doc.html();
        }
        return html;
    }
}
