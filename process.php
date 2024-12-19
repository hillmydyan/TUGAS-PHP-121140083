<?php
// Start session to pass data to result.php
session_start();

// Validasi bahwa form dikirim dengan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $gender = trim($_POST['gender']);
    $file = $_FILES['file'];

    $errors = [];

    // Validasi nama
    if (empty($name) || strlen($name) < 3 || strlen($name) > 50) {
        $errors[] = "Nama harus diisi dan panjangnya antara 3-50 karakter.";
    }

    // Validasi email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email tidak valid.";
    }

    // Validasi nomor telepon
    if (empty($phone) || !preg_match('/^[0-9]{10,15}$/', $phone)) {
        $errors[] = "Nomor telepon harus terdiri dari 10-15 digit angka.";
    }

    // Validasi jenis kelamin
    if (empty($gender)) {
        $errors[] = "Jenis kelamin harus dipilih.";
    }

    // Validasi file upload
        if ($file['error'] === 0) {
        $allowedTypes = ['text/plain'];
        $maxSize = 1024 * 1024; // 1MB

        if (!in_array($file['type'], $allowedTypes)) {
            $errors[] = "Hanya file teks (.txt) yang diperbolehkan.";
        }

        if ($file['size'] > $maxSize) {
            $errors[] = "Ukuran file tidak boleh lebih dari 1MB.";
        }
    } else {
        $errors[] = "File harus diunggah.";
    }

    if (empty($errors)) {
        // Baca isi file
        $fileContent = file_get_contents($file['tmp_name']);
        $lines = explode("\n", trim($fileContent));

        // Simpan data ke sesi
        $_SESSION['data'] = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'gender' => $gender,
            'browser' => $_SERVER['HTTP_USER_AGENT'],
            'fileContent' => $lines,
        ];

        // Redirect ke result.php
        header("Location: result.php");
        exit;
    } else {
        // Tampilkan error jika validasi gagal
        echo "<h3>Terjadi Kesalahan:</h3>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li style='color:red;'>$error</li>";
        }
        echo "</ul>";
        echo "<p><a href='form.php'>Kembali ke Formulir</a></p>";
    }
} else {
    header("Location: form.php");
    exit;
}
?>
