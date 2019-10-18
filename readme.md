# Laravel Taxes Statistics Application


## Description

This is a simple PHP Laravel application to report on the taxes of a given country and the states and counties in it, the current feature set include:

- Multiple states.
- Multiple counties per state.
- Separate tax entries per county.
- Multiple data sources for reporting, currently a database provider and a CSV file based provider.
- Unit tests for validating the reporting results

## Requirements

This app uses Laravel version 5.8, therefore you can head to the [official Laravel docs](https://laravel.com/docs/5.8/installation#server-requirements) to see the full requirements.

## Usage

You can follow these instruction to quickly get the project up and running:

```
# clone the project and install the dependencies
git clone https://github.com/Feras94/PHP-Taxes.git php-taxes
cd php-taxes
composer install

# configure the laravel project
cp .env.example .env
php artisan key:generate
php artisan storage:link

# run the project
php artisan serve
```

Remember to configure your own parameters for the database connection in the `.env` file.

After getting the project running you can get the reporting data by making a `GET` request to the following endpoint `<host>/api/reporting/taxes`

## Configuration

You can switch the used data source in the `config/reporting.php` file, the currently supported values for the `source` param are: `db` and `csv` for the database and the file based providers respectively.
