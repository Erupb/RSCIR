<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sort</title>
</head>
<body>
<?php

function quick_sort($my_array)
{
    $loe = $gt = array();
    if(count($my_array) < 2)
    {
        return $my_array;
    }
    $pivot_key = key($my_array);
    $pivot = array_shift($my_array);
    foreach($my_array as $val)
    {
        if($val <= $pivot)
        {
            $loe[] = $val;
        }elseif ($val > $pivot)
        {
            $gt[] = $val;
        }
    }
    return array_merge(quick_sort($loe),array($pivot_key=>$pivot),quick_sort($gt));
}

if (isset($_GET['array'])) {
    $array = explode(",", $_GET["array"]);
    echo "<p>Заданный массив</p>";
    echo "<pre>[";
    echo implode(", ", $array);
    echo "]</pre>";
    echo "<p>Отсортированный массив</p>";
    $new_array = quick_sort($array);
    echo "<pre>[";
    echo implode(", ", $new_array);
    echo "]</pre>";


} else{
    echo "<p>Неправильный запрос. Укажите корректное значение в параметре URL строки. Например</p>
<pre>
    http:localhost:8081/sort.php?array=3,4,5,6,0,1,8,4
</pre>";
}

?>
</body>
</html>
