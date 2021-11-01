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
    <title>Produk</title>
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
                <a href="dashboard.php" style="text-decoration: none;"><div class="item active">Produk</div></a>
                <a href="keranjang.php" style="text-decoration: none;"><div class="item">Keranjang</div></a>
            </div>
        </div>
        <div class="content" style="height: 100vh; overflow: hidden;">
            <div class="header">
                <div class="hamburger" onclick="toogleSidebar()">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <p style="text-decoration: none;" class="profile mt-2">Selamat Datang, <b><?php echo $row['nama'] ?></b></p>
                <a style="text-decoration: none;" href="logout.php" class="logout">SIGN OUT<i class="fa fa-sign-out"></i></a>
            </div>
            <div class="body">
                <div class="d-flex justify-content-between">
                    <p class="title">Produk</p>    
                </div> 
                <div class="container mb-5" style="z-index: 0; height: 80vh; width: 100%; max-width: 1180px; overflow-y: auto;">
                    <div class="row" style="margin-bottom: 50px;">
                        <div class="col-md-4 mt-5">
                            <form action="process/beliProcess.php" method="post">
                            <input type="text" name="user" value="<?php echo $row['id'] ?>" hidden>
                            <input type="text" name="nama" value="Sawi" hidden>  
                            <input type="text" name="harga" value="10000" hidden>
                                <div class="card">
                                    <img src="image/sawi.jpg" class="card-img-top"  style="height: 250px; object-fit: cover;" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Sawi</h5>
                                        <p class="card-text">Harga : 10.000</p>
                                        <input type="number" class="form-control" min="1" max="5" name="jumlah" placeholder="Masukan jumlah...">
                                        <button type="submit" name="btn-beli" value="btn-beli" style="width: 100%; margin-top: 15px;" class="btn btn-primary">Masukan Keranjang</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4 mt-5">
                            <form action="process/beliProcess.php" method="post">
                            <input type="text" name="user" value="<?php echo $row['id'] ?>" hidden>
                            <input type="text" name="nama" value="Bayam" hidden>    
                            <input type="text" name="harga" value="5000" hidden>
                                <div class="card">
                                    <img src="image/bayam.jpg" class="card-img-top" style="height: 250px; object-fit: cover;"  alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Bayam</h5>
                                        <p class="card-text">Harga : 5.000</p>
                                        <input type="number" class="form-control" min="1" max="5" name="jumlah" placeholder="Masukan jumlah...">
                                        <button type="submit" name="btn-beli" value="btn-beli" style="width: 100%; margin-top: 15px;" class="btn btn-primary">Masukan Keranjang</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4 mt-5">
                            <form action="process/beliProcess.php" method="post">
                            <input type="text" name="user" value="<?php echo $row['id'] ?>" hidden>
                            <input type="text" name="nama" value="Daging Ayam" hidden>  
                            <input type="text" name="harga" value="15000" hidden>
                                <div class="card">
                                    <img src="image/dagingayam.jpg" class="card-img-top" style="height: 250px; object-fit: cover;" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Daging Ayam</h5>
                                        <p class="card-text">Harga : 15.000</p>
                                        <input type="number" class="form-control" min="1" max="5" name="jumlah" placeholder="Masukan jumlah...">
                                        <button type="submit" name="btn-beli" value="btn-beli" style="width: 100%; margin-top: 15px;" class="btn btn-primary">Masukan Keranjang</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4 mt-5">
                            <form action="process/beliProcess.php" method="post">
                            <input type="text" name="user" value="<?php echo $row['id'] ?>" hidden>
                            <input type="text" name="nama" value="Daging Sapi" hidden>  
                            <input type="text" name="harga" value="30000" hidden>
                                <div class="card">
                                    <img src="image/dagingsapi.jpg" class="card-img-top"  style="height: 250px; object-fit: cover;" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Daging Sapi</h5>
                                        <p class="card-text">Harga : 30.000</p>
                                        <input type="number" class="form-control" min="1" max="5" name="jumlah" placeholder="Masukan jumlah...">
                                        <button type="submit" name="btn-beli" value="btn-beli" style="width: 100%; margin-top: 15px;" class="btn btn-primary">Masukan Keranjang</button>
                                    </div>
                                </div>
                            </form>
                        </div>
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

