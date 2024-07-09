# HSBC BACS Standard 18 for direct bank transactions implementation

Partial implementation of the HSBC BACS Standard 18 for direct bank transactions in Laravel


## Installation

This package is not on packagist yet, so you need to install it as a local package. In your "packages" somewhere close to your Laravel project, clone this repository:
```bash
git clone https://github.com/slimgee/laravel-bacs
```

Add the path to the package in your Laravel composer.json file:
```json
"repositories": [
    {
        "type": "path",
        "url": "../packages/laravel-bacs"
    }
    "require": {
        "slimgee/laravel-bacs": "*"
    }
],
```

Finally, run:
```bash
composer install
```

Now, You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-bacs-config"
```

This is the contents of the published config file:

```php
return [
    /*
     * -----------------------
     *
     * The route for the BACS endpoint
     */
    'route' => 'api/bacs',

    /*
     * -------------------------
     *
     * Register any middleware you'd like to run before this route
     */
    'middleware' => [],
];
```

## Usage

This package will expose a `GET` route that accepts a number query parameters to and return BACS standard 18 message response in JSON format

By default the endpoint is at `/api/bacs` but you're free to configure to something that best suits your requirements by editing the config file

You may also want to register middleware that you'd want to run before the route hits, probably `auth`, simply append to the middleware array key in the config file

### Get parameters

When making requests to the endpoint, you can pass the following query parameters:


| Parameter  | Required? | Description 
| ------------- | ------------- | ------------ |
| serial_number | Yes  | Unique alpha-number characters, right justified but can’t be all spaces or zeroes. Each unique reference is
validated against duplicates and will be held for a period of 3 months |
|  sun  | optional | (Owner ID) Assigned by BACS to you. This is coordinated by our Client Implementation Team and provided to you. This is also known as the BACS OI |
| marker | optional, default HSBC | marker is required when `sun` is not provided. It can be either `HSBC` or `SAGE` |
| generation_number | optional | 4 digit number |
| generation_version_number | optional | 2 digit number |
| creation_date | optional | Date in the format `YYYY-MM-DD`. If not provided, the current date will be used |
| expiration_date | optional | The expiration date indicates to BACS the earliest date at which file may be overwritten. Date in the format `YYYY-MM-DD`. If not provided, the current date will be used |
| system_code | optional | 13 characters string |
| fast_payment | optional | 1 or 0 |


Simply append the parameters to the endpoint URL, for example:
```
https://yourdomain.com/api/bacs?serial_number=123456
```

example response

```json
{
  "vol": "VOL18DLYX80                              rSfDRI                                1",
  "hdr": "HDR1ArSfDRS  1rSfDR8DLYX800010001129246 24191 242120000000X9i0VbIs2hmNq       "
}
```


Additionally, a swagger documentation is available at [https://app.swaggerhub.com/apis/GivenNcube/Bacs/1.0.0](https://app.swaggerhub.com/apis/GivenNcube/Bacs/1.0.0) 

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.



## Credits

- [Given Ncube](https://github.com/slimgee)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
