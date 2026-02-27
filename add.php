<?php
require 'functions.php';

if ( isset($_POST["submit"])) {
    if(add($_POST) > 0 ){
        echo "
        <script>
        alert('Added data');
        document.location.href = 'index.php';
        </script>
        ";

    }else {
        echo "
        <script>
        alert('Failed added data!');
        document.location.href = 'add.php';
        </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    
    <title>tambah data</title>
    <link rel="stylesheet" href="main.css">

</head>
<body>
    
    <div class="center">
        <h1>Tambah data makanan</h1>

        <form action="" method="post" enctype="multipart/form-data">

            <ul>
                <li>
                    <label for="nama">Nama : </label>
                    <input type="text" name="nama" id="nama" placeholder="Nama Makanan" required>
                </li>
                
                <li>
                    <label>Gambar :</label>
                    <input type="file" name="gambar" required>
                </li>
                
                <li>
                    <label for="harga" >Harga : </label>
                    <input type="text" name="harga" id="harga" placeholder="Rp" required >
                </li>
                
                <li>
                    <label for="stock">Stock : </label>
                    <input type="text" name="stock" id="stock" placeholder="Jumlah" required>
                </li>

                <li>
                    <button type="submit" name="submit"> Add </button>
                </li>
            </ul>
        </form>
        
        <br>

        <a href="index.php">Back</a>

    </div>
</body>
</html>