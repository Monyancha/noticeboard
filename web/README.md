##USIU Notice Board Web Service
This simple web service will regularly check the feeds and send notifications to the app if new content is available. It will serve as the feeds management app for the school staff and the mobile app’s backend api.

####Features Summary
- Registration of feeds by school staff
- Serve feed URLs to app
- Check feeds once every minute for new content
- Send GCM (Google Cloud Messaging) and SMS notifications
- Student phone registration and removal

####Feed Management

- Home ( `/` ): Landing page.
- Register ( `/register` ): Register staff email and password.
- Login ( `/login` and `/logout` ): Use email and password to authenticate staff.
- Dashboard ( `/dashboard` ):
	- Add, update and remove feeds.
	- Set, update notifications type (push notification or SMS or both)

####HTTP API
- `GET` from `/api/feeds`: Get registered feeds URLs.
- `POST` to `/api/sync`: Sync all feeds and send notifications. Called every minute by a job scheduler like `CRON`
- `POST` to `/api/register`: Register student device and phone number.
- `POST` to `/api/unregister`: To remove a student’s phone and device.

####Database Tables ( `MySQL` )
- `users`: Staff emails and password.
- `feeds`: Registered feeds.
- `settings`: Notifications settings.
- `devices`: Students GCM devices and phone numbers.
