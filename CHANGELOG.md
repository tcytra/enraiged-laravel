# Release Notes

2022-03-24 : 0.0.3 
Update: Added a basic registration form; Reorganizing,rebuilding

- Added custom fonts; expanded scss variables
- Added full-stack simple registration form
- Added password complexity configuration
- Added password_history table, user relationship
- Rebuilt,reorganized the controllers,routes,requests
- Rebuilt,reorganized the login form components
- Updated (corrected) the Open Sans font css

--

2022-03-22 : 0.0.2 
Update: Replaced vendor provided postcss,tailwindcss with sass,primevue

This includes updates to the package.json, yarn.lock, webpack.mix.js.
The initial ui/ux for the Login and Dashboard page components are
completed, including the Default layout component.

References:

- [https://primefaces.org/primevue/]
- [https://www.primefaces.org/primeflex/]

--

2022-03-20 : 0.0.1 
Update: Manually added initial inertiajs package from pingcrm example

This is a minimal variant of the example code from inertiajs/pingcrm.
It will allow a log in and present a dashboard. There are tables,models
for users and persons.

References:

- [https://inertiajs.com/]
- [https://github.com/inertiajs/pingcrm]
