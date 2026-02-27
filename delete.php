<?php
require 'functions.php';

$id = $_GET["id"];

if (delete($id) > 0) {
    echo "
        <script>
            alert('Data deleted');
            document.location.href = 'index.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Failed delete data!');
            document.location.href = 'index.php';
        </script>
    ";
}
?>
