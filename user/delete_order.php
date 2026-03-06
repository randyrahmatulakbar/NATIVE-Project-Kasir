<?php
require '../functions.php';

$id = $_GET['id'];

// ambil data pesanan
$data = mysqli_query($conn,"SELECT * FROM pesanan WHERE id = $id");
$row = mysqli_fetch_assoc($data);

$nama = $row['nama'];
$jumlah = $row['jumlah'];

// kembalikan stock
mysqli_query($conn,"
UPDATE makanan 
SET stock = stock + $jumlah 
WHERE nama = '$nama'
");

// hapus pesanan
mysqli_query($conn,"DELETE FROM pesanan WHERE id = $id");

header("Location: user.php");
?>