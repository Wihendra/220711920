function fn_ValForm() {
    // 1. Inisialisasi variabel penampung pesan error & data input
    var sMsg = "";
    
    var nama = document.getElementById("nama").value.trim();
    var email = document.getElementById("email").value.trim();
    var umur = document.getElementById("umur").value.trim();
    var kategori = document.getElementById("kategori").value;

    // Ketentuan b: Validasi dasar tidak boleh kosong
    if (nama === "") {
        sMsg += "\n* Nama tidak boleh kosong";
    }

    if (email === "") {
        sMsg += "\n* Email tidak boleh kosong";
    } else {
        // Ketentuan c: Validasi format email menggunakan Regular Expression (hanya huruf kecil)
        var emailPattern = /^[a-z0-9][a-z0-9_\.\-]{0,}[a-z0-9]@[a-z0-9][a-z0-9_\.\-]{0,}[a-z0-9][\.]?[a-z0-9]{2,4}$/;
        if (!emailPattern.test(email)) {
            sMsg += "\n* Format email tidak valid (harus menggunakan huruf kecil & pola benar)";
        }
    }

    if (umur === "") {
        sMsg += "\n* Umur tidak boleh kosong";
    } else {
        // Ketentuan d: Validasi umur harus berupa angka dan berada di antara 10 sampai 18 tahun
        var angkaUmur = Number(umur);
        if (isNaN(angkaUmur) || angkaUmur < 10 || angkaUmur > 18) {
            sMsg += "\n* Umur harus berupa angka dan berada di antara 10 sampai 18 tahun";
        }
    }

    if (kategori === "") {
        sMsg += "\n* Pilihan lomba tidak boleh kosong";
    }

    // Ketentuan b.i & b.ii: Jika ada kesalahan, tampilkan semua error dalam satu alert dan gagalkan submit
    if (sMsg !== "") {
        alert("Peringatan:" + sMsg);
        return false;
    }

    // --- JIKA SEMUA ISIAN VALID ---
    
    // Ketentuan d.i & d.ii: Logika penentuan info kategori berdasarkan batasan umur
    var info = "";
    var angkaUmurValid = Number(umur);
    if (angkaUmurValid <= 14) {
        info = "Kategori Junior";
    } else if (angkaUmurValid > 14) {
        info = "Kategori Senior";
    }

    // Ketentuan e: Switch-case untuk menentukan nama pilihan berdasarkan kode lomba
    var pilihan = "";
    switch (kategori) {
        case "C":
            pilihan = "Cerdas Cermat";
            break;
        case "P":
            pilihan = "Puisi";
            break;
        case "D":
            pilihan = "Design poster";
            break;
        default:
            pilihan = "Tidak diketahui";
    }

    // Ketentuan f: Tampilkan alert sukses apabila data dinyatakan valid sepenuhnya
    alert("Terima kasih " + nama + " ! Anda terdaftar di lomba " + pilihan + " [" + info + "].");
    return true;
}
