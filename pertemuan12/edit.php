<?php include "koneksi/db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Edit Data Mahasiswa</h2>
    
    <?php
    // Ambil data mahasiswa berdasarkan ID
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id = $id");
        $data = mysqli_fetch_assoc($query);
        
        if (!$data) {
            echo "<div class='alert alert-danger'>Data tidak ditemukan.</div>";
            exit();
        }
    } else {
        echo "<div class='alert alert-danger'>ID tidak valid.</div>";
        exit();
    }
    
    // Proses update data
    if (isset($_POST['update'])) {
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        
        $update_query = mysqli_query($conn, "UPDATE mahasiswa SET nama = '$nama', nim = '$nim' WHERE id = $id");
        
        if ($update_query) {
            echo "<div class='alert alert-success mt-3'>Data berhasil diperbarui.</div>  
                  <script> 
                    alert('Data Berhasil Diupdate');
                    window.location.href = 'index.php';
                  </script>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Gagal memperbarui data: " . mysqli_error($conn) . "</div>";
        }
    }
    ?>
    
    <form method="POST">
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($data['nama']); ?>" required>
        </div>
        
        <div class="mb-3">
            <label>NIM</label>
            <input type="text" name="nim" class="form-control" value="<?php echo htmlspecialchars($data['nim']); ?>" required>
        </div>
        
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>