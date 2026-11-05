<h2>Belanja</h2>
<h3>Daftar Kategori:</h3>

<form method="POST" action="">
    <p>Makanan dan Minuman : <br />
        <select name="makanan_minuman">
            <option value="">-- Pilih --</option>
            <option value="daging kaleng" <?php echo (($_POST['makanan_minuman'] ?? '') === 'daging kaleng') ? 'selected' : ''; ?>>daging kaleng</option>
            <option value="susu" <?php echo (($_POST['makanan_minuman'] ?? '') === 'susu') ? 'selected' : ''; ?>>susu</option>
        </select>
    </p>
    <p>Aksesoris : <br />
        <select name="aksesoris">
            <option value="">-- Pilih --</option>
            <option value="kalung" <?php echo (($_POST['aksesoris'] ?? '') === 'kalung') ? 'selected' : ''; ?>>kalung</option>
            <option value="pakaian" <?php echo (($_POST['aksesoris'] ?? '') === 'pakaian') ? 'selected' : ''; ?>>pakaian</option>
        </select>
    </p>
    <button type="submit" name="submit_belanja">Kirim</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $makanan_minuman = $_POST['makanan_minuman'] ?? '';
    $aksesoris = $_POST['aksesoris'] ?? '';
    $error_belanja = "";

    if (empty($makanan_minuman) || empty($aksesoris)) {
        $error_belanja = "Makanan dan minuman serta aksesoris tidak boleh kosong.";
    }

    if (!empty($error_belanja)) {
        echo "<p style='color:red;'>! " . htmlspecialchars($error_belanja) . " !</p>";
    } else {

        $harga_makmin = 0;
        if ($makanan_minuman === "daging kaleng") {
            $harga_makmin = 10000;
        } else if ($makanan_minuman === "susu") {
            $harga_makmin = 15000;
        }

        $harga_aksesoris = 0;
        if ($aksesoris === "kalung") {
            $harga_aksesoris = 50000;
        } else if ($aksesoris === "pakaian") {
            $harga_aksesoris = 100000;
        }

        $totalBayar = $harga_makmin + $harga_aksesoris;

        function dapatDiskon($totalBayar) {
            if ($totalBayar >= 100000) {
                return 0.10;
            } else {
                return 0;
            }
        }

        function totalHarga($diskon, $totalBayar) {
            return $totalBayar - ($totalBayar * $diskon);
        }

        $diskon = dapatDiskon($totalBayar);
        $totalAkhir = totalHarga($diskon, $totalBayar);

        echo "<h3>Informasi Belanja</h3>";
        echo "<p>Makanan dan Minuman: " . htmlspecialchars($makanan_minuman) . " (Rp " . number_format($harga_makmin, 0, ',', '.') . ")</p>";
        echo "<p>Aksesoris: " . htmlspecialchars($aksesoris) . " (Rp " . number_format($harga_aksesoris, 0, ',', '.') . ")</p>";
        echo "<p>Total Awal: Rp " . number_format($totalBayar, 0, ',', '.') . "</p>";
        echo "<p>Diskon: " . ($diskon * 100) . "%</p>";
        echo "<p><strong>Total Harga: Rp " . number_format($totalAkhir, 0, ',', '.') . "</strong></p>";

        if ($diskon == 0) {
            echo "<p>Maaf tidak ada diskon yang diberikan.</p>";
        } else {
            echo "<p style='color:green;'>Selamat! Anda mendapatkan diskon " . htmlspecialchars($diskon * 100) . "%.</p>";
        }
    }
} else {
    echo "<p>Silahkan pilih produk yang ingin dibeli.</p>";
}
?>
