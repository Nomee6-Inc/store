<?php
session_start();
include 'config.php';

if (isset($_POST['srchsubmit'])) {
    $srchq = $_POST['searchq'];
    header("Location: search.php?q=$srchq");
}

if (isset($_POST['login'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql2 = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$result2 = mysqli_query($conn, $sql2);
	if ($result2->num_rows > 0) {
		$row = mysqli_fetch_assoc($result2);
		$_SESSION['username'] = $row['name'];
		$_SESSION['email'] = $row['email'];
		header("Location: user/");
	} else {
		echo "<script>alert('Bir hata oluştu! E-Posta veya şifre yanlış.')</script>";
	}
}

if (isset($_POST['register'])) {
	$registeremail = $_POST['register-email'];
	$registerusername = $_POST['register-username'];
	$registerpassword = md5($_POST['register-password']);
		$sql = "SELECT * FROM users WHERE email='$registeremail'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
            $randommd5create = md5(rand());
			$sql = "INSERT INTO users (email, name, password, sellertoken)
					VALUES ('$registeremail', '$registerusername', '$registerpassword', '$randommd5create')";
			$result = mysqli_query($conn, $sql);

			if ($result) {
        		echo "<script>alert('Kayıt İşlemi Başarılı.')</script>";
				$registerusername = "";
				$registeremail = "";
	    		$_POST['password'] = "";
			} else {
				echo "<script>alert('Bir hata oluştu.')</script>";
			}
		} else {
			echo "<script>alert('Mail adresi zaten kullanılmakta.')</script>";
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
			<div class="page-header">
				<div class="container d-flex flex-column align-items-center">
					<h1>Hesap</h1>
				</div>
			</div>

			<div class="container login-container">
				<div class="row">
					<div class="col-lg-10 mx-auto">
						<div class="row">
							<div class="col-md-6">
								<div class="heading mb-1">
									<h2 class="title">Giriş Yap</h2>
								</div>

								<form action="" method="POST">
									<label for="login-email">
										E-Posta
										<span class="required">*</span>
									</label>
									<input type="email" class="form-input form-wide" name="email" required />

									<label for="login-password">
										Şifre
										<span class="required">*</span>
									</label>
									<input type="password" class="form-input form-wide" name="password" required />
                                <div class="form-footer mb-2">
									<button type="submit" name="login" class="btn btn-dark btn-md w-100">
										Giriş Yap
									</button>
                                </div>
								</form>
							</div>
							<div class="col-md-6">
								<div class="heading mb-1">
									<h2 class="title">Kayıt Ol</h2>
								</div>

								<form action="" method="POST">
                                <label for="register-email">
										Kullanıcı adı
										<span class="required">*</span>
									</label>
								<input type="text" class="form-input form-wide" name="register-username" required />
									
                                    <label for="register-email">
										E-Posta
										<span class="required">*</span>
									</label>
									<input type="email" class="form-input form-wide" name="register-email" required />

									<label for="register-password">
										Şifre
										<span class="required">*</span>
									</label>
									<input type="password" class="form-input form-wide" name="register-password"
										required />

									<div class="form-footer mb-2">
										<button type="submit" name="register" class="btn btn-dark btn-md w-100 mr-0">
											Kayıt Ol
										</button>
									</div>
								</form>
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