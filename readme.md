
## Setup

- Copy file .env.example and rename to file .env => setup up database.
- Run command 
    - composer install.
    - php artisan key:generate
    - php artisan migrate
- Visit url
    - domain.com/upload => upload file by file upload js
    - domain.com/dropzone => upload file by dropzone js
    - domain.com/resumable => upload file by resumable js
    - domain.com/history => history file and download file