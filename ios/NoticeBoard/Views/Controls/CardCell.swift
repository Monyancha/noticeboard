//
//  CardCell.swift
//  NoticeBoard
//
//  Created by Salama AB on 3/29/15.
//  Copyright (c) 2015 Salama AB. All rights reserved.
//

import UIKit

class CardCell: UITableViewCell {
    
    @IBOutlet weak var photo: UIImageView!
    @IBOutlet weak var title: UILabel!
    @IBOutlet weak var date: UILabel!
    @IBOutlet weak var source: UILabel!
    @IBOutlet weak var summary: UILabel!
    
    
    override func awakeFromNib() {
        super.awakeFromNib();
        
        self.applyBorder();
        self.applyPlainShadow();
        
    }
    
    func applyBorder() {
        var borderWidth: CGFloat = 0.1;
        frame = CGRectInset(frame, -borderWidth, -borderWidth);
        layer.borderColor = UIColor.grayColor().CGColor
        layer.borderWidth = borderWidth;
        layer.cornerRadius = 3;
//        layer.masksToBounds = true;
    }
    
    func applyPlainShadow() {
        layer.shadowColor = UIColor.blackColor().CGColor;
        layer.shadowOffset = CGSize(width: -3, height: 3);
        layer.shadowRadius = 3;
        layer.shadowOpacity = 0.1;
    }
    

    
}