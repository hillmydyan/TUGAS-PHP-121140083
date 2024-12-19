<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.js"></script>
    <title>Form Pendaftaran</title>
</head>
<body>
    <div class="container">
        <h2>Form Pendaftaran</h2>
        <form id="registrationForm" action="process.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="phone" class="col-sm-2 col-form-label">Nomor Telepon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="phone" name="phone" required pattern="[0-9]{10,15}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="gender" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <select id="gender" name="gender" class="form-select" required>
                        <option value="">Pilih</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Unggah File (Teks)</label>
                <input class="form-control form-control-sm" id="file" type="file" name="file" accept=".txt" required>
            </div>

            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
    </div>

    <script>
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            const fileInput = document.getElementById('file');
            const file = fileInput.files[0];

            if (file) {
                const allowedTypes = ['text/plain'];
                const maxSize = 1024 * 1024; // 1MB

                if (!allowedTypes.includes(file.type)) {
                    alert('Hanya file teks yang diperbolehkan.');
                    event.preventDefault();
                    return;
                }

                if (file.size > maxSize) {
                    alert('Ukuran file tidak boleh lebih dari 1MB.');
                    event.preventDefault();
                    return;
                }
            } else {
                alert('File harus diunggah.');
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
