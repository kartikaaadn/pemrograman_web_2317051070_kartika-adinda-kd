<?php
include "db.php";

$id = $username = $fullname = $foto = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM user WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();

    $username = $data['username'];
    $fullname = $data['fullname'];
    $foto = $data['foto'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $password = $_POST['password'];
    $fotoBaru = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $uploadDir = "uploads/";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir);
    }

    if ($fotoBaru) {
        if ($foto && file_exists($uploadDir . $foto)) {
            unlink($uploadDir . $foto);
        }
        move_uploaded_file($tmp, $uploadDir . $fotoBaru);
    }

    if ($id) {
        if ($password) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE user SET username=?, fullname=?, password=?, foto=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $username, $fullname, $hash, $fotoBaru ? $fotoBaru : $foto, $id);
        } else {
            $sql = "UPDATE user SET username=?, fullname=?, foto=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $username, $fullname, $fotoBaru ? $fotoBaru : $foto, $id);
        }
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        move_uploaded_file($tmp, $uploadDir . $fotoBaru);
        $sql = "INSERT INTO user (username, fullname, password, foto) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $fullname, $hash, $fotoBaru);
    }

    $stmt->execute();
    header("Location: user.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $id ? "Edit" : "Tambah" ?> User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2><?= $id ? "Edit" : "Tambah" ?> User</h2>
    <form method="post" enctype="multipart/form-data" class="border p-4 rounded shadow">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($username) ?>" required>
        </div>
        <div class="mb-3">
            <label for="fullname" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="fullname" name="fullname" value="<?= htmlspecialchars($fullname) ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" <?= $id ? "" : "required" ?>>
            <?php if ($id): ?>
                <small class="text-muted">(Kosongkan jika tidak ingin mengubah password)</small>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" name="foto">
            <?php if ($foto): ?>
                <div class="mt-2">
                    <img src="uploads/<?= htmlspecialchars($foto) ?>" width="80" class="img-thumbnail">
                </div>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-success"><?= $id ? "Update" : "Tambah" ?></button>
        <a href="user.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
