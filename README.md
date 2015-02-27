
E-commerce sales extension for Yii 2
========================================
This extension provides a sales section for e-commerce

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist infoweb-internet-solutions/yii2-ecommerce-sales "*"
```

or add

```
"infoweb-internet-solutions/yii2-ecommerce-sales": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed run this migration

```
yii migrate/up --migrationPath=@vendor/infoweb-internet-solutions/yii2-ecommerce-sales/migrations
```

And modify your backend configuration as follows:

```php
return [
    ...
    'modules' => [
        'sales' => [
            'class' => 'infoweb\ecommerce\sales\Module',
        ],
    ],
    ...
];
```

Import the translations and use category 'infoweb/ecommerce/sales':
```
yii i18n/import @infoweb/ecommerce/sales/messages
```
