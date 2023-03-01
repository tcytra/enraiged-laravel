# Enraiged Laravel

**This package is experimental and not intended for production use.**

### Laravel +Vue +Inertiajs +PrimeVue +Vite

+ [Laravel 9](https://laravel.com/docs/9.x/releases)
+ [Vue 3](https://vuejs.org/guide/introduction.html)
+ [Inertia.js v1](https://inertiajs.com/)
+ [PrimeVUE 3](https://www.primefaces.org/primevue/#/setup)
+ [PrimeFlex 3](https://www.primefaces.org/primeflex/)
+ [PrimeIcons v6](https://www.primefaces.org/primevue/#/icons)

## Requirements

- Laravel v9 (review vendor requirements)
- NPM v16
- Vue v3

---

## Install Application

Retrieve the repository contents:

```sh
cd /path/to/your/repos/ # ensure you are in the correct directory
git clone https://github.com/tcytra/enraiged-laravel
cd enraiged-laravel/
```

Install the vendor packages:

```sh
composer install
```

---

## Configure Application

The application configuration file must be created and updated to suit the environment:

```sh
cp .env.example .env     # create the .env file from the example config
php artisan key:generate # create the application key
```

The setup from the .env.example will be enough to get you started in a local environment. At minimum, a valid database 
connection will need to be created in the .env config file. Change the appropriate lines to match the environment:

---

## Build Database

We can now execute the data migration and seeder scripts:

```sh
php artisan migrate --seed
```

---

## Build Client

Finally, we will install the node packages and build the front-end resources. Start with:

```sh
npm install
```

Launch the vite development build (during development):

```sh
npm run dev
```

When complete, build the app for service:

```sh
npm run build
```

---

## Serve the application

The simplest way to launch and preview this application is with `artisan serve`:

```sh
php artisan serve
```

Run the SSR server:

```sh
php artisan inertia:start-ssr
```

Now, navigate to (http://127.0.0.1:8000/), et voilà.

Serving this application by other means is beyond the scope of this README.


Stop the SSR server:

```sh
php artisan inertia:stop-ssr
```

Please see [https://inertiajs.com/server-side-rendering](https://inertiajs.com/server-side-rendering) for more 
information.

## License

Enraiged Laravel is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
