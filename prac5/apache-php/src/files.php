<?php /*require '../vendor/autoload.php'; require_once '_helper.php'; use MongoDB\BSON\Binary;
    const dir = '/var/www/files/';
    define('requestMethod', $_SERVER[method]);
    const file = 'file',
        name = 'name',
        tmpName = 'tmp_name',
        url = 'mongodb://mongo:27017',
        files = 'files',
        id = 'id';

    if (requestMethod === methods[1]) upload();
    else if (requestMethod === methods[0]) download();

    function upload() {
        $tempFile = $_FILES[file][tmpName];
        $fileName = $_FILES[file][name];

        if (!isset($_POST['submit']) || empty($fileName)) { error(); return; }
        if (pathinfo(basename($_FILES[file][name]), PATHINFO_EXTENSION) != 'pdf') { error(); return; }

        $handle = fopen($tempFile, 'rb');
        $content = fread($handle, filesize($tempFile));
        fclose($handle);

        $client = new MongoDB\Client(url);
        $db = $client->selectDatabase(files);
        $collection = $db->selectCollection(files);
        if (!$collection) $db->createCollection(files);

        session_start();
        $sid = session_id();
        $collection->deleteMany([id => $sid]);

        if ($collection->insertOne([
            id => $sid,
            name => $fileName,
            file => new Binary($content, Binary::TYPE_GENERIC)
        ])->getInsertedCount() !== 1)
        { error(); return; }

        $result = $collection->findOne([id => $sid]);
        echo 'File ' . $result[name] . ' uploaded by ' . $result[id] . ', Content: ' . $result[file];
    }

    function download() {
        session_start();

        $client = new MongoDB\Client(url);
        $db = $client->selectDatabase(files);
        $collection = $db->selectCollection(files);
        if (!$collection) { error(); return; }

        $result = $collection->findOne([id => session_id()]);
        $fileName = $result[name];
        $content = $result[file]->getData();
        error_log(print_r('File ' . $fileName . ' uploaded by ' . $result[id] . ' Content: ' . $content, TRUE));

        $filePath = dir . $fileName;
        $handle = fopen($filePath, 'wb+');
        if (!$handle) { error(); return; }
        if (!fwrite($handle, $content)) { error(); return; }
        fclose($handle);

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Content-Length: ' . filesize($filePath));
        header('Pragma: public');
        flush();
        readfile($filePath);
        unlink($filePath);
        exit();
    }
*/?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Toys store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">
</head>
<body>
<form enctype="multipart/form-data" action="pdf.php" method="POST">
    <div>
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
        <br>
        <label class="custom-file-label" for="file_field">Отправить этот файл:</label>
        <br>
        <input class="custom-file-input" id="file_field" name="userfile" type="file"/>
    </div>
    <br>
    <input class="btn btn-primary" type="submit" value="Отправить файл"/>
</form>


<?php
$files = scandir('./files');
if (count($files) <= 1) {
    echo "<h2>Нет загруженных файлов</h2>";
} else {
    echo "<h2>Загруженные файлы</h2>";
    foreach ($files as $file) {
        if ($file != "." and $file != "..") {
            echo "<div class='card'><a class='card-body' href='./files/".$file."'>".$file."</a></div>";
        }
    }
}
?>
</body>
</html>