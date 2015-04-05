//
//  DataManager.swift
//  NoticeBoard
//
//  Created by Salama AB on 3/19/15.
//  Copyright (c) 2015 Salama AB. All rights reserved.
//

import Foundation


class DataManager {
    
    class var DEFAULT_FEED_ID: Int {return -1}
    
    private let TAG = "DataManager";
    
    private var feeds: [BoardFeed] = []
    private var items: Dictionary<BoardFeed, Array<BoardItem>> = [:];
    
    // Swift 1.1 singleton pattern
    class var sharedInstance : DataManager {
        struct Static {
            static let instance: DataManager = DataManager();
        }
        return Static.instance
    }
    
    private init(){
        var defaultFeed = BoardFeed(
            id:DataManager.DEFAULT_FEED_ID, title: "Latest Posts",
            description:"Latest Notice Board Posts", url: "");
        feeds.insert(defaultFeed, atIndex: 0);
        items[defaultFeed] = [];
    }
    
    func countFeeds() -> Int {
        return feeds.count;
    }
    
    func getFeed(id:Int) -> BoardFeed? {
        for feed in feeds {
            if feed.id == id {
                return feed
            }
        }
        return nil;
    }
    
    func getFeedByIndex(index:Int) -> BoardFeed? {
        return feeds[index];
    }
    
    func getItems(feedId: Int) -> [BoardItem] {
        if let feed = self.getFeed(feedId) {
            return items[feed]!;
        }
        return [];
    }
    
    func fetchFeeds(callback: (status: Bool) -> Void) {
        API.getFeeds({(feeds: [BoardFeed]) -> Void in
            let ok = !feeds.isEmpty;
            self.feeds += feeds;
            self.feeds.sort({ (lhs, rhs) -> Bool in
                return lhs.id < rhs.id;
            });
            callback(status: ok);
        });
    }
    
    
    func fetchAllFeedsItems(callback: (Bool -> Void)? ) {
        
        var defaultFeed = self.getFeed(DataManager.DEFAULT_FEED_ID)!;
        var remainingWorkers = feeds.count - 1; // minus default feed because it has no dedicated worker
        var result = true;
        
        for feed in feeds {
            if feed.id != DataManager.DEFAULT_FEED_ID {
                self.fetchItems(feed, callback: { (status: Bool) in
                    
                    remainingWorkers -= 1;
                    result = result & status;
                    
                    // Add my first item to default feed
                    if let fs = self.items[feed]?.first {
                        self.items[defaultFeed]?.append(fs);
                    }
                    
                    if remainingWorkers == 0 { // I'm the last one to finish
                        // Sort default feed
                        self.items[defaultFeed]?.sort({ (lhs, rhs) -> Bool in
                            return lhs._date_ms > rhs._date_ms;
                        });
                        
                        callback?(result);
                    }
                });
            }
        }
        
        
    }
    
    func fetchItems(feedId: Int, callback: (Bool -> Void)? ) {
        if let feed = self.getFeed(feedId) {
            if(feedId == DataManager.DEFAULT_FEED_ID) {
                // Clear default feed
                self.items[feed] = [];
                self.fetchAllFeedsItems(callback);
            } else {
                fetchItems(feed, callback: callback);
            }
        }
    }
    
    func fetchItems(feed: BoardFeed, callback: ((status: Bool)->Void)? ) {
        Log.i(self.TAG, msg: "Fetching items of feed \(feed.title)");
        
        var parser = BoardFeedParser(feed: feed);
        parser.parse { (items, error) -> Void in
            
            Log.i(self.TAG, msg: "Got \(items.count) item(s) for feed \(feed.title)");
            
            if items.count > 0 {
                self.items[feed] = items;
                self.items[feed]?.sort({ (lhs, rhs) -> Bool in
                    return lhs._date_ms > rhs._date_ms;
                })
            } else {
                self.items[feed] = [];
            }
            
            if error != nil {
                Log.d(self.TAG, msg: "\(error)");
            }
            
            callback!(status: error == nil);
        }
    }
    
}
