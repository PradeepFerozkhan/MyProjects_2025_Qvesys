<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    if ($name === '' || $email === '') {
        echo "<script>alert('Name and Email are required.'); window.location.href='index.php';</script>";
        exit;
    }

    $file = 'data.json';
    $data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

    // Check for duplicate name and email
    foreach ($data as $entry) {
        if (strtolower($entry['name']) === strtolower($name) && strtolower($entry['email']) === strtolower($email)) {
            echo "<script>alert('This name and email already exists. Please try something else.'); window.location.href='index.php';</script>";
            exit;
        }
    }

    // Get next ID
    $newId = empty($data) ? 1 : max(array_column($data, 'id')) + 1;

    // Create new entry
    $data[] = [
        'id' => $newId,
        'name' => $name,
        'email' => $email
    ];

    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

    echo "<script>alert('Data added successfully!'); window.location.href='index.php';</script>";
}
?>
