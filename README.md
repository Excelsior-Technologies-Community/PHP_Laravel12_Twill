# PHP_Laravel12_Twill

## Overview

PHP_Laravel12_Twill is a Content Management System (CMS) project built using Laravel 12 and Twill CMS.
This project allows an Admin user to manage website content dynamically using a block-based page builder, without writing frontend code.

The project follows the official Twill GitHub reference and demonstrates how to integrate Twill CMS with Laravel 12 to build a modern, scalable, and maintainable CMS application.


## Project Objective

The main objectives of this project are:

- To learn Laravel 12 framework

- To understand Twill CMS architecture

- To implement dynamic pages using blocks

- To separate Admin (CMS) and Frontend (Website) logic

- To build a real-world CMS similar to professional projects


## Technologies Used

- PHP 8.x

- Laravel 12

- Twill CMS

- MySQL

- Blade Templating Engine

- Node.js & Vite (Admin UI)

- HTML / CSS


## Key Features

- Admin panel powered by Twill CMS
- Block-based page builder (Hero, Text, Image)
- Dynamic page rendering using slugs
- Media library for image uploads
- Menu and navigation management
- Homepage configuration via settings
- Clean separation of admin and frontend logic



---

FULL STEP-BY-STEP: LARAVEL 12 + TWILL

---


## STEP 1: CREATE LARAVEL 12 PROJECT

### Open terminal / CMD and run:

```
composer create-project laravel/laravel PHP_Laravel12_Twill "12.*"

```

### Go inside project:

```
cd PHP_Laravel12_Twill

```

Meaning:

✔ Creates a new Laravel 12 project




## STEP 2: DATABASE SETUP

### Open .env and set:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel12_twill
DB_USERNAME=root
DB_PASSWORD=

```

### Create database in MySQL / phpMyAdmin:

```
Database name: laravel12_twill

```


## STEP 3: INSTALL TWILL (CMS PACKAGE)

### Run:

```
composer require area17/twill

```

Wait until installation finishes.



## STEP 4: INSTALL TWILL INTO LARAVEL

Run:

php artisan twill:install


When prompted:

Enter an email: → demo123@gmail.com

Enter a password: → Demo@123

Confirm the password: → Demo@123

### You see:

```
Your account has been created
All good!

```



## STEP 5: STORAGE LINK (MEDIA UPLOADS)

### Run:

```
php artisan storage:link

```


## STEP 6 (MOST IMPORTANT): INSTALL PAGE BUILDER 

### This step makes your project IDENTICAL to Twill reference repo.

Run:

```
php artisan twill:install basic-page-builder

```


#### WHAT THIS COMMAND CREATES

Automatically creates:

✔ Pages module
✔ Page builder
✔ Blocks system
✔ Navigation
✔ Frontend views

This is EXACTLY what the Twill GitHub reference uses.



## STEP 7: RUN MIGRATIONS

### Run:

```
php artisan migrate

```



## STEP 8: VERIFY CREATED FILES (IMPORTANT)

### You will now see:

```
app/
├── Models/Page.php
├── Repositories/PageRepository.php
├── Http/Controllers/Admin/PageController.php

resources/
├── views/
│   ├── site/page.blade.php
│   └── blocks/
│       ├── hero.blade.php
│       ├── text.blade.php
│       └── image.blade.php

routes/
├── twill.php

```

This matches the official reference structure



## STEP 9: CHECK BLOCK CONFIGURATION

### config/twill.php

```
<?php

return [
   'block_editor' => [

    'use_twill_blocks' => [
        'hero',
        'text',
        'image',
    ],

    'crops' => [
        'image' => [
            'default' => [
                [
                    'name' => 'default',
                    'ratio' => 16 / 9,
                ],
            ],
        ],
    ],
],
];



```


## STEP 10: CHECK CONTROLLER

### app/Http/Controllers/PageDisplayController.php

```

<?php

namespace App\Http\Controllers;

use A17\Twill\Facades\TwillAppSettings;
use App\Repositories\PageRepository;
use Illuminate\Contracts\View\View;

class PageDisplayController extends Controller
{
    public function show(string $slug, PageRepository $pageRepository): View
    {
        $page = $pageRepository->forSlug($slug);

        if (!$page) {
            abort(404);
        }

        return view('site.page', ['item' => $page]);
    }

    public function home(): View
    {
        if (TwillAppSettings::get('homepage.homepage.page')->isNotEmpty()) {
            /** @var \App\Models\Page $frontPage */
            $frontPage = TwillAppSettings::get('homepage.homepage.page')->first();

            if ($frontPage->published) {
                return view('site.page', ['item' => $frontPage]);
            }
        }

        abort(404);
    }
}

```




## STEP 11: FULL BLOCK FILES

### File 1: resources/views/blocks/hero.blade.php

```
<section style="padding:40px; background:#f5f5f5; margin-bottom:20px;">
    <h1>
        {{ $block->input('title') }}
    </h1>

    <p>
        {{ $block->input('subtitle') }}
    </p>
</section>


