<?php
session_start();
if (!isset($_SESSION['data'])) {
    header("Location: form.php");
    exit;
}

$data = $_SESSION['data'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Hasil Pendaftaran</title>
</head>
<body>
    <div class="container">
        <h2>Hasil Pendaftaran</h2>
        <table class="table table-bordered">
            <tr>
                <th>Nama Lengkap</th>
                <td><?= htmlspecialchars($data['name']) ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= htmlspecialchars($data['email']) ?></td>
            </tr>
            <tr>
                <th>Nomor Telepon</th>
                <td><?= htmlspecialchars($data['phone']) ?></td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td><?= htmlspecialchars($data['gender']) ?></td>
            </tr>
            <tr>
                <th>Browser</th>
                <td><?= htmlspecialchars($data['browser']) ?></td>
            </tr>
        </table>

        <h3>Isi File yang Diupload</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Isi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['fileContent'] as $index => $line): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($line) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
