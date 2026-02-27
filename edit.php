<?php
require 'functions.php';

$id = $_GET["id"];

$mkn = query("SELECT * FROM makanan WHERE id = $id")[0]; 

if (isset($_POST["submit"])) {

    if(edit($_POST) > 0 ){
    echo"
    <script>
    alert('Data edited');
    document.location.href = 'index.php';
    </script>";
    }else {
    echo"
    <script>
    alert('Failed edit data!');
    document.location.href = 'index.php';
    </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Ubah data</title>
    <link rel="stylesheet" href="main.css">

</head>
<body>
    
    <div class="center">
    <h1>Ubah data makanan</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $mkn["id"]; ?>">
            <ul>
                <li>
                    <label for="nama">Nama : </label>
                    <input type="text" name="nama" id="nama" value="<?= $mkn["nama"]; ?>" placeholder="<?= $mkn["nama"]; ?>" required>
                </li>
                
                <li>
                    <input type="hidden" name="gambarLama" value="<?= $mkn["gambar"]; ?>">
                </li>
                <li>
                    <label>Gambar :</label>
                    <br><img src="img/<?= $mkn["gambar"]; ?>" width="80"><br>
                    <input type="file" name="gambar">
                </li>

                <li>
                    <label for="harga">Harga : </label>
                    <input type="text" name="harga" id="harga" value="<?= $mkn["harga"]; ?>" placeholder="<?= $mkn["harga"]; ?>" required>
                </li>
                
                <li>
                    <label for="stock">Stock : </label>
                    <input type="text" name="stock" id="stock" value="<?= $mkn["stock"]; ?>" placeholder="<?= $mkn["stock"]; ?>" required>
                </li>

                <li>
                    <button type="submit" name="submit"> Edit </button>
                </li>
            </ul>
        </form>
    </div>

</body>
</html>