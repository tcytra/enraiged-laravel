# Project History

Todo:
- Addresses, Contacts, Impersonation, Organizations (Networks?)
- Auth options to prevent changing account primary login,profile name
  - (req permission, issue token)
- Complex table searching
- Custom table filters
- Data Import
- Geo, Geo Social
- I18n
- Menu
- Move Enraiged model resources into Enraiged\Http\Resources namespace
- New account creates registered list of site 'helps' (dismissable)
- Secondary email login
- Split VueTable component into reusable parts
- There is code common to the {Form,Table}Builder(s)
  - Implement parent RequestBuilder class?
- User timezone
- Validation and rules for table requests (?)
! Upgrade the node client packages

---

2022-05-04 : 0.0.12  
Update: Various fixes and improvements to page actions,header,messages

- Added back buttons to various pages; Access auth.user via $attrs
- Added is_administrator attribute to the Account model
- Added Page{Actions,Header,Messages} components to available pages
- Corrected css width issue with browser scrollbar present
- Corrected namespace issue in the enraiged avatar requests
- Corrected various vuejs warnings
- Moved all custom App\Http logic to the Enraiged\Http namespace
- Updated the composer vendor packages

---

2022-05-01 : 0.0.11  
Update: Added Avatar system; Added basic content to My Account

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
