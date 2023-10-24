<?php

require __DIR__ . '/../models/bribe-model.php';

    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        $bribe = array_map('trim', $_POST);


        // Validate data
        $errors = validateBribe($bribe);

        // Save the recipe
        if (empty($errors)) {
            saveBribe($bribe);
            header('Location: book.php');
        }

    }

    // Generate the web page
    // require __DIR__ . '/../public/book.php';


function validateBribe(array $bribe): array
{
    if (empty($bribe['name'])) {
        $errors[] = 'The name is required';
    }
    if (empty($bribe['payment'])) {
        $errors[] = 'The payment is required';
    }
    if (isset($bribe['payment']) && ($bribe['payment'] <= 0)) {
        $errors[] = 'The payment must be bigger than 0';
    }


    return $errors ?? [];
}






