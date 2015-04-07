//
//  ItemViewController.swift
//  NoticeBoard
//
//  Created by Salama AB on 3/30/15.
//  Copyright (c) 2015 Salama AB. All rights reserved.
//

import UIKit

class ItemViewController: UIViewController {
    
    var item: BoardItem!;
    
    @IBOutlet weak var contentImage: UIImageView!
    @IBOutlet weak var contentTitle: UILabel!
    @IBOutlet weak var contentView: UIWebView!
    
    override func viewDidLoad() {
        super.viewDidLoad();
        
        setupNavbar();
        
        updateContent();
    }
    
    func setupNavbar() {
        navigationItem.title = item.title;
        
        var attribs: [NSObject: AnyObject] = [NSForegroundColorAttributeName: UIColor.usiuBlue()];
        if let font = UIFont(name: "FontAwesome", size: 20) {
            attribs[NSFontAttributeName] = font;
        }
        let backBtn = UIBarButtonItem(title: "\u{f053}", style: UIBarButtonItemStyle.Plain, target: self, action: "goBack")
        backBtn.setTitleTextAttributes(attribs, forState: UIControlState.Normal);
        self.navigationItem.leftBarButtonItem = backBtn;
    }
    
    func updateContent() {
        contentTitle.text = item.summary//item.title;
        
        contentView.loadHTMLString(item.content, baseURL: nil);
        
        if item.imageUrl != nil {
            contentImage.load(item.imageUrl!, errorCallback: { (error) -> Void in
                // TODO: Load placeholder?
            });
        }
    }
    
    func goBack() {
        navigationController?.popViewControllerAnimated(true);
    }
    
}
