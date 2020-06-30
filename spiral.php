<?php
$size = (int) ($argv[1] ?? 5);
$result = [];

$i = $j = floor(($size - 1) / 2);
$cell = ['i' => $i, 'j' => $j];
$maxNumber = $size**2;

$direction = 3;
for ($i = 1; $i <= $maxNumber; $i++) {
	$result[$cell['j']][$cell['i']] = $i;
	$cell = getNextValidCell($cell, $direction, $result);
}
printResult($result, $size);

function getNextValidCell(array $cell, int &$direction, array $result) {
	$newDirection = ($direction + 1) % 4;
	$nextCell = getNextCell($cell, $newDirection);
	if (cellIsFree($nextCell, $result)) {
		$direction = $newDirection;
		return $nextCell;
	}
	return getNextCell($cell, $direction);
}

function cellIsFree(array $cell, array $result) {
	return !isset($result[$cell['j']][$cell['i']]);
}

// directions 0 -> right, 1 -> down; 2 -> left; 3 -> up
function getNextCell(array $cell, int $direction) {
	switch ($direction) {
		case 2: $cell['i']--; break;
		case 0: $cell['i']++; break;
		case 3: $cell['j']--; break;
		case 1: $cell['j']++; break;
	}
	return $cell;
}

function printResult(array $result, int $size) {
	for ($i = 0; $i < $size; $i++) {
		for ($j = 0; $j < $size; $j++) {
			echo sprintf('%3d ', $result[$i][$j]);
		}
		echo "\n";
	}
}