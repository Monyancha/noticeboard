//
//  AppDelegate.swift
//  NoticeBoard
//
//  Created by Salama AB on 3/19/15.
//  Copyright (c) 2015 Salama AB. All rights reserved.
//

import UIKit

@UIApplicationMain
class AppDelegate: UIResponder, UIApplicationDelegate, SSASideMenuDelegate {

    let TAG = "AppDelegate";
    
    let dataMngr = DataManager.sharedInstance;
    var window: UIWindow?;

    func application(application: UIApplication, didFinishLaunchingWithOptions launchOptions: [NSObject: AnyObject]?) -> Bool {
        // Override point for customization after application launch.
        
        var notifSettings = UIUserNotificationSettings(
            forTypes: UIUserNotificationType.Alert | UIUserNotificationType.Sound | UIUserNotificationType.Sound,
            categories: nil);
        
        application.registerUserNotificationSettings(notifSettings);
        application.registerForRemoteNotifications();
        
        return true
        
    }
    

    func applicationWillResignActive(application: UIApplication) {
        // Sent when the application is about to move from active to inactive state. This can occur for certain types of temporary interruptions (such as an incoming phone call or SMS message) or when the user quits the application and it begins the transition to the background state.
        // Use this method to pause ongoing tasks, disable timers, and throttle down OpenGL ES frame rates. Games should use this method to pause the game.
    }

    func applicationDidEnterBackground(application: UIApplication) {
        // Use this method to release shared resources, save user data, invalidate timers, and store enough application state information to restore your application to its current state in case it is terminated later.
        // If your application supports background execution, this method is called instead of applicationWillTerminate: when the user quits.
    }

    func applicationWillEnterForeground(application: UIApplication) {
        // Called as part of the transition from the background to the inactive state; here you can undo many of the changes made on entering the background.
    }

    func applicationDidBecomeActive(application: UIApplication) {
        // Restart any tasks that were paused (or not yet started) while the application was inactive. If the application was previously in the background, optionally refresh the user interface.
    }

    func applicationWillTerminate(application: UIApplication) {
        // Called when the application is about to terminate. Save data if appropriate. See also applicationDidEnterBackground:.
    }
    
    
    // SSASideMenu
    func sideMenuWillShowMenuViewController(sideMenu: SSASideMenu, menuViewController: UIViewController) {
        println("Will Show \(menuViewController)")
    }
    
    func sideMenuDidShowMenuViewController(sideMenu: SSASideMenu, menuViewController: UIViewController) {
        println("Did Show \(menuViewController)")
    }
    
    func sideMenuDidHideMenuViewController(sideMenu: SSASideMenu, menuViewController: UIViewController) {
        println("Did Hide \(menuViewController)")
    }
    
    func sideMenuWillHideMenuViewController(sideMenu: SSASideMenu, menuViewController: UIViewController) {
        println("Will Hide \(menuViewController)")
    }
    func sideMenuDidRecognizePanGesture(sideMenu: SSASideMenu, recongnizer: UIPanGestureRecognizer) {
        println("Did Recognize PanGesture \(recongnizer)")
    }

    
    
    // APNS
    func application(application: UIApplication,
        didRegisterForRemoteNotificationsWithDeviceToken deviceToken: NSData) {
            var characterSet: NSCharacterSet = NSCharacterSet( charactersInString: "<>" )
            var deviceTokenString: String = ( deviceToken.description as NSString )
                .stringByTrimmingCharactersInSet( characterSet )
                .stringByReplacingOccurrencesOfString( " ", withString: "" ) as String
            
            println(deviceTokenString)
            
            // Save token, get phone number and send both to server
            if let crtl = self.window?.rootViewController as? BoardViewController {
                crtl.sendNotificationSettings(deviceTokenString);
            }
    }
    
    func application(application: UIApplication,
        didFailToRegisterForRemoteNotificationsWithError error: NSError) {
            Log.e(self.TAG, msg: error.localizedDescription);
            
//            if let crtl = self.window?.rootViewController as? BoardViewController {
//                crtl.sendNotificationSettings(nil);
//            }
    }
    
    func application(application: UIApplication, didReceiveRemoteNotification userInfo: [NSObject : AnyObject], fetchCompletionHandler completionHandler: (UIBackgroundFetchResult) -> Void) {
        println(userInfo)
    }

}

