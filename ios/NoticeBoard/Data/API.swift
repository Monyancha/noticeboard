//
//  API.swift
//  NoticeBoard
//
//  Created by Salama AB on 3/19/15.
//  Copyright (c) 2015 Salama AB. All rights reserved.
//

import Foundation
import SwiftyJSON
import Alamofire

class API {
    
    class var TAG: String { return "API" }
    class var ENDPOINT: String { return "http://usiu.aksalj.me" }
    class var USER_AGENT: String { return "Lonesome Scarecrow"; }
    
    class var manager: Alamofire.Manager {
        
        // Prep Alamofire for API Auth
        Alamofire.Manager.defaultHTTPHeaders()
        var defaultHeaders = Alamofire.Manager.sharedInstance.session.configuration.HTTPAdditionalHeaders ?? [:]
        defaultHeaders["User-Agent"] = USER_AGENT;
        //defaultHeaders["Signature"] = "";
        
        let configuration = NSURLSessionConfiguration.defaultSessionConfiguration()
        configuration.HTTPAdditionalHeaders = defaultHeaders
        return Alamofire.Manager(configuration: configuration)
    
    }
    
    class func getFeeds(cb: ((feeds: [BoardFeed]) -> Void)) {
        let urlStr = ENDPOINT + "/api/feeds";
        
        manager
            .request(.GET, urlStr)
            .response {
                (request, response, data, error) in
                
                var feeds: [BoardFeed] = [];
                if let resp = response {
                    if resp.statusCode == 200 {
                        var dt = data as? NSData;
                        var json = JSON(data: dt!)
                        for (pos, jsonFeed) in json {
                            let id = jsonFeed["id"].string;
                            let intId = id?.toInt();
                            let title = jsonFeed["title"].string;
                            let desc = jsonFeed["description"].string;
                            let url = jsonFeed["url"].string;
                            var feed = BoardFeed(id: intId!, title: title!, description: desc!, url: url!);
                            feeds.append(feed);
                        }
                    }
                }
                cb(feeds: feeds);
                
        }
    }
    
    class func getRSS(forFeed feed: BoardFeed, cb:(xmlData: NSData?)->Void) {
        manager
            .request(.GET, feed.url)
            .response { (request, response, data, error) -> Void in
                
                // TODO: Check errors
                
                
                cb(xmlData: data! as? NSData);
        }
        
    }
    
    class func register(uuid: String?, phone: String?, cb: (()->Void)?) {
        let urlStr = ENDPOINT + "/api/register";
        
        var params = [ "phone": "null", "uuid": "null", "type": "apns" ];
        
        if let token = uuid {
            params["uuid"] = uuid;
        }
        if let phn = phone {
            params["phone"] = phn;
        }
        
        
        manager
            .request(.POST, urlStr, parameters: params)
            .response {
                (request, response, data, error) in
                println(response)
                cb?();
        }
        
    }
    
    class func unregister(phone: String, cb: (()->Void)?) {
        let urlStr = ENDPOINT + "/api/unregister";
        let params = ["phone": phone];
        
        manager
            .request(.POST, urlStr, parameters: params)
            .response {
                (request, response, data, error) in
                println(response?.description)
                cb?();
        }
    }
}