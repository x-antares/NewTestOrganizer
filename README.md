# Organizer

This app allows users to create events on the site and get push notification when event start. 


## Requirements

* PHP 8.1
* Composer
* Node js 14
* NPM 6.14

## How to Deploy

1. Cloning repository: `git clone https://github.com/x-antares/NewTestOrganizer.git`
2. Rename .env.example: mv .env.example .env
3. Create your own database with mail and config .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

4. Create your own OneSignal account on https://app.onesignal.com/signup, config OneSiganal by https://documentation.onesignal.com/docs/web-push-quickstart and config .env:

ONE_SIGNAL_APP_ID=
ONE_SIGNAL_AUTH_KEY=
ONE_SIGNAL_REST_API_KEY=


5. Run `npm install && npm run dev`
6. Installing composer packages `composer install`
7. Make migrate `php artisan migrate`
8. Start seeders `php artisan db:seed`
9. Start local process this queue `php artisan queue:work`
10. Start local server and start scripts: 

`php artisan serve`
`npm run watch`

10. Go to your site.
http://127.0.0.1:8000
