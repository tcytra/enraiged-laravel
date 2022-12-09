# Project History

Todo:
- Add remaining form fields (port from primevue)
- Addresses, Contacts, Impersonation, Networks
- Complex table searching
- Custom table filters
- Data Import (from model index page)
- Implement theme preference
- Import menus to database from json files
- Page exporter (ie. account details) (pdf, xls?, txt?)
- Geo, Geo Social
- Minimize menu preference?
- Model Activity History
- Move Auth Services into the Enraiged namespace
- New account creates registered list of site 'helps' (dismissable)
- Split VueTable component into reusable parts
- Test cases and documentation
- There is code common to the {Form,Table}Builder(s)
  - Implement parent RequestBuilder class?
- User configurable notifications system
- Username availability check
- Vendor role

! Correct avatar character centering in mobile browser
! Correct vue warning when selecting dropdown value (unknown cause, works anyway)

---

2022-12-09 : 0.0.16  
Update: Added enraiged asset publishing, table filters, other improvements

- Added ability to optionally publish enraiged assets during the install
- Added table filters via json configuration
  - Apply a model scope to select options filters
  - Performs security assertions
- Added strictVisibility scope to Role model
- Ensure body, card theming is accessible from the variables.css
- Removed embedded card header classes
- Updated initial roles and users seeding from json resource files

---

2022-07-18 : 0.0.15  
Update: Added auth config options; various corrections,improvements

This update provides additional auth configuration options, and
improvements to the form and menu handling. This update also corrects
some nagging issues and reorganizes the App,State components for
improved hierachy and begins the removal of vue state handling.

- Added 'allow_impersonation' configuration option and intitial system
- Added 'allow_name_change' configuration option and intitial system
- Added 'must_agree_to_terms' configuration option and intitial system
- Added 503 (artisan down) blade template
- Added ability to define 'auth' and 'guest' menus, or default for all
- Added ability to detect route method from name in the table actions
- Added ability to disable form fields from the configuration template
- Added injectable {action,error}Handler methods to the AppCore
- Adjustments to the App,State components:
  - Renamed AppState to AuthState
  - GuestState now also leverages CoreState; retrieve state from api
  - Removed use,meta objects from InertiaRequest, provide with state
- Corrected issue when clicking Accounts Index avatar
- Corrected various minor ui/ux issues with the main panel menu
- Simplfied call to form builder create,edit methods from controllers

---

2022-05-25 : 0.0.14  
Update: Added ip tracking, secondary login, menu builder, email notices

This update expands the configurability of the authentication system in
various ways, including allowing a second login credential, ip address
tracking, and some account policy enforcement systems. Included in this
update are some basic account observer driven email notifications.

Also, this update provided an initial configuration file based menu
builder system with security assessments, similar to the solution used
for the form builder system.

Finally, this update furthers the separation between the laravel
package and the enraiged system, as the intent is to eventually split
the Enraiged namespace into a distinct composer package.

- Added agreements table
- Added auth configuration helper functions:
  - allow_username_login() to simplify reading a pair of config options
- Added auth configuration options:
  - allow_secondary_credential to allow a second email (or username)
  - allow_username_login to expressly allow a username login
- Added configurable ability to track ip addresses
- Added configurable notifications for account events:
  - account_introduction, account_login_change, internet_address_login
- Added ip helpers: ip_from_binary(), ip_to_binary(), ip_version()
- Added initial (config file driven) secure menu builder system
- Renamed enraiged.setup config to enraiged.app
- Renamed 'menu panel' tp 'main panel' in various places
  - Split menus.scss into {auth,main}.scss
- Restored original laravel auth config file
  - Added custom auth config to enraiged.auth
- Restored original laravel create_users_table migration
  - Modify users table in the enraiged namespace

---

2022-05-09 : 0.0.13  
Update: Implemented dateformat,languages,timezones as user settings

