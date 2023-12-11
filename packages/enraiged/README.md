
### Publish Assets

Enraiged requires certain assets be published into the local framework for proper application operation.

_Publishable assets can be referenced in the publish/ directory of the enraiged packages._

Publish these assets collectively with the following:

> Note: --force is necessary to overwrite the original DatabaseSeeder.php and web.php route file.

```bash
php artisan vendor:publish --tag=enraiged --force
```

Or, publish these assets selectively:

```bash
php artisan vendor:publish --tag=enraiged-config --force  # overwrite original ~/config/auth.php
php artisan vendor:publish --tag=enraiged-migrations
php artisan vendor:publish --tag=enraiged-routes --force  # overwrite original ~/routes/web.php
php artisan vendor:publish --tag=enraiged-seeders --force # overwrite original ~/database/seeders/DatabaseSeeder.php
php artisan vendor:publish --tag=enraiged-seeds --force
```

**Important:** It is not recommended to omit publishing any of these assets without a strategy to replace them.

A new developer is especially encouraged to familiarize themselves with the configuration files that are added to the ~/config/enraiged directory.
