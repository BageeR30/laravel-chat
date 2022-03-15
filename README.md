## About project
1:1 real time chat using sockets. If an offline user receives a message, he/she will be notified about that via email. There is a task scheduler that will remove old messages every 24 hours.

## Installation
- Clone repo: `git clone https://github.com/BageeR30/laravel-chat.git`
- Start containers: `docker-compose up -d`
- Run bash inside container: `docker-compose exec laravel.test bash`
- `composer install`
- `php artisan migrate`
- `npm i`
- `npm run prod`

Now you can visit http://localhost/