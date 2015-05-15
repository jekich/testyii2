Yii 2 test
============================

INSTALL
-------------

1. Создать БД
2. Создать файл config/local.php (пример ниже)
3. Выполнить миграции.

P.S. Тестовые данные зальются при выполнении миграций, также дамп БД лежит в папке data



CONFIGURATION
-------------

### Database

Edit the file `config/local.php` with real data, for example:

```php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=testdev',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ]
    ]
];
```

