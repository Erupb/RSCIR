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
    switch ($shape) {
        case 0:
            $side = $size * $scale;
            $shape_tag = "polygon points='".($side / 2 + 5).",10"." 10,".($side)." ".($side).",".($side)."' ";
            break;
        case 1:
            $shape_tag = "rect x=10 y=10 width=".($size * $scale * 2)." height=".($size * $scale)." ";
            break;
        case 2:
            $shape_tag = "rect x=10 y=10 width=".($size * $scale)." height=".($size * $scale)." ";
            break;
        case 3:
            $radius = ($size * $scale / 2);
            $shape_tag = "circle cx=".($radius + 10)." cy=".($radius + 10)." r=".$radius." ";
            break;
    }
    echo "<svg width='1000' height='1000'>";
    echo "  <".$shape_tag."fill=".$color." style='stroke:black'"."/>";
    echo "</svg>";
} else {
    echo "<p>Задайте число от 0 до 127 в параметре, чтобы нарисовать фигуру</p>
<pre>
    http:localhost:8080/drawer.php?num=...
</pre>";
}
?>
</body>
</html>


}
?>
</body>