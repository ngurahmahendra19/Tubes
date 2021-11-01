<?php 

if( isset($_POST['btn-bayar']) ){
    include('../db.php');

    $user = $_POST['user'];
    $uang = $_POST['uang'];
    $total = $_POST['total'];

    if($uang >= $total){
        $query = mysqli_query($con, "UPDATE items SET status = 'Lunas' WHERE idUser = $user");

        if($query){
            echo "<script>
                alert('Berhasil!');
                window.location = '../keranjang.php';
            </script>";
        } else {
            echo "<script>
                alert('Gagal!');
                window.location = '../keranjang.php';
            </script>";
        }
    } else {
        echo "<script>alert('Uang anda tidak cukup!'); window.location='../keranjang.php';</script>";
    }
}

?>