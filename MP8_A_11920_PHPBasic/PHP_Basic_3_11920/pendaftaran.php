<h2>Pendaftaran Membership</h2>

<form method="POST" action="">
    <p>Nama : <br /><input type="text" name="nama" value="<?php echo htmlspecialchars($_POST['nama'] ?? ''); ?>" /></p>
    <p>NPM : <br /><input type="text" name="npm" value="<?php echo htmlspecialchars($_POST['npm'] ?? ''); ?>" /></p>
    <p>Paket Membership : <br />
        <select name="paket">
            <option value="">-- Pilih Paket --</option>
            <option value="1 bulan" <?php echo (($_POST['paket'] ?? '') === '1 bulan') ? 'selected' : ''; ?>>1 bulan</option>
            <option value="3 bulan" <?php echo (($_POST['paket'] ?? '') === '3 bulan') ? 'selected' : ''; ?>>3 bulan</option>
        </select>
    </p>
    <button type="submit" name="submit_pendaftaran">Kirim</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $npm = $_POST['npm'] ?? '';
    $paket = $_POST['paket'] ?? '';
    $errors = array();

    if (empty($nama) || empty($npm) || empty($paket)) {
        $errors[] = "Nama, NPM, dan Paket tidak boleh kosong.";
    } else {

        if (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
            $errors[] = "Nama hanya boleh mengandung huruf dan spasi.";
        }

        if (!preg_match("/^[0-9]*$/", $npm)) {
            $errors[] = "NPM hanya boleh mengandung angka.";
        }
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>! " . htmlspecialchars($error) . " !</p>";
        }
    } else {

        $benefit = "";
        if ($paket === "1 bulan") {
            $benefit = "Potongan 50% untuk pembelian produk tertentu.";
        } else if ($paket === "3 bulan") {
            $benefit = "Gratis cemilan hewan peliharaan untuk 3 bulan pertama.";
        }

        echo "<h3>Informasi Pendaftaran</h3>";
        echo "<p>Nama: " . htmlspecialchars($nama) . "</p>";
        echo "<p>NPM: " . htmlspecialchars($npm) . "</p>";
        echo "<p>Paket Membership: " . htmlspecialchars($paket) . "</p>";
        echo "<p>Keuntungan: " . htmlspecialchars($benefit) . "</p>";
        echo "<p style='color:green;'>Selamat! Anda telah berhasil mendaftar sebagai member dengan benefit: " . htmlspecialchars($benefit) . "</p>";
    }
} else {
    echo "<p>Silahkan lengkapi formulir di atas.</p>";
}
?>
