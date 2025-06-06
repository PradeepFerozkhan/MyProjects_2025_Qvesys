<?php
$data = json_decode(file_get_contents('data.json'), true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Directory - JSON DB</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="wrapper">
    <header>
      <h1>📋 Employers Details</h1>
    </header>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'duplicate'): ?>
      <div class="alert error">❌ User with same name & email already exists!</div>
    <?php endif; ?>
    <?php if (isset($_GET['success'])): ?>
      <div class="alert success">✅ Data added successfully!</div>
    <?php endif; ?>

    <section class="form-section">
      <form action="create.php" method="POST" class="add-form">
        <input type="text" name="name" placeholder="Enter name" required>
        <input type="email" name="email" placeholder="Enter email" required>
        <button type="submit">➕ Add User</button>
      </form>
    </section>

    <section class="table-section">
      <table>
        <thead>
          <tr>
            <th>#</th><th>Name</th><th>Email</th><th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data as $item): ?>
            <tr>
              <td><?= $item['id'] ?></td>
              <td><?= htmlspecialchars($item['name']) ?></td>
              <td><?= htmlspecialchars($item['email']) ?></td>
              <td>
                <a href="edit.php?id=<?= $item['id'] ?>" class="btn edit">✏️ Edit</a>
                <a href="delete.php?id=<?= $item['id'] ?>" class="btn delete" onclick="return confirm('Delete this user?')">🗑️ Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </section>
  </div>
</body>
</html>
