# URL Short

URL Short is a Api PHP library for shortening/minifying website urls.

With this library it is possible to register, edit and remove urls, with a user token.

When you access a minified URL, the site will automatically go to the corresponding url, generating a hit counter.

Whenever necessary, you can refer to the details for a shortened url, such as the access count.

## Installation

To install the project, you need a machine with php and laravel compatible database.

### Requires:

1. PHP 7.1.3

### Steps for Instalation:
1. Clone the GIT project
```bash
git clone https://github.com/guipassos/urlshort.git
```
2. Download the dependencies with:
```bash
composer install
```
3. Copy the file ".env.example" to ".env" and edit the settings for your database.

4. In the file ".env" set the website url in the key: APP_URL.

5. Generate application key wih:
```bash
php artisan key:generate
```
6. Create the migrations and initial application data
```bash
php artisan migrate --force
php artisan db:seed
```
## Example

A working example is running at the link: http://wget.space

## Usage - Routes

### 1. GET a token for tests
#### Method: GET
* /user
* Example: http://wget.space/user
#### Headers: 
* Content-Type: application/json
#### Body:  
* {"email":"app@test.com","password":"123"}
### 2. POST your URL
#### Method: POST
* /urls
* Example: http://wget.space/urls
#### Headers: 
* Content-Type: application/json
* token: YOUR_TOKEN_FROM_STEP_1
#### Body:
* {"url":"http://www.google.com","name":"google"}
### 3. GO to URL minified
#### Method: GET
* /MINIFIED_URL_HASH
* Example: http://wget.space/ER52hpdJCIEF6v1M
### 4. GET details from URL minified
#### Method: GET
* /urls/MINIFIED_URL_HASH
* Example: http://wget.space/urls/ER52hpdJCIEF6v1M
### 5. DELETE url minified
#### Method: DELETE
* /urls/MINIFIED_URL_HASH
* Example: http://wget.space/urls/ER52hpdJCIEF6v1M
#### Headers:
* Content-Type: application/json
* token: YOUR_TOKEN_FROM_STEP_1
### 6. UPDATE url minified
#### Method: POST
* /urls/MINIFIED_URL_HASH
* Example: http://wget.space/urls/ER52hpdJCIEF6v1M
#### Headers:
* Content-Type: application/json
* token: YOUR_TOKEN_FROM_STEP_1
#### Body:
* {"url":"http:\/\/www.bing.com","name":"bing"}

## Contributing
Pull requests are welcome. 

## License
[MIT](https://choosealicense.com/licenses/mit/)