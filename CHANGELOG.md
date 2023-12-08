# Release Notes

2023-12-08 : 0.3.4.1  
Bugfix: Resolved various issues with 0.3.4

- Corrected issue preventing administrator accessing my profile systems
- Corrected issue preventing model tracking 'deleted_by' properly
- Corrected issue preventing avatar image upload; correct border radius
- Corrected issue preventing table refresh on delete action
- Simplified,improved initial administrator seeding; Ensure is_protected

---

2023-12-07 : 0.3.4  
Update: Completed initial builder systems for templating actions,menus

- Added Enraiged\Support\Builders\{ActionBuilder,MenuBuilder} classes
  - Improvements to the UriBuilder class
  - Moved User profile actions to Enraiged\Users\Actions\ProfileActions
  - Moved config.enraiged.menu to App\Menus builder/template system
  - Updated pages,PageActions components to reflect these changes
- Upgraded vite from 4.5.0 to 4.5.1 (dependabot alert)

Breaking changes from 0.3.3

The current main menu configuration system has been changed. Assembling
the main menu is now performed through the MenuBuilder class. The 
developer should be able to move their ~/config/enraiged/menu.php to 
~/app/Menus/Templates/main-menu.php and the app will work as before.

```
mv config/enraiged/menu.php app/Menus/Templates/main-menu.php
```

---

2023-12-04 : 0.3.3  
Update: Improvement updates to the datatables system; Various bugfixes

- Added ability to remove table template actions,filters,columns
- Added ability to define FORCE_DEFAULT_ROLE against user registration
- Added isSortable($column) method to the table builder
- Added RouteCollection class; Improved RequestCollection handling
- Corrected issues with the User/Profile relation
- Corrected issue preventing ability to register an account
- Corrected issue throwing errors for users without a role
- Implemented a UriBuilder for determining table routes
- Improved functional application of the table sorting
- Only show table rows dropdown if options exist in the template
- Provide ability to assert secureFirst before secureAny

---

2023-11-15 : 0.3.2  
Update: Upgrade primevue to v3.40; Resolved SSR issues

- Added ~/storage/app/temp directory
- Added ability to apply custom table filter methods
- Added model name to table template output
- Corrected issues preventing SSR from working properly
- Corrected v-for args in the VueTable template.actions
- Ensure table daterange dates are adjusted for user timezone
- Tweaks/improvements to the enraiged themes
- Updated primevue to v3.40.1; Updated the patches

---

2023-10-11 : 0.3.1.1  
Minor: Corrected various issues with 0.3.1

- Corrected enraiged-ground color in the enraiged-grey theme
- Ensure the ThemeFormField component reset method works properly
- Ensure the initial seeded administrator user from env is_hidden

---

2023-10-10 : 0.3.1  
Update: Multiple improvements to forms/tables; Added theme switching

- Added ability to define a route prefix for main menu groups
- Added ability to define a table route prefix via security assertions
- Added ability to define multi conditions: disabled/hidden if/unless
- Added ability to group enraiged-form fields,sections into tabs
- Added ability to provide css classes for form section text content
- Added appendFields method to build form template fields,sections,tabs
- Added fieldUnless, valueUnless methods to the enraiged form builder
- Corrected css display issues with primevue tables
- Corrected issue displaying 'stop impersonating' button in top nav
- Corrected issue with form population attempting to use model attrs
- Ensure the Users AvailabilityRequest leverages validated values
- Implemented basic theme preference selection (enraiged{-blue,-grey})
- Improved forms redirect; avoid redirect to login, argue fallback
- Improved the AvatarEditor,AvatarFormSection components
- Updated DropdownField component to use externally provided uri params
- Updated enraiged-forms to allow submitting to api routes via axios
- Updated postcss{,--scss} packages

---

2023-07-11 : 0.3.0  
Update: Upgraded laravel; Corrections for SSR; Various improvements

- Added Enraiged TableBuilder::{column,columExists}() methods
- Added ability to define model for table action security assertions
- Added ability to configure tables to order by sortable count
- Added ability to define a horizontal rule before a form field
- Added ability to define field disabledIf,disabledUnless conditions
- Added ability to define field hiddenIf,hiddenUnless conditions
  - Add definition to the json template to process client-side
  - Or, add method call server-side to process in the form builder
- Added 'daterange' type table filter
- Added exim data reader for geo coords in uploaded images
- Added patch for correcting primevue import lines for ssr use
- Added patch for issue with primevue datatables rowgroup colspan
  - https://github.com/primefaces/primevue/issues/3685
- Added 'enraiged:fix-ssr' command to enable ssr with primevue
- Corrected 419 error issue handling logout requests
- Corrected issue handling field disabled attribute when provided
- Corrected issue searching table columns with compound sources
- Corrected various issues with the user password validation
- Ensure table export options not displayed unless permitted
- Improved table global actions processing
- Removed neccessity of errors object in the js form system
- Updated to the Laravel 10 framework
  - https://laravel.com/docs/10.x/releases

---

2023-04-05 : 0.2.5  
Update: Various updates,corrections for avatars,passwords,assertions

- Added Enraiged\Forms\Builder\FormBuilder::{remove,value}If() methods
- Added Profile::name() method to return formatted first and last name
- Added predis/predis to the composer.json
- Added users.name table column; Populated via services and observers
- Corrected issue enforcing avatar policies
- Corrected issue enforcing password validation
- Corrected issue booting Avatarable trait
- Removed labels attribute from form builders,components (use class)
- Renamed Enraiged\Avatars\Traits\HasAvatar to Avatarable
- Renamed Enraiged\Files\Traits\HasFile to Attachable
- Various updates to the dropdown form fields
  - Added ability to define additional params for dropdown api fetches
  - Ensure table dropdown filters are able to fetch from api source
