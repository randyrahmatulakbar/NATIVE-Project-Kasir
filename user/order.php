<?php
require '../functions.php';

foreach($_POST['jumlah'] as $id => $jumlah){

	if($jumlah > 0){

		$nama = $_POST['nama'][$id];
		$harga = $_POST['harga'][$id];

		// cek stock
		$data = mysqli_query($conn,"SELECT stock FROM makanan WHERE id = $id");
		$makanan = mysqli_fetch_assoc($data);

		if($jumlah > $makanan['stock']){

			echo "<script>
			alert('Stock $nama tidak cukup');
			document.location.href='user.php';
			</script>";
			exit;

		}

		$total = $harga * $jumlah;

		mysqli_query($conn,"
		INSERT INTO pesanan (id_makanan, nama, harga, jumlah, total)
		VALUES ('$id', '$nama', '$harga', '$jumlah', '$total')
		");

	}

}

header("Location: user.php");
exit;