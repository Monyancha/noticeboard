//
//  SideViewController.swift
//  NoticeBoard
//
//  Created by Salama AB on 4/3/15.
//  Copyright (c) 2015 Salama AB. All rights reserved.
//

import UIKit

class SideViewController: UIViewController {
    
    lazy var tableView: UITableView = {
        let tableView = UITableView()
        tableView.delegate = self
        tableView.dataSource = self
        tableView.separatorStyle = .SingleLine
        tableView.frame = CGRectMake(20, (self.view.frame.size.height - 54 * 5) / 2.0, self.view.frame.size.width, 54 * 5)
        tableView.autoresizingMask = .FlexibleTopMargin | .FlexibleBottomMargin | .FlexibleWidth
        tableView.registerClass(UITableViewCell.self, forCellReuseIdentifier: "cell")
        tableView.opaque = false
        tableView.backgroundColor = UIColor.clearColor()
        tableView.backgroundView = nil
        tableView.bounces = false
        return tableView
        }()
    
     let dataMngr: DataManager = DataManager.sharedInstance;
    
    override func viewDidLoad() {
        super.viewDidLoad()
        view.addSubview(tableView)
    }
    
    override func preferredStatusBarStyle() -> UIStatusBarStyle {
        return UIStatusBarStyle.BlackOpaque;
    }
    
}

extension SideViewController: UITableViewDelegate, UITableViewDataSource {
    
    
    func tableView(tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return dataMngr.countFeeds();
    }
    
    func tableView(tableView: UITableView, heightForRowAtIndexPath indexPath: NSIndexPath) -> CGFloat {
        return 35
    }
    
    func tableView(tableView: UITableView, cellForRowAtIndexPath indexPath: NSIndexPath) -> UITableViewCell {
        
        let feed = dataMngr.getFeedByIndex(indexPath.row);
        let cell = tableView.dequeueReusableCellWithIdentifier("cell", forIndexPath: indexPath) as UITableViewCell
        
        cell.backgroundColor = UIColor.clearColor();
        cell.textLabel?.font = UIFont(name: "HelveticaNeue", size: 18);
        cell.textLabel?.textColor = UIColor.whiteColor();
        cell.textLabel?.text  = feed?.title;
        cell.selectionStyle = .Default;
        
        return cell
    }
    
    func tableView(tableView: UITableView, didSelectRowAtIndexPath indexPath: NSIndexPath) {
        tableView.deselectRowAtIndexPath(indexPath, animated: true);
        
        sideMenuViewController?.hideMenuViewController()
        
        if let navView = sideMenuViewController?.contentViewController? as? UINavigationController {
            if let mainView = navView.topViewController as? BoardViewController {
                if let feed = dataMngr.getFeedByIndex(indexPath.row) {
                    mainView.changeCurrentFeed(feed);
                }
            }
        }
        
    }
    
}
