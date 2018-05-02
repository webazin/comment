[![Latest Stable Version](https://poser.pugx.org/webazin/comment/v/stable.svg)](https://packagist.org/packages/webazin/comment) [![License](https://poser.pugx.org/webazin/comment/license.svg)](https://packagist.org/packages/webazin/comment)

[![Total Downloads](https://poser.pugx.org/webazin/comment/downloads.svg)](https://packagist.org/packages/webazin/comment)

# Laravel Comment
comment system for laravel 5

## Installation

First, pull in the package through Composer.

```js
composer require webazin/Comment
```
or add this in your project's composer.json file .
````
"require": {
  "webazin/Comment": "dev-master",
}
````

And then include the service provider within `app/config/app.php`.

```php
'providers' => [
    webazin\Comment\CommentServiceProvider::class
];
```

-----
## Getting started
After the package is correctly installed, you need to generate the migration.
````
php artisan comment:migration
````

It will generate the `<timestamp>_create_comments_table.php` migration. You may now run it with the artisan migrate command:
````
php artisan migrate
````

After the migration, one new table will be present, `comments`.

## Usage
### Setup a Model
```php
<?php

namespace App;

use webazin\comment\Traits\Commentable as Comment;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements Comment
{
    use Comment;
}
```

### Create a comment
```php
$user = User::first();
$post = Post::first();

$comment = $post->comment([
    'comment' => 'comment text'
], $user);

dd($comment);
```

### Create or update a unique comment
```php
$user = User::first();
$post = Post::first();

$comment = $post->commentUnique([
    'comment' => 'comment text'
], $user);

dd($comment);
```

### Update a comment
```php
$comment = $post->updateComment(1, [
    'comment' => 'comment text'
]);
```

### Delete a comment:
```php
$post->deleteComment(1);
```

### fetch the Sum comment:
````php
$post->commentCount

// $post->commentCount() also works for this.
```` 
