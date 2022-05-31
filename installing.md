Installing
==========

* Create an empty database for your application (MySQL/MariaDB);

* Copy the content from .env.example and put it into .env file;

* Replace database credentials in .env file;

* Replace mail keys in .env file with mailtrap.io key;

    ```bash
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=123
    MAIL_PASSWORD=123
    MAIL_ENCRYPTION=tls
    ```

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
