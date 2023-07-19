<?php

function stringCouples(int $immutable, array $args) : string
{
    $result = array_map(function($value) {
        return sprintf('(%d, %d)', 1, $value);
    }, $args);

    return implode(', ', $result);
}
