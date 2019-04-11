# Requirement

```
PHP >= 7.0
```
# Installation

```shell
$ composer require "hybo/face-recognition"
```

# Usage

```php
<?php
require 'vendor/autoload.php';
use FaceRecognition\Client;

$config = [
    'baidu' => [
        'app_id' => '',
        'api_key' => '',
        'secret_key' => '',
    ],
    'face++' => [
        'api_key' => '',
        'api_secret' => '',
    ],
    'tencent-youtu' => [
        'app_id' => '',
        'secret_id' => '',
        'secret_key' => '',
        'user_id' => 'QQ号',
    ],
];

$image = '图片URL';

$client = new Client($config);

$client->driver('baidu')->detect($image);
$client->driver('face++')->detect($image);
// ...
```