//
//  BoardFeed.swift
//  NoticeBoard
//
//  Created by Salama AB on 3/19/15.
//  Copyright (c) 2015 Salama AB. All rights reserved.
//

import Foundation

public class BoardFeed: Hashable {
    
    var id: Int
    var title: String
    var description: String
    var url: NSURL
    
    public var hashValue: Int {
        return "HasValue is \(self.id)".hashValue
    }
    
    init(id:Int, title: String, description:String, url: String) {
        self.id = id
        self.title = title
        self.description = description
        self.url = NSURL(string: url)!
    }
}

public func ==(lhs: BoardFeed, rhs: BoardFeed) -> Bool {
    return lhs.hashValue == rhs.hashValue
}