- Various updates to the security assertions system
  - Added ability to assert security against env variable
  - Added assertion filter to FormBuilder::assembleTemplateColumns()
  - Ensure ability to enforce all|any of multiple assertions

---

2023-03-25 : 0.2.4  
Update: Improved enraiged table actions handling; Various minor changes

- Added FormBuilder::remove() method to purge section/field by key
- Added AvatarFormSection.vue to enable editing avatars via edit form
- Various updates to the enraiged tables actions systems
  - Added standard theme coloring (danger,info,etc) as table row classes
  - Ensure application of table row actions is conditional
    - Removed Enraiged\Tables\Contracts\ProvidesTableBuilder
    - Removed Enraiged\Tables\Contracts\ProvidesTableServices
  - Ensure table row actions are using action parameter, if provided
  - Ensure tables will display without provided actions
  - Ensure tables will display without resource class

---

2023-03-19 : 0.2.3  
Update: Improved enraiged forms redirect; Various minor changes

- Corrected issue saving user details
- Enraiged FormBuilder tracks referer, redirects when stored,updated
- Improved the obj() helper; Will decode first if string
- Improved the {Create,Update}UserProfile parameters handling
- Moved FlashMessages to Enraiged\Support\Builders\FlashableBuilder

---

2023-03-13 : 0.2.2  
Update: Improvements to enraiged tables and security assertions

- Added /bootstrap/ssr to .gitignore
- Added ability to append,prepend select options via template
- Added ability to define,apply table filters per defined scope
- Added ability to define a defaultSort() method to a table builder
- Added ability to define a select option class,slot via template
- Added ability to filter/restore deleted users via the UserIndex
- Added actions to the profile pages/forms
- Added morphMap for auth_model() to the enraiged AppServiceProvider
- Added PrimevueCheckbox field component
- Corrected issue in the enraiged FormRequest
- Display the provided back button in the form actions
- Ensure table paginator scrolls to top when data is fetched
- Improved the security assertions system
  - Ability to define multiple action security assertions
  - Ability to define 'permission' as a security assertion
- Removed unused enraiged.auth.administrator_role config
- Simplified,improved the users available

---

2023-02-22 : 0.2.1  
Update: Clean production ssr build; Various corrections,improvements

- Added Enraiged\Support\Collections\RequestCollection
- Added ability to assertSecure() against a config and value
- Added app_host to the spa meta data
- Added {created,deleted,updated}.{at,by} to the tracking traits
- Added 'enraiged.auth.send_welcome_notification' config option
- Added 'enraiged.notifications.*.markdown' config option for x-mail
- Added is_date(), obj() helpers
- Corrected issue with CreateUserProfile::from in registration system
- Corrected issues with production,ssr build
  - Added vite alias ! to ./resources
  - Custom fonts now included in build from the resources directory
  - Resolved build issues with bootstrap/ssr/ssr.mjs
- Ensure 'automated_login' and 'must_verify_email' do not conflict
- Include current build lock files in the package
- Minor improvements with the enraiged.auth.allow_username_login config
- Moved avatar_{color,file} from resource traits to model attributes
- Removed $assert_security from FormBuilder; Assertions are automatic
- Resolved security issue with symfony/http-kernel
  - Remove symfony/http-kernel from composer.json when vendor updates
- Updated enraiged-forms
  - Ability to pass table class via form template
  - Ability to pass route params to FormBuilder::{create,edit}
  - Added fieldIf() method to the FormBuilder
- Updated users index export
- Various ui/ux corrections,improvements

---

2023-01-23 : 0.2.0  
Update: Upgraded inertiajs and laravel framework

- Added ability to specify default sort,direction in table builders
- Added date-fns package https://date-fns.org/v2.29.3/docs/
- Added traits for {Created,Deleted,Updated}By
- Added yarn.lock to the publishable resources
- Corrected issue executing correct query for table exports
- Corrected issue with computed clientSize,clientWidth
- Migrate sass to postcss with scss,plugins
- Migrate webpack/mix to vite
- Merged App\Auth,Enraiged\Auth,Enraiged\Accounts as Enraiged\Users
- Removed pinia
- Upgrade inertiajs/inertia-laravel to v0.6.9
- Upgrade inertiajs to v1.0.0
- Upgrade laravel/framework to v9.19

---

2022-12-20 : 0.0.17  
Update: Improved the UI/UX and handling of forms and tables

- Added accounts.availability system for api select options
- Added ability to publish enraiged into the local app space
- Better error handling when trying to delete a protected account
- Corrected incorrect config file path in the README
- Exploded enraiged package into separate package namespaces
- Improvements to the VueForm ui/ux and handling
  - Added api fetching for DropdownField options
  - Added creating,updating field aesthetics
  - Easily switch between horizontal or vertical labels
  - VueForm ability to auto-generate fields,layout from template
- Improvements to the VueTable ui/ux and handling
  - Added system for applying filters to table data
  - Corrected issue with the VueTable inactive-data rowClass
  - Provide table searching for columns with compound sources
  - Provide table sorting for columns with compound sources
- Removed extra features from login page password field
- Simplifed handling the forms,tables from the controllers
- Updated various items in the package.json

---

2022-12-09 : 0.0.16  
Update: Added enraiged asset publishing, table filters, other improvements

- Added ability to optionally publish enraiged assets during the install
- Added table filters via json configuration
  - Apply a model scope to select options filters
  - Performs security assertions
- Added strictVisibility scope to Role model
- Ensure body, card theming is accessible from the variables.css
- Exploded enraiged package into separate package namespaces
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
