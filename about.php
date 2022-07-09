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
    <script>
		WebFontConfig = {
			google: { families: [ 'Open+Sans:300,400,600,700,800', 'Poppins:300,400,500,600,700', 'Shadows+Into+Light:400', 'Playfair+Display:900' ] }
		};
		( function ( d ) {
			var wf = d.createElement( 'script' ), s = d.scripts[ 0 ];
			wf.src = 'assets/js/webfont.js';
			wf.async = true;
			s.parentNode.insertBefore( wf, s );
		} )( document );
	</script>
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/style.min.css">
<link rel="stylesheet" type="text/css" href="assets/vendor/fontawesome-free/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/prototype/1.7.3/prototype.min.js" integrity="sha512-C4LuwXQtQOF1iTRy3zwClYLsLgFLlG8nCV5dCxDjPcWsyFelQXzi3efHRjptsOzbHwwnXC3ZU+sWUh1gmxaTBA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
        <main class="main about">
			<div class="page-header page-header-bg text-left"
				style="background: 50%/cover #D4E1EA url('assets/images/page-header-bg.jpg');">
				<div class="container">
					<h1><span>Hakkımızda</span>
						Nomee6 Inc.</h1>
					<a href="contact.php" class="btn btn-dark">İletişim</a>
				</div>
			</div>
			<div class="about-section">
				<div class="container">
					<h2 class="subtitle">Misyonumuz</h2>
					<p>Nomee6 Inc. tüm insanların mutlu olması ve eğlenmesi için kurulan eğlence amaçlı bir şirkettir. Sitede bulunan tüm içerikler mizah amaçlı olarak insanların eğlenmesini sağlamak içindir.</p>

					<p class="lead">“Çocuk papatyaya demiş ki; Seviyor mu? Sevmiyor mu? Papatyada demiş ki; Koparma yapraklarımı anneni severim.”</p>
				</div>
			</div>

			<div class="features-section bg-gray">
				<div class="container">
					<h2 class="subtitle">Neden bizi tercih etmelisiniz?</h2>
					<div class="row">
						<div class="col-lg-4">
							<div class="feature-box bg-white">
								<i class="icon-shipped"></i>

								<div class="feature-box-content p-0">
									<h3>Ücretsiz Kargo</h3>
									<p>Kargo hizmeti tamamen tarafımızca karşılanmakta olup ek olarak kargo ücreti tarafınıza yansıtılmamaktadır.</p>
								</div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="feature-box bg-white">
								<i class="icon-us-dollar"></i>

								<div class="feature-box-content p-0">
									<h3>100% Para iade garantisi</h3>
									<p>Ürünü beğenmediniz mi? İade mi etmek istiyorsunuz? Hiç sorun değil. 100% Para iade garantimiz sayesinde bu mümkün.</p>
								</div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="feature-box bg-white">
								<i class="icon-online-support"></i>

								<div class="feature-box-content p-0">
									<h3>7/24 Online Destek</h3>
									<p>Yaşadığınız herhangi bir problem ile ilgili desteğe mi ihtiyacınız var? Anında destek alabilirsiniz.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="testimonials-section">
				<div class="container">
					<h2 class="subtitle text-center">Mutlu Kullanıcılar</h2>

					<div class="testimonials-carousel owl-carousel owl-theme images-left" data-owl-options="{
						'margin': 20,
                        'lazyLoad': true,
                        'autoHeight': true,
                        'dots': false,
                        'responsive': {
                            '0': {
                                'items': 1
                            },
                            '992': {
                                'items': 2
                            }
                        }
                    }">
						<div class="testimonial">
							<div class="testimonial-owner">
								<figure>
									<img src="assets/images/clients/client1.png" alt="client">
								</figure>

								<div>
									<strong class="testimonial-title">Abdullah</strong>
									<span>Müşteri</span>
								</div>
							</div>

							<blockquote>
								<p>Onlarca ürünümü Nomee6 Store üzerinden satın aldım. En ufak problem yaşamadım. En ucuz fiyatı da sundular. Çok iyi bir yer tavsiye ederim.</p>
							</blockquote>
						</div>

						<div class="testimonial">
							<div class="testimonial-owner">
								<figure>
									<img src="assets/images/clients/client2.png" alt="client">
								</figure>

								<div>
									<strong class="testimonial-title">Mahmut</strong>
									<span>PC Teknik Servis</span>
								</div>
							</div>

							<blockquote>
								<p>Nomee6 Store üzerinden ürün aldım 15 DK içerisinde elime ulaştı. Çok memnun kaldım tavsiye ederim.</p>
							</blockquote>
						</div>
					</div>
				</div>
			</div>

			<div class="counters-section bg-gray">
				<div class="container">
					<div class="row">
						<div class="col-6 col-md-4 count-container">
							<div class="count-wrapper">
								<span class="count-to" data-from="0" data-to="200" data-speed="2000"
									data-refresh-interval="50">200</span>+
							</div>
							<h4 class="count-title">Müşteri</h4>
						</div>

						<div class="col-6 col-md-4 count-container">
							<div class="count-wrapper">
								<span class="count-to" data-from="0" data-to="1800" data-speed="2000"
									data-refresh-interval="50">50</span>+
							</div>
							<h4 class="count-title">Destek ekibi</h4>
						</div>

						<div class="col-6 col-md-4 count-container">
							<div class="count-wrapper line-height-1">
								<span class="count-to" data-from="0" data-to="24" data-speed="2000"
									data-refresh-interval="50">24</span><span>Saat</span>
							</div>
							<h4 class="count-title">Destek Kullanılabilir</h4>
						</div>

						<div class="col-6 col-md-4 count-container">
							<div class="count-wrapper">
								<span class="count-to" data-from="0" data-to="265" data-speed="2000"
									data-refresh-interval="50">265</span>+
							</div>
							<h4 class="count-title">Çözülmüş Destek İstekleri</h4>
						</div>

						<div class="col-6 col-md-4 count-container">
							<div class="count-wrapper line-height-1">
								<span class="count-to" data-from="0" data-to="99" data-speed="2000"
									data-refresh-interval="50">99</span><span>%</span>
							</div>
							<h4 class="count-title">İndirim</h4>
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