<?php
session_start();
include 'config.php';
$getusermail = $_SESSION["email"];
$getusername = $_SESSION["username"];
$getproductid = $_GET['id'];

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

if (isset($_POST['srchsubmit'])) {
    $srchq = $_POST['searchq'];
    header("Location: search.php?q=$srchq");
}
error_reporting(0);
$query = mysqli_query($conn,"SELECT * FROM products WHERE productid = '$getproductid'");
$result = $query->fetch_assoc();
$getproductname = $result['name'];
$getproductprice = $result['price'];
$getproductseller = $result['seller'];


if(!$result) {
    header("Location: products.php");
}

if (isset($_POST['order'])) {
    $getcardnumber = $_POST['cardnumber'];
    $getcardowner = $_POST['cardowner'];
    $getcardexpiredate = $_POST['expiredatem'] . "/" . $_POST['expiredatey'];
    $getcardcvv = $_POST['cardcvv'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://devlet.nomee6.xyz/api/odeme.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
"secret=secret&cardnumber=$getcardnumber&cardowner=$getcardowner&cardexpire=$getcardexpiredate&cardcvv=$getcardcvv&amount=$getproductprice");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.66 Safari/537.36 Edg/103.0.1264.44");
    $server_output = curl_exec($ch);
    
    curl_close ($ch);
    if($server_output == "OK") {
        $createrandomorderid = rand("100000", "999999");
        $getdate = date("M/d/Y");
        $sql79 = "INSERT INTO orders (orderid, date, amount, owner, product, status, reviewstatus, seller)
					VALUES ('$createrandomorderid', '$getdate', '$getproductprice', '$getusername', '$getproductid', 'Teslimat Aşamasında', 'unreviewed', '$getproductseller')";
		$result79 = mysqli_query($conn, $sql79);

$query32 = mysqli_query($conn, "SELECT * FROM users WHERE email = '$getusermail'");
$result32 = $query32->fetch_assoc();
$getuorders = $result32['orders'];
$query89 = mysqli_query($conn, "SELECT * FROM users WHERE sellertoken = '$getproductseller'");
$result89 = $query89->fetch_assoc();
$getsellermoney = $result89['money'];
    if(!$getuorders) {
        $newuserordersdb = "$createrandomorderid";
    } else {
        $newuserordersdb = "$getuorders,$createrandomorderid";
    };

    $sql8 = "UPDATE users SET orders = '$newuserordersdb' WHERE email = '$getusermail'";
    $run_query8 = mysqli_query($conn, $sql8);

    if(!$getproductseller) {
        $newproductsellermoneydb = "$getproductprice";
    } else {
        $newproductsellermoneydb = $getsellermoney+$getproductprice;
    };
    $sql948 = "UPDATE users SET money = '$newproductsellermoneydb' WHERE sellertoken = '$getproductseller'";
    $run_query948 = mysqli_query($conn, $sql948);
    if($run_query948 && $run_query8 && $result79) {
        header("Refresh:2 url=user/");
        echo "Ürününüz yola çıktı!";
    } else {
        echo "İşlem gerçekleştirilirken bir hata oluştu!";
    }
    } else {
        echo $server_output;
    }
}
?>


<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>NOMEE6 Store</title>
    <meta name="keywords" content="NOMEE6, nomee6, store, torbaci, huseyin, torbaci huseyin, hussein" />
    <meta name="description" content="NOMEE6 Store yenilikçi altyapısıyla yepyeni bir alışveriş deneyimi sunuyor!">
    <meta name="author" content="Ali Yasin Yeşilyaprak">
    <link rel="icon" type="image/x-icon" href="https://nomee6.xyz/assets/pp.png">
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
    <script>
        WebFontConfig = {
            google: {
                families: ['Open+Sans:300,400,600,700,800', 'Poppins:300,400,500,600,700', 'Shadows+Into+Light:400']
            }
        };
        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = 'assets/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="assets/css/style.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/fontawesome-free/css/all.min.css">
</head>

