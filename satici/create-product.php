<?php
session_start();
include '../config.php';
$getusermail = $_SESSION["email"];
$getusername = $_SESSION["username"];

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
}
error_reporting(1);
$query8 = mysqli_query($conn,"SELECT * FROM users WHERE email = '$getusermail'");
$result8 = $query8->fetch_assoc();   
$getsellertoken = $result8['sellertoken'];
$getuproducts = $result8['products'];

if(isset($_POST['createproduct'])) {
$upload_dir = '../images'.DIRECTORY_SEPARATOR;
$allowed_types = array('jpg', 'png', 'jpeg');

$maxsize = 20 * 1024 * 1024;
if(!empty(array_filter($_FILES['photos']['name']))) {

    foreach ($_FILES['photos']['tmp_name'] as $key => $value) {
        $createmd5hashphotoname = md5($_FILES['photos']['name'][$key].rand());
        $file_tmpname = $_FILES['photos']['tmp_name'][$key];
        $file_name = $createmd5hashphotoname;
        $file_size = $_FILES['photos']['size'][$key];
        $file_ext = pathinfo($_FILES['photos']['name'][$key], PATHINFO_EXTENSION);
        $filepath = $upload_dir.$file_name;
        if(in_array(strtolower($file_ext), $allowed_types)) {
            if ($file_size > $maxsize) {
                echo "Error: Eklediğiniz fotoğraf 20MB boyutunu geçmemelidir!";
                $uploadOk = 0;
            } else {
                if(move_uploaded_file($file_tmpname, $filepath.".".$file_ext)) {
                    $uploadOk = 1;
                    if($uploadedphotos != "") {
                        $uploadedphotos = "$uploadedphotos,$file_name.$file_ext";
                    } else {
                        $uploadedphotos = "$file_name.$file_ext";
                    }
                } else {                    
                    echo "Ürün fotoğrafları eklenirken bir hata oluştu!";
                    $uploadOk = 0;
                }
            }
        } else {
            echo "Bazı ürün fotoğrafları yüklenirken bir hata oluştu! ";
            echo "({$file_ext} dosya türü desteklenmemektedir)<br>";
            $uploadOk = 0;
        }
    }
} else {
    echo "Fotoğraf seçilmedi.";
    $uploadOk = 0;
}


if($uploadOk == 1) {
    $createproductid = rand("100000", "999999");
    $getproductname = $_POST['productname'];
    $getproductdescpost = $_POST['productdesc'];
    $getproductdesc = str_replace('','&nbsp;',$getproductdescpost);
    $getproductprice = $_POST['productprice'];
    $sql974 = "INSERT INTO products (productid, description, name, photos, price, seller) 
            VALUES ('$createproductid', '$getproductdesc', '$getproductname', '$uploadedphotos', '$getproductprice', '$getsellertoken');";
	$result974 = mysqli_query($conn, $sql974);
	
    if($getuproducts == "") {
      $newuserproducts = $createproductid;
    } else {
      $newuserproducts = "$getuproducts,$createproductid";
    }
	
    $sql10 = "UPDATE users SET products = '$newuserproducts' WHERE sellertoken = '$getsellertoken'";
    $run_query10 = mysqli_query($conn, $sql10);
	
    if($result974 && $run_query10) {
      echo "Ürün Oluşturma başarılı!";
      header("Refresh:2 url=products.php");
    } else {
      echo "Bir hata oluştu!";
    }
}
}
?>

<!doctype html>
<html lang="tr">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Satıcı Portalı | Nomee6 Store</title>
    <!-- CSS files -->
    <link href="https://devlet.nomee6.xyz/dist/css/tabler.min.css" rel="stylesheet"/>
    <!-- Matomo -->
