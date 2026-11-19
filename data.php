
<?php

// Function untuk memproses data mahasiswa
function simpanMahasiswa($nama, $umur, $jurusan) {
    return [
        "nama" => htmlspecialchars($nama),
        "umur" => htmlspecialchars($umur),
        "jurusan" => htmlspecialchars($jurusan)
    ];
}

// Function untuk menampilkan hasil data mahasiswa
function tampilkanMahasiswa($data) {
    echo "<div class='hasil'>";
    echo "<h3>✓ Data Berhasil Disimpan!</h3>";
    echo "<p><b>Nama Lengkap:</b> " . $data['nama'] . "</p>";
    echo "<p><b>Umur:</b> " . $data['umur'] . " Tahun</p>";
    echo "<p><b>Jurusan:</b> " . $data['jurusan'] . "</p>";
    echo "</div>";
}

// Function untuk memvalidasi input
function validasiData($nama, $umur, $jurusan) {
    if (empty(trim($nama)) || empty($umur) || empty($jurusan)) {
        return false;
    }

    if (!is_numeric($umur) || $umur < 1 || $umur > 120) {
        return false;
    }

    return true;
}

// Proses form
$hasil = null;
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama = $_POST['nama'] ?? "";
    $umur = $_POST['umur'] ?? "";
    $jurusan = $_POST['jurusan'] ?? "";

    if (validasiData($nama, $umur, $jurusan)) {
        $hasil = simpanMahasiswa($nama, $umur, $jurusan);
    } else {
        $error = "Mohon isi semua data dengan benar!";
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Form Data Mahasiswa</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            margin: 0;
            padding: 40px 20px;
        }

        .container {
            max-width: 450px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            color: #6654c5;
        }

        .deskripsi {
            text-align: center;
            color: #777;
        }

        label {
            display: block;
            margin-top: 18px;
            margin-bottom: 8px;
            font-weight: bold;
            color: #444;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 14px;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #667eea;
        }

        button {
            width: 100%;
            padding: 13px;
            margin-top: 25px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.85;
        }

        .hasil {
            margin-top: 25px;
            padding: 15px;
            background: #e9f9ef;
            border-left: 5px solid #28a745;
            border-radius: 8px;
        }

        .hasil h3 {
            color: #218838;
        }

        .hasil p {
            color: #333;
        }

        .error {
            margin-top: 20px;
            padding: 12px;
            background: #ffe5e5;
            color: #d62828;
            border-radius: 8px;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>🎓 Form Data Mahasiswa</h2>

    <p class="deskripsi">
        Silakan isi data mahasiswa di bawah ini
    </p>

    <form method="POST">

        <label>Nama Lengkap</label>
        <input type="text"
               name="nama"
               placeholder="Masukkan nama lengkap"
               required>

        <label>Umur</label>
        <input type="number"
               name="umur"
               placeholder="Masukkan umur"
               min="1"
               max="120"
               required>

        <label>Jurusan</label>
        <select name="jurusan" required>
            <option value="">-- Pilih Jurusan --</option>
            <option value="Teknik Informatika">Teknik Informatika</option>
            <option value="Sistem Informasi">Sistem Informasi</option>
            <option value="Manajemen">Manajemen</option>
            <option value="Akuntansi">Akuntansi</option>
            <option value="Ilmu Komunikasi">Ilmu Komunikasi</option>
            <option value="Hukum">Hukum</option>
        </select>

        <button type="submit">
            💾 Simpan Data
        </button>

    </form>

    <?php
    // Memanggil function untuk menampilkan data
    if ($hasil !== null) {
        tampilkanMahasiswa($hasil);
    }

    // Menampilkan pesan error
    if ($error != "") {
        echo "<div class='error'>$error</div>";
    }
    ?>

</div>

</body>
</html>