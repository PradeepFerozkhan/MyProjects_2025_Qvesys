<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    if ($name === '' || $email === '') {
        echo "<script>alert('Name and Email are required.'); window.location.href='index.php';</script>";
        exit;
    }

    $file = 'data.json';
    $data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

    // Check for duplicate name and email, excluding current record
    foreach ($data as $entry) {
        if (
            $entry['id'] != $id &&
            strtolower($entry['name']) === strtolower($name) &&
            strtolower($entry['email']) === strtolower($email)
        ) {
            echo "<script>alert('Duplicate record exists with the same name and email. Update rejected.'); window.location.href='index.php';</script>";
            exit;
        }
    }

    // Perform the update
    foreach ($data as &$entry) {
        if ($entry['id'] == $id) {
            $entry['name'] = $name;
            $entry['email'] = $email;
            break;
        }
    }

    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    echo "<script>alert('Data updated successfully!'); window.location.href='index.php';</script>";
}
?>
