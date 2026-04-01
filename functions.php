<?php
//konek database
$conn = mysqli_connect("localhost", "root", "", "kasir");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function add($data){

    global $conn;

    $harga = htmlspecialchars($data["harga"]);
    $nama = htmlspecialchars($data["nama"]);
    $stock = htmlspecialchars($data["stock"]);

    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO makanan (harga, nama, stock, gambar)
              VALUES ('$harga', '$nama', '$stock', '$gambar')";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function delete($id){

    global $conn;
    mysqli_query($conn, "DELETE FROM makanan WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function edit($data){

    global $conn;

    $id = $data["id"];
    $harga = htmlspecialchars($data["harga"]);
    $nama = htmlspecialchars($data["nama"]);
    $stock = htmlspecialchars($data["stock"]);
    $gambarLama = $data["gambarLama"];

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE makanan SET
        harga = '$harga',
        nama = '$nama',
        stock = '$stock',
        gambar = '$gambar'
        WHERE id = $id
    ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function upload(){

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ($error === 4) {
        return false;
    }

    $ekstensiValid = ['jpg','jpeg','png','webp'];
    $ekstensi = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION)); 

    if (!in_array($ekstensi, $ekstensiValid)) {
        echo "<script>alert('File must be an image');</script>";
        return false;
    }

    if ($ukuranFile > 2000000) {
        echo "<script>alert('File size is too big');</script>";
        return false;
    }

    $namaBaru = uniqid();
    $namaBaru .= '.' . $ekstensi;

    move_uploaded_file($tmpName, 'img/' . $namaBaru);

    return $namaBaru;
}

function pesan($data){
	global $conn;

	$nama = htmlspecialchars($data["nama"]);
	$harga = htmlspecialchars($data["harga"]);
	$jumlah = htmlspecialchars($data["jumlah"]);

	// cek stock makanan
	$makanan = query("SELECT * FROM makanan WHERE nama='$nama'")[0];
	$stock = $makanan["stock"];

	if($jumlah > $stock){
		echo "
		<script>
		alert('Stock tidak cukup');
		document.location.href='user.php';
		</script>
		";
		exit;
	}

	$total = $harga * $jumlah;

	$query = "INSERT INTO pesanan (nama, harga, jumlah, total)
			  VALUES ('$nama','$harga','$jumlah','$total')";

	mysqli_query($conn,$query);

	// kurangi stock
	$sisa = $stock - $jumlah;
	mysqli_query($conn,"UPDATE makanan SET stock=$sisa WHERE nama='$nama'");

	return mysqli_affected_rows($conn);
}

?>