<?php
require 'Converter.php';

$units = new SplFixedArray(8);

$units[0] = new Unit('8pce', 'LOT DE 8 PCE', 8.0, 'pce');
$units[1] = new Unit('6pce', 'LOT DE 6 PCE', 6.0, 'pce');
$units[2] = new Unit('4pce', 'LOT DE 4 PCE', 4.0, 'pce');
$units[3] = new Unit('3pce', 'LOT DE 3 PCE', 3.0, 'pce');
$units[4] = new Unit('pce', 'pce', 3.0, 'kg');
$units[5] = new Unit('kg', 'kg', 1000.0, 'g');
$units[6] = new Unit('g', 'g', null, null);
$units[7] = new Unit('cs', 'Cuillère à soupe', 20.0, 'g');

$converter = new Converter($units);

$originUnit = $units[3];
$targetUnit = $units[7];

/*$originUnit = $units[2];
$targetUnit = $units[1];*/

$converter->convertUnit($originUnit, $targetUnit);
echo $converter->factor . "\n";