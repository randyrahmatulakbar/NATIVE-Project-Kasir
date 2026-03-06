<?php
require '../functions.php';

$total = $_POST["total"];
$uang = $_POST["uang"];

if($uang < $total){

	echo "
	<script>
	alert('Uang tidak cukup!');
	document.location.href='user.php';
	</script>
	";

}else{

	$kembalian = $uang - $total;

	mysqli_query($conn,"DELETE FROM pesanan");

	echo "
	<script>
	alert('Pembayaran berhasil! Kembalian: Rp $kembalian');
	document.location.href='user.php';
	</script>
	";

}
?>