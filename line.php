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

header("Content-type: image/png");

$width = 700;
$height = 400;
$image = imagecreatetruecolor($width, $height);

imagesavealpha($image, true);
$transparent = imagecolorallocatealpha($image, 255, 255, 255, 0);
imagefill($image, 0, 0, $transparent);

$black = imagecolorallocate($image, 0, 0, 0);
$blueLine = imagecolorallocate($image, 0, 102, 204);
$redLine = imagecolorallocate($image, 204, 0, 0);
$blueDot = imagecolorallocate($image, 51, 153, 255);
$redDot = imagecolorallocate($image, 255, 77, 77);
$lightGray = imagecolorallocatealpha($image, 200, 200, 200, 90);

imageline($image, 50, 30, 50, 350, $black);
imageline($image, 50, 350, 650, 350, $black);

imagestring($image, 3, 280, 370, "Components", $black);
imagestringup($image, 3, 0, 250, "Expenditure (RM)", $black);

$gap = 80;
$max = max(max($data2010), max($data2011));
$max_rounded = ceil($max / 5000) * 5000;
$scale = 250 / $max_rounded;

for ($val = 0; $val <= $max_rounded; $val += 5000) {
    $y = (int) (350 - ($val * $scale));
    imageline($image, 45, $y, 650, $y, $lightGray);
    imageline($image, 45, $y, 50, $y, $black);
    imagestring($image, 1, 15, $y - 7, number_format($val), $black);
}

$start_x = 50;
$prev_x_2010 = $prev_y_2010 = $prev_x_2011 = $prev_y_2011 = 0;

for ($i = 0; $i < count($labels); $i++) {
    $x = (int) ($start_x + $i * $gap);
    $y2010 = (int) (350 - ($data2010[$i] * $scale));
    $y2011 = (int) (350 - ($data2011[$i] * $scale));

    imagefilledellipse($image, $x, $y2010, 6, 6, $blueDot);
    imagefilledellipse($image, $x, $y2011, 6, 6, $redDot);

    $label_x = $x - (int) (strlen($labels[$i]) * 3.5);
    imagestring($image, 1, $label_x, 355, $labels[$i], $black);

    if ($i > 0) {
        imageline($image, $prev_x_2010, $prev_y_2010, $x, $y2010, $blueLine);
        imageline($image, $prev_x_2010, $prev_y_2010 + 1, $x, $y2010 + 1, $blueLine);

        imageline($image, $prev_x_2011, $prev_y_2011, $x, $y2011, $redLine);
        imageline($image, $prev_x_2011, $prev_y_2011 + 1, $x, $y2011 + 1, $redLine);
    }

    $prev_x_2010 = $x;
    $prev_y_2010 = $y2010;
    $prev_x_2011 = $x;
    $prev_y_2011 = $y2011;
}

imagestring($image, 2, 520, 40, "Blue = 2010", $blueLine);
imagestring($image, 2, 520, 60, "Red = 2011", $redLine);

imagepng($image);
imagedestroy($image);
