<?php
session_start();
include '../config.php';
$getusermail = $_SESSION["email"];
$getusername = $_SESSION["username"];

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
}

if (isset($_POST['srchsubmit'])) {
    $srchq = $_POST['searchq'];
    header("Location: ../search.php?q=$srchq");
}

$query5 = mysqli_query($conn,"SELECT * FROM users WHERE email = '$getusermail'");
$result2 = $query5->fetch_assoc();
$getuserordersid = $result2['orders'];
$getuserordersidarray = explode(",", $getuserordersid);

if (isset($_POST['saveaccdetails'])) {
	$getnewusername = $_POST['newusername'];
	$getnewemail = $_POST['newemail'];	
	$sql8 = "UPDATE users SET 
		name = '$getnewusername',
		email = '$getnewemail'
	WHERE email = '$getusermail'";
    $run_query8 = mysqli_query($conn, $sql8);
	if($run_query8) {
		header("Refresh:2 url=../login.php");
		echo "İşlem başarılı!";
		session_destroy();
	}
};

if (isset($_POST['changepasswd'])) {
	$getnowpasswd = $_POST['nowpassword'];
	$getnewpasswd = $_POST['newpassword'];
	$usernowpasswd = $result2['password'];
	if(md5($getnowpasswd) == $usernowpasswd) {
		$md5newpassword = md5($getnewpasswd);
		$sql9 = "UPDATE users SET password = '$md5newpassword' WHERE email = '$getusermail'";
    	$run_query9 = mysqli_query($conn, $sql9);
		if($run_query9) {
			header("Refresh:2 url=../login.php");
			echo "İşlem başarılı!";
			session_destroy();
		} else {
			echo "İşlem başarısız oldu.";
		}
	} else {
		echo "Şuan ki şifrenizi doğru girmediniz.";
	}
};

