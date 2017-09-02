<?php

require __DIR__ . '/src/bootstrap.php';

use Notyourtechguy\Snipe;
use Notyourtechguy\Snipe\Student;


$student = new Student(getenv('USERNAME'), getenv('PASSWORD'));
$classmates = $student->getClassmates('2017-1-00814');

foreach($classmates as $classmate)
{
    echo $classmate->LAST_NAME . '<br>';
}
