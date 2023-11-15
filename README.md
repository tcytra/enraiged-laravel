# Enraiged Laravel

> **Status:** This package is currently being tested as the framework in a small number of production projects.

### Laravel +Vue +Inertiajs +PrimeVue +Vite

+ [Laravel 10](https://laravel.com/docs/10.x/releases)
+ [Vue 3](https://vuejs.org/guide/introduction.html)
+ [Inertia.js v1](https://inertiajs.com/)
+ [PrimeVUE 3](https://www.primefaces.org/primevue/#/setup)
+ [PrimeFlex 3](https://www.primefaces.org/primeflex/)
+ [PrimeIcons v6](https://www.primefaces.org/primevue/#/icons)

---

## Install Application

Retrieve the repository contents:

```sh
cd /path/to/your/repos/ # ensure you are in the correct directory
git clone https://github.com/tcytra/enraiged-laravel
cd enraiged-laravel/
```

> **Important:** Ensure system state directories exist, these must be writable by the host service user:

```sh
install -d bootstrap/cache
install -d storage/{app,logs,framework/{cache,sessions,views}}
```

Install the vendor packages:

> Add the --no-dev flag when installing on a production host.

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

> Add the --no-dev flag when installing on a production host.

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

### Known Issue

I encountered an issue with Primevue Datatables handling of rowgroup colspan. In the vendor files, they are actively
subtracting the calculated column count and I don't understand why. I've included a patch to prevent this subtraction.

Apply the patch (optional):

> Revert these changes by using `-Rp0` instead of `-p0`

```sh
patch -Nr - --version-control none -p0 < patches/primevue-3.40.1-datatable-correct-rowgroup-colspan.patch
```

> **Note:** The `npm run build` command will need to be reexecuted after applying this patch.

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

### Known Issue

Primevue does not seem to be ssr-ready, so I spent some time providing a quick means of correcting the vendor files. 
There are two options for applying these corrections. While option 2 is quicker, option 1 is more likely to work for
future versions of the vendor packages.

> **Note:** Verify whether this fix is working for you by inspecting the viewing the html source with the SSR service
running. If SSR is working, the html body will be populated (or hydrated) with the html structure of the page.

**Option 1: Artisan Command**

The primevue packages can be fixed with an artisan command:

> Add the --revert flag to reverse these changes.

```sh
php artisan enraiged:fix-ssr
```

**Option 2: Apply Patch**

Or, the quicker option is to apply the provided patch:

> Reverse these changes by using `-Rp0` instead of `-p0`

```sh
patch -Nr - --version-control none -p0 < patches/primevue-3.40.1-ssr-ready-corrections.patch
```

---

## License

Enraiged Laravel is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
