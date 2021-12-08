 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="css/buka.css">
     <title>Website Cek Vaksinasi</title>
 </head>

 <body>
     <div class="page">
         <div class="container">
             <form class="logout" action="admin.php">
                 <button class="btn btn-danger" type="submit">Back</button>
             </form>
             <?php
                include 'koneksi.php';
                include 'enkripsi.php';
                if (isset($_GET['nik'])) {
                    $nik = $_GET['nik'];
                    $sql = mysqli_query($konek, "SELECT * FROM user where NIK = '$nik'");
                    $data = mysqli_fetch_array($sql);
                    $data['Alamat'] = openssl_decrypt($data['Alamat'], $algoritma, $kunci, 0, $IV);
                    $data['jenis_kelamin'] = openssl_decrypt($data['jenis_kelamin'], $algoritma, $kunci, 0, $IV);
                    $data['tgl_lahir'] = openssl_decrypt($data['tgl_lahir'], $algoritma, $kunci, 0, $IV);
                }
                ?>
             <h5><?php echo $nik; ?></h5>
             <div class="form">
                 <form action="editdata.php" method="POST" class="login-form" onSubmit="return validasi1()">
                     <input type="text" name="nik" value="<?php echo $nik ?>" id="" hidden>
                     <input type="text" placeholder="<?php echo $data['nama']; ?>" value="<?php echo $data['nama']; ?>" disabled>
                     <input type="text" placeholder="<?php echo $data['Alamat']; ?>" value="<?php echo $data['Alamat']; ?>" disabled>
                     <input type="text" placeholder="<?php echo $data['tgl_lahir']; ?>" value="<?php echo $data['tgl_lahir']; ?>" disabled>
                     <input type="text" placeholder="<?php echo $data['jenis_kelamin']; ?>" value="<?php echo $data['jenis_kelamin']; ?>" disabled>
                     <select name="status">
                         <option value="Tahap-1">Tahap-1</option>
                         <option value="Tahap-2">Tahap-2</option>
                     </select>
                     <button class="btn btn-primary" type="submit">Simpan</button>
                 </form>
             </div>
         </div>
     </div>
 </body>

 </html>
 <script type="text/javascript">
     function validasi1() {
         var cek = confirm("Apakah data sudah benar?");
         if (cek) {
             return true;
         } else {
             return false;
         }
     }
 </script>