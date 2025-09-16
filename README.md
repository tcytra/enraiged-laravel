# Enraiged Laravel

**[Laravel 10](https://laravel.com/docs/10.x/releases)
 • [Vue v3.5](https://vuejs.org/guide/introduction.html)
 • [Inertia.js v2.0](https://inertiajs.com/)
 • [PrimeVUE v3.53](https://v3.primevue.org/setup/)
 • [PrimeFlex v3.3](https://primeflex.org/installation)
 • [PrimeIcons v6.0](https://v3.primevue.org/icons/)**
 • [Ziggy v2.5](https://github.com/tighten/ziggy#readme)


## Table of Contents

- [Installation](#installation)
  * [Retrieve Repository](#retrieve-repository)
  * [Init Environment](#init-environment)
  * [Install Database](#install-database)
  * [Build Client](#build-client)
  * [Serve Application](#serve-application)
- [Usage](#usage)
  * [Seed Data](#seed-data)
  * [Enraiged Forms](#enraiged-forms)
- [Licence](#license)


## Install Application

### Retrieve Repository

```bash
cd /path/to/your/repos/ # traverse into your repositories directory
git clone https://github.com/tcytra/enraiged-laravel [new-directory]
cd [new-directory]/
```

> **Important:** Ensure system state directories exist, these must be writable by the host service user:

```bash
install -d bootstrap/cache
install -d storage/{app,logs,framework/{cache,sessions,testing,views}}
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

The database build process will use the data found in the seeds resources to add the application roles and the initial 
users. These assets were published into ~/resources/seeds/:

The developer will need to define their application roles and any initial users, such as a master administrator:

- Define the initial users in ~/resources/seeds/users.json
- Define the application roles in ~/resources/seeds/roles.json
- Update the roles enums in ~/app/Enums/Roles.php


The migration and seeder assets can now be run:

```bash
php artisan migrate --seed
```


### Build Client

Finally, we will install the node packages and build the front-end resources. Start with:

> Add the --no-dev flag when installing on a production host.

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


### Serve Application

The simplest way to launch and preview this application is with `artisan serve`:

```bash
php artisan serve
```

Run the SSR server:

```bash
php artisan inertia:start-ssr
```

Now, navigate to (http://127.0.0.1:8000/), et voilà.

Serving this application by other means is beyond the scope of this README.


Stop the SSR server:

```bash
php artisan inertia:stop-ssr
```


## Usage

### Laravel Horizon

The option exists for the developer to use Laravel Horizon for various queued tasks such as sending notifications and
exporting table data.

The documenation for Laravel Horizon includes running the following command to publish the assets
to the project filesystem (These assets already exist in the default Enraiged Laravel project files):

```bash
php artisan horizon:install
```

It remains for the developer to tailor the horizon setup for their project, which include setting up the supervisors in
the config file, setting up the driver database, and installing the supervisor daemon on the host.

Please refer to the [Laravel Horizon documentation](https://laravel.com/docs/10.x/horizon) for more information.


### Seed Data

All initial seed data can be found in the ~/resources/seeds directory.

**appmenu.json** Contains the main menu structure (currently read from the filesystem at runtime, not seeded to the db).

**countries.json** Contains the list of countries seeded into the database.

**regions.json** Contains the list of regions (states, provinces, etc) seeded into the database.

**roles.json** Contains the list of initial roles seeded into the database.

> **Important!** The `App\Enums\Roles` needs to be kept in sync with this data (for now).

**users.json** Contains the list of initial users seeded into the database.


### Enraiged Forms

Documentation for using the Enraiged Forms package can be found in the enraiged-forms/README.md.


## License

Enraiged Laravel is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
