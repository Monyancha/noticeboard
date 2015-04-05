//
//  StrechingParallaxScrollView.swift
//  NoticeBoard
//
//  Created by Salama AB on 3/26/15.
//  Copyright (c) 2015 Salama AB. All rights reserved.
//

import UIKit


extension UIView {
    
    func setY(y: CGFloat) {
        self.frame = CGRectMake(self.frame.origin.x, y, self.frame.size.width, self.frame.size.height);
    }
    
    func setX(x: CGFloat) {
        self.frame = CGRectMake(x, self.frame.origin.y, self.frame.size.width, self.frame.size.height);
    }
    
    func setWidth(width: CGFloat) {
        self.frame = CGRectMake(self.frame.origin.x, self.frame.origin.y, width, self.frame.size.height);
    }
    
    func setHeight(height: CGFloat) {
        self.frame = CGRectMake(self.frame.origin.x, self.frame.origin.y, self.frame.size.width, height);
    }
}

class StrechingParallaxScrollView: UIView, UIScrollViewDelegate {
    
    var topView: UIView;
    var scrollView: UIScrollView;
    
    var parallaxWeight: CGFloat;
    var strechs: Bool = true;
    var parallax: Bool = true;
    
    var defaultTopViewRect: CGRect;

    
    init(frame: CGRect, topView: UIView) {
        
        self.topView = topView;
        self.topView.clipsToBounds = true;
        
        self.scrollView = UIScrollView(frame: frame);
        
        self.strechs = true;
        self.parallax = true;
        
        self.parallaxWeight = 0.5;
        self.defaultTopViewRect = self.topView.frame;
        
        super.init(frame: frame);
        
        self.addSubview(self.topView);
        
        self.scrollView.delegate = self;
        self.addSubview(self.scrollView);
    }

    required init(coder aDecoder: NSCoder) {
        fatalError("init(coder:) has not been implemented")
    }

    

    func setContentSize(size: CGSize) {
        self.scrollView.contentSize = size;
    }

    override func addSubview(view: UIView) {
        if (view === self.scrollView || view === self.topView) {
            super.addSubview(view);
        } else {
            self.scrollView.addSubview(view);
        }
    }
    
    func scrollViewDidScroll(scrollView: UIScrollView) {
        Log.i("Scroll->", msg: "Aksal");
        if (scrollView.contentOffset.y < 0 && self.strechs) {
            
            let diff = -scrollView.contentOffset.y;
            let oldH = self.defaultTopViewRect.size.height;
            let oldW = self.defaultTopViewRect.size.width;
            
            let newH = oldH + diff;
            let newW = oldW*newH/oldH;
            
            self.topView.frame = CGRectMake(0, 0, newW, newH);
            self.topView.center = CGPointMake(self.center.x, self.topView.center.y);
            
        }
            
        else {
            if (self.parallax) {
                let diff = scrollView.contentOffset.y;
                self.topView.setY(-diff * self.parallaxWeight);
            }
        }
    }
    
//    class func scrollViewItem(y: CGFloat, width: CGFloat, num: Int) -> UILabel {
//        let item = UILabel(frame: CGRectMake(10, y, width, 180))
//        item.backgroundColor = UIColor.brownColor();
//        item.text = "Item #\(num)";
//        item.textAlignment = .Center;
//        item.textColor = UIColor.whiteColor();
//        return item;
//    }
    
}
