# DB Manager

A Laravel package for database visualization and CRUD operations.

## Features

- Visualize database tables and their data.
- Perform Create, Read, Update, and Delete (CRUD) operations on the tables.
- Real-time updates with Livewire for a seamless user experience.

## Installation

1. **Install the package via Composer:**

   ```bash
   composer require tsrgtm/db-manager
   ```

2. **Register the Service Provider (if using Laravel < 5.5):**

   Add the following line to your `config/app.php` file in the `providers` array:

   ```php
   Tsrgtm\DbManager\DbManagerServiceProvider::class,
   ```

3. **Publish the package assets (if needed):**

   Use the following command to publish the views:

   ```bash
   php artisan vendor:publish --provider="Tsrgtm\DbManager\DbManagerServiceProvider"
   ```

## Usage

### Step 1: Add the Livewire Component

You can use the Livewire component in your Blade views. Here’s an example of how to include the DB Manager component in your Blade file:

```blade
@extends('layouts.app')

@section('content')
    <div class="container">
        @livewire('db-manager')
    </div>
@endsection
```

### Step 2: Accessing the DB Manager

After including the Livewire component, you can access the DB Manager through your application. It will display all database tables and allow you to perform CRUD operations.

## CRUD Operations

- **View Tables:** Select a table from the dropdown to view its contents.
- **Edit Rows:** Click on a row to edit its data. Make changes and save.
- **Delete Rows:** Click on the delete button to remove a row from the database.
- **Add New Rows:** Add new rows directly from the interface.

## Requirements

- PHP 8.1 or higher
- Laravel 11.x
- Livewire 3.x

## License

This package is licensed under the MIT License. See the [LICENSE](../../../../Downloads/LICENSE) file for more details.

## Contributing

Contributions are welcome! Please open an issue or submit a pull request for any enhancements or bug fixes.

## Acknowledgments

- [Laravel](https://laravel.com)
- [Livewire](https://laravel.livewire.com)
