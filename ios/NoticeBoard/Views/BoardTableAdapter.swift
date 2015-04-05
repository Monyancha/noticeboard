//
//  BoardTableAdapter.swift
//  NoticeBoard
//
//  Created by Salama AB on 3/29/15.
//  Copyright (c) 2015 Salama AB. All rights reserved.
//

import UIKit
import QuartzCore
import Refresher

class BoardTableAdapter: NSObject, UITableViewDelegate, UITableViewDataSource {
    
    class var TAG: String { get { return "BoardTableAdapter"} }
    
    let dataMngr = DataManager.sharedInstance;
    
    let tableView: UITableView;
    
    
    var currentFeed: Int {
        didSet {
            if currentFeed != oldValue {
                self.refresh();
            }
        }
    }
    
    init(table: UITableView, feed: Int) {
        self.tableView = table;
        self.currentFeed = feed;
        
        super.init();
        
        self.tableView.delegate = self;
        self.tableView.dataSource = self;
        
    }
    
    func addRefresher(callback: Bool -> Void) {
        
        self.tableView.addPullToRefreshWithAction({
            
            self.refresh(fromServer: true) {(ok) in
                callback(ok);
                self.tableView.stopPullToRefresh();
            };
            
            },
            withAnimator: BeatAnimator());
        
    }
    
    func pullToRefresh() {
        self.tableView.startPullToRefresh();
    }
    
    func refresh(fromServer: Bool = false, callback:(Bool->Void)? = nil) {
        
        if fromServer {
            dataMngr.fetchItems(self.currentFeed){
                (status) in
                
                if let feed = self.dataMngr.getFeed(self.currentFeed) {
                    var items = self.dataMngr.getItems(feed.id);
                    Log.i(BoardTableAdapter.TAG, msg: "Feed '\(feed.title)' has loaded \(items.count) item(s)")
                }
                
                if status {
                    self.tableView.reloadData();
                }
                
                callback?(status);
                
            }
        } else {
            tableView.reloadData();
            callback?(true);
        }
        
    }
    
    
    private func _getBoardItem(tableRow: Int) -> BoardItem? {
        let items = dataMngr.getItems(currentFeed);
        return items[tableRow / 2];
    }
    
    func getSelectedItem() -> BoardItem? {
        if let idx = tableView.indexPathForSelectedRow() {
            return self._getBoardItem(idx.row);
        }
        return nil;
    }
    
    func clearSelection() {
        if let idx = tableView.indexPathForSelectedRow() {
            tableView.deselectRowAtIndexPath(idx, animated: true);
        }
    }
    
    func getFeedTitle() -> String? {
        if let feed = dataMngr.getFeed(currentFeed) {
            return feed.title;
        }
        
        return nil;
    }
    
    func tableView(tableView: UITableView, cellForRowAtIndexPath indexPath: NSIndexPath) -> UITableViewCell {
        
        // even rows will be invisible
        if (indexPath.row % 2 == 1) {
            var separatorCell = tableView.dequeueReusableCellWithIdentifier("CardSeparator") as UITableViewCell;
            return separatorCell;
        } else {
            var cell = tableView.dequeueReusableCellWithIdentifier("CardCell") as CardCell
            return cell;
        }
    }
    
    func tableView(tableView: UITableView, willDisplayCell cell: UITableViewCell, forRowAtIndexPath indexPath: NSIndexPath) {
        
        if indexPath.row % 2 != 1 {
            let card = cell as CardCell;
            
            if let item = self._getBoardItem(indexPath.row) {
                card.title.text = item.title;
                card.summary.text = item.summary;
                card.source.text = "\u{f09e}   " + item.source!;
                
                if let timeAgo = item.date?.timeAgo(false) {
                    card.date.text = "\u{f017}   " + timeAgo;
                }
                
                if let imgUrl = item.imageUrl {
                    card.photo.loadImage(imgUrl.absoluteString!);
                }
            }
        }
    }
    
    func tableView(tableView: UITableView, heightForRowAtIndexPath indexPath: NSIndexPath) -> CGFloat {
        if indexPath.row % 2 != 1 {
            return 237;
        } else {
            return 15;
        }
    }
    
    func tableView(tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        let items = dataMngr.getItems(currentFeed).count;
        let rows = (items * 2) - 1; // Invisiable items
        return rows;
    }
    
}

class BeatAnimator: PullToRefreshViewAnimator {
    
    private var layerLoader: CAShapeLayer = CAShapeLayer()
    
    init() {
        
        layerLoader.lineWidth = 4
        layerLoader.strokeColor = UIColor.usiuBlue().CGColor;
        layerLoader.strokeEnd = 0
    }
    
    func startAnimation() {
        
        var pathAnimationEnd = CABasicAnimation(keyPath: "strokeEnd")
        pathAnimationEnd.duration = 0.5
        pathAnimationEnd.repeatCount = 100
        pathAnimationEnd.autoreverses = true
        pathAnimationEnd.fromValue = 1
        pathAnimationEnd.toValue = 0.8
        self.layerLoader.addAnimation(pathAnimationEnd, forKey: "strokeEndAnimation")
        
        var pathAnimationStart = CABasicAnimation(keyPath: "strokeStart")
        pathAnimationStart.duration = 0.5
        pathAnimationStart.repeatCount = 100
        pathAnimationStart.autoreverses = true
        pathAnimationStart.fromValue = 0
        pathAnimationStart.toValue = 0.2
        self.layerLoader.addAnimation(pathAnimationStart, forKey: "strokeStartAnimation")
    }
    
    func stopAnimation() {
        self.layerLoader.removeAllAnimations()
    }
    
    func layoutLayers(superview: UIView) {
        
        if layerLoader.superlayer == nil {
            superview.layer.addSublayer(layerLoader)
        }
        
        var bezierPathLoader = UIBezierPath()
        bezierPathLoader.moveToPoint(CGPointMake(0, superview.frame.height - 3))
        bezierPathLoader.addLineToPoint(CGPoint(x: superview.frame.width, y: superview.frame.height - 3))
        
        layerLoader.path = bezierPathLoader.CGPath
    }
    
    func changeProgress(progress: CGFloat) {
        self.layerLoader.strokeEnd = progress
    }
}
