# Route resource extension

This package attempts to help with building routes for models with softdeletes.

It adds a macro to extend the existing routes and build some other routes on top of it for restoring, and an index of trashed models.

Pull in the package:

```bash
composer require sjorsvanleeuwen/route-resource-extension
```

Next, open your route file and modify a resource route like so:

```php
Route::resource('myresource', MyResourceController::class)->withSoftDeletes();
```
Next to the normal routes this will create the following routes:

| Method | URI | Name | Action |
| ------ | --- | ---- | ------ |
| GET\|HEAD | myresource/trash | myresource.trash | MyResourceController@trash |
| PATCH  | myresource/{myresource}/restore | myresource.restore | MyResourceController@restore |
