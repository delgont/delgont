
## Options

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