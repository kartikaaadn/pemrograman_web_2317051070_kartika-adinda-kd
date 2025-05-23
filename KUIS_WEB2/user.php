<?php
include "db.php";
$result = $conn->query("SELECT * FROM user");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Data User</h2>
    <a href="userform.php" class="btn btn-success mb-3">+ Tambah User</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Username</th>
                <th>Full Name</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= htmlspecialchars($row['fullname']) ?></td>
                <td><img src="uploads/<?= htmlspecialchars($row['foto']) ?>" width="50" class="img-thumbnail"></td>
                <td>
                    <a href="userform.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus_user.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
</div>
</body>
</html>
