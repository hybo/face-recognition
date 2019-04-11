<?php

require('../vendor/autoload.php');

use FaceRecognition\Client;

$config = [
    'baidu' => [
        'app_id' => '15953880',
        'api_key' => 'BuOxKsZIMRSW0TYnkC2d1mDW',
        'secret_key' => '1R0Ypf8o7GnAKMF7VuFkpQdhaBGALjKW',
    ],
    'face++' => [
        'api_key' => 'yOq-nGCft_ByxQ8F28YjjQ9azAMHMGlC',
        'api_secret' => 'e5mC7NY5zieNpsMzAHDfOvAa4lQ92_z-',
    ],
    'tencent-youtu' => [
        'app_id' => '',
        'secret_id' => '',
        'secret_key' => '',
        'user_id' => '535193232',
    ],
];

// user_1
$image1 = 'http://face.worthcloud.net/2019-04-08-10-09-30_00_0024_0022_164_164.jpeg';
$image2 = 'http://face.worthcloud.net/2019-04-08-10-15-39_00_0018_0026_164_164.jpeg';
$image3 = 'http://face.worthcloud.net/2019-04-08-08-54-31_00_0037_0044_208_208.jpeg';
$image4 = 'http://face.worthcloud.net/2019-04-08-10-33-20_00_0032_0035_200_200.jpeg';
$image5 = 'http://face.worthcloud.net/2019-04-08-08-43-46_00_0011_0034_172_172.jpeg';

// user_2
$image6 = 'http://face.worthcloud.net/2019-04-08-09-20-50_00_0016_0042_168_168.jpeg';
$image7 = 'http://face.worthcloud.net/2019-04-08-08-47-55_00_0028_0018_136_136.jpeg';


$client = new Client($config);

// $res = $client->driver('baidu')->detect($image1);
// echo '<pre>';
// print_r($res);
//
// $res = $client->driver('face++')->detect($image1);
// echo '<pre>';
// print_r($res);

// $res = $client->driver('baidu')->compare($image1, $image2);
// echo '<pre>';
// print_r($res);
//
// $res = $client->driver('face++')->compare($image1, $image2);
// echo '<pre>';
// print_r($res);

$res = $client->driver('baidu')->search($image1, ['test_1']);
echo '<pre>';
print_r($res);