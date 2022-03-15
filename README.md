## About project
1:1 real time chat using sockets. If an offline user receives a message, he/she will be notified about that via email. There is a task scheduler that will remove old messages every 24 hours.
## Requirements
- composer 
- Docker Desktop with WSL2 on Windows or Docker Compose on Linux
## Installation
- Clone repo: `git clone https://github.com/BageeR30/laravel-chat.git`
- Run:`cd laravel-chat`
- Run: `composer install`
- Run: `./vendor/bin/sail up -d`
- `./vendor/bin/sail composer install`
- Copy env file: `cp .env.example .env`
- Add pusher config to env
- Generate app key: `./vendor/bin/sail artisan key:generate`
- Run: `./vendor/bin/sail artisan migrate`
- Run: `./vendor/bin/sail npm i`
- Run: `./vendor/bin/sail npm run prod`

Now you can visit http://localhost/