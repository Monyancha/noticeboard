//
//  BoardItem.swift
//  NoticeBoard
//
//  Created by Salama AB on 3/19/15.
//  Copyright (c) 2015 Salama AB. All rights reserved.
//

import Foundation

public class BoardItem {
    var id: String?
    var title: String?
    var summary: String?
    var content: String?
    var webUrl: NSURL?
    var imageUrl: NSURL?
    var source: String?
    var date: NSDate?
    
    var _date_ms: Double {
        get {
            if var dt = self.date {
                return dt.timeIntervalSince1970;
            } else {
                return 0;
            }
        }
    }
    var read: Bool {
        get{
            // TODO: Get read value from db?
            return false;
        }
        set {
            // TODO: Set read value to db?
        }
    }
    
    public init(){}
    
    public init(id: String) {
        self.id = id;
    }
}