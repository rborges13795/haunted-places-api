# haunted-places-api
A simple API made with Lumen that fetches haunted places data through the use of keywords.

## Installation
You can clone the repository to a path of your choice or donwload the zip file and then extract it.
```
https://github.com/rborges13795/haunted-places-api.git
```
## Configuration
First thing that needs to be done is to create a database. After that, change the `.env.example` file to just `.env` and configure your database setting as well 
as adding a random string to `APP_KEY` inside the file.
Then, run composer install with
```
composer install 
```
Now, make the necessary migration and seeding to the database (the seeding will take more than a second since the json file that will be seeded has more than 10.000 rows) with
```
php artisan migrate --path=/database/migrations/2021_06_29_133904_create_haunted_table
php artisan db:seed
```
### Usage
For testing the api i highly recommend donwloading [Postman](https://www.postman.com). After downloading it, initiate your server and add to postman one of the uncommented routes 
in /routes/web.php (note that the prefix is `/api/haunts`. To initiate the server:
```
php -S localhost:8080 -t public
```
Finally, to fetch a haunted place using a keyword, add to Postman the url http://localhost:8080/api/haunts (assuming you initiated the server with :8080), go to 
`body`, change from HTML to JSON, type a keyword then press `send`.
```
{
    "keyword": "vampire"
}
```
## Adding authentication and a Users table
In case you want the feature of adding users and allowing them to have favorite haunted places, do the following:
- Go to your `.env` file and add a string (preferably a encoded one) to `JWT_KEY`.
- Migrate the tables `users` and `user_haunt` with
```
php artisan migrate
```
- Now to seed the tables, go to /database/seeders/DatabaseSeeder.php and comment the call to HauntSeeder and uncomment the others. Check the files `UserSeeder.php`
and `UserHauntSeeder.php` before seeding them so you can choose the values to be added.
```
php artisan db:seed
```
- Then, go to /routes/web.php and uncomment all the routes that are commented in order to use them in Postman.
## The Data
The Json file with all the haunted places data is already on the api on /database/data. I downloaded and formatted said file on the [data.com](https://data.world/timothyrenner/haunted-places) Website. Furthermore, you can check out how the data was scraped from the [Shadowlands](http://theshadowlands.net/places/) Website in [this](https://github.com/timothyrenner/shadowlands-haunted-places) repository made by [Timothy Renner](https://github.com/timothyrenner).
## Requirements
- PHP >= 7.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