if (isset($_POST['savecard'])) {
	$getcardowner = $_POST['cardowner'];
	$getcardnumber = $_POST['cardnumber'];
	$getcardexpiredate = $_POST['expiredatem'] . "/" . $_POST['expiredatey'];
	$getcardcvv = $_POST['cardcvv'];
	$randnumber = rand("100000", "999999");
	$sql10 = "UPDATE users SET card = '$randnumber' WHERE email = '$getusermail'";
    $run_query10 = mysqli_query($conn, $sql10);
	$sql11 = "INSERT INTO cards (cardid, number, expiredate, cvv, owner)
			VALUES ('$randnumber', '$getcardnumber', '$getcardexpiredate', '$getcardcvv', '$getcardowner')";
	$query11 = mysqli_query($conn, $sql11);
	if($run_query10 && $query11) {
		echo "İşlem başarılı!";
	} else {
		echo "Bir hata oluştu!";
	}
};
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

        <main class="main">
			<div class="page-header">
				<div class="container d-flex flex-column align-items-center">
					<h1>Hesabım</h1>
				</div>
			</div>

			<div class="container account-container custom-account-container">
				<div class="row">
					<div class="sidebar widget widget-dashboard mb-lg-0 mb-3 col-lg-3 order-0">
						<h2 class="text-uppercase">Hesabım</h2>
						<ul class="nav nav-tabs list flex-column mb-0" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard"
									role="tab" aria-controls="dashboard" aria-selected="true">Yönetim Paneli</a>
							</li>

							<li class="nav-item">
								<a class="nav-link" id="order-tab" data-toggle="tab" href="#order" role="tab"
									aria-controls="order" aria-selected="true">Siparişlerim</a>
							</li>

							<li class="nav-item">
								<a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab"
									aria-controls="address" aria-selected="false">Kayıtlı Kartlarım</a>
							</li>

							<li class="nav-item">
								<a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab"
									aria-controls="edit" aria-selected="false">Hesap Detayları</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="../logout.php">Çıkış Yap</a>
							</li>
						</ul>
					</div>
					<div class="col-lg-9 order-lg-last order-1 tab-content">
						<div class="tab-pane fade show active" id="dashboard" role="tabpanel">
							<div class="dashboard-content">
								<p>
									Merhaba <strong class="text-dark"><?php echo $_SESSION["username"]; ?></strong>!
								</p>

								<p>
									Bu sayfa üzerinden siparişlerini görebilir hesabını yönetebilirsin.
								</p>

								<div class="mb-4"></div>

								<div class="row row-lg">
									<div class="col-6 col-md-4">
										<div class="feature-box text-center pb-4">
											<a href="#order" class="link-to-tab"><i
													class="sicon-social-dropbox"></i></a>
											<div class="feature-box-content">
												<h3>Siparişlerim</h3>
											</div>
										</div>
									</div>

									<div class="col-6 col-md-4">
										<div class="feature-box text-center pb-4">
											<a href="#address" class="link-to-tab"><i
													class="fas fa-credit-card"></i></a>
											<div class="feature-box-content">
												<h3>Kayıtlı Kartlarım</h3>
											</div>
										</div>
									</div>

									<div class="col-6 col-md-4">
										<div class="feature-box text-center pb-4">
											<a href="#edit" class="link-to-tab"><i class="icon-user-2"></i></a>
											<div class="feature-box-content p-0">
												<h3>Hesap Detayları</h3>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane fade" id="order" role="tabpanel">
							<div class="order-content">
								<h3 class="account-sub-title d-none d-md-block"><i
										class="sicon-social-dropbox align-middle mr-3"></i>Siparişlerim</h3>
								<div class="order-table-container text-center">
									<table class="table table-order text-left">
										<thead>
											<tr>
												<th class="order-id">ID</th>
												<th class="order-date">Tarih</th>
												<th class="order-date">Ürün İsmi</th>
												<th class="order-status">Durum</th>
												<th class="order-price">Tutar</th>
												<th class="order-action">Eylemler</th>
											</tr>
										</thead>
										<tbody>
											<tr>
											<?php
											if($getuserordersid != "") {
                                    			foreach($getuserordersidarray as $array) {
												$query = mysqli_query($conn,"SELECT * FROM orders WHERE orderid = '$array'");
												$result = $query->fetch_assoc();
												$orderid = $result['orderid'];
												$orderdate = $result['date'];
												$orderstatus = $result['status'];
												$orderamount = $result['amount'];
												$orderproduct = $result['product'];
												$query87 = mysqli_query($conn,"SELECT * FROM products WHERE productid = '$orderproduct'");
												$result87 = $query87->fetch_assoc();
												$productname = $result87['name'];
                                    			    echo "
													<tr>
													<td>$orderid</td>
													<td>$orderdate</td>
													<td>$productname</td>
													<td>$orderstatus</td>
													<td>₺$orderamount</td>
													<td>
													<a class=\"dropdown-item\" href=\"view_item.php?orderid=$orderid\">
													Satıcı mesajını göster
													</a>
													<a class=\"dropdown-item\" href=\"rate.php?orderid=$orderid\">
													Ürünü değerlendir
													</a>
													<a class=\"dropdown-item\" href=\"invoice.php?orderid=$orderid\">
													Faturayı Göster
													</a>
													</td>
													</tr>
													";
                                    			}
											} else {
												echo "<td class=\"text-center p-0\" colspan=\"5\">
												<p class=\"mb-5 mt-5\">
													Heniz herhangi bir siparişiniz bulunmamaktadır.
												</p>
											</td>";
											}
                                			?>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="tab-pane fade" id="address" role="tabpanel">
							<h3 class="account-sub-title d-none d-md-block mb-1"><i
									class="fas fa-credit-card align-middle mr-3"></i>Kayıtlı Kartlar</h3>
							<div class="addresses-content">
								<p class="mb-4">
									Sistemimize kaydettiğiniz tüm ödeme yöntemlerini buradan yönetebilirsiniz.
								</p>

								<div class="row">
									<div class="address col-md-6">
										<div class="heading d-flex">
											<h4 class="text-dark mb-0">Banka Kartı</h4>
										</div>
										<a href="#billing" class="btn btn-default address-action link-to-tab">Kart Detaylarını Düzenle</a>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="edit" role="tabpanel">
							<h3 class="account-sub-title d-none d-md-block mt-0 pt-1 ml-1"><i
									class="icon-user-2 align-middle mr-3 pr-1"></i>Hesap Detayları</h3>
							<div class="account-content">
								<form action="" method="POST">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="acc-name">Kullanıcı adı <span class="required">*</span></label>
												<input type="text" class="form-control" name="newusername" value="<?php echo $getusername; ?>" required />
											</div>
										</div>
									</div>

									<div class="form-group mb-4">
										<label for="acc-email">E-Posta Adresi <span class="required">*</span></label>
										<input type="email" class="form-control" name="newemail" value="<?php echo $getusermail; ?>" required />
									</div>
									<button type="submit" name="saveaccdetails" class="btn btn-dark mr-0">
											Değiklikleri Kaydet
									</button>
								</form>
								<br>
								<form action="" method="POST">
									<div class="change-password">
										<h3 class="text-uppercase mb-2">Şifre Değişimi</h3>

										<div class="form-group">
											<label for="acc-password">Şuanki Şifre</label>
											<input type="password" class="form-control" name="nowpassword" required/>
										</div>

										<div class="form-group">
											<label for="acc-password">Yeni Şifre</label>
											<input type="password" class="form-control" name="newpassword" required />
										</div>
										<div class="form-footer mt-3 mb-0">
										<button type="submit" name="changepasswd" class="btn btn-dark mr-0">
											Şifreyi Değiştir
										</button>
									</div>
									</div>
								</form>
							</div>
						</div>

						<div class="tab-pane fade" id="billing" role="tabpanel">
							<div class="address account-content mt-0 pt-2">
								<h4 class="title">Yeni Kart Bilgileri</h4>

								<form class="mb-2" action="" method="POST">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Kart Sahibi <span class="required">*</span></label>
												<input name="cardowner" type="text" class="form-control" required />
											</div>
										</div>
									</div>

									<div class="form-group">
										<label>Kart Numarası <span class="required">*</span></label>
										<input name="cardnumber" type="text" class="form-control">
									</div>

									<label>Kart Bitiş Tarihi <span class="required">*</span></label>
										<select name="expiredatem" class="form-control">
											<option value="01">01</option>
											<option value="02">02</option>
											<option value="03">03</option>
											<option value="04">04</option>
											<option value="05">05</option>
											<option value="06">06</option>
											<option value="07">07</option>
											<option value="08">08</option>
											<option value="09">09</option>
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
									<div class="form-footer mt-3 mb-0">
										<button type="submit" name="savecard" class="btn btn-dark mr-0">
											Kartı Kaydet
										</button>
									</div>
								</form>
							</div>
						</div>

						<div class="tab-pane fade" id="shipping" role="tabpanel">
							<div class="address account-content mt-0 pt-2">
								<h4 class="title mb-3">Shipping Address</h4>

								<form class="mb-2" action="#">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>First name <span class="required">*</span></label>
												<input type="text" class="form-control" required />
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Last name <span class="required">*</span></label>
												<input type="text" class="form-control" required />
											</div>
										</div>
									</div>

									<div class="form-group">
										<label>Company </label>
										<input type="text" class="form-control">
									</div>

									<div class="select-custom">
										<label>Country / Region <span class="required">*</span></label>
										<select name="orderby" class="form-control">
											<option value="" selected="selected">British Indian Ocean Territory
											</option>
											<option value="1">Brunei</option>
											<option value="2">Bulgaria</option>
											<option value="3">Burkina Faso</option>
											<option value="4">Burundi</option>
											<option value="5">Cameroon</option>
										</select>
									</div>

									<div class="form-group">
										<label>Street address <span class="required">*</span></label>
										<input type="text" class="form-control"
											placeholder="House number and street name" required />
										<input type="text" class="form-control"
											placeholder="Apartment, suite, unit, etc. (optional)" required />
									</div>

									<div class="form-group">
										<label>Town / City <span class="required">*</span></label>
										<input type="text" class="form-control" required />
									</div>

									<div class="form-group">
										<label>State / Country <span class="required">*</span></label>
										<input type="text" class="form-control" required />
									</div>

									<div class="form-group">
										<label>Postcode / ZIP <span class="required">*</span></label>
										<input type="text" class="form-control" required />
									</div>

									<div class="form-footer mb-0">
										<div class="form-footer-right">
											<button type="submit" class="btn btn-dark py-4">
												Save Address
											</button>
										</div>
									</div>
								</form>
							</div>
						</div><!-- End .tab-pane -->
					</div><!-- End .tab-content -->
				</div><!-- End .row -->
			</div><!-- End .container -->

			<div class="mb-5"></div><!-- margin -->
		</main><!-- End .main -->

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