This update provides the ability for an authorized user to select
preferred dateformat, language, and timezone in their account settings.

- Added account settings form,page,controller with new users columns
- Added core components for App{,State}
- Added crude ability to translate date strings (months, need weeks)
- Added dateformat,language,military_time columns to the users table
- Added enraiged.setup. config namespace
- Added timezone helpers
- Added translations for en,es,fr
- Added vue-i18n to the node packages
- Corrected issue: administrator role changed when updating account
- Revised AppState component to fetch api data before showing app
- Upgraded the node client packages

---

2022-05-04 : 0.0.12  
Update: Various fixes and improvements to page actions,header,messages

This update is a code cleanup,reorganization.

- Added back buttons to various pages; Access auth.user via $attrs
- Added is_administrator attribute to the Account model
- Added Page{Actions,Header,Messages} components to available pages
- Added {Birthdate,{,Readable}Datetime}AttributeResource classes
- Corrected css width issue with browser scrollbar present
- Corrected namespace issue in the enraiged avatar requests
- Corrected various vuejs warnings
- Moved all custom App\Http logic to the Enraiged\Http namespace
- Updated the composer vendor packages

---

2022-05-01 : 0.0.11  
Update: Added Avatar system; Added basic content to My Account

This update provides a morphable avatar system and the beginning of
an account management system.

- Added Active indicator component; implemented in the accounts table
- Added Avatar model, basic support systems to the enraiged namespace
  - Ability to select avatar css color
  - Ability to upload,remove image
- Added Avatar,Status ui components; implemented in the accounts table
- Added AvatarEditor component to manage an avatar
- Added Auth store for AppState auth.user
- Added basic content to the My Account (Show) dashboard
- Added forms,pages,routes,etc for updating My {Avatar,Login,Profile}
- Added list view to the My Files display
- Corrected UpdateAccount service issue when password is null
- Corrected issue with table exporting symbol not falsified
- Corrected menu toggle transition (not applied) bug
- Corrected table issues preserving,restoring column sort

---

2022-04-26 : 0.0.10  
Update: Added: roles; forms builder,templating; create account form

This update provides ranked roles for authorized users.

- Added FormBuilder with json form template (similar to TableBuilder)
  - Ability to organize form fields into logical sections
  - Ability to prevent section visibility based on security assertions
- Added provision for ABSOLUTE_URIS in the env config
- Added Role model and basic support systems to the enraiged namespace
- Corrected issue with accounts index model; returning role_id as id
- Corrected issue with file download; Set filename,content-type
- Updated AccountForm, VueForm, and Vue{..}Field components

---

2022-04-19 : 0.0.9  
Update: Added full-featured builder,template functionality to the table

This update provides a form builder, templater system.

- Added accounts.{create,store} controllers, routes, pages
- Added axios to the package.json
- Added enraiged.tables.template to the config as the base table
- Added Export,File models,migrations; Ability to export csv,xlsx
- Added laravel-excel composer package for table exports
- Added placeholder My Files route,page,controller for files index
- Added TableBuilders to handle the request()->table() processing
- Added optional ability to preserve table state in localStorage
- Added table create action, refresh, pagination, search, sort
- Added various auth,date,utility helpers to the enraiged package
- Cleaned up the ui in the table sass; (header componenents)
- Move Requests\Accounts\IndexRequest to Requests\Accounts\TableRequest
- Move custom config files into the /config/enraiged directory

```
composer require psr/simple-cache:^1.0 maatwebsite/excel
```

References:

