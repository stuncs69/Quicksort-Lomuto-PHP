<?php

declare(strict_types=1);

final class Sort
{
	/*
	 * <Summary>
	 * Sort an array in ascending order by recursively partitioning the same array into 2 parts, smaller than/equal to pivot and greater than pivot.
	 * The pivot is defined as the value at the high index
	 * The wall is defined as low index
	 * Walker J is defined and is used to walk through the array and find any values that are lower than/equal to the pivot.
	 * When a lower/equal value is found, the value swaps positions with the wall, and the wall's index increases by 1
	 * After walking through the array, the value at Wall's current index is swapped with the value at High index
	 * The algorithm calls itself again, using (Wall - 1) as High value, applying the same algorithm to a subset of the array containing numbers that where lower than/equal to the pivot before.
	 * The algorithm calls itself again, using (Wall + 1) as Low value, applying the same algoritm to a subset of the array containing numbers that were greater than the pivot before.
	 * Continue until Low index is greater than/equal to High index, or Low index is lesser than 0.
	 * </Summary
	 *
	 * <Algo> (Pseudocode)
	 * 	Void Quicksort(Numbers[], Int Low, Int High)
	 *		if Low >= High || Low < 0 then
	 *			return
	 *		end
	 *
	 *		Pivot = Numbers[High]
	 *		Wall = Low
	 *
	 *		for j = Low to High -1 do
	 *			if Numbers[j] <= Pivot then
	 *				Swap(Numbers, Wall, j)
	 *				Wall++
	 *			end
	 *		end
	 *
	 *		Swap(Numbers, Wall, High)
	 *		Quicksort(Numbers, Low, Wall - 1)
	 *		Quicksort(Numbers, Wall + 1, High)
	 * 	end
	 * </Algo>
	 */
	public static function Quicksort(array &$nums, int $low, int $high): void
	{
		if ($low >= $high || $low < 0) return;

		$pivot = $nums[$high];
		$wall = $low;

		for ($j = $low; $j < $high; $j++) {
			if ($nums[$j] <= $pivot) {
				self::Swap($nums, $wall, $j);
				$wall++;
			}
		}
		self::Swap($nums, $wall, $high);

		self::Quicksort($nums, $low, $wall - 1);
		self::Quicksort($nums, $wall + 1, $high);
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
		$temp = $arr[$x];
		$arr[$x] = $arr[$y];
		$arr[$y] = $temp;
	}
}
