<?php

include('db.php');

if( !isset($_SESSION['username']) ){
    header("Location: login.php");
}

$username = $_SESSION['username'];
$select_user = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
$row = mysqli_fetch_assoc($select_user);

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">  
    <title>Keranjang</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Georgia;
            background-color: whitesmoke;
        }

        #app {
            display: flex;
            max-width: 100%;
            min-height: 100vh;
        }

        #app .sidebar {
            background-color: #752BEA;
            transition: margin-left .5s ease-out;
            min-width: 250px;
        }

        #app .sidebar-hide {
            margin-left: -250px;
        }

        #app .sidebar .header {
            background-color: #752BEA;
            text-align: center;
            padding: 32px 8px;
        }

        #app .sidebar .header .brand {
            font-family: 'Segoe UI';
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            font-size: 32px;
        }

        #app .sidebar .sidebar .header .brand span {
            color: rgba(255, 255, 255, 1);
            font-weight: 700;
        }

        #app .sidebar .body {
            margin-top: 64px;
        }

        #app .sidebar .body {
            text-decoration: none;
        }

        #app .sidebar .body .item {
            color: #F5F6FA;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding: 18px 24px;
            font-size: 14px;
        }

        #app .sidebar .body  .item:hover {
            background-color: rgba(255, 255, 255, 0.5);
        }

        .active {
            background-color: rgba(255, 255, 255, 0.5);
        }

        .content {
            width: 100%;
            padding: 10px 20px;
        }

        .content .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content .header .hamburger {
            display: flex;
            flex-direction: column;
            cursor: pointer;
            width: 22px;
        }

        .content .header .hamburger div {
            border: 1px solid #A5B1C2;
            margin-top: 6px;
        }

        .content .header .logout {
            font-family: Arial;
            color: #95AFC0;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
        }

        .content .header .logout i {
            margin-left: 4px;
        }

        .content .body {
            padding: 0 20px;
            margin-top: 40px;
        }

        .content .body .title {
            color: #4B6584;
            font-size: 22px;
        }

        .data .fa-pencil {
            color: green !important;
        }

        .data .fa-times {
            color: red !important;
        }

        input, select {
            width: 100% !important; 
        }


    </style>
  </head>

  <body>
    <div id="app">
        <div class="sidebar">
            <div class="header">
                <p class="brand">Freshmart</p>
            </div>
            <div class="body">
                <a href="dashboard.php" style="text-decoration: none;"><div class="item ">Produk</div></a>
                <a href="keranjang.php" style="text-decoration: none;"><div class="item active">Keranjang</div></a>
            </div>
        </div>
        <div class="content" style="height: 100vh; overflow: hidden;">
            <div class="header">
                <div class="hamburger" onclick="toogleSidebar()">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <p style="text-decoration: none;" class="profile mt-2">Selamat Datang, <b>Wahmaha</b></p>
                <a style="text-decoration: none;" href="logout.php" class="logout">SIGN OUT<i class="fa fa-sign-out"></i></a>
            </div>
            <div class="body">
                <div class="d-flex justify-content-between">
                    <p class="title">Keranjang</p>    
                </div> 
                <div class="container mb-5" style="z-index: 0; height: 80vh; width: 100%; max-width: 1180px; overflow-y: auto;">
                    <?php 

                        $user = $row['id'];

                        $select_item = mysqli_query($con, "SELECT * FROM items WHERE idUser = $user AND status = 'Belum'");

                        if( mysqli_num_rows($select_item) > 0 ){
                            $i = 0;
                            $total = 0;
                    ?>
                        <table class="table">
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Status</th>
                            </tr>
                            <?php while($rows = mysqli_fetch_assoc($select_item)){ ?>
                            <tr>
                                <td><?php echo $i+=1; ?></td>
                                <td><?php echo $rows['item']; ?></td>
                                <td><?php echo $rows['harga']; ?></td>
                                <td><?php echo $rows['jumlah']; ?></td>
                                <td><?php echo $rows['subtotal']; ?></td>
                                <td><?php echo $rows['status']; ?></td>
                            </tr>
                            <?php
                                    $total += $rows['subtotal'];
                                } 
                            ?>
                        </table>
                        <h3 class="mt-5 mb-3">Total Harga : Rp. <?php echo $total ?></h3>
                        <form action="process/bayarProcess.php" method="POST">
                            <input type="text" name="user" value="<?php echo $row['id'] ?>" hidden>
                            <input type="text" name="total" value="<?php echo $total ?>" hidden>
                            <input type="number" min="0" name="uang" class="form-control mb-3" placeholder="Masukan Jumlah pembayaran...">
                            <button type="submit" class="btn btn-primary" name="btn-bayar" value="btn-bayar">Bayar sekarang</button>
                        </form>
                    <?php } else { ?>
                        <p>Anda belum belanja</p>
                    <?php } ?>
                </div>
              </div>      
            </div>
        </div>
    </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="script.js"></script>
  </body>
</html>

