# Enraiged Laravel v0.4.x

**[Laravel 12](https://laravel.com/docs/12.x/releases)**


## Table of Contents

- [Installation](#installation)
  * [Retrieve Repository](#retrieve-repository)
  * [Init Environment](#init-environment)
  * [Install Database](#install-database)
  * [Serve Application](#serve-application)
- [Licence](#license)


## Install Application

### Retrieve Repository

```bash
cd /path/to/your/repos/ # traverse into your repositories directory
git clone https://github.com/tcytra/enraiged-laravel [new-directory]
cd [new-directory]/
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


### Serve Application

The simplest way to launch and preview this application is with `artisan serve`:

```bash
php artisan serve
```

Now, navigate to (http://127.0.0.1:8000/), et voilà.

Serving this application by other means is beyond the scope of this README.


## License

Enraiged Laravel is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