<script>
  var _paq = window._paq = window._paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="https://matomo.aliyasin.org/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '18']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Code -->
    <link href="https://devlet.nomee6.xyz/dist/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="https://devlet.nomee6.xyz/dist/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="https://devlet.nomee6.xyz/dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="https://devlet.nomee6.xyz/dist/css/demo.min.css" rel="stylesheet"/>
    <meta name="keywords" content="NOMEE6, nomee6, store, torbaci, huseyin, torbaci huseyin, hussein" />
    <meta name="description" content="NOMEE6 Store yenilikçi altyapısıyla yepyeni bir alışveriş deneyimi sunuyor!">
    <meta name="author" content="Ali Yasin Yeşilyaprak">
    <link rel="icon" type="image/x-icon" href="https://nomee6.xyz/assets/pp.png">
  </head>
  <body >
    <div class="page">
      <header class="navbar navbar-expand-md navbar-light d-print-none">
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand d-none-navbar-horizontal pe-0 pe-md-3">
            <a href=".">
              <img src="https://nomee6.xyz/assets/pp.png" width="110" height="32" class="navbar-brand-image">
            </a>
          </h1>
          <div class="navbar-nav flex-row order-md-last">
            <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Koyu Temaya Geç" data-bs-toggle="tooltip" data-bs-placement="bottom">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
            </a>
            <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Açık Temaya Geç" data-bs-toggle="tooltip" data-bs-placement="bottom">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="4" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
            </a>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Kullanıcı menüsü">
                <div class="d-none d-xl-block ps-2">
                  <div><?php echo $getusername; ?></div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="../logout.php" class="dropdown-item">Çıkış Yap</a>
              </div>
            </div>
          </div>
        </div>
      </header>
      <div class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar navbar-light">
            <div class="container-xl">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="./" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Ana Sayfa
                    </span>
                  </a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" /><line x1="12" y1="12" x2="20" y2="7.5" /><line x1="12" y1="12" x2="12" y2="21" /><line x1="12" y1="12" x2="4" y2="7.5" /><line x1="16" y1="5.25" x2="8" y2="9.75" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Ürünler
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <a class="dropdown-item" href="./orders.php" >
                          Siparişleri Görüntüle
                        </a>
                        <a class="dropdown-item" href="./products.php" >
                          Ürünlerimi Göster
                        </a>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./money-withdraw.php" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="3" y1="21" x2="21" y2="21"></line><line x1="3" y1="10" x2="21" y2="10"></line><polyline points="5 6 12 3 19 6"></polyline><line x1="4" y1="10" x2="4" y2="21"></line><line x1="20" y1="10" x2="20" y2="21"></line><line x1="8" y1="14" x2="8" y2="17"></line><line x1="12" y1="14" x2="12" y2="17"></line><line x1="16" y1="14" x2="16" y2="17"></line></svg>
                    </span>
                    <span class="nav-link-title">
                      Para Çek
                    </span>
                  </a>
                </li>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="page-wrapper">
        <div class="container-xl">
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Ürün Oluştur
                </h2>
              </div>
              <div class="col-auto ms-auto d-print-none">
              </div>
            </div>
          </div>
        </div>
<div class="page-body">
  <div class="container-xl">
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
                <label class="form-label">Ürün İsmi</label>
                <input type="text" class="form-control" name="productname" required>
          </div>
          <div class="mb-3">
                <label class="form-label">Ürün Açıklaması</label>
                <textarea class="form-control" rows="6" name="productdesc" required></textarea>
          </div>
          <div class="mb-3">
                <label class="form-label">Ürün Fiyatı</label>
                <input type="number" class="form-control" name="productprice" required>
          </div>
          <div class="mb-3">
                <label class="form-label">Ürün Resimleri</label>
                <input type="file" name="photos[]" class="form-control" required multiple/>
                <small class="form-hint">En az 1 adet resim eklemeniz zorunludur.</small>
          </div>
          <input type="submit" name="createproduct" class="btn btn-primary" value="Oluştur">
        </form>
    </div>
</div>
        <footer class="footer footer-transparent d-print-none">
          <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">
              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                    Copyright &copy; 2022
                    <a href="." class="link-secondary">Nomee6 Inc</a>.
                    All rights reserved.
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- Libs JS -->
    <script src="https://devlet.nomee6.xyz/dist/js/tabler.min.js"></script>
    <script src="https://devlet.nomee6.xyz/dist/js/demo.min.js"></script>
  </body>
</html>