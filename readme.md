
## Setup

- Copy file .env.example and rename to file .env => setup up database.
- Run command 
    - composer install.
    - php artisan key:generate
    - php artisan migrate
- Visit url
    - domain.com/upload => upload file
    - domain.com/history => history file and download file