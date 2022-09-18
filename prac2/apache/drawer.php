<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>svg drawer</title>
</head>
<body>
<?php
if (isset($_GET['num'])) { // истина, если в качестве параметра в URL-строке указан параметр num с каким-то значением
    $num = $_GET['num'];
    $size = ($num & 3);
    $red = ($num >> 4) & 1;
    $green = ($num >> 3) & 1;
    $blue = ($num >> 2) & 1;
    $shape = ($num >> 5) & 3;
    $color = "\"#".($red == 1 ? "ff" : "00").($green == 1 ? "ff" : "00").($blue == 1 ? "ff" : "00")."\"";
    $shape_tag = "";
    $scale = 50;
    switch ($shape) { // https://www.rapidtables.com/convert/number/binary-to-decimal.html
        case 0: // http://127.0.0.1:8081/drawer.php?num=19 - 0010011 = 19
            $radius = ($size * $scale / 2);
            $shape_tag = "circle cx=".($radius + 10)." cy=".($radius + 10)." r=".$radius." ";
            break;
        case 1: // http://127.0.0.1:8081/drawer.php?num=43 - 0101011 = 43
            $shape_tag = "rect x=10 y=10 width=".($size * $scale * 2)." height=".($size * $scale)." ";
            break;
        case 2: // http://127.0.0.1:8081/drawer.php?num=71 - 1000111 = 71
            $shape_tag = "rect x=10 y=10 width=".($size * $scale)." height=".($size * $scale)." ";
            break;
        case 3: // http://127.0.0.1:8081/drawer.php?num=109 - 1101101 = 109
            $side = $size * $scale;
            $shape_tag = "polygon points='".($side / 2 + 5).",10"." 10,".($side)." ".($side).",".($side)."' ";
            break;
    }
    echo "<svg width='1000' height='1000'>";
    echo "  <".$shape_tag."fill=".$color." style='stroke:black'"."/>";
    echo "</svg>";
} else {
    echo "<p> Неправильный запрос. Укажите корректное значение в параметре URL строки. Например</p>
<pre>
    http:localhost:8081/drawer.php?num=122
</pre>";
}
?>
</body>
</html>