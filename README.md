Laravel 8 validation helper
===============================================
------------
Installation
------------

```
composer require spe11/laravel-validator "*"
```

Usage
-----

This helper provides to helper function for rules creation: rules(), where u can pass single field validators and field() for validator creation
You will get IDE autocomplete and php-doc commentaries for methods from official documentation

Before:
```php
    public function rules()
    {
        return [
            'id' => 'required|exists:App\Models\Model:id',
            'name' => ['string', 'max:5', new CustomRule],
        ];
    }
```

After:
```php
    public function rules()
    {
        return rules(
            field('id')->required()->exists(Model::class, 'id'),
            field('name')->string()->max(5)->custom(new CustomRule),
        );
    }
```
