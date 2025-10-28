# Enraiged Laravel v0.4.x

**[Laravel 12](https://laravel.com/docs/12.x/releases)
 • [Vue v3.5](https://vuejs.org/guide/introduction.html)
 • [Inertia.js v2.0](https://inertiajs.com/)
 • [Primevue v4.3](https://primevue.org/laravel)
 • [TailwindCSS v4.0](https://tailwindcss.com/docs/installation/framework-guides/laravel/vite)
**

**Enraiged Laravel is a starter kit implementing Laravel 12, Vite, VueJS, InertiaJS, Primevue, and TailwindCSS.**

> **Please Note:** The **0.4.x** branch is currently being tested for production use.


## Table of Contents

- [Installation](#installation)
  * [Retrieve Repository](#retrieve-repository)
  * [Init Environment](#init-environment)
  * [Publish Routes](#publish-routes)
  * [Build Database](#build-database)
  * [Build Client](#build-client)
  * [Serve Application](#serve-application)
- [Configuration](#configuration)
  * [App Config](#app-config)
  * [Auth Config](#auth-config)
  * [Password Config](#password-config)
  * [Secure Http Headers](#secure-http-headers)
- [Internationalisation](#internationalisation)
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


## Publish Routes

Make the routes available in the client-side by publishing them into the ~/resources/js/ directory:

```bash
phpa ziggy:generate # will output into ziggy.js
```

> This file will need to be regenerated when routes are added, removed, or modified.

An alternate means of providing the routes to the client-side is through the @routes directive in the app.blade.php, but
including the javascript in the html head will trigger Content-Security-Policy 'script-src' 'self' errors.


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

Now, navigate to (http://127.0.0.1:8000/), et voilà.

Run the SSR server:

```bash
php artisan inertia:start-ssr
```

Serving this application by other means is beyond the scope of this README.


## Configuration

Enraiged Laravel provides many additional configuration options on top of the default Laravel setup, as described below.
These options are grouped into various file in the `~/config/enraiged/` directory, as follows:


### App Config

The app configuration options can be found in `~/config/enraiged/app.php`, as follows:

**Absolute Uris**

This configuration option is `false` by default and should be set to `true` if the maintainer wishes to generate routes
with the full path, scheme, and domain in the enraiged-laravel system. For example, the Auth controllers are leveraging
the abstract `App\Http\Controller::route()` method, which references this configuration value.

**Mail Markdown**

This configuration option is `false` by default and should be set to `true` if the maintainer wishes to format outgoing
emails with blade templates.


### Auth Config

The enraiged-laravel framework contains a port of the Laravel Breeze auth scaffolding system already built in, with
various configuration parameters the developer may find useful to quickly tailor how the authentication system works.

The auth configuration options can be found in `~/config/enraiged/auth.php`, as follows:

**Allow User Login**

Generally this value would always be `true`, but this is provided in the event the maintainer needs to quickly disable
user logins. The maintainer would still need to manually kill the sessions/tokens if there was such a need.

The .env equivalent is ALLOW_LOGIN=true|false.

**Allow Password Reset**

Generally this value would always be `true`, but this is provided in the event the maintainer needs to quickly disable
password resets. This configuration option does not affect whether or not a user can change their password through their
profile editor.

The .env equivalent is ALLOW_PASSWORD_RESET=true|false.

**Allow User Registration**

This configuration option is `false` by default and should be set to `true` if the application requires allowing guest 
registration. This configuration option does not affect whether or not a user can be created within the application by an
administrator.

The .env equivalent is ALLOW_REGISTER=true|false.

**Allow Secondary Credential**

This configuration option is `false` by default and should be set to `true` if the application requires allowing login
with a second email address.

The .env equivalent is ALLOW_SECONDARY=true|false.

**Allow Self Delete**

This configuration option is `true` by default and should be set to `false` if the application requires denying the
ability to delete their own accounts. This configuration option does not affect whether or not a user can be deleted 
within the application by an administrator.

The .env equivalent is ALLOW_DELETE=true|false.

**Allow Username Login**

This configuration option is `false` by default and should be set to `true` if the application requires allowing login
with a unique username. The **Allow Secondary Credential** must also be enabled for this option to work.

The .env equivalent is USERNAME=true|false.

**Force Guest Login**

This configuration option is `false` by default and should be set to `true` if the application has any number of pages
that may be viewed by unauthenticated guests. When `true`, **all** guest requests will be redirected to the login page.

Out of the box, the default Laravel Welcome screen will be displayed by a request to `/`. 

The .env equivalent is FORCE_GUEST_LOGIN=true|false.

**Must Verify Email**

This configuration option is `false` by default and should be set to `true` if the application requires email
verification before allowing a registered user to access the functionality of the application.

Out of the box, this value will determine which User model is defined in the Laravel `auth.providers.users.model`
configuration option, User or VerifiedUser. Please refer to this setting and set it to one or the other to suit your
application's requirements.

The content of the notification can be updated in `App\System\Users\Notifications\VerifyEmailNotification`.

The .env equivalent is MUST_VERIFY_EMAIL=true|false.

**Must Verify Secondary**

This configuration option is `false` by default and should be set to `true` if the application requires email
verification on the secondary email address.

This option should be enabled if the MUST_VERIFY_EMAIL is enabled.

The .env equivalent is MUST_VERIFY_SECONDARY=true|false.

**Reject Unverified Secondary**

This configuration option is `false` by default and should be set to `true` if the application should reject logging in
with unverified secondary email addresses. The default behavior (false) will redirect the user to a verify email page
as per Laravel behavior with an unverified primary email address.

The .env equivalent is REJECT_UNVERIFIED_SECONDARY=true|false.

**Send Login Change Notification**

This configuration option is `false` by default and should be set to `true` if the application maintainer wants to send
a notification to the user when any changes are made to their login credentials.

The .env equivalent is SEND_LOGIN_CHANGE=true|false.

**Send Login Address Notification**

This configuration option is `false` by default and should be set to `true` if the application maintainer wants to send
a notification to the user when a login is detected from a new ip address.

This configuration option requires 'track_ip_addresses' is enabled.

The .env equivalent is SEND_LOGIN_ADDRESS=true|false.

**Send Welcome Notification**

This configuration option is `false` by default and should be set to `true` if the application maintainer wants to send
a Welcome notification to a newly registered user.

Please note that if the `enraiged.auth.must_verify_email` configuration option is set to `true`, the notification will
be triggered _after_ the email verification is completed successfully, otherwise it will be sent immediately after the
user account has been created.

The content of the notification can be updated in `App\System\Users\Notifications\WelcomeNotification`.

The .env equivalent is SEND_WELCOME=true|false.

**Track Ip Addresses**

This configuration option is `false` by default and should be set to `true` if the application maintainer wants to track
ip addresses that users are logging in from.

The .env equivalent is TRACK_IP_ADDRESSES=true|false.


### Password Config

The enraiged-laravel framework provides the ability to apply various rules to user passwords for elevated security.

The password configuration options can be found in `~/config/enraiged/passwords.php`, as follows:

**Current Password Restriction**

This configuration option is `false` by default and should be set to `true` if the application maintainer wants to deny
submitting the current user password as an update request.

The .env equivalent is PASSWORD_CURRENT=true|false.

**Password History Restriction**

This configuration option is `false` by default and should be set to `true` if the application maintainer wants to deny
submitting the previous user password as an update request. This configuration option may also be set to an integer
value to deny resetting the password to that number of recent passwords in the user's history.

The history of passwords is stored in the `password_history` table, which will be populated if this configuration option
is set to anything but `false`.

The .env equivalent is PASSWORD_HISTORY=true|false|[0,*].

**Password Length Requirement**

This configuration option is set to force a minimum of `8` characters by default and can be set to any integer value, or
`false` to disable the requirement.

The .env equivalent is PASSWORD_LENGTH=false|[1,*].

**Password Lowercase Character Requirement**

This configuration option is `false` by default and should be set to `true` if the application maintainer wants to
enforce a policy of at least 1 lowercase character. This configuration option may also be set to an integer value to
require that number of lowercase characters.

The .env equivalent is PASSWORD_LOWERCASE=true|false|[1,*].

**Password Numeric Character Requirement**

This configuration option is `false` by default and should be set to `true` if the application maintainer wants to
enforce a policy of at least 1 numeric character. This configuration option may also be set to an integer value to
require that number of numeric characters.

The .env equivalent is PASSWORD_NUMERIC=true|false|[1,*].

**Password Special Character Requirement**

This configuration option is `false` by default and should be set to `true` if the application maintainer wants to
enforce a policy of at least 1 special character. This configuration option may also be set to an integer value to
require that number of special characters.

The .env equivalent is PASSWORD_SPECIAL=true|false|[1,*].

**Password Uppercase Characater Requirement**

This configuration option is `false` by default and should be set to `true` if the application maintainer wants to
enforce a policy of at least 1 uppercase character. This configuration option may also be set to an integer value to
require that number of uppercase characters.

The .env equivalent is PASSWORD_UPPERCASE=true|false|[1,*].


### Secure Http Headers

Enraiged Laravel applies secure http headers out of the box in all environments except local (because browser inspectors
will often trigger these security configurations, especially with the use of javascript eval() function).

The configuration parameters can be found in the `~/config/enraiged/headers.php` file for the developer to adjust as per
the application requirements.

The developer may refer to `App\Http\Middleware\SecureHttpHeaders` to modify the environments in which these secure
headers are applied, or the `~/bootstrap/app.php` file to disable them entirely (which is _not recommended_ in a 
production environment, unless they are already applied via the application service).

Securing the application is a large and complex topic and outside the scope of this README. It is the responsibility of
the developer to understand how and why to apply these configuration options properly.


## Internationalisation

Enraiged Laravel is i18n-ready out of the box as per [Laravel Localization](https://laravel.com/docs/12.x/localization).
Translations in the client-side are handled by the
[laravel-vue-i18n](https://www.npmjs.com/package/laravel-vue-i18n/v/2.7.8) package.

The maintainer of the Enraiged Laravel software is located in North America, as such the available locales currently
provided are English, French, and Spanish. These may be removed and other locales may be added to/from the `~/lang/`
directory as needed.

To change the default from 'en' to any other locale, be sure to change the `app.locale` value in `~/config/app.php`, the
fallbackLang value in the `~/resource/js/app.js` file, and the locale validation rules in `Auth\Register\Request` and
`Users\Update\Request`.

```js
fallbackLang: 'en',
```

The locales configuration is defined in the `~/config/enraiged/locales.php` file. This configuration defined the values
that are provided as language options throughout the application. **Please be sure to update this list to suit the needs
of your build**.

Please refer to the Laravel documentation for further information.


## License

Enraiged Laravel is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
