
# Forms

Enraiged Forms are configured and driven almost entirely through a powerful, flexible json templating system.



### Securing Form Field Data



### Form Section Content

It will often be useful to provide a heading or descriptive content in your form sections. This templating system
provides the ability to define a section `heading`, section `precontent`, and section `postcontent`.

> **Note:** These are all optional.

- The section heading will display in large bold letters at the top of the section.
- The section precontent will display under the heading but above the rendered form fields.
- The section postcontent will display under the rendered form fields.

The argument for any of these can be a simple string of text, which will be displayed as is in the form, or as an object
containing a class and a body, in case you require custom styling for these content areas.

In the following example the heading will appear with its default styles, there will be no precontent underneath the
heading, and the postcontent will appear in small, italics text underneath the rendered form fields.

```
    "member_profile_section": {
        "heading": "Member Profile",
        "fields": { ... },
        "postcontent": {
            "body": "Please take care to protect your privacy online.",
            "class": "font-italic text-sm",
        }
    }
```

> **Note:** Sections are renedered as Primevue cards and will inherit the default styles from this component for the
heading, fonts, background color, etc.


### Disable/Hide Fields If/Unless

Form fields can be disabled or hidden using the disableIf, disableUnless, hiddenIf, or hiddenUnless parameters. The
argument for these parameters can be a string, or an object, or an array of strings and objects.

In the example below `disableUnless` is argued on the region_id field with a string: **"disableUnless": "country_id"**

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

In this next example `hiddenUnless` is argued with an object: **"hiddenUnless": {"product_type": [id]}**

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

> **Note:** The system will make no attempt to stop you from defining more than one of these If/Unless arguments. But!


## License

Enraiged Laravel is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
