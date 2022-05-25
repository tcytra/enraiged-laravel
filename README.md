# Enraiged Laravel

### Laravel Vue Inertia

> **Please Note:** This is not intended for production use.

**This package is in an experimental state of development and therefore volatile and subject to dramatic changes.**


## Preamble

I began this as a personal project to introduce myself to the Inertia.js system. I had worked with and preferred Laravel
as a solution for many years, initially with blade templating and later with Vue as a pure SPA, but I was dissatisfied
with the limitations and confinement of either of these and was interested in something new and unique.

This led me to discover Inertia.js and the demo software (PingCRM) they provide as an example, and enraiged-laravel was
born as an experiment to familiarize myself with this as my permanent go-to solution. Once I began working with it I
didn't want to stop, and so here we are. Inertia and Laravel really is a 'best-of-both-worlds' option and I have (and 
will continue to) invest my personal time into furthering this, my little experiment.


## Features

- Laravel authentication scaffolding with extra configurable options
- Forms, menus, tables templating and builders with security assertions
- User timezone, language, and date-format options
- Hybrid css or uploaded image model-morphable avatars


## Technology Stack

+ [Laravel 9](https://laravel.com/docs/9.x/releases)
+ [Vue 3](https://vuejs.org/guide/introduction.html)
+ [Inertia.js](https://inertiajs.com/)
+ [PrimeVUE 3](https://www.primefaces.org/primevue/#/setup)
+ [PrimeFlex 3](https://www.primefaces.org/primeflex/)
+ [PrimeIcons v5](https://www.primefaces.org/primevue/#/icons)

[Introducing InertiaJS](https://reinink.ca/articles/introducing-inertia-js)

---

## Install Application

Retrieve the repository contents:

```bash
cd /path/to/your/repos/ # ensure you are in the correct directory
git clone https://github.com/tcytra/enraiged-laravel
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


## License

Enraiged Laravel is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
