Installing
==========

* Create an empty database for your application (MySQL/MariaDB);

* Copy the content from .env.example and put it into .env file;

* Replace database credentials in .env file;

* Run composer and yarn to install all the dependencies required;

    ```bash
    composer install;
    ```

* Run database migrations to create tables and seed it;
    ```bash
    php artisan migrate --seed;
    ```

* Default user
    ```html
    Email: test@example.com
    Password: laravel-test
    ```
