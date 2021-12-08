<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th class="text-center">NO</th>
            <th>NIK</th>
            <th>NAMA</th>
            <th>JENIS KELAMIN</th>
            <th>TANGGAL LAHIR</th>
            <th>ALAMAT</th>
            <th>STATUS</th>
            <th>UBAH STATUS</th>
        </tr>
        <?php
        // Include / load file koneksi.php
        include "koneksi.php";

        // Cek apakah variabel $keyword tersedia
        // Artinya cek apakah user telah mengklik tombol search atau belum
        // variabel $keyword ini berasal dari file search.php,
        // dimana isinya adalah apa yang diinput oleh user pada textbox pencarian
        if (isset($_POST['keyword'])) { // Jika veriabel $keyword ada (user telah mengklik tombol search)
            $keyword = $_POST['keyword'];
            $sql = mysqli_query($konek, "SELECT * FROM user where NIK = '$keyword'");
        } else { // Jika user belum mengklik tombol search
            // Buat query untuk menampilkan semua data siswa
            $sql = mysqli_query($konek, "SELECT * FROM user");
        }

        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        while ($data = mysqli_fetch_array($sql)) { // Ambil semua data dari hasil eksekusi $sql
        ?>
            <tr>
                <td class="align-middle text-center"><?php echo $no; ?></td>
                <td class="align-middle"><?php echo $data['NIK']; ?></td>
                <td class="align-middle"><?php echo $data['nama']; ?></td>
                <td class="align-middle"><?php echo $data['jenis_kelamin']; ?></td>
                <td class="align-middle"><?php echo $data['tgl_lahir']; ?></td>
                <td class="align-middle"><?php echo $data['Alamat']; ?></td>
                <td class="align-middle"><?php echo $data['status']; ?></td>
                <td class="align-middle">
                    <span>
                        <select name="status">
                            <option value="Tahap-1">Tahap-1</option>
                            <option value="Tahap-2">Tahap-2</option>
                        </select>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </span>
                </td>
            </tr>
        <?php
            $no++; // Tambah 1 setiap kali looping
        }
        ?>
    </table>
</div>