<?php

// Hybrid quicksort:
// 1. Validate bounds once at the public entry point.
// 2. Use median-of-three pivot selection for large partitions.
// 3. Use insertion sort for small partitions to reduce overhead.
// 4. Recurse into the smaller side first to limit stack growth.

require_once __DIR__ . '/Sort.php';

$arr = [5,1,8,3,7,1,3,2];
Sort::Quicksort($arr, 0, count($arr) - 1);

var_dump($arr);
