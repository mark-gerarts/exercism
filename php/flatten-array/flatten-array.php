<?php

function flatten(array $array): array {
    // Flatten the array.
    $flattenedArray = [];
    array_walk_recursive(
        $array,
        function ($leaf) use (&$flattenedArray) {
            $flattenedArray[] = $leaf;
        }
    );

    // Remove any null values.
    $flattenedArray = array_filter($flattenedArray, function ($element): bool {
        return $element !== null;
    });

    // Normalize the array keys.
    return array_values($flattenedArray);
}
