<?php
$conn = new mysqli("localhost", "root", "", "lab4");
if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

$sql = "SELECT components, expenditure2010, expenditure2011 FROM expenditure";
$result = $conn->query($sql);

$labels = $data2010 = $data2011 = [];

while ($row = $result->fetch_assoc()) {
    $labels[] = $row['components'];
    $data2010[] = $row['expenditure2010'];
    $data2011[] = $row['expenditure2011'];
}
$conn->close();

header('Content-type: image/png');

$width = 700;
$height = 400;
$image = imagecreate($width, $height);

$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);
$blue = imagecolorallocate($image, 0, 102, 204);
$red = imagecolorallocate($image, 204, 0, 0);

imageline($image, 50, 30, 50, 350, $black);
imageline($image, 50, 350, 650, 350, $black);

imagestringup($image, 3, 0, 250, "Expenditure (RM)", $black);
imagestring($image, 3, 280, 370, "Components", $black);

$x = 60;
$bar_width = 20;
$gap = 40;
$max = max(max($data2010), max($data2011));
$max_rounded = ceil($max / 5000) * 5000; // Round for clean scale
$scale = 250 / $max_rounded;

for ($val = 0; $val <= $max_rounded; $val += 5000) {
    $y = (int) (350 - ($val * $scale));
    imageline($image, 45, $y, 50, $y, $black);
    imagestring($image, 1, 15, $y - 7, number_format($val), $black);
}

for ($i = 0; $i < count($labels); $i++) {
    $bar2010 = $data2010[$i] * $scale;
    $bar2011 = $data2011[$i] * $scale;

    $bar2010_top = (int) (350 - $bar2010);
    $bar2011_top = (int) (350 - $bar2011);

    $x1_2010 = (int) $x;
    $x2_2010 = (int) ($x + $bar_width);

    $x1_2011 = (int) ($x + $bar_width + 5);
    $x2_2011 = (int) ($x + 2 * $bar_width + 5);

    imagefilledrectangle($image, $x1_2010, $bar2010_top, $x2_2010, 350, $blue);
    imagefilledrectangle($image, $x1_2011, $bar2011_top, $x2_2011, 350, $red);

    imagestring($image, 1, $x1_2010, $bar2010_top - 15, (string) $data2010[$i], $black);
    imagestring($image, 1, $x1_2011, $bar2011_top - 15, (string) $data2011[$i], $black);

    $label_x = $x + $bar_width - (int) (strlen($labels[$i]) * 3.5);
    imagestring($image, 2, $label_x, 355, $labels[$i], $black);

    $x += ($bar_width * 2 + $gap);
}

imagestring($image, 2, 520, 40, "Blue = 2010", $blue);
imagestring($image, 2, 520, 60, "Red = 2011", $red);

imagepng($image);
imagedestroy($image);
