<?php
include "db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil nama file foto
    $stmt = $conn->prepare("SELECT foto FROM user WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result && file_exists("uploads/" . $result['foto'])) {
        unlink("uploads/" . $result['foto']);
    }

    // Hapus data
    $stmt = $conn->prepare("DELETE FROM user WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: user.php");
exit;
?>
