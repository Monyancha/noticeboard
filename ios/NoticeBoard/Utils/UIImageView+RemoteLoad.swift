//
//  UIImageView+RemoteLoad.swift
//
//  Created by Salama AB on 4/07/15.
//  Copyright (c) 2015 Salama AB. All rights reserved.
//

import UIKit

extension UIImageView {
    
    func load(url: NSURL, errorCallback: ((NSError) -> Void)? = nil ) {
        
        dispatch_async(dispatch_get_global_queue(DISPATCH_QUEUE_PRIORITY_BACKGROUND, 0)) {() in
            var task = NSURLSession.sharedSession().dataTaskWithURL(url, completionHandler: {(data: NSData!, response: NSURLResponse!, error:NSError!) -> Void in
                
                let cb = {() -> Void in
                    
                    if error != nil {
                        errorCallback?(error!);
                    }
                    
                    if data != nil {
                        let image = UIImage(data: data!)
                        self.image = image;
                    }
                };
                
                dispatch_async(dispatch_get_main_queue(), {() in cb() })
                
            });
            
            task.resume();
        }
    }
}
