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

$query1 = mysqli_query($conn,"SELECT * FROM orders WHERE orderid = '$getorderid'");
$result1 = $query1->fetch_assoc();
$deliveryimg = $result1['deliveryimg'];
$product = $result1['product'];
$reviewstatus = $result1['reviewstatus'];
$deliverynote = $result1['deliverynote'];

if (!strstr($getuserordersid, "$getorderid")) {
    header("Location: index.php");
}

if ($reviewstatus == "reviewed") {
    header("Location: index.php");
}

if (isset($_POST['srchsubmit'])) {
    $srchq = $_POST['searchq'];
    header("Location: ../search.php?q=$srchq");
}

if (isset($_POST['reviewsubmit'])) {
    $createrandomcommentid = rand("100000", "999999");
    $query2 = mysqli_query($conn,"SELECT * FROM products WHERE productid = '$product'");
    $result2 = $query2->fetch_assoc();
    $getproductnowreviews = $result2['reviews'];
    $getproductnowreviewsarray = explode(",", $getproductnowreviews);
    $getcomment = $_POST['review'];
    if($getproductnowreviews != "") {
        $sql1 = "UPDATE products SET reviews = '$getproductnowreviews,$createrandomcommentid' WHERE productid = '$product'";
        $run_query1 = mysqli_query($conn, $sql1);

        $sql3 = "INSERT INTO reviews (commentid, owner, comment)
					VALUES ('$createrandomcommentid', '$getusername', '$getcomment')";
	    $run_query3 = mysqli_query($conn, $sql3);
        if($run_query1 && $run_query3) {
            $sql4 = "UPDATE orders SET reviewstatus = 'reviewed' WHERE orderid = '$getorderid'";
            $run_query4 = mysqli_query($conn, $sql4);
            header("Refresh:2 url=index.php");
            echo "İşlem başarılı!";
        } else {
            echo "Bir hata oluştu!";
        }
    } else {
        $sql2 = "UPDATE products SET reviews = '$createrandomcommentid' WHERE productid = '$product'";
        $run_query2 = mysqli_query($conn, $sql2);

        $sql5 = "INSERT INTO reviews (commentid, owner, comment)
					VALUES ('$createrandomcommentid', '$getusername', '$getcomment')";
	    $run_query5 = mysqli_query($conn, $sql5);
        if($run_query2 && $run_query5) {
            $sql6 = "UPDATE orders SET reviewstatus = 'reviewed' WHERE orderid = '$getorderid'";
            $run_query6 = mysqli_query($conn, $sql6);
            header("Refresh:2 url=index.php");
            echo "İşlem başarılı!";
        } else {
            echo "Bir hata oluştu!";
        }
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
    <meta name="author" content="Ali Yasin Yeşilyaprak">
    <link rel="icon" type="image/x-icon" href="https://nomee6.xyz/assets/pp.png">
    <script>
		WebFontConfig = {
			google: { families: [ 'Open+Sans:300,400,600,700,800', 'Poppins:300,400,500,600,700', 'Shadows+Into+Light:400' ] }
		};
		( function ( d ) {
			var wf = d.createElement( 'script' ), s = d.scripts[ 0 ];
			wf.src = '../assets/js/webfont.js';
			wf.async = true;
			s.parentNode.insertBefore( wf, s );
		} )( document );
	</script>

	<!-- Plugins CSS File -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<!-- Main CSS File -->
	<link rel="stylesheet" href="../assets/css/style.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/vendor/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/vendor/simple-line-icons/css/simple-line-icons.min.css">
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
                                    <li><a href="../account.php">Hesap</a></li>
                                    <li><a href="../about.php">Hakkımızda</a></li>
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
                        <a href="../index.php" class="logo">
                            <img src="https://nomee6.xyz/assets/pp.png" width="50" height="50" alt="NOMEE6 Store">
                        </a>
                    </div>
                    <div class="header-right w-lg-max">
                        <div class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mt-0">
                            <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                            <form action="" method="POST">
                                <div class="header-search-wrapper">
                                    <input type="search" class="form-control" name="searchq" placeholder="Ara..." required>
                                    <button class="btn icon-magnifier p-0" title="search" type="submit" name="srchsubmit"></button>
                                </div>
                            </form>
                        </div>
                        <a href="../account.php" class="header-icon" title="login"><i class="icon-user-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom sticky-header d-none d-lg-block" data-sticky-options="{'mobile': false}">
                <div class="container">
                    <nav class="main-nav w-100">
                        <ul class="menu">
                            <li>
                                <a href="../index.php">Ana Sayfa</a>
                            </li>
                            <li><a href="../products.php">Ürünler</a></li>
                            <li><a href="../contact.php">İletişime Geç</a></li>
                            <li class="float-right"><a href="orders.php" class="pl-5">Siparişlerim</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>

        <main class="main info-box-wrapper">
			<div class="container">
            <div class="add-product-review">
                <h3 class="review-title">Ürün İncelemesi Ekle</h3>
                <form action="" method="POST" class="comment-form m-0">
                    <div class="rating-form">
                    <div class="form-group">
                        <label>İnceleme mesajınız <span class="required">*</span></label>
                        <textarea name="review" cols="5" rows="6" class="form-control form-control-sm"></textarea>
                    </div>
                        <input type="submit" name="reviewsubmit" class="btn btn-primary" value="Gönder">
                    </form>
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
                                <span class="payment-icon visa" style="background-image: url(../assets/images/payments/payment-visa.svg)"></span>
                                <span class="payment-icon paypal" style="background-image: url(../assets/images/payments/payment-paypal.svg)"></span>
                                <span class="payment-icon stripe" style="background-image: url(../assets/images/payments/payment-stripe.png)"></span>
                                <span class="payment-icon verisign" style="background-image:  url(../assets/images/payments/payment-verisign.svg)"></span>
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
    <script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/js/bootstrap.bundle.min.js"></script>
	<script src="../assets/js/plugins.min.js"></script>

	<!-- Main JS File -->
	<script src="../assets/js/main.min.js"></script>
</body>
</html>