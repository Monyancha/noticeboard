##Web Service

This simple web service will regularly check the feeds and send notifications to the app if new content is available. It will serve as the feeds management app for the school staff and the mobile app’s backend API.
The service will offer the following:

- Marketing of the mobile app.
- Registration of feeds by school staff.
- Service of feed URLs to mobile app.
- Regular monitoring feeds for new content.
- Sending Push and SMS notifications.
- Registration and removal of student phone (device and number).

###Content / Data
Data to be handled by the system.

- `users`: Staff names, emails and password.
- `feeds`: Registered feeds. Each feed has a title, a description and a URL.
- `items`: Noticeboard content. Each item belongs to a feed, has a title, summary, content, author and date.
- `settings`: Various notifications settings.
- `devices`: Students devices and phone numbers.


###App Marketing
Single-page web app to market the notice board mobile app.

- **Home** ( `/`)
- **About** ( `/#about` )
- **Download** ( `/#download` )
- **Team** ( `/#team` )
- **Contact** ( `/#contact` )

###Content Management
Manage the system’s content.

- **Register** ( `/register` ): Register staff email and password.
- **Login** ( `/login` and `/logout` ): Use email and password to authenticate staff.
- **Dashboard** ( `/dashboard` ): Simple web app to manage noticeboard content.

	- Add, update and remove feeds.
	- Set, update notifications type (push notification or SMS or both).
	- Set, update push notifications and SMS providers settings.
	- Add, update and remove feed content.
	- Send notifications.

###HTTP API
Send and/or receive data from mobile app.

- `GET` from `/api/feeds`: Get registered feeds URLs.
- `GET` from `/api/feed/:name`: Get RSS of feed :name.
- `POST` to `/api/sync`: Sync all feeds and send notifications. Called every minute by a job scheduler. Used when pulling content from school’s CMS.
- `POST` to `/api/register`: Register student device and phone number.
- `POST` to `/api/unregister`: To remove a student’s phone and device.


This web service will be built around **CodeIgniter**, a powerful PHP framework with a very small footprint, **AngularJS**, an amazing JavaScript MVC framework, and **Bootstrap**, a very popular front-end framework for developing responsive, mobile first projects on the web. Finally, data will be served by **MySQL**, the world’s most popular database management system.
