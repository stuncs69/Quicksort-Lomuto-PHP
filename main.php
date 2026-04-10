<?php

// [UNRELATED] Notes
// Quicksort Lomuto
// if low index greater than or equal to high index or low index is lower than 0, the array is sorted.
// Otherwise, partition and receive Wall position, call self with (Wall - 1) as high
// Call self again with (Wall + 1) as low

// Partition
// A Pivot is defined as the value at high index 
// A Wall is defined at the low index
// A Walker is defined at the low index
// Walk through the array with the Walker, until (High - 1) index
// If the Walker's value is lower than or equal to the Pivot's value, swap Wall value with Walker value and increase Wall index by 1
// After walking through, Swap value of Wall with value at High index.
// Return Wall index

include_once 'Sort.php';

$arr = [5,1,8,3,7,1,3,2];
Sort::Quicksort($arr, 0, count($arr) - 1);

var_dump($arr);
