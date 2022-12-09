# Agreements

This system provides support for displaying and requiring agreement to defined legal documents, called Agreements.

## Overview

There are currently two types of agreement available in this system: EULA (End User License Agreement) and TOS (Terms Of
Service), which can be populated during the database seeding process from text files in ~/resources/seeds/agreements/.

The placeholder documents in this directory (EULA.md and TOS.md) which can be edited as necessary prior to seeding or
via the database itself, although this system does not currently provide this ability.

In the rest of this document the code samples will work if this application is seeded in a development environment and
the 'enraiged.auth.must_agree_to_terms' is configured as follows:

```php
    'must_agree_to_terms' => [
        'automatic_agreements' => true,
        'except_roles' => 'Administrator',
        'required_terms' => ['EULA', 'TOS'],
    ],
```

## Configuration

The configuration for requiring agreement involves some simple core concepts:

1. Does this application require agreement to act as an authorized user? If so...
2. Which user roles will or will not require agreement?
3. Which agreements will need to be made?
4. Do we want the system to 'automate' the agreement process?

This system is enabled by providing a boolean true or a configuration array for 'enraiged.auth.must_agree_to_terms'.

> Please see the config/enraiged/auth.php configuration file to review or edit this option.

When enabled, this system will cause the 'must agree to terms' checkbox to appear in the account registration form,
which must be checked or the user will receive an error. Under this checkbox, actions will be provided to open and
review the agreement, an action for each agreement required.

When enabled, the agreement documents can be viewed with a GET request to the corresponding url (/eula and /tos). If not
enabled, these requests will throw a 404 Not Found exception.

When defined, only the roles that match the configuration criteria in 'except_roles' or 'only_roles' will be expected to
agree. Roles that do not match the criteria will be ignored.

When enabled, the 'automatic_agreements' configuration option will automatically create all necessary agreement records
when a new account is created or registered in the system.

> **Note:** The random accounts created in the default enraiged seeding will not automatically agree, even if the
'automatic_agreements' options is enabled.


## Usage

**Agreement::current()**  
This is a static method that will return either an eloquent collection or agreement model, depending on whether the
method is called with an argument. Without an argument, the method returns a collection of the most recently published
distinct types of agreements:

```php
use Enraiged\Agreements\Models\Agreement;

$current_agreements = Agreement::current();

//  returns Illuminate\Database\Eloquent\Collection
```

With a 'type' as an argument, the method returns the most recently published model of that type of agreement.

```php
use Enraiged\Agreements\Enums\AgreementType;
use Enraiged\Agreements\Models\Agreement;

$agreement_type = AgreementType::EULA;
$current_agreement = Agreement::current(agreement);

//  returns Enraiged\Agreements\Models\Agreement
```


**Agreement::Required()**  
This is a static method that will return an eloquent collection of published distinct types of agreements that match the
requirement criteria.

```php
use Enraiged\Agreements\Models\Agreement;

$required_agreements = Agreement::required();

//  returns Illuminate\Database\Eloquent\Collection
```

> **Note:** This method returns a collection, even if there are no agreements required.


**$user->mustAgreeToTerms** and **$user->hasAgreedToTerms**  
If the required agreements system is enabled, the attributes 'must_agree_to_terms' and 'has_agreed_to_terms' will be 
appended to the user instance, to facilitate handling this system per user.

```php
use Enraiged\Accounts\Models\Account;

$must_agree = Account::find(5)->user->mustAgreeToTerms;

//  will return true for the seeded account
```

```php
use Enraiged\Accounts\Models\Account;

$has_agreed = Account::find(5)->user->hasAgreedToTerms;

//  will return false for the seeded account
```


**$user->unagreedTerms()**  
This method will return an array of agreement types a specific user has not yet agreed to but is required to do so.

```php
use Enraiged\Accounts\Models\Account;

$array = Account::find(5)->user->unagreedTerms();

//  will return the array ['EULA', 'TOS'] for the seeded account
```


**$user->acceptAgreements()**  
This method will create all required agreement records for the user instance.

```php
use Enraiged\Accounts\Models\Account;

Account::find(5)->user->acceptAgreements();

//  the seeded account will now have all agreement records
```


## License

Enraiged Laravel is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
