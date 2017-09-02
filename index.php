<?php

require __DIR__ . '/src/bootstrap.php';

use Notyourtechguy\Snipe;


if (!function_exists('dd')) {
    function dd()
    {
        array_map(function($x) {
            dump($x);
        }, func_get_args());
        die;
    }
}

$sniper = new Snipe\Snipe('201011229', '985464');
$sniper->login();
$classmates = $sniper->getClassmates();

foreach($classmates as $classmate)
{
    echo $classmate->LAST_NAME . '<br>';
}
