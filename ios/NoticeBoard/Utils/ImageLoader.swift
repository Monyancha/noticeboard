
import UIKit

extension UIImageView {
    
    func loadImage(url: String) {
        ImageLoader.sharedInstance.imageForUrl(url, callback:{(image: UIImage?, url: String, error: NSError?) in
            if image != nil {
                self.image = image;
            }
        })
    }
    
}

class ImageLoader {
    
    var cache = NSCache()
    
    class var sharedInstance : ImageLoader {
        struct Static {
            static let instance : ImageLoader = ImageLoader()
        }
        return Static.instance
    }
    
    func imageForUrl(urlString: String, callback:(image: UIImage?, url: String, error: NSError?) -> Void ) {
        dispatch_async(dispatch_get_global_queue(DISPATCH_QUEUE_PRIORITY_BACKGROUND, 0), {()in
            var data: NSData? = self.cache.objectForKey(urlString) as? NSData
            
            if let goodData = data {
                let image = UIImage(data: goodData)
                dispatch_async(dispatch_get_main_queue(), {() in
                    callback(image: image, url: urlString, error: nil)
                })
                return
            }
            
            var downloadTask: NSURLSessionDataTask = NSURLSession.sharedSession().dataTaskWithURL(NSURL(string: urlString)!, completionHandler: {(data: NSData!, response: NSURLResponse!, error: NSError!) -> Void in
                if (error != nil) {
                    callback(image: nil, url: urlString, error: error)
                    return
                }
                
                if data != nil {
                    let image = UIImage(data: data)
                    self.cache.setObject(data, forKey: urlString)
                    dispatch_async(dispatch_get_main_queue(), {() in
                        callback(image: image, url: urlString, error: nil)
                    })
                    return
                }
                
            })
            downloadTask.resume()
        })
    }
}
