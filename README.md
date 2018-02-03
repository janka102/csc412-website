# csc412-website

Website made at San Francisco State University in CSC412 during Fall of 2017. 

## About

The backend is written in PHP. It uses a MySQL database to hold quotes and tile data.

The client is built with [Bootstrap 4](https://getbootstrap.com/) and is mobile friendly. It features a section to submit quotes and a small clone of Reddit's [r/place](https://www.reddit.com/r/place/). The quotes and tile data are sanitized to prevent SQL injection by using `htmlspecialchars()` to print data and `mysqli`'s `bind_param()` when saving data.

To run:

1. Copy `auth.php.example` to `auth.php` and fill in the variables for the database credentials
2. Use the `src` folder as webroot for PHP
    - Simplest way is running `php -S localhost:8080 -t src`
