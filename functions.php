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
        echo "<script>alert('File harus gambar!');</script>";
        return false;
    }

    if ($ukuranFile > 2000000) {
        echo "<script>alert('Ukuran terlalu besar!');</script>";
        return false;
    }

    $namaBaru = uniqid();
    $namaBaru .= '.' . $ekstensi;

    move_uploaded_file($tmpName, 'img/' . $namaBaru);

    return $namaBaru;
}


?>