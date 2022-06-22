<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

##Requirement


- php > = 7.4
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- XML PHP Extension

## install

Clone from https://github.com/inspiration988/olive-challenge.git

`git clone https://github.com/inspiration988/olive-challenge.git .`

Run composer install

`composer install`

## Database
you have to run migration
`php artisan migrate`

## Run API
In root directory run :
`php artisan serve`



## Apis

- register POST : http://127.0.0.1:8000/api/v1/register
`{
    "email" : "test@yaho.com" , 
    "password" : "12345678"
}`

- login POST : http://127.0.0.1:8000/api/v1/login
`{
    "email" : "test@yaho.com" , 
    "password" : "12345678"
}`

- transaction request  withdraw : 1 , deposit : 2 POST : http://127.0.0.1:8000/api/v1/transaction/request
`{
    "amount" : 2000 , 
    "type" : 1
}`

- transaction list GET : http://127.0.0.1:8000/api/v1/transaction/list
- credit amount GET : http://127.0.0.1:8000/api/v1/wallet/creditAmount

