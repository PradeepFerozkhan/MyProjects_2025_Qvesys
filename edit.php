<?php
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "Invalid request.";
    exit;
}

$data = json_decode(file_get_contents('data.json'), true);

// Find user by ID
$found = null;
foreach ($data as $user) {
    if ($user['id'] == $id) {
        $found = $user;
        break;
    }
}

if (!$found) {
    echo "User not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit User</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="wrapper">
    <h2>Edit User - ID #<?= $id ?></h2>
    <form action="update.php" method="POST" class="add-form">
      <input type="hidden" name="id" value="<?= $id ?>">
      <input type="text" name="name" value="<?= htmlspecialchars($found['name']) ?>" required>
      <input type="email" name="email" value="<?= htmlspecialchars($found['email']) ?>" required>
      <button type="submit">💾 Update</button>
    </form>
    <p><a href="index.php" class="btn">← Back</a></p>
  </div>
</body>
</html>
