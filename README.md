[![](https://raw.githubusercontent.com/delgont/delgont/main/cover.png)](ttps://www.linkedin.com/in/stephendev)

### Get Started

```php
composer require delgont/cms
```

```php
composer require delgont/web
```

```php
php artisan vendor:publish --tag=delgont-config
```
```php
php artisan vendor:publish --tag=delgont-config-web
```
```php
php artisan vendor:publish --tag=delgont-overwrite-not-authenticated-redirect --force
```
```php
php artisan vendor:publish --tag=delgont-overwrite-if-authenticated-redirect --force
```
```php
php artisan vendor:publish --tag=delgont-overwrite-user-model --force
```

```php
php artisan user:create --default
```

#### Options

```php
'options' => [
    'option_key' => 'default-value-here'
],
'option_sidebar_link_routes' => [
    'web.settings'
]
```

```php
Route::prefix(config('delgont.route_prefix'))->group(function(){
        Route::post('/web/settings', 'SettingsController::class@index')->name('web.settings');
});
```