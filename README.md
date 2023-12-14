# Enraiged Laravel

**[Laravel 10](https://laravel.com/docs/10.x/releases)
 • [Vue v3.3](https://vuejs.org/guide/introduction.html)
 • [Inertia.js v1.0](https://inertiajs.com/)
 • [PrimeVUE v3.40](https://primevue.org/installation/)
 • [PrimeFlex v3.3](https://primeflex.org/installation)
 • [PrimeIcons v6.0](https://primevue.org/icons/#list)**



## Table of Contents

- [Installation](#installation)
  * [Retrieve Repository](#retrieve-repository)
  * [Init Environment](#init-environment)
  * [Install Database](#install-database)
  * [Build Client](#build-client)
  * [Serve Application](#serve-application)
- [Usage](#usage)
  * []()
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

#### Known Issue

I encountered an issue with Primevue Datatables handling of rowgroup colspan. In the vendor files, they are actively
subtracting the calculated column count and I don't understand why. I've included a patch to prevent this subtraction.

Apply the patch (optional):

> Revert these changes by using `-Rp0` instead of `-p0`

```bash
patch -Nr - --version-control none -p0 < patches/primevue-3.40.1-datatable-correct-rowgroup-colspan.patch
```

> **Note:** The `npm run build` command will need to be reexecuted after applying this patch.

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

#### Known Issue

Primevue does not seem to be ssr-ready, so I spent some time providing a quick means of correcting the vendor files. 
There are two options for applying these corrections. While option 2 is quicker, option 1 is more likely to work for
future versions of the vendor packages.

> **Note:** Verify whether this fix is working for you by inspecting the viewing the html source with the SSR service
running. If SSR is working, the html body will be populated (or hydrated) with the html structure of the page.

**Option 1: Artisan Command**

The primevue packages can be fixed with an artisan command:

> Add the --revert flag to reverse these changes.

```bash
php artisan enraiged:fix-ssr
```

**Option 2: Apply Patch**

Or, the quicker option is to apply the provided patch:

> Reverse these changes by using `-Rp0` instead of `-p0`

```bash
patch -Nr - --version-control none -p0 < patches/primevue-3.40.1-ssr-ready-corrections.patch
```

> **Note:** The `npm run build` command will need to be reexecuted after applying this patch.



## Usage

...



## License

Enraiged Laravel is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
