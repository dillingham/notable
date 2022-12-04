# Notable

A simple documentation package for Laravel.

```
php artisan notable:install
```

- adds a `docs` folder in your project's root for markdown

- adds a `docs` folder in  resources/views for the page layout

- adds the following route to the top of routes/web.php


```
Route::markdown('docs', base_path('docs'));
```

1st parameter is the endpoint to make the root
2nd parameter is a path to a markdown folder

A file with the following path in a project:

```
docs/getting-started/installation.md
```
will appear like this in the browser
```
docs/getting-started/installation
```

Note: `docs` in the url is from Route definition
It isn't the folder's name. It can be changed.

### TODO:

- [ ] Cache html rendered markdown.. if modified time > last cache, render
- [ ] Add route helpers for settings (see below)
- [ ] Add "On this page" section links
- [ ] Add repository config for "edit page"


```php
Route::markdown()
    ->prefix('documentation')
    ->view('docs.show')
```
