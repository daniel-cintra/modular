### Create a new Laravel Project

```bash
laravel new modular-app
```

Configure the database connection `.env`

```
DB_DATABASE=project_db_name
```

Add the modular repository to `composer.json`

```json
    "license": "MIT",
    "repositories": [
        {
            "type": "path",
            "url": "../modular"
        }
    ],
```


Add the modular dependency to `composer.json`

```json
    "require": {
        ...
        "laravel/tinker": "^2.7",
        "modular/modular": "dev-main"
       ...
    },
```

Update composer modules

```bash
cd modular-app && composer update
```

Run the install command

```bash
php artisan modular:install
```