- [laravel-excel.com](https://docs.laravel-excel.com/3.1/exports/)

---

2022-04-11 : 0.0.8  
Update: Added row actions to the Accounts table; Rudimentary templating

This update provides the ability to define row actions for a table via
a templating mechanism. Accounts table can now show, edit, and delete.

- Added Accounts\Models\Table with AccountVisibility scope
- Added Pinia store management library package via yarn
- Added CreatePinia,ConfirmationService to the app.js
- Corrected scss issue with .content.main width (with scrollbars)
- Leverage store state to handle flash messages
- Reverted adding composer.json to packages/enraiged; ide misbehaving

---

2022-04-08 : 0.0.7  
Update: Added basic table + data for Accounts

This update provides a very basic Accounts table through the request
object. There are no row actions or data pagination yet.

- Added composer.json to packages/enraiged; Further isolate as package
- Added basic table + data for Accounts
- Moved the accounts controllers,requests,reoutes back to App namespace
- Moved the parent form,table requests into the Enraiged namespace

---

2022-04-07 : 0.0.6  
Update: Reorganized custom system into Enraiged namespace

This update begins the process of isolating the custom code into the
Enraiged namespace, to eventually split into a vendor package.

- Added CreateAccount db transaction service to create User + Profile 
- Added Enraiged\{App,Auth,Events}ServiceProviders
- Added storage:clean filesystem command to purge storage directory
- Added config/storage.php with array of clearable directories
- Added ADMIN_{EMAIL,PASSWORD} variables to the .env.example
- Added initial route, placeholder page for the Accounts\Index

---

2022-04-04 : 0.0.5  
Update: Completed Auth; Reorganized client-side; Added Account Edit

The Auth scaffolding is now completed, with the ability to log{in,out},
register (if option is true), reset forgotten password, apply password
requirements, and confirm password via middleware interrupt.

- Added auth.panel on the ui right had side
- Added initial account control panel page with basic account form
- Added initial account,user policies
- Added placeholder class for account updated event
- Added scss sizing classes, layout for .adjacent-labels .form
- Added VueDropdownField, VueForm, and VueFormField components
- Corrected final issues with auth scaffolding
- Reorganized the client layouts components and sass systems
- Seeding 10 random accounts on fresh migration (for table testing)

---

2022-03-28 : 0.0.4  
Update: Completed porting the Laravel Breeze auth scaffolding

Provides the ability to reset a password, confirm password, and verify
a registered email address.

- Added 'allow_registration','automated_logins' to the auth config
- Added 'data','message','status','success' to the flashed session
- Added layout-level flash session messaging system
- Added remaining Laravel Breeze auth scaffolding controllers,views
- Added resources for returning User,Profile
- Added vue pages,components for the remaining auth scaffolding
- Modified HandleInertiaRequests share() method output
- Renamed Default layout to App using state/{AuthState,GuestState}
- Renamed System\Persons model to Account\Profile throughout the system
- Reorganized,improved the existing Auth Login.Register systems
- Reorganized the layouts sass; Added breakpoint classes to #app.layout

---

2022-03-24 : 0.0.3  
Update: Added a basic registration form; Reorganizing,rebuilding

This update provides the ability to register an account in the system.

- Added custom fonts; expanded scss variables
- Added full-stack simple registration form
- Added password complexity configuration
- Added password_history table, user relationship
- Rebuilt,reorganized the controllers,routes,requests
- Rebuilt,reorganized the login form components
- Updated (corrected) the Open Sans font css

---

2022-03-22 : 0.0.2  
Update: Replaced vendor provided postcss,tailwindcss with sass,primevue

This includes updates to the package.json, yarn.lock, webpack.mix.js.
The initial ui/ux for the Login and Dashboard page components are
completed, including the Default layout component.

References:

- [primefaces.org/primevue](https://primefaces.org/primevue/)
- [primefaces.org/primeflex](https://www.primefaces.org/primeflex/)

---

2022-03-20 : 0.0.1  
Update: Manually added initial inertiajs package from pingcrm example

This is a minimal variant of the example code from inertiajs/pingcrm.
It will allow a log in and present a dashboard. There are tables,models
for users and persons.

References:

- [inertiajs.com](https://inertiajs.com/)
- [github.com/inertiajs/pingcrm](https://github.com/inertiajs/pingcrm)
