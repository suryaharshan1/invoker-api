#INVOKER REST API

Rest api for the invoker android application](https://github.com/suryaharshan1/Invoker-Android-Client/) . The application has been build upon the Yii2 advanced template 2.0.6 with only the REST components.

## AUTHORS


[Surya Harsha  Nunnaguppala](https://github.com/suryaharshan1)

[Vishnu Priya Matha](https://github.com/vishnupriyam)

## INSTALLATION

Clone the repository to your server htdocs.

## CONFIGURATION

The database configuration is in application/config/common.php

```php
components' => [
    'db' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=127.0.0.1;dbname=invoker',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
    ],
```

The database structure remains the same as the [invoker web interface](https://github.com/vishnupriyam/invoker-web-interface)
