<?php

declare(strict_types=1);

final class Sort
{
	private const INSERTION_SORT_THRESHOLD = 16;

	/*
	 * <Summary>
	 * Sort an array in ascending order using a hybrid quicksort.
	 * Small ranges switch to insertion sort to reduce overhead.
	 * Larger ranges use Lomuto partitioning with a median-of-three pivot
	 * to avoid the obvious worst cases for already sorted input.
	 * The smaller partition is processed recursively first and the larger
	 * partition is handled iteratively to keep stack growth bounded.
	 * </Summary
	 *
	 * <Algo> (Pseudocode)
	 * 	Void Quicksort(Numbers[], Int Low, Int High)
	 *		if Numbers is empty then
	 *			return
	 *		end
	 *
	 *		if Low or High are out of bounds then
	 *			throw
	 *		end
	 *
	 *		while Low < High do
	 *			if range length <= threshold then
	 *				InsertionSort(Numbers, Low, High)
	 *				return
	 *			end
	 *
	 *			Pivot = MedianOfThree(Numbers, Low, Middle, High)
	 *			Partition using Lomuto around Pivot
	 *
	 *			Recurse into smaller side
	 *			Iterate over larger side
	 *		end
	 * 	end
	 * </Algo>
	 */
	public static function Quicksort(array &$nums, int $low, int $high): void
	{
		$count = count($nums);
		if ($count === 0) {
			return;
		}

		if ($low < 0 || $high < 0 || $low >= $count || $high >= $count) {
			throw new OutOfRangeException('Low and high indexes must be within the array bounds.');
		}

		if ($low >= $high) {
			return;
		}

		self::quicksortRange($nums, $low, $high);
	}

	private static function quicksortRange(array &$nums, int $low, int $high): void
	{
		while ($low < $high) {
			if (($high - $low) <= self::INSERTION_SORT_THRESHOLD) {
				self::insertionSort($nums, $low, $high);
				return;
			}

			$pivotIndex = self::partition($nums, $low, $high);
			$leftSize = $pivotIndex - $low;
			$rightSize = $high - $pivotIndex;

			if ($leftSize < $rightSize) {
				self::quicksortRange($nums, $low, $pivotIndex - 1);
				$low = $pivotIndex + 1;
				continue;
			}

			self::quicksortRange($nums, $pivotIndex + 1, $high);
			$high = $pivotIndex - 1;
		}
	}

	private static function partition(array &$nums, int $low, int $high): int
	{
		$mid = $low + intdiv($high - $low, 2);
		$pivotIndex = self::medianOfThree($nums, $low, $mid, $high);
		self::swap($nums, $pivotIndex, $high);

		$pivot = $nums[$high];
		$wall = $low;

		for ($j = $low; $j < $high; $j++) {
			if ($nums[$j] < $pivot) {
				self::swap($nums, $wall, $j);
				$wall++;
			}
		}

		self::swap($nums, $wall, $high);

		return $wall;
	}

	private static function medianOfThree(array $nums, int $a, int $b, int $c): int
	{
		if ($nums[$a] > $nums[$b]) {
			[$a, $b] = [$b, $a];
		}

		if ($nums[$b] > $nums[$c]) {
			[$b, $c] = [$c, $b];
		}

		if ($nums[$a] > $nums[$b]) {
			[$a, $b] = [$b, $a];
		}

		return $b;
	}

	private static function insertionSort(array &$nums, int $low, int $high): void
	{
		for ($i = $low + 1; $i <= $high; $i++) {
			$value = $nums[$i];
			$j = $i - 1;

			while ($j >= $low && $nums[$j] > $value) {
				$nums[$j + 1] = $nums[$j];
				$j--;
			}

			$nums[$j + 1] = $value;
		}
	}

	/*
	 * <Summary>
	 * Swap items in an array
	 * </Summary>
	 *
	 * <Algo>
	 *	Void Swap(Numbers[], Int X, Int Y)
	 *		Temp = Numbers[X]
	 *		Numbers[X] = Numbers[Y]
	 *		Numbers[Y] = Temp
	 *	end
	 * </Algo>
	 */
	private static function swap(array &$arr, int $x, int $y): void
	{
		if ($x === $y) {
			return;
		}

		$temp = $arr[$x];
		$arr[$x] = $arr[$y];
		$arr[$y] = $temp;
	}
}
