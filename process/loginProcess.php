<?php
    if(isset($_POST['login'])){

        include('../db.php');
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $query = mysqli_query($con, "SELECT * FROM users WHERE username = '$username' AND active='1' ") or die(mysqli_error($con));
        
        if(mysqli_num_rows($query) == 0){
            echo
            '<script>
            alert("Verifikasi email terlebih dahulu"); window.location = "../login.php"
            </script>';
        }else {
            $user = mysqli_fetch_assoc($query);
            if(password_verify($password, $user['password'])){      
                $_SESSION['isLogin'] = true;
                $_SESSION['username'] = $username;

                echo
                '<script>
                alert("Login Success"); window.location = "../dashboard.php";
                </script>';
            }else {
                echo
                '<script>
                alert("Username or Password Invalid");
                window.location = "../login.php"
                </script>';
            }
        }
    }else{
        echo
        '<script>
        window.history.back()
        </script>';
    }
?>