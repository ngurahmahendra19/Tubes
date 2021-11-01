<?php
    if(isset($_POST['btnRegister'])){
      
        include('../db.php');
        require('../mail.php');

        $query = mysqli_query($con,
            "INSERT INTO users(username, password, nama, email, alamat, telp, active, hash)
                VALUES
            ('$username', '$password', '$nama', '$email', '$alamat', '$telp', 0, '$hash')")
                or die(mysqli_error($con)); 

        if($query){
            echo
                '<script>
                alert("Register Success"); window.location = "../login.php"
                </script>';
        }else{
            echo
                '<script>
                alert("Register Failed");
                </script>';
        }

    }else{
        echo
        '<script>
        window.history.back()
        </script>';
    }
?>