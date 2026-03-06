<?php
require '../functions.php';
if(isset($_POST['bayar'])){

	$pesanan = mysqli_query($conn,"SELECT * FROM pesanan");

	while($row = mysqli_fetch_assoc($pesanan)){

		$nama = $row['nama'];
		$jumlah = $row['jumlah'];

		mysqli_query($conn,"
		UPDATE makanan 
		SET stock = stock - $jumlah
		WHERE nama = '$nama'
		");

	}

	mysqli_query($conn,"DELETE FROM pesanan");

	echo "<script>
	alert('Pembayaran berhasil');
	document.location.href='user.php';
	</script>";

}

$makanan = query("SELECT * FROM makanan");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pesan Makanan</title>
	<link rel="stylesheet" href="user.css">
</head>

<body>

	<div class="container">
		<div class="menu">
			<h2>Menu Makanan</h2>

			<div class="menu-grid">
				<?php foreach ($makanan as $row) : ?>

					<div class="card">
						<div class="foto">
							<img src="../img/<?= $row["gambar"]; ?>">
						</div>

						<div class="info">

							<div class="nama">
								<?= $row["nama"]; ?>
							</div>

							<div class="harga">
								Rp <?= $row["harga"]; ?>
							</div>

							<div class="beli">
								<form action="order.php" method="post">

									<input type="hidden" name="nama" value="<?= $row["nama"]; ?>">
									<input type="hidden" name="harga" value="<?= $row["harga"]; ?>">

									<input type="number" name="jumlah" placeholder="jumlah" required>

									<button type="submit">+</button>

								</form>
							</div>

						</div>

					</div>

				<?php endforeach; ?>

			</div>

		</div>

		<div class="pesanan">

	<h2>Pesanan</h2>

	<div class="list">

	<?php
	$pesanan = mysqli_query($conn,"SELECT * FROM pesanan");

	$total = 0;

	if(mysqli_num_rows($pesanan) == 0){
		echo "Belum ada pesanan";
	}else{
		while($row = mysqli_fetch_assoc($pesanan)){
	?>

	<div>
		<?= $row['nama']; ?> x<?= $row['jumlah']; ?> 
		Rp<?= $row['total']; ?>

		<a href="delete_order.php?id=<?= $row['id']; ?>">❌</a>
	</div>

	<?php
		$total += $row['total'];
		}
	}
	?>

	</div>

	<div class="total">
		Total : Rp <?php echo $total; ?>
	</div>

	<br>

	<form action="payment.php" method="post">

		Uang Pembeli
		<br>
		<input type="number" name="uang">

		<input type="hidden" name="total" value="<?= $total; ?>">

		<br><br>

		<button class="pay" name="bayar">Bayar</button>

	</form>

	<?php

	?>

</div>

	</div>

</body>
</html>