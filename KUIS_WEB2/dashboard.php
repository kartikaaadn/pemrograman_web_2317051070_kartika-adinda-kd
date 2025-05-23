<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Selamat datang, <?= htmlspecialchars($user['fullname']); ?></h2>
    <img src="uploads/<?= htmlspecialchars($user['foto']); ?>" width="100" class="img-thumbnail"><br><br>
    <a href="user.php" class="btn btn-primary">Kelola User</a>
    <a href="logout.php" class="btn btn-secondary">Logout</a>
</div>
</body>
</html>