<body>
    <div class="page-wrapper">
        <header class="header">
            <div class="header-top">
                <div class="container">
                    <div class="header-right header-dropdowns ml-0 ml-sm-auto w-sm-100">
                        <div class="header-dropdown dropdown-expanded d-none d-lg-block">
                            <div class="header-menu">
                                <ul>
                                    <li><a href="account.php">Hesap</a></li>
                                    <li><a href="about.php">Hakkımızda</a></li>
                                </ul>
                            </div>
                        </div>
                        <span class="separator"></span>
                        <div class="header-dropdown">
                            <a href="#"><i class="flag-tr flag"></i>TR</a>
                        </div>
                        <div class="header-dropdown mr-auto mr-sm-3 mr-md-0">
                            <a href="#">TRY</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
                <div class="container">
                    <div class="header-left col-lg-2 w-auto pl-0">
                        <button class="mobile-menu-toggler text-primary mr-2" type="button">
							<i class="fas fa-bars"></i>
						</button>
                        <a href="index.php" class="logo">
                            <img src="https://nomee6.xyz/assets/pp.png" width="50" height="50" alt="NOMEE6 Store">
                        </a>
                    </div>
                    <div class="header-right w-lg-max">
                        <div class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mt-0">
                            <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                            <form action="" method="POST">
                                <div class="header-search-wrapper">
                                    <input type="search" class="form-control" name="searchq" placeholder="Ara..." required>
                                    <button class="btn icon-magnifier p-0" title="search" type="submit" name="submit"></button>
                                </div>
                            </form>
                        </div>
                        <a href="account.php" class="header-icon" title="login"><i class="icon-user-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom sticky-header d-none d-lg-block" data-sticky-options="{'mobile': false}">
                <div class="container">
                    <nav class="main-nav w-100">
                        <ul class="menu">
                            <li>
                                <a href="index.php">Ana Sayfa</a>
                            </li>
                            <li><a href="products.php">Ürünler</a></li>
                            <li><a href="contact.php">İletişime Geç</a></li>
                            <li class="float-right"><a href="user/orders.php" class="pl-5">Siparişlerim</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <main class="main main-test">
            <div class="container checkout-container">
                <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                    <li class="active">
                        <a>Ödeme</a>
                    </li>
                    <li class="disabled">
                        <a>Sipariş Tamam</a>
                    </li>
                </ul>
                <div class="checkout-discount">
                    <h4>İndirim Kuponun mu var?
                        <button data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne" class="btn btn-link btn-toggle">KODU GİR</button>
                    </h4>

                    <div id="collapseTwo" class="collapse">
                        <div class="feature-box">
                            <div class="feature-box-content">
                                <p>İndirim kuponunu buradan girerek siparişine yansıtabilirsin.</p>

                                <form action="" method="POST">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm w-auto" placeholder="Kupon Kodu" required="" />
                                        <div class="input-group-append">
                                            <button name="couponsubmit" class="btn btn-sm mt-0" type="submit">
                                                Kuponu Uygula
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-7">
                        <ul class="checkout-steps">
                            <li>
                                <h2 class="step-title">Kart Bilgileri</h2>

                                <form action="" method="POST">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kart sahibi
                                                    <abbr class="required" title="required">*</abbr>
                                                </label>
                                                <input type="text" name="cardowner" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
										<label>Kart Numarası <span class="required">*</span></label>
										<input name="cardnumber" type="text" class="form-control">
									</div>

									<label>Kart Bitiş Tarihi <span class="required">*</span></label>
										<select name="expiredatem" class="form-control">
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
										</select>
										<select name="expiredatey" class="form-control">
											<option value="22">22</option>
											<option value="23">23</option>
											<option value="24">24</option>
											<option value="25">25</option>
											<option value="26">26</option>
											<option value="27">27</option>
											<option value="28">28</option>
											<option value="29">29</option>
											<option value="30">30</option>
										</select>

									<div class="form-group">
										<label>Kart CVV <span class="required">*</span></label>
										<input type="text" class="form-control" name="cardcvv" required />
									</div>

                                    <div class="form-group">
                                        <label>Şehir
                                            <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" class="form-control" required />
                                    </div>

                                    <div class="form-group">
                                        <label>Posta Kodu
                                            <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" class="form-control" required />
                                    </div>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-5">
                        <div class="order-summary">
                            <h3>Siparişiniz</h3>

                            <table class="table table-mini-cart">
                                <thead>
                                    <tr>
                                        <th colspan="1">Ürün</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="product-col">
                                            <h3 class="product-title">
                                            <?php echo $getproductname; ?>
                                            </h3>
                                        </td>

                                        <td class="price-col">
                                            <span>₺<?php echo $getproductprice; ?></span>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <td>
                                            <h4>Toplam Tutar</h4>
                                        </td>

                                        <td class="price-col">
                                            <span>₺<?php echo $getproductprice; ?></span>
                                        </td>
                                    </tr>
                                    <tr class="order-shipping">
                                        <td class="text-left" colspan="2">
                                            <h4 class="m-b-sm">Teslimat</h4>

                                            <div class="form-group form-group-custom-control">
                                                <div class="custom-control custom-radio d-flex">
                                                    <input type="radio" class="custom-control-input" name="radio" checked />
                                                    <label class="custom-control-label">Online Teslimat</label>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>

                                    <tr class="order-total">
                                        <td>
                                            <h4>Toplam</h4>
                                        </td>
                                        <td>
                                            <b class="total-price"><span>₺<?php echo $getproductprice; ?></span></b>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <button type="submit" name="order" class="btn btn-dark btn-place-order">
                                Ödemeyi Tamamla
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <footer class="footer bg-dark">
            <div class="footer-middle">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <div class="widget">
                                <h4 class="widget-title">İletişim</h4>
                                <ul class="contact-info">
                                    <li>
                                        <span class="contact-info-label">Email:</span> <a href="mailto:torbacihuseyin@nomee6.xyz">torbacihuseyin@nomee6.xyz</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="widget">
                                <h4 class="widget-title">Linkler</h4>

                                <ul class="links">
                                    <li><a href="account.php">Hesabım</a></li>
                                    <li><a href="https://nomee6.xyz/privacy">Gizlilik Politikası</a></li>
                                    <li><a href="about.php">Hakkımızda</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="footer-bottom">
                    <div class="container d-sm-flex align-items-center">
                        <div class="footer-left">
                            <span class="footer-copyright">© NOMEE6 Inc. 2022</span>
                        </div>

                        <div class="footer-right ml-auto mt-1 mt-sm-0">
                            <div class="payment-icons">
                                <span class="payment-icon visa" style="background-image: url(assets/images/payments/payment-visa.svg)"></span>
                                <span class="payment-icon paypal" style="background-image: url(assets/images/payments/payment-paypal.svg)"></span>
                                <span class="payment-icon stripe" style="background-image: url(assets/images/payments/payment-stripe.png)"></span>
                                <span class="payment-icon verisign" style="background-image:  url(assets/images/payments/payment-verisign.svg)"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <div class="loading-overlay">
        <div class="bounce-loader">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    <!-- Plugins JS File -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/optional/isotope.pkgd.min.js"></script>
    <script src="assets/js/plugins.min.js"></script>
    <script src="assets/js/jquery.appear.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.min.js"></script>
</body>
</html>