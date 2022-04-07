# Project History

Todo:
- Addresses, Avatars, Organizations, Roles, Tables
- Add parent FormBuilder, Tablebuilder functionality
- Secondary email login
- VueX

---

2022-00-00 : 0.0.7  
Update: 

- Added composer.json to packages/enraiged; Further isolate as package

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

- [https://primefaces.org/primevue/]
- [https://www.primefaces.org/primeflex/]

---

2022-03-20 : 0.0.1  
Update: Manually added initial inertiajs package from pingcrm example

This is a minimal variant of the example code from inertiajs/pingcrm.
It will allow a log in and present a dashboard. There are tables,models
for users and persons.

References:

- [https://inertiajs.com/]
- [https://github.com/inertiajs/pingcrm]
