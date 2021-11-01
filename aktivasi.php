<?php
    require('db.php');

    if(isset($_GET['hash'])){
        $hash = $_GET['hash'];
        $sql = "SELECT * FROM users where hash = '$hash'";
        $query = mysqli_query($con,$sql);
        if(mysqli_num_rows($query) > 0){
            $user = mysqli_fetch_assoc($query);
            $id = $user['id'];
            $sql =  "UPDATE users set active=1 where id=$id";
            $query = mysqli_query($con,$sql);
            if($query){
                echo "<script>
                    alert('verifikasi berhasil');
                    window.location='login.php';
                </script>";
            }else{
                echo "VERIFIKASI GAGAL ERROR : ".$query;
            }
        }else {
            echo "CODE TIDAK DITEMUKAN ATAU TIDAK VALID";
        }
    }else {
        echo "";
        
    }
?>