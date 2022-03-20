# enraiged

## Install Application

Retrieve the repository contents:

```bash
cd /path/to/your/repos/ # ensure you are in the correct directory
git clone tcytra/enraiged
cd enraiged/
```

> **Important:** Ensure system state directories exist, these must be writable by the host service user:

```bash
install -d bootstrap/cache
install -d storage/{app,logs,framework/{cache,sessions,views}}
```

Install the vendor packages:

```bash
composer install
```

## Configure Application

The application configuration file must be created and updated to suit the environment:

```bash
cp .env.example .env     # create the .env file from the example config
php artisan key:generate # create the application key
```