```

#### What this does

Shows a Hero section

Gets data from admin block fields

Same concept as Twill reference


### File 2: resources/views/blocks/text.blade.php

```
<section style="padding:20px; margin-bottom:20px;">
    {!! $block->input('text') !!}
</section>

```

#### What this does

Shows rich text content

{!! !!} allows HTML from editor


### File 3: resources/views/blocks/image.blade.php

```
<section style="padding:20px; margin-bottom:20px;">
    @if ($block->image('image'))
        <img 
            src="{{ $block->image('image', 'default') }}" 
            alt="Block Image"
            style="max-width:100%; height:auto;"
        >
    @endif
</section>

```

#### What this does

Displays uploaded image

Uses Twill media library

Same as reference logic



## STEP 12: FULL PAGE VIEW FILE (MOST IMPORTANT)

### File: resources/views/site/page.blade.php

```

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $item->title }}</title>
</head>
<body>

    <h1>{{ $item->title }}</h1>

    {{-- Render Twill blocks (REFERENCE STYLE) --}}
    @if ($item->blocks)
        @foreach ($item->blocks as $block)
            @include('blocks.' . $block->type)
        @endforeach
    @endif

</body>
</html>

```


## STEP 13: PAGE ROUTE 

### Open: routes/web.php

```

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageDisplayController;

Route::get('/', [PageDisplayController::class, 'home'])
    ->name('frontend.home');

Route::get('/{slug}', [PageDisplayController::class, 'show'])
    ->name('frontend.page');


```


## STEP 14: INSTALL NODE PACKAGES (ADMIN UI)

### Open new terminal in this project:

```
npm install
npm run dev
php artisan serve

```

### Open:

```
http://127.0.0.1:8000/admin

```

## So you can see this type Output:

### Laravel Login Page:


<img width="1919" height="956" alt="Screenshot 2026-02-09 120210" src="https://github.com/user-attachments/assets/89ac1996-8e17-4718-a408-45c1f3bed3d0" />


### Pages:


<img width="1919" height="958" alt="Screenshot 2026-02-09 120313" src="https://github.com/user-attachments/assets/58f769c8-f0a9-4311-8f38-0edf70eea74b" />


### Menu:


<img width="1919" height="961" alt="Screenshot 2026-02-09 120326" src="https://github.com/user-attachments/assets/4e5f3c06-a558-4a1d-b997-ae3859a0cf5c" />

<img width="1916" height="946" alt="Screenshot 2026-02-09 120409" src="https://github.com/user-attachments/assets/09ef0f83-c05e-45be-bdca-a3035e1f7799" />

<img width="1917" height="962" alt="Screenshot 2026-02-09 120432" src="https://github.com/user-attachments/assets/5c4c3a95-3925-4fe1-a377-ec1d15f52751" />


### Settings:


<img width="1891" height="964" alt="Screenshot 2026-02-09 120440" src="https://github.com/user-attachments/assets/e93525f9-21e2-4ec8-a7da-319478f61d3c" />


### Media Library:


<img width="1919" height="940" alt="Screenshot 2026-02-09 120955" src="https://github.com/user-attachments/assets/f9f9b97e-5bc2-4a15-9087-28f0ec627369" />


### Users:


<img width="1919" height="963" alt="Screenshot 2026-02-09 121355" src="https://github.com/user-attachments/assets/e1012ab1-d8b5-4ed7-a1f6-48449a5f6647" />

<img width="1893" height="952" alt="Screenshot 2026-02-09 121555" src="https://github.com/user-attachments/assets/e1d642bd-b3b6-4949-8e64-913406e22416" />

---


# Project Folder Structure:

```

PHP_Laravel12_Twill/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   └── PageController.php        # Admin Pages CRUD (auto by Twill)
│   │   │   │
│   │   │   └── PageDisplayController.php     # Frontend page display
│   │   │
│   │   └── Middleware/
│   │
│   ├── Models/
│   │   └── Page.php                          # Page model (Twill)
│   │
│   ├── Repositories/
│   │   └── PageRepository.php                # Fetch page by slug
│   │
│   └── Providers/
│
├── bootstrap/
│
├── config/
│   ├── app.php
│   ├── database.php
│   ├── filesystems.php
│   └── twill.php                             # Block + media config
│
├── database/
│   ├── migrations/                           # Twill + Laravel tables
│   ├── seeders/
│
├── public/
│   ├── storage/                              # Linked storage (images)
│   └── index.php
│
├── resources/
│   ├── views/
│   │   ├── blocks/                           # Twill blocks
│   │   │   ├── hero.blade.php
│   │   │   ├── text.blade.php
│   │   │   └── image.blade.php
│   │   │
│   │   └── site/
│   │       └── page.blade.php                # Frontend page renderer
│   │
│   ├── css/
│   ├── js/
│
├── routes/
│   ├── web.php                               # Frontend routes
│   └── twill.php                             # Admin routes (auto)
│
├── storage/
│   ├── app/
│   ├── framework/
│   └── logs/
│
├── vendor/
│
├── .env
├── artisan
├── composer.json
├── package.json
└── vite.config.js

```
