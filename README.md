<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://www.4me.com/wp-content/uploads/2018/01/4me-icon-link.png" width="300"></a></p>


## About URL shortener

This application shortens the link.

With additional functionality:
- authorization to store your personal links
- named link
- the secret key at the end of the link
- link expiration date
- blacklist for named links

## How to install

Write this in terminal

- git clone https://github.com/hels123/url-shortener.git
- cd url-shortener
- composer install --ignore-platform-reqs
- cp .env.example .env
- php artisan key:generate
- ./vendor/bin/sail build --no-cache
- ./vendor/bin/sail up -d
- ./vendor/bin/sail npm install
- ./vendor/bin/sail artisan migrate --seed

Use github auth - create github application, copy and paste github_client_id and github_client_secret to .env

## Enjoy!
