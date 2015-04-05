//
//  Log.swift
//  NoticeBoard
//
//  Created by Salama AB on 3/20/15.
//  Copyright (c) 2015 Salama AB. All rights reserved.
//

import Foundation

public class Log {
    
    private class func printLine(line:String) {
        println(line);
    }
    
    class func e(tag: String, msg:String){
        Log.printLine("E: \(tag)::\(msg)");
    }
    
    
    class func i(tag: String, msg:String){
        Log.printLine("I: \(tag)::\(msg)");
    }
    
    
    class func d(tag: String, msg:String){
        Log.printLine("D: \(tag)::\(msg)");
    }
}