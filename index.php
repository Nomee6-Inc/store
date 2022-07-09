<?php
include 'config.php';


if (isset($_POST['submit'])) {
    $srchq = $_POST['searchq'];
    header("Location: search.php?q=$srchq");
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
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/demo4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/fontawesome-free/css/all.min.css">
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
            <div class="header-middle sticky-header">
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
            <div class="header-bottom sticky-header d-none d-lg-block" data-sticky-options="{'mobile': true}">
                <div class="container">
                    <nav class="main-nav w-100">
                        <ul class="menu">
                            <li class="active">
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
            <div class="home-slider slide-animate owl-carousel owl-theme show-nav-hover nav-big mb-2 text-uppercase" data-owl-options="{
				'loop': false
			}">
                <div class="home-slide home-slide1 banner">
                    <img class="slide-bg" src="assets/images/demoes/demo4/slider/slide-1.jpg" width="1903" height="499" alt="slider image">
                    <div class="container d-flex align-items-center">
                        <div class="banner-layer appear-animate" data-animation-name="fadeInUpShorter">
                            <h2 class="text-transform-none mb-0">Yaz İndirimi</h2>
                            <h3 class="m-b-3">70% İndirim</h3>
                            <h5 class="d-inline-block mb-0">
                            </h5>
                            <a href="products.php" class="btn btn-dark btn-lg">Alışveriş Yap!</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="info-boxes-slider owl-carousel owl-theme mb-2" data-owl-options="{
					'dots': false,
					'loop': false,
					'responsive': {
						'576': {
							'items': 2
						},
						'992': {
							'items': 3
						}
					}
				}">
                    <div class="info-box info-box-icon-left">
                        <i class="icon-shipping"></i>

                        <div class="info-box-content">
                            <h4>ÜCRETSİZ TESLİMAT</h4>
                            <p class="text-body">Bütün siparişler ücretsiz teslim edilir.</p>
                        </div>
                    </div>

                    <div class="info-box info-box-icon-left">
                        <i class="icon-money"></i>

                        <div class="info-box-content">
                            <h4>PARA İADE GARANTİSİ</h4>
                            <p class="text-body">30 gün içerisinde 100% para iade garantisi sunuyoruz.</p>
                        </div>
                    </div>
                    <div class="info-box info-box-icon-left">
                        <i class="icon-support"></i>

                        <div class="info-box-content">
                            <h4>24/7 ONLINE DESTEK</h4>
                            <p class="text-body">Websitemiz üzerinden canlı destek hizmeti sunuyoruz.</p>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <h2 class="section-title heading-border ls-20 border-0">Önerilen Ürünler</h2>

                    <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center" data-owl-options="{
						'dots': false,
						'nav': true
					}">
                    <?php
                    $sql2 = "SELECT * from featuredproducts";
                    $result2 = $mysqli->query($sql2);
                    while($row = mysqli_fetch_array($result2)){
                        $productid = $row['productid'];
                        $query = mysqli_query($conn,"SELECT * FROM products WHERE productid = '$productid'");
                        $result = $query->fetch_assoc();   
                        $productphotosdb = $result['photos'];
                        $productname = $result['name'];
                        $productprice = $result['price'];
                        $productphotos = explode(",", $productphotosdb);
                        $productphoto0 = $productphotos[0];
                       echo "<div class=\"product-default appear-animate\" data-animation-name=\"fadeInRightShorter\">
                       <figure>
                           <a href=\"view_product.php?id=$productid\">
                               <img src=\"images/$productphoto0\" width=\"280\" height=\"280\" alt=\"product\">
                           </a>
                       </figure>
                       <div class=\"product-details\">
                           <h3 class=\"product-title\">
                               <a href=\"view_product.php?id=$productid\">$productname</a>
                           </h3>
                           <div class=\"price-box\">
                               <span class=\"product-price\">₺$productprice</span>
                           </div>
                           <!-- End .price-box -->
                           <div class=\"product-action\">
                               <a href=\"view_product.php?id=$productid\" class=\"btn-icon btn-add-cart\"><i
                                       class=\"fa fa-arrow-right\"></i><span>Satın Al</span></a>
                           </div>
                       </div>
                   </div>";
                    };
                    ?>
                    </div>
                </div>
            </section>
        </main>
        <!-- End .main -->

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