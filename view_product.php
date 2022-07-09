<?php
include 'config.php';
$getproductid = $_GET['id'];

if(!$getproductid) {
    header("Location: products.php");
};

if (isset($_POST['srchsubmit'])) {
    $srchq = $_POST['searchq'];
    header("Location: search.php?q=$srchq");
}
error_reporting(0);
$query = mysqli_query($conn,"SELECT * FROM products WHERE productid = '$getproductid'");
$result = $query->fetch_assoc();
$productname = $result['name'];
$productphotosdb = $result['photos'];
$productprice = $result['price'];
$productstok = $result['stock'];
$productreviews = $result['reviews'];
$productdescription = $result['description'];
$productphotosarray = explode(",", $productphotosdb);
$productreviewsarray = explode(",", $productreviews);

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>NOMEE6 Store</title>
    <meta name="keywords" content="NOMEE6, nomee6, store, torbaci, huseyin, torbaci huseyin, hussein" />
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
    <meta name="description" content="NOMEE6 Store yenilikçi altyapısıyla yepyeni bir alışveriş deneyimi sunuyor!">
    <meta name="author" content="Ali Yasin Yeşilyaprak">
    <link rel="icon" type="image/x-icon" href="https://nomee6.xyz/assets/pp.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/demo4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/fontawesome-free/css/all.min.css">
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
                                    <button class="btn icon-magnifier p-0" title="search" type="submit" name="srchsubmit"></button>
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
        <main class="main">
            <div class="container">
                <div class="product-single-container product-single-default">
                    <div class="cart-message d-none">
                        <strong class="single-cart-notice">“<?php ?>”</strong>
                        <span>has been added to your cart.</span>
                    </div>

                    <div class="row">
                        <div class="col-lg-5 col-md-6 product-single-gallery">
                            <div class="product-slider-container">
                                <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                <?php
                                    foreach($productphotosarray as $array) {
                                        echo "<div class=\"product-item\">
                                        <img class=\"product-single-image\" src=\"images/$array\" data-zoom-image=\"images/$array\" width=\"468\" height=\"468\" alt=\"product\" />
                                    </div>";
                                    }
                                ?>
                                </div>
                                <span class="prod-full-screen">
									<i class="icon-plus"></i>
								</span>
                            </div>

                            <div class="prod-thumbnail owl-dots">
                                <?php
                                    foreach($productphotosarray as $array) {
                                        echo "<div class=\"owl-dot\">
                                        <img src=\"images/$array\" width=\"110\" height=\"110\" alt=\"product-thumbnail\" />
                                    </div>";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6 product-single-details">
                            <h1 class="product-title"><?php echo $productname; ?></h1>
                            <div class="price-box">
                                <span class="new-price">₺<?php echo $productprice; ?></span>
                            </div>
                            <div class="product-desc">
                                <p>
                                    <?php echo $productdescription; ?>
                                </p>
                            </div>
                            <ul class="single-info-list">

                                <li>
                                    Ürün ID: <strong><?php echo $getproductid; ?></strong>
                                </li>
                            </ul>

                            <div class="product-action">
                                <a href="buy.php?id=<?php echo $getproductid; ?>" class="btn btn-dark mr-2" title="Satın Al">Satın Al</a>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-single-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">Ürün Açıklaması</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content" role="tab" aria-controls="product-reviews-content" aria-selected="false">İncelemeler (<?php
                                if(!$productreviews) {
                                    $reviewscount = "0";
                                } else {
                                    $reviewscount = count($productreviewsarray);
                                }
                                    echo $reviewscount; 
                                ?>)</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
                            <div class="product-desc-content">
                                <p><?php echo $productdescription; ?></p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="product-reviews-content" role="tabpanel" aria-labelledby="product-tab-reviews">
                            <div class="product-reviews-content">
                                <h3 class="reviews-title"><?php echo $reviewscount; ?> İnceleme bulunuyor</h3>

                                <div class="comment-list">
                                    <div class="comments">
                                    <?php
                                    if($productreviews != "") {
                                        foreach($productreviewsarray as $array) {
                                            $query5 = mysqli_query($conn,"SELECT * FROM reviews WHERE commentid = '$array'");
                                            $result2 = $query5->fetch_assoc();
                                            $commentowner = $result2['owner'];
                                            $commentdate = $result2['date'];
                                            $comment = $result2['comment'];
                                            echo "<div class=\"comment-block\">
                                            <div class=\"comment-header\">
                                                <span class=\"comment-by\">
													<strong>$commentowner</strong> – $commentdate
												</span>
                                            </div>

                                            <div class=\"comment-content\">
                                                <p>$comment</p>
                                            </div>
                                        </div>
                                        <br>";
                                        }}
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
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