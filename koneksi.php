<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "bioskop";
$conn = mysqli_connect($host,$user,$pass,$db);
if ($conn == false)
{
 echo "Koneksi ke server gagal.";
 die();
} #else echo "Koneksi berhasil";
?>
<?php 
include("koneksi.php"); 
 
// query untuk menampilkan data 
$sql = 'SELECT * FROM data_barang'; 
$result = mysqli_query($conn, $sql); 

?> 
<!DOCTYPE html> 
<html lang="en"> 
<head>
    <meta charset="UTF-8">     
    <link href="style.css" rel="stylesheet" type="text/css" />     
    <title>Data Barang</title> 
</head> 
<body>     
    <div class="container">         
        <h1>Data Barang</h1>         
        <div class="main">             
            <table>             
                <tr>                 
                    <th>Gambar</th>                 
                    <th>Nama Barang</th>                 
                    <th>Katagori</th>                 
                    <th>Harga Jual</th>                 
                    <th>Harga Beli</th>                 
                    <th>Stok</th>                 
                    <th>Aksi</th>             
                 </tr>            
                 <?php if($result): ?>             
                 <?php while($row = mysqli_fetch_array($result)): ?>             
                 <tr>                 
                     <td><img src="gambar/<?= $row['gambar'];?>" alt="<?= $row['nama'];?>"></td>                 
                        <td><?= $row['nama'];?></td>                 
                        <td><?= $row['kategori'];?></td>                 
                        <td><?= $row['harga_beli'];?></td>                 
                        <td><?= $row['harga_jual'];?></td>                 
                        <td><?= $row['stok'];?></td>                 
                        <td><?= $row['id_barang'];?></td>             
                </tr>             
                <?php endwhile; else: ?>             
                <tr>                 
                    <td colspan="7">Belum ada data</td>             
                </tr>             
                <?php endif; ?>             
            </table>         
        </div>     
    </div> 
</body> 
</html>
<?php 
error_reporting(E_ALL); 
include_once 'koneksi.php'; 
 
if (isset($_POST['submit'])) 
{     
    $nama = $_POST['nama'];     
    $kategori = $_POST['kategori'];     
    $harga_jual = $_POST['harga_jual'];     
    $harga_beli = $_POST['harga_beli'];     
    $stok = $_POST['stok'];     
    $file_gambar = $_FILES['file_gambar'];     
    $gambar = null;     
    if ($file_gambar['error'] == 0)     
    {         
        $filename = str_replace(' ', '_',$file_gambar['name']);         
        $destination = dirname(__FILE__) .'/gambar/' . $filename;         
        if(move_uploaded_file($file_gambar['tmp_name'], $destination))         
        {             
            $gambar = 'gambar/' . $filename;;         
        }     
    }     
    $sql = 'INSERT INTO data_barang (nama, kategori,harga_jual, harga_beli, stok, gambar) ';     
    $sql .= "VALUE ('{$nama}', '{$kategori}','{$harga_jual}', '{$harga_beli}', '{$stok}', '{$gambar}')";     
    $result = mysqli_query($conn, $sql);     
    header('location: index.php'); }