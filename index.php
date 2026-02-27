<?php
require 'functions.php';
$kasir = query("SELECT * FROM makanan")
?>

<html>
<head>

    <title>Halaman Admin</title>
    <link rel="stylesheet" href="main.css">

</head>
<body>
    <h1>Daftar Menu</h1>

    
    <table border= "1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>nama</th>
            <th>Gambar</th>
            <th>harga</th>
            <th>stock</th>
            <th>action</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($kasir as $row) : ?>
            
            <tr>
                <td><?= $i; ?></td>
                <td><?= $row["nama"]; ?></td>
                
                <td> <img src="img/<?= $row["gambar"]; ?>" width="70" class="img"> </td>
                
                <td>Rp <?= $row["harga"]; ?></td>
                <td><?= $row["stock"]; ?></td>
                
                <td>
                    <a href="edit.php?id=<?= $row["id"]; ?>">Edit</a>

                <a href="delete.php?id=<?= $row["id"]; ?>"
                class="delete"
                onclick="return confirm('Confirm?');">
                delete</a>
            </td>
            
        </tr>
        
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
        
        <br><br>
        <a href="add.php" id="add">Add data</a>
</body>
</html>