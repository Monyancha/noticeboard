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
        
        navigationItem.title = nil;
        
        updateContent();
    }
    
    func updateContent() {
        contentTitle.text = item.title;
        
        contentView.loadHTMLString(item.content, baseURL: nil);
        
        if let url = item.imageUrl?.absoluteString {
            contentImage.loadImage(url);
        }
    }
}
