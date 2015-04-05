//
//  BoardFeedParser.swift
//  NoticeBoard
//
//  Created by Salama AB on 3/20/15.
//  Copyright (c) 2015 Salama AB. All rights reserved.
//

import Foundation
import Alamofire

class BoardFeedParser: NSObject, NSXMLParserDelegate {
    
    var TAG = "BoardFeedParser";
    var feed: BoardFeed;
    var items: [BoardItem] = [];
    
    var callbackClosure: ((items: [BoardItem], error: NSError?) -> Void)?
    
    var currentItem: BoardItem?;
    var currentElement: String = "";
    var currentAttibtues: Dictionary<String, String> = [:];
    
    // node names
    let node_item: String = "item"
    let node_title: String = "title"
    let node_link: String = "link"
    let node_guid: String = "guid"
    let node_publicationDate: String = "pubDate"
    let node_description: String = "description"
    let node_content: String = "content:encoded"
    let node_thumbnail: String = "media:thumbnail"
    
    init(feed: BoardFeed) {
        self.feed = feed;
    }
    
    func parse(callback: (([BoardItem], NSError?)->Void)) {
        
        API.getRSS(forFeed: feed) { (xmlData) -> Void in
            
            // TODO: Parse xml RSS
            if let data = xmlData {
                self.callbackClosure = callback;
                var parser = NSXMLParser(data: data);
                parser.delegate = self;
                parser.shouldResolveExternalEntities = false
                if !parser.parse() {
                    Log.e(self.TAG, msg: "Failed to parse RSS");
                }
            }
        }
        
    }
    
    
    
    // MARK - NSXMLParserDelegate
    
    func parserDidStartDocument(parser: NSXMLParser) {
    }
    
    func parserDidEndDocument(parser: NSXMLParser) {
        if let closure = self.callbackClosure? {
            closure(items: self.items, error: nil)
        }
    }
    
    func parser(parser: NSXMLParser, didStartElement elementName: String, namespaceURI: String?, qualifiedName qName: String?, attributes attributeDict: [NSObject : AnyObject]) {
        
        if elementName == node_item {
            self.currentItem = BoardItem()
            self.currentItem?.source = feed.title;
        }
        
        self.currentAttibtues = attributeDict as [String:String];
        self.currentElement = "";
    }
    
    func parser(parser: NSXMLParser, didEndElement elementName: String, namespaceURI: String?, qualifiedName qName: String?) {
        
        if elementName == node_item {
            if let item = self.currentItem? {
                self.items.append(item)
            }
            self.currentItem = nil
            return
        }
        
        if let item = self.currentItem? {
            if elementName == node_title {
                item.title = self.currentElement
            }
            
            if elementName == node_link {
                item.webUrl = NSURL(string: self.currentElement);
            }
            
            if elementName == node_guid {
                item.id = self.currentElement
            }
            
            if elementName == node_publicationDate {
                item.date = NSDate.dateFromInternetDateTimeString(self.currentElement)
            }
            
            if elementName == node_description {
                item.summary = self.currentElement
            }
            
            if elementName == node_content {
                item.content = self.currentElement
            }
            
            if elementName == node_thumbnail {
                if let url = self.currentAttibtues["url"] {
                    item.imageUrl = NSURL(string: url);
                }
            }
            
        }
        
        self.currentAttibtues = [:];
    }
    
    func parser(parser: NSXMLParser, foundCharacters string: String) {
        self.currentElement += string
    }
    
    func parser(parser: NSXMLParser, parseErrorOccurred parseError: NSError) {
        if let closure = self.callbackClosure? {
            closure(items: self.items, error: parseError)
        }
    }
}