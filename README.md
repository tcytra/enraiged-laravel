# Enraiged Laravel

**Laravel Vue Inertia**

> **Please Note:** This is not intended for production use.

## Technology Stack

+ [Laravel 9](https://laravel.com/docs/9.x/releases)
+ [Vue 3](https://vuejs.org/guide/introduction.html)
+ [Inertia.js](https://inertiajs.com/)
+ [PrimeVUE 3](https://www.primefaces.org/primevue/#/setup)
+ [PrimeFlex 3](https://www.primefaces.org/primeflex/)
+ [PrimeIcons v5](https://www.primefaces.org/primevue/#/icons)

---

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

---

## Configure Application

The application configuration file must be created and updated to suit the environment:

```bash
cp .env.example .env     # create the .env file from the example config
php artisan key:generate # create the application key
```

The setup from the .env.example will be enough to get you started in a local environment. At minimum, a valid database 
connection will need to be created in the .env config file. Change the appropriate lines to match the environment:

> **Note:** You could edit these from the command line using `sed`.

```bash
sed -i 's|DB_HOST=.*|DB_HOST=127.0.0.1|' .env
sed -i 's|DB_DATABASE=.*|DB_DATABASE=enraiged|' .env
sed -i 's|DB_USERNAME=.*|DB_USERNAME=enraiged|' .env
sed -i 's|DB_PASSWORD=.*|DB_PASSWORD=changeme|' .env
```

> **Note:** Non standard values have been placed into the .env.example config file and will be copied to your .env:

```
ALLOW_REGISTER=true
AUTO_LOGIN=true
```

These values will override their counterpart definitions in the config/auth.php config file. Completely remove these 
from your .env if you wish to control these parameters from the auth config array.

**ALLOW_REGISTER** will turn on or off the ability to register an account as a guest.

**AUTO_LOGIN** will enable or disable the automatic post-registration login

> **Note:** AUTO_LOGIN will not take effect if the User model is configured to verify registered email addresses.

---

## Build Database

We can now execute the data migration and seeder scripts:

```bash
php artisan migrate --seed
```

---

## Build Client

Finally, we will install the node packages and build the front-end resources. Start with:

```bash
yarn
```

And when that finishes:

```bash
yarn dev
```

> **Note:** I was getting npm complaints about mismatched binaries; Executed: `npm config set scripts-prepend-node-path auto`

---

## Serve the application

The simplest way to launch and preview this application is with `artisan serve`:

```php
php artisan serve
```

Now, navigate to (http://127.0.0.1:8000/), et voilà.

Serving this application by other means is beyond the scope of this README.
