<?php
$file = 'data.json';
$data = json_decode(file_get_contents($file), true);

$id = $_GET['id'];
$newData = [];

foreach ($data as $item) {
    if ($item['id'] != $id) {
        $newData[] = $item;
    }
}

file_put_contents($file, json_encode($newData, JSON_PRETTY_PRINT));
header('Location: index.php');
exit;
