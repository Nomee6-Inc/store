<?php
session_start();
include '../config.php';
$getusermail = $_SESSION["email"];
$getusername = $_SESSION["username"];
$getorderid = $_GET['orderid'];
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
}

$query = mysqli_query($conn,"SELECT * FROM users WHERE email = '$getusermail'");
$result = $query->fetch_assoc();
$getuserordersid = $result['orders'];

if (!strstr($getuserordersid, "$getorderid")) {
    header("Location: index.php");
}

$query1 = mysqli_query($conn,"SELECT * FROM orders WHERE orderid = '$getorderid'");
$result1 = $query1->fetch_assoc();
$getproductid = $result1['product'];
$getamount = $result1['amount'];

$query2 = mysqli_query($conn,"SELECT * FROM products WHERE productid = '$getproductid'");
$result2 = $query2->fetch_assoc();
$getproductname = $result2['name'];
?>

<!doctype html>
<html lang="tr">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Fatura Görüntüle</title>
    <link href="https://devlet.nomee6.xyz/dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="https://devlet.nomee6.xyz/dist/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="https://devlet.nomee6.xyz/dist/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="https://devlet.nomee6.xyz/dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="https://devlet.nomee6.xyz/dist/css/demo.min.css" rel="stylesheet"/>
    <meta name="keywords" content="NOMEE6, nomee6, store, torbaci, huseyin, torbaci huseyin, hussein" />
    <meta name="description" content="NOMEE6 Store yenilikçi altyapısıyla yepyeni bir alışveriş deneyimi sunuyor!">
    <meta name="author" content="Ali Yasin Yeşilyaprak">
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
    <link rel="icon" type="image/x-icon" href="https://nomee6.xyz/assets/pp.png">
  </head>
  <body >
    <div class="page">
      <div class="page-wrapper">
        <div class="container-xl">
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Fatura Görüntüle
                </h2>
              </div>
              <div class="col-auto ms-auto d-print-none">
                <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><rect x="7" y="13" width="10" height="8" rx="2" /></svg>
                  Faturayı Yazdır
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
          <div class="container-xl">
            <div class="card card-lg">
              <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <p class="h3">Nomee6 Inc.</p>
                    <address>
                      Türkiye<br>
                      Antalya<br>
                      torbacihuseyin@nomee6.xyz
                    </address>
                  </div>
                  <div class="col-6 text-end">
                    <p class="h3"><?php echo $getusername; ?></p>
                    <address>
                      <?php echo $getusermail; ?>
                    </address>
                  </div>
                  <div class="col-12 my-5">
                    <h1>Sipariş ID: <?php echo $getorderid; ?></h1>
                  </div>
                </div>
                <table class="table table-transparent table-responsive">
                  <thead>
                    <tr>
                      <th>Ürün</th>
                      <th class="text-end" style="width: 1%">Tutar</th>
                    </tr>
                  </thead>
                  <tr>
                    <td>
                      <p class="strong mb-1"><?php echo $getproductname; ?></p>
                    </td>
                    <td class="text-end">₺<?php echo $getamount; ?></td>
                  </tr>
                </table>
                <p class="text-muted text-center mt-5">Alışverişiniz için teşekkür ederiz!</p>
              </div>
            </div>
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
    <script src="https://devlet.nomee6.xyz/dist/js/tabler.min.js"></script>
    <script src="https://devlet.nomee6.xyz/dist/js/demo.min.js"></script>
  </body>
</html>