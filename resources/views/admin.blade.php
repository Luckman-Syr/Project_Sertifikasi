<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/admin.css">
    <title>Website Cek Vaksinasi</title>
</head>

<body>
    <div class="page">
        <div class="container">
            <form class="logout" action="logout.php" onSubmit="return validasi()">
                <button class="btn btn-danger" type="submit">Logout</button>
            </form>
            <h5>Vaksinasi 2021</h5>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <form action="admin.php" method="POST">
                        <div class="input-group">
                            <!-- Buat sebuah textbox dan beri id keyword -->
                            <input type="text" class="form-control" placeholder="Pencarian..." name="keyword" id="keyword">
                            <span class="input-group-btn">
                                <!-- Buat sebuah tombol search dan beri id btn-search -->
                                <button class="btn" style="background-color: indianred; color: white;" type="submit" id="btn-search">SEARCH</button>
                                <a href="" class="btn btn-warning">RESET</a>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th class="text-center">NO</th>
                            <th>NIK</th>
                            <th>NAMA</th>
                            <th>STATUS</th>
                            <th>BUKA DATA</th>
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
                            $no = 1;
                            while ($data = mysqli_fetch_array($sql)) {
                        ?>
                                <tr>
                                    <td class="align-middle text-center"><?php echo $no; ?></td>
                                    <td class="align-middle"><?php echo $data['NIK']; ?></td>
                                    <?php
                                    $nama = $data['nama'];
                                    $nama = substr($nama, 0, 10);
                                    $nama = $nama . "*****";
                                    ?>
                                    <td class="align-middle"><?php echo $nama ?></td>
                                    <td class="align-middle"><?php echo $data['status']; ?></td>
                                    <td>
                                        <?php
                                        include 'enkripsi.php';
                                        $pass = openssl_encrypt($data['NIK'], $algoritma, $kunci, 0, $IV);
                                        ?>
                                        <input type="text" value="<?php echo $pass ?>" id="pass" hidden>
                                        <form action="buka.php?nik=<?php echo $data['NIK'] ?>" method="POST" onSubmit="return validasiPass()">
                                            <button type="submit" class="btn" style="background-color: #358fe8;color: white;">BUKA</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                        } else { // Jika user belum mengklik tombol search
                            // Buat query untuk menampilkan semua data siswa
                            ?>
                            <div class="kosong" style="padding: 20px;">
                                <h4>Silahkan Lakukan Pencarian Data</h4>
                            </div>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script type="text/javascript">
    function validasi() {
        if (confirm("Yakin Keluar?")) {
            return true;
        } else {
            return false;
        }
    }
</script>

<script type="text/javascript">
    function validasiPass() {
        var pass = document.getElementById("pass").value;
        var cek = prompt("Masukkan Password (*" + pass + ")");
        if (cek == pass) {
            return true;
        } else {
            return false;
        }
    }
</script>