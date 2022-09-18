<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bash</title>
</head>
<body>
<h1>unix</h1>
<?php
function print_cmd($cmd) {
    $lines = array();
    exec($cmd, $lines);
    echo "<pre> > ".$cmd."</pre>";
    echo "<pre>".implode("\n", $lines)."</pre>";
}

$command_list = array("pwd", "ls", "cat Dockerfile", "ps");
foreach ($command_list as $cmd) {
    print_cmd($cmd);
}
?>
</body>
</html>