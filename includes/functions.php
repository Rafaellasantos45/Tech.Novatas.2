<?php

// Facilita o DEBUG dos códigos:
function debug($var, $exit = true, $dump = false)
{
    echo '<pre>';
    if ($dump) var_dump($var);
    else print_r($var);
    echo '</pre>';
    if ($exit) exit();
}
