<?php 

if(isset($_POST['btn-beli'])){
    include('../db.php');

    $user = $_POST['user'];
    $item = $_POST['nama'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];

    $subtotal = $harga * $jumlah;
    $query = mysqli_query($con, "INSERT INTO items VALUES('', '$item', $harga, $jumlah, $subtotal, $user, 'Belum')");

    if($query){
        echo "<script>
            alert('Berhasil memasukan ke keranjang!');
            window.location = '../dashboard.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal!');
            window.location = '../dashboard.php';
        </script>";
    }
}

?>