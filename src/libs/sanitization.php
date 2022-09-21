<?php
const FILTERS = [
    'string' => FILTER_DEFAULT,
    'string[]' => [
        'filter' => FILTER_DEFAULT,
        'flags' => FILTER_REQUIRE_ARRAY
    ],
    'email' => FILTER_SANITIZE_EMAIL,
    'int' => [
        'filter' => FILTER_SANITIZE_NUMBER_INT,
        'flags' => FILTER_REQUIRE_SCALAR
    ],
    'int[]' => [
        'filter' => FILTER_SANITIZE_NUMBER_INT,
        'flags' => FILTER_REQUIRE_ARRAY
    ],
    'float' => [
        'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
        'flags' => FILTER_FLAG_ALLOW_FRACTION
    ],
    'float[]' => [
        'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
        'flags' => FILTER_REQUIRE_ARRAY
    ],
    'url' => FILTER_SANITIZE_URL,
];

/**
 * Recursively trim strings in an array
 * @param array $items
 * @return array
 */
function array_trim(array $items): array
{
    return array_map(function ($item) {
        if (is_string($item)) {
            return trim($item);
        } elseif (is_array($item)) {
            return array_trim($item);
        } else
            return $item;
    }, $items);
}

/**
 * Converts some predefined characters to HTML entities, and 
 * sanitize the inputs based on the rules and optionally trim the string
 * @param array $inputs
 * @param array $fields
 * @param int $default_filter FILTER_SANITIZE_STRING
 * @param array $filters FILTERS
 * @param bool $trim
 * @return array
 */
function sanitize(array $inputs, array $fields = [], int $default_filter = FILTER_DEFAULT, array $filters = FILTERS, bool $trim = true): array
{
    array_walk($inputs, function (&$val, $key) {
        $val = htmlspecialchars($val);
    });
    if ($fields) {
        $options = array_map(fn ($field) => $filters[$field], $fields);
        $data = filter_var_array($inputs, $options);
    } else {
        $data = filter_var_array($inputs, $default_filter);
    }

    return $trim ? array_trim($data) : $data;
}
