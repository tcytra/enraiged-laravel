
# Enraiged Forms

**Enraiged Forms are configured and driven through a simple but powerful json template and builder class system.**


## Table Of Contents

- [Server Side](#server-side)
  * [Creating A Form](#creating-a-form)
    - [Form Builder](#form-builder)
    - [Form Controller](#form-controller)
    - [Form Template](#form-template)
  * [Configuring Form Fields](#configuring-form-fields)
  * [Defining Field Parameters](#defining-field-parameters)
  * [Available Form Fields](#available-form-fields)
    - [Calendar Field](#calendar-field)
    - [Checkbox Field](#checkbox-field)
    - [Daterange Field](#daterange-field)
    - [Hidden Field](#hidden-field)
    - [Multiselect Field](#multiselect-field)
    - [Password Field](#password-field)
    - [Select Field](#select-field)
    - [Switch Field](#switch-field)
    - [Textarea Field](#textarea-field)
    - [Text Field](#text-field)
  * [Disable/Hide Fields If/Unless](#disable-hide-fields-if-unless)
  * [Form Sections](#form-sections)
  * [Securing Form Fields](#securing-form-fields)
    - [Configuration Value](#)
    - [Environment Value](#)
    - [Method Call](#)
    - [Auth Assertion Methods](#)
    - [Role Assertion Methods](#)
    - [User Assertion Methods](#)
    - [Arguing Multiple Assertions](#)
- [Client Side](#client-side)
- [License](#license)


## Server Side


### Creating A Form

Creating a form for display to an end-user requires php classes for a form builder, the controller that invokes it, and
a json configuration template.

#### Form Builder

At minimum, the form builder class must contain the filesystem path to the json template file:

```php
<?php

namespace App\MyProject\Products\Forms\Builders;

use Enraiged\Forms\Builders\FormBuilder;

class CreateProduct extends FormBuilder
{
    /** @var  string  The template json file path. */
    protected $template = __DIR__.'/../Templates/create-user.json';
}
```

In the form builder class, the developer is free to overload many of the Enraiged Forms methods and/or add custom 
methods they need (for example custom security assertion methods may be placed here).


#### Form Controller

The process of creating an instance of the form builder and getting the prepared/populated template is three steps.

- Step 1 requires the request object and will optionally accept ar array of parameters.
- Step 2 requires calling either the 'create' or 'edit' method with the model, the submit route, and optionally the
submit method (create() defaults to POST, edit() defaults to PATCH).
- Step 3 is simply the call to output the template.

```php
<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\MyProject\Products\Forms\Builders\CreateProduct;
use App\MyProject\Products\Models\Product;
use Illuminate\Http\Request;

class Create extends Controller
{
    public function __invoke(Request $request)
    {
        $template = CreateProduct::from($request)      // step 1
            ->create(Product::class, 'products.store') // step 2
            ->template();                              // step 3

        // ...
    }
}
```


#### Form Template

A form template is a json file containing the configuration for displaying the form to the end-user:

```js
{
    "class": "vertical shadow-1",
    "fields": {
        "category_id": {
            "class": "col-12 md:col-6",
            "label": "Product Category",
            "options": {
                "source": "\\App\\MyProject\\Products\\Models\\ProductCategory",
                "type": "model"
            },
            "type": "select"
        }
        "product_name": {
            "class": "col-12 md:col-6",
            "label": "Product Name",
            "placeholder": "Required"
        }
    }
}
```

Continue reading the following sections for more information on configuring form fields:


### Configuring Form Fields

A basic definition for a form field requires a unique key and a set of attributes, as follows:

```js
{
    "name": {
        "class": "col-12 md:col-6 lg:col-3",
        "label": "Product Name",
        "placeholder": "Required",
        "type": "text"
    }
}
```

> **Please Note:** The provided key will be used to populate the data for the form field, so it should (in most cases)
match the database column name for the associated model/table. When the data needs to be sourced from a relation of the
model, the field configuration will need to define the **"source"** parameter (see "Available Parameters" below).


### Defining Field Parameters

The following parameters are generally available for all form fields for defining appearance and behavior:

> **Note:** Various form fields have additional configuration requirements/options, defined in "Available Form Fields"
below.

- **after:** _(string)_ If provided, a DIV element with this value as the class attribute will be created immediately
**after** the wrapper element that contain the elements of the form field. This is useful for creating controlled
whitespace after this form field.
- **before:** _(string)_ If provided, a DIV element with this value as the class attribute will be created immediately
**before** the wrapper element that contain the elements of the form field. This is useful for creating controlled 
whitespace before this form field.
- **break:** _(boolean|string)_ If provided, a DIV element with the class **"col-12 line-break"** and containing an HR 
element will be injected into the page source immediately before all other elements associated with this field. If the
provided value is a string, it will be applied as the class attribute of the HR element.
- **class:** _(string)_ If provided, this value will be applied to the field html wrapper element as the class attribute.
- **custom:** _(boolean)_ If provided and true, this will allow the developer to provide custom handling of this field in
the VueJS by defining a TEMPLATE using the field key as the slot name.
- **disabled:** _(boolean)_ If provided, this value will determine whether the field is disabled for the end-user.
- **disabledIf:** _(array|object|string)_ If provided, this value is the key (or array of keys) of other fields. This
field is disabled **if** that other field (fields) has value.
- **disabledUnless:** _(array|object|string)_ If provided, this value is the key (or array of keys) of other fields in 
this form. This field is disabled **unless** that other field (fields) has value.
- **hidden:** _(boolean)_ If provided, this value will determine whether the field is hidden from the end-user.
- **hiddenIf:** _(array|object|string)_ If provided, this value is the key (or array of keys) of other fields. This
field is hidden **if** that other field (fields) has value.
- **hiddenUnless:** _(array|object|string)_ If provided, this value is the key (or array of keys) of other fields in
this form. This field is hidden **unless** that other field (fields) has value.
- **label:** _(string)_ If provided, a LABEL element containing this value will be created within the field html
wrapper.
- **placeholder:** _(string)_ If provided, this value will be applied to the form field as the placeholder attribute.
- **secure:** _(object)_ If provided, this value will be used to assert a security check against the authorized user. A
failed result would cause this field to be removed from the processed template to prevent exposing it to the end-user.
See "Securing Form Field Data" below for more information.
- **secureAll:** _(array)_ If provided, this is an array of assertion objects as would be provided in a single 
**"secure"**, in which **all** of the assertions in the array must return true for the security check to pass.
- **secureAny:** _(array)_ If provided, this is an array of assertion objects as would be provided in a single 
**"secure"**, in which **any** of the assertions in the array may return true for the security check to pass.
- **source:** _(string, **sometimes required**)_ This value is required when the data must be sourced from a relation of
the form's primary model, and is provided as a dot-notated string of the full path to the related data. For example,
the ```"source"``` for an addressable model's country name would be **"address.country.name"**.
- **type:** _(string, **required**)_ This value specifies the type of form field being defined. If not provided, the value
will default to **"text"**.

> **Note:** A developer is always free to define any key/value attributes as they require in the field configution, and
these will be available to work with throughout the lifecycle of processing the field and displaying it to the end-user.

> **Also Note:** More info about disabling/hiding fields below in 
[Disable/Hide Fields If/Unless](#disable-hide-fields-ff-unless)

### Available Form Fields

#### Calendar Field

A calendar field type will display a single-date datepicker and has additional configuration parameters:

- **dateFormat:** _(string)_ The display format of the selected date.
- **disabledDates:** _(array)_ An array of calendar dates to disable from end-user selection. (Example: [0,6] for disabling holidays)
- **disabledDays:** _(array)_ An array of calendar days in the week to disable from end-user selection. (Example: disabling weekends)
- **maxDate:** _(string)_ The maximum allowed date for end-user selection (client-side computed to JavaScript Date()).
- **minDate:** _(string)_ The minimum allowed date for end-user selection (client-side computed to JavaScript Date()).
- **numberOfMonths:** _(integer)_ The number of months to show in the datepicker UI.
- **touchUI:** _(boolean)_ Whether or not to display the datepicker as a touch-compatible dialog.
- **value:** _(string)_ The value is the date to be initially selected in the datepicker.

```
    "expiry_date": {
        "label": "Expiry Date",
        "minimum": "today",
        "placeholder": "Optional",
        "type": "calendar",
        "value": "2000-01-01"
    }
```

The value will default to null.

_See the [Primevue Calendar](https://v3.primevue.org/calendar/) documentation for more information._


#### Checkbox Field

A checkbox field type will display a checkbox form field. Submits boolean true/false.

- **value:** _(boolean)_ The value must be boolean true/false.

```js
    "is_active": {
        "label": "Active",
        "type": "switch",
        "value": true
    }
```

The value will default to false.

_See the [Primevue Checkbox](https://v3.primevue.org/checkbox) documentation for more information._


#### Daterange Field

A daterange field type will display a calendar field with the **"selectionMode"** attribute set to **"range"**.

- **value:** _(array)_ The value of the daterange field must be an array of ["_first date_", "_final date_"].

```js
    "date_range": {
        "label": "Active",
        "placeholder": "Date Range",
        "type": "daterange",
        "value": ["2020-01-01", "2021-01-01"]
    }
```

The value will default to an empty array.

_Refer to the **calendar** field documentation above for more detail configuring dropdowns._


#### Hidden Field

A hidden field type will display an html INPUT with the attribute type set to "hidden". Except for **"value"** and
**"source"** (if provided), all other configuration parameters are ignored unless used by the developer in a
**"custom"** field.

```js
    "user_id": {
        "type": "hidden"
    }
```

The value will default to null.


#### Multiselect Field

A multiselect field type will display a select form field with options that are checkbox selectable. The multiselect
field is an alias of the **"select"** field type with the **"multiple"** parameter set to **true**.

- **value:** _(array)_ The value must be an array.

```
    "fruits": {
        "label": "Fruit Salad",
        "options": {
            "source": "App\\Support\\Enums\\Fruits",
            "type": "enum"
        },
        "type": "multiselect",
        "value": ["Cherry", "Orange", "Peach", "Pineapple"]
    },
```

The value will default to an empty array.

_Refer to the **select** field documentation below for more detail configuring dropdowns._


#### Password Field

A password field type will display an html INPUT with the attribute type set to "password". The password field is the
only field that is never populated on the server-side before presenting data to the end-user.

- **feedback:** _(boolean)_ Whether or not to display a password strength meter.
- **unmask:** _(boolean)_ Whether or not to display a toggle to unmask the password.

```
    "password": {
        "feedback": true,
        "label": "Password",
        "type": "password",
        "unmask": true
    }
```

_See the [Primevue Password](https://v3.primevue.org/password) documentation for more information._


#### Select Field

A select field type will display a select form field with provided option values, which may be supplied inline with the
field configuration, retrieved from an enum or model class, or through an api call from the client-side.

- **autoselectable:** _(boolean)_ Whether or not to autoselect the option if there is only one available.
- **clearable:** _(boolean)_ Whether or not to allow clearing selected options.
- **multiple:** _(boolean)_ Whether or not to allow multiple selected options.
- **options:** _(object)_ The configuration for directing the select field to obtain it's option values.
  - **label:** _(string)_ The object key for the human-readable value displayed to the end-user (default **"name"**).
  - **params:** _(array)_ Any other form values that must be included with an api call to process the request.
  - **select:** _(array)_ The select array will be passed to the query 
  - **source:** _(string, **sometimes required**)_ The direct server-side source of the option values.
  - **type:** _(string, **sometimes required**)_ Defines the source type (**"config"**, **"enum"**, or **"model"**) when
the values must be prepopulated on the server-side.
  - **uri:** _(string, **sometimes required**)_ The name of the route used for retrieving the options from an api call.
  - **value:** _(string)_ The object key for the value to be submitted by the form (default **"id"**)
  - **values:** _(array)_ The array of values to display to the end-user.
- **searchable:** _(boolean)_ Whether or not to display an input field in the dropdown panel to apply a search filter to
the available options.

**Inline Option Values**

If the **"values"** is defined in the template, even if it's an empty array, all other configuration in the
**"options"** will be ignored. It is assumed in this case the developer wishes to handle populating the values through
some other means:

```
        ...
        "options": {
            "values": [
                {"id": "A", "name": "Animal"},
                {"id": "M", "name": "Mineral"},
                {"id": "V", "name": "Vegetable"}
            ]
        },
        ...
    }
```

**Custom Options Values Keys**

The default keys for options values objects are **"id"** and **"name"**. The developer may specify custom object keys
using the **"label"** and **"value"** configuration options:

```
        ...
        "options": {
            "label": "full_name",
            "value": "code"
        },
        ...
```

Additional object keys/values may be retrieved from a model query by defining the **"select"** array (useful when the
developer needs to display additional information about a selected option in the UI):

```
        ...
        "options": {
            "select": ["code", "full_name", "short_name"]
            "label": "full_name",
            "value": "code"
        },
        ...
```

**Option Values Source**

It will most often be the case that the source of the option values is external to the template itself. In this case it
is necessary to define the source for the options data.

If the developer wishes to prefetch all options and embed them into the template along with the field configuration, the
**"source"** must be the full path to the values data source and the **"type"** must be defined:

Sourcing the data from the **config**:

```
        ...
        "options": {
            "source": "products.categories.available",
            "type": "config"
        },
        ...
```

Sourcing the data from an **enum**:

```
        ...
        "options": {
            "source": "\\App\\MyProject\\Products\\Enums\\Categories",
            "type": "model"
        },
        ...
```

Sourcing the data from a **model**:

```
        ...
        "options": {
            "source": "\\App\\MyProject\\Products\\Models\\ProductCategory",
            "type": "model"
        },
        ...
```

If the developer wishes to defer the prefetching of values and populate the data through an api call, the **"source"**
must be set to **"api"** and the **"uri"** must be defined as the route for the api call to request the values.

If the form builder detects a dot-notated value as the **"uri"** it will be assumed to be a route name and an attempt
will be made to convert the name into the actual routing uri.

```
        ...
        "options": {
            "source": "api",
            "uri": "products.categories.available"
        },
        ...
```

Sometimes it is necessary for an options api call to include other form values in the request. In this case the
developer may define the **"params"** with the keys of the form field values that need to be included in the request:

```
        ...
        "options": {
            "params": ["category_id", "country_code"],
            "source": "api",
            "uri": "products.available"
        },
        ...
```

The value for a select field will default to **null** (except for multiselects, which default to an empty array).


#### Switch Field

A switch field type will display a sliding toggle style UI tool for setting a value true or false.

```
    "is_active": {
        "type": "switch"
    }
```

The value for a switch field will default to **false**.

_See the [Primevue Switch](https://v3.primevue.org/switch) documentation for more information._


#### Textarea Field

A textarea field type will display an html TEXTAREA field with these additional parameters:

- **autoresizable:** _(boolean)_ Whether or not the textarea should resize as internal content grows.
- **rows:** _(integer)_ The (initial) number of rows to display in the textarea (excess rows will invoke a scrollbar).

```
    "description": {
        "type": "textarea"
    }
```

The value for a textarea field will default to **null**.

_See the [Primevue Textarea](https://v3.primevue.org/textarea/) documentation for more information._


#### Text Field

A text field type will display a basic html INPUT field:

```
    "name": {
        "type": "text"
    }
```

The value for a textarea field will default to **null**.

_See the [Primevue InputText](https://v3.primevue.org/inputtext/) documentation for more information._


### Disable/Hide Fields If/Unless

Form fields can be disabled or hidden using the **"disableIf"** or **"disableUnless"**; or the **"hiddenIf"** or 
**"hiddenUnless"** parameters. The argument for these parameters can be a string, or an object, or an array of strings 
and objects.

In the example below **disableUnless** is argued on the region_id field with a string: **"disableUnless": "country_id"**

This will cause the State/Province field to be disabled unless the Country field has any selected value.

```
    "country_id": {
        "label": "Country",
        "options": { ... },
        "type": "select"
    }
    "region_id": {
        "disableUnless": "country_id",
        "label": "State/Province",
        "options": { ... },
        "type": "select"
    }
```

In this next example **hiddenUnless** is argued with an object: **"hiddenUnless": {"product_type": [id]}**

This will cause either the Electronics Type or Vehicle Type to be hidden unless Product Type is selected as Electronics
or Vehicles.

```
    "product_type": {
        "label": "Product Type",
        "options": { ... "values": [{"id": 1, "name": "Electronics"}, {"id": 2, "name": "Vehicles"}] },
        "type": "select"
    }
    "electronics_type": {
        "hiddenUnless": {"product_type": 1},
        "label": "Electronics Type",
        "options": { ... },
        "type": "select"
    },
    "vehicle_type": {
        "hiddenUnless": {"product_type": 2},
        "label": "Vehicle Type",
        "options": { ... },
        "type": "select"
    }
```


### Form Sections

Form fields can be grouped into sections for ease of organization, applying field-group security, or to argue for a
section that the developer needs full control over (for example, a section may not even have fields at all, but the
developer needs to inject a custom block into a form).

We can preview how these are achieved with this example:

```
    ...
    "fields": {
        "admin_section": {
            "fields": { ... },
            "secure": { ... },
            "type": "section"
        },
        "display_section": {
            "custom": true,
            "type": "section"
        },
        "detail_section": {
            "fields": { ... },
            "type": "section"
        }
    }
    ...
```

In the **"admin_section"** we are arguing for blanket security over all the fields in this section.

In the **"display_section"** we are arguing for a "custom" section without any fields defined.

The **"detail_section"** will be processed and displayed normally.

A Section is normally displayed as a Primevue Card and (unless custom styles are configured) will inherit the default 
styles from this component for the heading, fonts, background color, etc.

_See the [Primevue Card](https://v3.primevue.org/card/) documentation for more information._


**Section Headings/Other Content**

It will often be useful to provide a heading or descriptive content in your form sections. In this case the developer
may define any one of a section **"heading"**, **"precontent"**, and/or **"postcontent"**.

- **heading:** _(object|string)_ Will display text as the primevue card title.
- **precontent:** _(object|string)_ Will display provided text under the heading but above the section form fields.
- **postcontent:** _(object|string)_ Will display provided text under the section form fields.

The argument for any of these can be a simple string of text, which will be displayed as is in the form, or as an object
containing a class and a body, in case you require custom styling for these content areas.

In the following example the heading will appear with its default styles, there will be no precontent underneath the
heading, and the postcontent will appear in small, italics text underneath the rendered form fields.

An example of a basic configuration that defaults to the original styling look like this:

```
    "member_profile_section": {
        "heading": "Member Profile",
        "precontent": "Please take care to protect your privacy online."
        "fields": { ... },
        "postcontent": "Any questions or concerns may be directed to our support team."
    }
```

An example of a controlled configuration that applies custom styling looks like this:

```
    "member_profile_section": {
        "heading": {
            "body": "Member Profile",
            "class": "font-bold text-lg",
        "precontent": {
            "body": "Please take care to protect your privacy online.",
            "class": "font-bold font-italic",
        }
        "fields": { ... },
        "precontent": {
            "body": "Any questions or concerns may be directed to our support team.",
            "class": "font-italic text-sm",
        }
    }
```


### Securing Form Fields

**In Enraiged Laravel, these security assertions are implemented universally across actions, forms, menus, and tables.**

A definition for a security assertion must contain at least one key/value pair to direct the means of executing the 
assertion, and may contain other supporting keys/values, as follows:

```
    "secure": {
        "method": "assertRoleIs",
        "role": "Administrator"
    }
```

> In the above example, the security assertion will call the method ```assertRoleIs()``` and will return true if the
provided "role" is "Administrator".


#### Configuration Value

A configuration security assertion will test whether the provided "config" is equal (===) to "value". If no "value" is
defined, a "value" of boolean "true" will be used to complete the assertion.

```
    "secure": {
        "config": "app.env",
        "value": "production"
    }
```

#### Environment Value

An environment security assertion will test whether the provided "env" is equal (===) to "value". If no "value" is
defined, a "value" of boolean "true" will be used to complete the assertion.

```
    "secure": {
        "env": "APP_ENV",
        "value": "production"
    }
```

#### Method Call

A security assertion via method call requires a function is defined in the builder that is reading the template, in this
case, an instance of the ```Enraiged\Forms\Builders\FormBuilder``` class.

The method call assertion requires the "method" key is defined, with the value providing the name of the function to be
called. The prefix "assert" can be omitted by the developer, in which case the assertion logic will prepend this prefix
to the function name.

Reconsider the first example above without the "assert" prefix:

```
    "secure": {
        "method": "roleIs",
        "role": "Administrator"
    }
```

The actual class function looks like this:

```
    protected function assertRoleIs($secure): bool
    {
        $security = (object) $secure;

        return Auth::check() && Auth::user()->hasRole()
            ? Auth::user()->role->is($security->role)
            : false;
    }
```

With this design pattern in mind, a developer is free to author custom assertion methods or overload existing methods in
their Builder class.

> **Please Note:** Not shown in the function code above is that is, if the builder model exists, it will be passed to
the assertion method. Developers are able to author custom assertions that leverage the working model. In the actual
code, an example of this can be found in the ```assertUserHasPermission()``` function where ```$secure``` and 
```$model``` arguments are passed to and used by the function.


#### Auth Assertion Methods

**Assert Is Authenticated:** Permit this item if the end-user is authenticated.

```
    "secure": {
        "method": "isAuth"
    }
```

**Assert Is Guest:** Permit this item if the end-user is unauthenticated.

```
    "secure": {
        "method": "isGuest"
    }
```

#### Role Assertion Methods

**Assert Is Administrator:** Permit if the authenticated user role is Administrator.

```
    "secure": {
        "method": "isAdministrator"
    }
```

**Assert Role At Least:** Permit if the authenticated user role is equal to or higher in rank than the specified "role".

```
    "secure": {
        "method": "roleAtLeast",
        "role": "Member"
    }
```

**Assert Role Is:** Permit if the authenticated user role is the specified "role".

```
    "secure": {
        "method": "roleIs",
        "role": "Member"
    }
```

**Assert Role Is Not:** Permit if the authenticated user role is not the specified "role".

```
    "secure": {
        "method": "roleIs",
        "role": "Member"
    }
```


#### User Assertion Methods

**Assert User Has Permission:** Permit if the authenticated user has the necessary "permission", based upon the model's
defined policies. See [Laravel Authorization](https://laravel.com/docs/10.x/authorization) for more information on 
implementing Policies.

```
    "secure": {
        "method": "userHasPermission",
        "permission": "update-email"
    }
```


**Assert User Email:** Permit if the authenticated user matches the specified "email".

```
    "secure": {
        "method": "userEmail",
        "email": "admin@myapp.local"
    }
```

**Assert User Email:** Permit if the authenticated user matches the specified "email".

```
    "secure": {
        "method": "userId",
        "id": 1
    }
```


#### Arguing Multiple Assertions

In some cases it may be necessary for a security call to assert one or all of many conditions. This is possible by 
providing an array of assertions as **"secureAll"** or **"secureAny"**, as follows:

This item will be allowed if any of the assertions is true:

```
    "secureAny": [
        {"method": "isAdministrator"},
        {"method" => "userHasPermission", "permission" => "audit-inventory"}
    ]
```

This item will be allowed if all of the assertions are true:

```
    "secureAll": [
        {"method": "roleAtLeast", "role": "Manager"},
        {"method" => "userHasPermission", "permission" => "audit-inventory"}
    ]
```

> **Please Note:** If multiple assertions exist in a normal **"secure"** configuration, they will be treated as
**"secureAny"**.


## Client Side

...


## License

Enraiged Laravel is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
