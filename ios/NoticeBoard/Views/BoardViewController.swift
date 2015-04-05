//
//  BoardViewController.swift
//  NoticeBoard
//
//  Created by Salama AB on 3/19/15.
//  Copyright (c) 2015 Salama AB. All rights reserved.
//

import UIKit

class BoardViewController: UIViewController {
    
    let TAG = "BoardViewController";
    
    @IBOutlet weak var tableView: UITableView!;
    
    let dataMngr = DataManager.sharedInstance;
    let detailsSegue = "ShowItemDetails";
    
    var dataAdapter: BoardTableAdapter!;
    var sideTableView: UITableView?;
    
    override func viewDidLoad() {
        super.viewDidLoad();
        // Do any additional setup after loading the view, typically from a nib.
        
        let menuBtn = UIBarButtonItem(title:"\u{f0c9}", style: .Plain, target: self, action: "presentLeftMenuViewController");
        if let font = UIFont(name: "FontAwesome", size: 20) {
            menuBtn.setTitleTextAttributes([NSFontAttributeName: font], forState: UIControlState.Normal)
        }
        navigationItem.leftBarButtonItem = menuBtn;
        
        sideTableView = (sideMenuViewController?.leftMenuViewController? as? SideViewController)?.tableView;

        dataAdapter = BoardTableAdapter(table: tableView, feed: DataManager.DEFAULT_FEED_ID);
        dataMngr.fetchFeeds { (status) -> Void in
            
            Log.i(self.TAG, msg: "Got \(self.dataMngr.countFeeds()) feeds");
            
            self.sideTableView?.reloadData();
            
            if status {
                
                self.dataAdapter.addRefresher() {(ok) in
                    if ok {
                        if let title = self.dataAdapter.getFeedTitle() {
                            self.navigationItem.title = title;
                        }
                    }
                };
                
                self.dataAdapter.pullToRefresh();
                
            }
        }
        
    }
    
    override func viewWillAppear(animated: Bool) {
        super.viewWillAppear(animated);
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    override func shouldPerformSegueWithIdentifier(identifier: String?, sender: AnyObject?) -> Bool {
        
        if identifier != nil {
            switch(identifier!) {
            case detailsSegue: // Not really useful
                if let item = dataAdapter.getSelectedItem() {
                    return true;
                } else {
                    return false;
                }
            default:
                return true;
            }
        }
        
        
        // by default
        return false;
        
    }
    
    override func prepareForSegue(segue: UIStoryboardSegue, sender: AnyObject?) {
        if let segueId = segue.identifier {
            switch(segueId) {
            case detailsSegue:
                let dest = segue.destinationViewController as ItemViewController;
                if let item = dataAdapter.getSelectedItem() {
                    dataAdapter.clearSelection();
                    dest.item = item;
                } else {
                    Log.d(self.TAG, msg: "Should Never Never Happen!!!!");
                }
            default:
                break;
            }
        }
    }
    
    func changeCurrentFeed(feed: BoardFeed) {
        dataAdapter.currentFeed = feed.id;
    }
    
    
    func sendNotificationSettings(apnsToken: String?) {
        
        let alertController = UIAlertController(title: "SMS Notifications", message: "Do you want to receive SMS Notifications?", preferredStyle: .Alert);
        
        let cancelAction = UIAlertAction(title : "No", style: .Cancel) { (action) in API.register(apnsToken, phone: nil, cb: nil) };
        alertController.addAction(cancelAction)
        
        let OKAction = UIAlertAction(title: "Yes", style: .Default) { (action) in
            let phoneTextField = alertController.textFields![0] as UITextField
            var phone = phoneTextField.text;
        
            API.register(apnsToken, phone: phone, cb: nil);
        }
        alertController.addAction(OKAction)
        
        
        alertController.addTextFieldWithConfigurationHandler { (textField) in
            textField.placeholder = "Enter Your Phone number"
            textField.keyboardType = UIKeyboardType.PhonePad;
            
            NSNotificationCenter.defaultCenter().addObserverForName(UITextFieldTextDidChangeNotification, object: textField, queue: NSOperationQueue.mainQueue()) { (notification) in
                OKAction.enabled = textField.text != ""
            }
        }
        
        
        self.presentViewController(alertController, animated: true, completion: nil);
    }
    


}

