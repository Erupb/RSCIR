<!--<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Files</title>
        <script src="http://localhost:8082/_helper.js"></script>
        <?php /*require_once '_helper.php'; defineDarkTheme(); */?>
    </head>
    <body>
        <form action="files.php" method="post" enctype="multipart/form-data">
            Select PDF File to Upload:
            <input type="file" name="file">
            <input type="submit" name="submit" value="Upload">
        </form>
        <button onclick="redir('files.php')">Download file</button>
    </body>
</html>
-->
<?php
$uploaddir = './files/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo '<pre>';
setlocale(LC_ALL,'en_US.UTF-8');
$ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
if ($ext != "pdf") {
    echo "Вы попытались загрузить не pdf файл";
} else {
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        echo "Файл корректен и был успешно загружен.\n";
    } else {
        echo "Возможная атака с помощью файловой загрузки!\n";
    }
}
echo "</pre>";
?>
<a href="files.php">К списку</a>