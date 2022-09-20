<?php

/**
 * Sanitize and validate data
 * @param array $data
 * @param array $fields
 * @param array $messages
 * @return array
 */
function filter(array $data, array $fields, array $messages = []): array
{
    $sanitization = [];
    $validation = [];

    // var_dump($data);
    // die();
    // extract sanitization & validation rules
    foreach ($fields as $field => $rules) {
        if (strpos($rules, '|')) {
            [$sanitization[$field], $validation[$field]] = explode(' |', $rules, 2);
        } else {
            $sanitization[$field] = $rules;
        }
    }

    $inputs = sanitize($data, $sanitization);
    $errors = validate($inputs, $validation, $messages);
    // var_dump($inputs);
    // var_dump($errors);
    // die();
    return [$inputs, $errors];
}
