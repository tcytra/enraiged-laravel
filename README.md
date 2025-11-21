# Enraiged Laravel v0.4.x

**[Laravel 12](https://laravel.com/docs/12.x/releases)
 • [Vue v3.5](https://vuejs.org/guide/introduction.html)
 • [Inertia.js v2.0](https://inertiajs.com/)
 • [Primevue v4.3](https://primevue.org/laravel)
 • [TailwindCSS v4.0](https://tailwindcss.com/docs/installation/framework-guides/laravel/vite)
**

**Enraiged Laravel is a starter kit implementing Laravel 12, Vite, VueJS, InertiaJS, Primevue, and TailwindCSS.**

> **Please Note:** The **0.4.x** branch is currently being tested for production; Use with caution, still lots to do.


## Table of Contents

- [Installation](#installation)
  * [Retrieve Repository](#retrieve-repository)
  * [Init Environment](#init-environment)
  * [Build Database](#build-database)
  * [Build Client](#build-client)
  * [Patch Packages](#patch-packages)
  * [Serve Application](#serve-application)
- [Licence](#license)


## Install Application

### Retrieve Repository

```bash
cd /path/to/your/repos/ # traverse into your repositories directory
git clone --depth 1 --single-branch --branch 0.4.x https://github.com/tcytra/enraiged-laravel
cd enraiged-laravel/
```

Install the vendor packages:

> Add the --no-dev flag when installing on a production host.

```bash
composer install
```


### Init Environment

Create the initial environment configuration:

```bash
cp .env.example .env     # create the .env file from the example config
php artisan key:generate # create the application key
```

The setup from the .env.example will be enough to get you started in a local environment. At minimum, valid DB_ 
parameters will need to be added, and the developer may want to double-check the basic APP_ config.


### Build Database

The migration and seeder assets can now be run:

```bash
php artisan migrate --seed
```

> Note: The initial administrator account is defined in ~/resources/seeds/users.json and will be created with the above 
command. The default email:password for this user is **administrator@enraiged.local:changeme**. Please change this to 
something suitable for your project.


### Build Client

Finally, we will install the node packages and build the front-end resources. Start with:

> Add the --omit=dev flag when installing on a production host.

```bash
npm install
```

Launch the vite development build (during development):

```bash
npm run dev
```

When complete, build the app for service:

```bash
npm run build
```


### Patch Packages

In the v4.x distribution of Primevue Datatable, a previously existing feature to display column data in a 'stack' format
under a provided breakpoint was removed for unknown reasons. Enraiged Laravel 0.4.x includes an optional patch to 
restore this feature.

Apply the patch by running the following command:

> **Note:** The `npm run build` command will need to be reexecuted after applying this patch.

```bash
patch -p0 < patches/primevue-datatable-4.4.1-restore-responsive-stack.patch
```

> Revert these changes by using -Rp0 instead of -p0.


### Serve Application

The simplest way to launch and preview this application is with `artisan serve`:

```bash
php artisan serve
```

Now, navigate to (http://127.0.0.1:8000/), et voilà.

Run the SSR server (this probably doesn't work yet, haven't tested :):

```bash
php artisan inertia:start-ssr
```

Serving this application by other means is beyond the scope of this README.


## License

Enraiged Laravel is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
