<?php
require '../functions.php';

if(pesan($_POST) > 0){

    echo "
    <script>
    alert('Pesanan berhasil');
    document.location.href='user.php';
    </script>
    ";

}else{

    echo "
    <script>
    alert('Pesanan gagal');
    document.location.href='user.php';
    </script>
    ";

}
?>
