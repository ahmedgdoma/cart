# Cart API

This project was generated with [Lumen website](https://lumen.laravel.com/docs/7.x) version 7.x

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## set up project

* clone the project
* install packages `composer install`
* update `.env` file with your database credentials and new database name
* migrate database `php artisan migrate`
* make new jwt security key `php artisan jwt:secret`


## Testing
to run phpunit testing run command `./vendor/bin/phpunit`

## Call APIs
serve project with command `php -S localhost:8000 -t public`

* login API
you can  login with API `POST`  `http://localhost:8000/login`

 Headers: `Content-Type: application/json`
 
 Body: `{"email":"admin@myShop.dev", "password": "admin"}`
 
 and it retrieves API Token
 
 available users
 
 1- Admin: Email: `"admin@myShop.dev` password: `admin`
 
 2- client: Email: `client@myShop.dev` password: `client`
 
 For Admin APIs
 
 1- create new product
 
  with API `POST`  `http://localhost:8000/admin/createProduct`
 
  Headers: 
  
  `Content-Type: application/json`
  
  `Authorization: bearer +yourTokenReturnFromLogin`
  
  Body: `{"name":"new product name", "price": float price}`
  
   2- create new product
   
   with API `POST`  `http://localhost:8000/admin/createOffer`
   
   Headers: 
    
    `Content-Type: application/json` 
    `Authorization: bearer +yourTokenReturnFromLogin`
    
   Body: 
   
   `{"product_name":"exist product name", "product_count": integer number,
    "offer_product":"exist product name", "offer_product_count": integer number,
    "sale": integer Number from 0 to 100
    }`
    
* product_name: is required and must exist in products
* product_count: is required and integer to determine how many pieces required for the offer
* offer_product: if not added the offer will be on the product itself if added the offer will be on extra product
* offer_product_count: integer to determine how many pieces extra in the offer
* sale: is required integer and this is the offer percentage

For Client API

 1- create a bill
 
  with API `POST`  `http://localhost:8000/makeCart`
 
  Headers: 
  
  `Content-Type: application/json`
  
  `Authorization: bearer +yourTokenReturnFromLogin`
  
  Body: `{"currency": "EGP", "items": "T-shirt T-shirt Shoes"}`
  
available Currencies
* EGP
* Dollar
if client choose not available currency it will change to Dollar
available items
* T-shirt $10.99
*  Pants $14.99
*  Jacket $19.99
*  Shoes $24.99
if client choose not available product an error will appear
if user choose an item with an extra offer but didn't add the extra offer item to items 
he will get a note that he can have an offer if item added



