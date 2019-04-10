<?php

function p(...$args)
{
    // $args = func_get_args();

    echo "<pre>";

    foreach ($args as $arg) {
        print_r($arg);
        echo PHP_EOL;
    }

    echo "</pre>";
}

function pd(...$args)
{
    // call_user_func_array('p', $args);
    p(...$args);
    die();
}
