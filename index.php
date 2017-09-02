<?php

require __DIR__ . '/src/bootstrap.php';

use Notyourtechguy\Snipe;
use Notyourtechguy\Snipe\Student;


if (!function_exists('dd')) {
    function dd()
    {
        array_map(function($x) {
            dump($x);
        }, func_get_args());
        die;
    }
}

$student = new Student(getenv('USERNAME'), getenv('PASSWORD'));
$classmates = $student->getClassmates('2017-1-00814');

foreach($classmates as $classmate)
{
    echo $classmate->LAST_NAME . '<br>';
}
