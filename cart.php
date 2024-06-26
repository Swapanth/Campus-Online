<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>

<head>

	<!-- Basic -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Campus Online</title>

	<meta name="keywords" content="WebSite Template" />
	<meta name="description" content="Porto - Multipurpose Website Template">
	<meta name="author" content="okler.net">

	<!-- Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	<link rel="apple-touch-icon" href="img/apple-touch-icon.png">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

	<!-- Web Fonts  -->
	<link id="googleFonts" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800%7CShadows+Into+Light%7CPlayfair+Display:400&display=swap" rel="stylesheet" type="text/css">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="vendor/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="vendor/animate/animate.compat.css">
	<link rel="stylesheet" href="vendor/simple-line-icons/css/simple-line-icons.min.css">
	<link rel="stylesheet" href="vendor/owl.carousel/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="vendor/owl.carousel/assets/owl.theme.default.min.css">
	<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.min.css">
	<link rel="stylesheet" href="vendor/bootstrap-star-rating/css/star-rating.min.css">
	<link rel="stylesheet" href="vendor/bootstrap-star-rating/themes/krajee-fas/theme.min.css">

	<!-- Theme CSS -->
	<link rel="stylesheet" href="css/theme.css">
	<link rel="stylesheet" href="css/theme-elements.css">
	<link rel="stylesheet" href="css/theme-blog.css">
	<link rel="stylesheet" href="css/theme-shop.css">

	<!-- Skin CSS -->
	<link id="skinCSS" rel="stylesheet" href="css/skins/default.css">

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="css/custom.css">

	<!-- latest css -->
	<link rel="stylesheet" href="css/latest.css">
	<style>
		body::after {
			content: "";
			display: table;
			clear: both;
			background-color: lightgreen;

		}

		.left-section {
			float: left;
			width: 30%;
			/* Takes up 1/3 of the available space */
			box-sizing: border-box;

		}

		.left-section-top {
			background-color: white;
			color: black;
			text-align: center;
			padding: 20px;
			margin: 5px;
			min-height: 40px;
			max-height: 70px;
			line-height: 70px;
			/* Set line-height equal to max-height to vertically center text */
			display: flex;
			align-items: center;
			justify-content: center;
			border-radius: 5px;
			margin-left: 30px;

		}

		.left-section-top img {
			vertical-align: middle;
			/* Vertically center the image */
			/* Adjust margin as needed */
			margin-left: -70px;
			/* Adjust margin as needed to move the image slightly to the left */
		}

		.left-section-top h4 {
			margin: 0;
			color: black;
			/* Remove default margin for h1 */
		}

		.left-section-bottom {
			background-color: white;
			color: white;
			text-align: center;
			padding: 20px;
			margin: 5px;
			min-height: 450px;
			border-radius: 5px;
			margin-left: 30px;
		}

		.right-section {
			float: left;
			width: 70%;
			/* Takes up 2/3 of the available space */
			box-sizing: border-box;
			min-height: 570px;

		}

		.right-section-inner {
			background-color: white;
			/* Adjust the color as needed */
			color: black;
			/* Set the text color to be visible */
			text-align: center;
			/* Center the text horizontally */
			padding: 20px;
			margin: 5px;
			margin-right: 200px;
			border-radius: 5px;
			margin-right: 40px;
			margin-bottom: 20px;
			min-height: 570px;

		}

		.profile-menu {
			list-style: none;
			padding: 10px;
			margin: 20px;
			margin-right: 30px;
		}

		.profile-menu li {
			margin-bottom: 20px;
			margin-top: 20px;
		}

		.profile-menu a {
			text-decoration: none !important;
			/* Added !important */
			color: #0088cc;
			display: flex;
			/* Use flex to align icon and text horizontally */
			align-items: center;
			/* Center items vertically */
			padding: 10px;
			border-radius: 5px;
			transition: background-color 0.3s;
			font-size: larger;
		}

		.profile-menu a svg {
			margin-right: 10px;
			/* Add margin to separate icon from text */
		}

		.profile-menu a:hover {
			background-color: #0088cc;
			color: white;

			text-decoration: none !important;
			/* Added !important */
		}
	</style>
</head>

<body data-plugin-page-transition>

	<?php include 'header.php'; ?>
	<div class="body">
		<div class="left-section">
			<?php
			// Start or resume the session


			// Include the file to establish a database connection
			include 'connect.php';

			// Check if the session variable 'reg_no' is set
			if (isset($_SESSION['idnum'])) {
				// Sanitize the session variable to prevent SQL injection
				$reg_no = mysqli_real_escape_string($conn, $_SESSION['idnum']);

				// Fetch data from the users table based on the session variable 'reg_no'
				$sql = "SELECT * FROM users WHERE reg_no = '$reg_no'";

				// Execute the query
				$result = mysqli_query($conn, $sql);

				// Check if there are any results
				if (mysqli_num_rows($result) > 0) {
					// Output data of the user
					while ($row = mysqli_fetch_assoc($result)) {
						// Extract the first name from the user's name
						$fullName = explode(" ", $row['firstname']);
						$firstName = $fullName[0];
			?>
						<div class="left-section-top">
							<a href="img/12.png"> <img src="img/12.png" alt="12" width="100" height="100"> </a>
							Hello&nbsp;
							<h4> <?php echo $firstName; ?></h4>
						</div>
			<?php
					}
				} else {
					// If there are no results, display a message or take any other appropriate action
					echo "No user found.";
				}
			} else {
				// If the session variable 'reg_no' is not set, display a message or redirect to login page
				echo "Session variable 'reg_no' not set.";
			}

			// Close the database connection
			mysqli_close($conn);
			?>
			<div class="left-section-bottom">
				<div class="col-lg-4 position-relative">
					<div class="card border-width-3 border-radius-0 border-color-hover-dark" style="min-height: 450px; width: 300px;">
						<div class="card-body">
							<h4 class="font-weight-bold text-uppercase text-4 mb-3">Cart Totals</h4>
							<table class="shop_table cart-totals mb-4">
								<tbody>
									<?php
									// Assuming you have already established a database connection
									include 'connect.php';

									// Assuming $_SESSION['idnum'] contains the registration number
									$idnum = $_SESSION['idnum'];

									// Initialize total sale price
									$totalSalePrice = 0;

									$sql = "SELECT seller.productid, seller.productName, seller.salePrice, cart.cart_quantity 
									FROM seller 
									INNER JOIN cart ON seller.productid = cart.productid 
									WHERE cart.reg_no = '$idnum'";
									$result = $conn->query($sql);

									// Check if there are any results
									if ($result->num_rows > 0) {
										// Output data of each row
										while ($row = $result->fetch_assoc()) {
											// Output product name and sale price in HTML table row
											echo '<tr>';
											echo '<td>' . htmlspecialchars($row['productName']) . '</td>';
											echo '<td>₹' . htmlspecialchars($row['salePrice']) . '</td>';
											echo '<td>x ' . htmlspecialchars($row['cart_quantity']) . '</td>';
											echo '</tr>';

											// Accumulate sale price to calculate total
											$totalSalePrice += $row['salePrice']* $row['cart_quantity'];
											$productid = $row['productid'];
										}
									} else {
										// Output if no results found
										echo '<tr><td colspan="2">No products found</td></tr>';
									}

									// Close the database connection
									$conn->close();

									// Print total sale price row
									echo '<tr class="total">';
									echo '<td><strong class="text-color-dark text-3-5">Total</strong></td>';
									echo '<td class="text-end"><strong class="text-color-dark">';
									echo '<span class="amount text-color-dark text-5">₹' . number_format($totalSalePrice, 2) . '</span></strong></td>';
									echo '</tr>';
									?>
									<tr class="cart-subtotal">
										<td class="border-top-0">
											<strong class="text-color-dark"></strong>
										</td>
										
									</tr>
									
								</tbody>
							</table>
							<a href="checkout.php?productid=<?php echo $productid; ?>&totalSalePrice=<?php echo $totalSalePrice; ?>" class="btn btn-dark btn-modern w-100 text-uppercase bg-color-hover-primary border-color-hover-primary border-radius-0 text-3 py-3">
								Proceed to Checkout <i class="fas fa-arrow-right ms-2"></i>
							</a>


						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<div class="right-section">
		<div class="right-section-inner">

			<div role="main" class="main shop pb-4">
				<h4 style="text-align: left; color:#0088cc">Shopping Cart</h4>

				<div class="container">


					<div class="row pb-4 mb-5">
						<div class="col-lg-8 mb-5 mb-lg-0">
							<form method="post" action="">
								<div class="">
									<table class="shop_table cart">
										<thead>
											<tr class="text-color-dark">
												<th class="product-thumbnail" width="15%">
													&nbsp;
												</th>
												<th class="product-name text-uppercase" width="30%">
													Product
												</th>


												<th class="product-subtotal text-uppercase text-end" width="20%">
													Subtotal
												</th>

												<th class="product-remove text-uppercase text-end" width="20%">
													Quantity
												</th>


											</tr>
										</thead>
										<tbody>

											<?php
											// Include the file to establish a database connection
											include 'connect.php';

											// Fetch data from the seller table based on matches with the cart table
											$sql = "SELECT  
            seller.productid,
            seller.productName,
            seller.image,
            seller.salePrice,
            cart.cart_quantity,
			seller.productid 
        FROM 
            seller
        INNER JOIN 
            cart ON seller.productid = cart.productid 
        WHERE 
            cart.reg_no = '$_SESSION[idnum]'";


											// Execute the query
											$result = mysqli_query($conn, $sql);

											// Check if there are any results
											if (mysqli_num_rows($result) > 0) {
												// Output data of each row
												while ($row = mysqli_fetch_assoc($result)) {
													// Output the HTML structure with product details
											?>
													<tr class="cart_table_item product-thumbnail-wrapperr">
														<td class="product-thumbnail" style="height: 100px; width: 100px !important;">
															<div class="product-thumbnail-wrapper" style="height: 100px; width: 100px !important;">

																<a href="shop-product-sidebar-right.html" class="product-thumbnail-image" title="<?php echo $row['productName']; ?>">
																	<img width="250" height="250" alt="<?php echo $row['productName']; ?>" class="img-fluid" src="<?php echo $row['image']; ?>">
																</a>
															</div>
														</td>
														<td class="product-name">
															<a href="shop-product-sidebar-right.html" class="font-weight-semi-bold text-color-dark text-color-hover-primary text-decoration-none"><?php echo $row['productName']; ?></a>
														</td>


														<td class="product-subtotal text-end">
															<span class="amount text-color-dark font-weight-bold text-4">₹<?php echo $row['salePrice']; ?></span>
														</td>

														<td class="product-remove text-end">

														<div class="dustbin-button">
															<a href="#" class="dustbin-button" title="Delete Product" data-product-id="<?php echo $row['productid']; ?>">
																<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-minus-fill" viewBox="0 0 16 16">
																	<path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M6 7.5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1 0-1" />
																</svg>
															</a>
														</div>

															<h2><?php echo $row['cart_quantity']; ?></h2>


															<div class="addtocart-btn">
																<a href="#" class="text-decoration-none addtocart-btn" title="Add to Cart" data-product-id="<?php echo $row['productid']; ?>">
																	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-plus-fill" viewBox="0 0 16 16">
																		<path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M8.5 6v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 1 0" />
																	</svg>
																</a>
															</div>
														</td>
													</tr>







											<?php
												}
											} else {
												// If there are no results, you can display a message or take any other appropriate action
												echo "0 results";
											}

											// Close the database connection
											mysqli_close($conn);
											?>

											<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
											<script>
												$(document).ready(function() {
													$('.dustbin-button').click(function(e) {
														e.preventDefault();
														var productId = $(this).data('product-id');
														$.ajax({
															url: 'removecart.php',
															method: 'POST',
															data: {
																productId: productId
															},
															success: function(response) {


																// Check if the page has been reloaded already
																if (!sessionStorage.getItem('reloaded')) {
																	// Set the flag in sessionStorage to indicate that the page has been reloaded
																	sessionStorage.setItem('reloaded', 'true');
																	// Reload the page
																	window.location.reload();
																} else {
																	// Remove the 'reloaded' flag from sessionStorage
																	sessionStorage.removeItem('reloaded');
																}

															},
															error: function(xhr, status, error) {
																console.error(xhr.responseText);
															}
														});
													});
												});
											</script>
											<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
											<script>
												$(document).ready(function() {
													$('.addtocart-btn').click(function(e) {
														e.preventDefault();
														var productId = $(this).data('product-id');
														$.ajax({
															url: 'insertcart.php',
															method: 'POST',
															data: {
																productId: productId
															},
															success: function(response) {
																// Create a success message element
																var successMessage = $('<div/>', {
																	text: response,
																	class: 'success-message'
																});
																// Append the success message to the body
																$('body').append(successMessage);
																// Fade out the success message after a certain duration
																setTimeout(function() {
																	successMessage.fadeOut('slow');
																	// Reload the page
																	location.reload();
																}, 2000);
															},
															error: function(xhr, status, error) {
																console.error(xhr.responseText);
															}
														});
													});
												});
											</script>

											<style>
												.success-message {
													position: fixed;
													top: 90px;
													right: 20px;
													background-color: #4CAF50;
													color: white;
													padding: 15px;
													border-radius: 5px;
													z-index: 9999;
												}
											</style>

										</tbody>
									</table>
								</div>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- <div class="row">
		<div class="col" style="background-color: white; padding:10px">
			<h4 class="font-weight-semibold text-4 mb-3" style="margin-left: 30px;">PEOPLE ALSO BOUGHT</h4>
			<hr class="mt-0">
			<div class="products row">
				<div class="col">
					<div class="owl-carousel owl-theme nav-style-1 nav-outside nav-outside nav-dark mb-0" data-plugin-options="{'loop': false, 'autoplay': false, 'items': 4, 'nav': true, 'dots': false, 'margin': 20, 'autoplayHoverPause': true, 'autoHeight': true, 'stagePadding': '75', 'navVerticalOffset': '50px'}">

						<div class="product mb-0">
							<div class="product-thumb-info border-0 mb-3">

								<div class="product-thumb-info-badges-wrapper">
									<span class="badge badge-ecommerce text-bg-success">NEW</span>

								</div>

								<div class="addtocart-btn-wrapper">
									<a href="shop-cart.html" class="text-decoration-none addtocart-btn" title="Add to Cart">
										<i class="icons icon-bag"></i>
									</a>
								</div>

								<a href="ajax/shop-product-quick-view.html" class="quick-view text-uppercase font-weight-semibold text-2">
									QUICK VIEW
								</a>
								<a href="shop-product-sidebar-left.html">
									<div class="product-thumb-info-image">
										<img alt="" class="img-fluid" src="img/products/product-grey-1.jpg">

									</div>
								</a>
							</div>
							<div class="d-flex justify-content-between">
								<div>
									<a href="#" class="d-block text-uppercase text-decoration-none text-color-default text-color-hover-primary line-height-1 text-0 mb-1">electronics</a>
									<h3 class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0"><a href="shop-product-sidebar-right.html" class="text-color-dark text-color-hover-primary">Photo Camera</a></h3>
								</div>
								<a href="#" class="text-decoration-none text-color-default text-color-hover-dark text-4"><i class="far fa-heart"></i></a>
							</div>
							<div title="Rated 5 out of 5">
								<input type="text" class="d-none" value="5" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'default', 'size':'xs'}">
							</div>
							<p class="price text-5 mb-3">
								<span class="sale text-color-dark font-weight-semi-bold">$69,00</span>
								<span class="amount">$59,00</span>
							</p>
						</div>

						<div class="product mb-0">
							<div class="product-thumb-info border-0 mb-3">

								<div class="product-thumb-info-badges-wrapper">
									<span class="badge badge-ecommerce text-bg-success">NEW</span>
									<span class="badge badge-ecommerce text-bg-danger">27% OFF</span>
								</div>

								<div class="addtocart-btn-wrapper">
									<a href="shop-cart.html" class="text-decoration-none addtocart-btn" title="Add to Cart">
										<i class="icons icon-bag"></i>
									</a>
								</div>

								<a href="ajax/shop-product-quick-view.html" class="quick-view text-uppercase font-weight-semibold text-2">
									QUICK VIEW
								</a>
								<a href="shop-product-sidebar-left.html">
									<div class="product-thumb-info-image product-thumb-info-image-effect">
										<img alt="" class="img-fluid" src="img/products/product-grey-7.jpg">

										<img alt="" class="img-fluid" src="img/products/product-grey-7-2.jpg">

									</div>
								</a>
							</div>
							<div class="d-flex justify-content-between">
								<div>
									<a href="#" class="d-block text-uppercase text-decoration-none text-color-default text-color-hover-primary line-height-1 text-0 mb-1">accessories</a>
									<h3 class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0"><a href="shop-product-sidebar-right.html" class="text-color-dark text-color-hover-primary">Porto Headphone</a></h3>
								</div>
								<a href="#" class="text-decoration-none text-color-default text-color-hover-dark text-4"><i class="far fa-heart"></i></a>
							</div>
							<div title="Rated 5 out of 5">
								<input type="text" class="d-none" value="5" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'default', 'size':'xs'}">
							</div>
							<p class="price text-5 mb-3">
								<span class="sale text-color-dark font-weight-semi-bold">$199,00</span>
								<span class="amount">$99,00</span>
							</p>
						</div>

						<div class="product mb-0">
							<div class="product-thumb-info border-0 mb-3">

								<div class="addtocart-btn-wrapper">
									<a href="shop-cart.html" class="text-decoration-none addtocart-btn" title="Add to Cart">
										<i class="icons icon-bag"></i>
									</a>
								</div>

								<a href="ajax/shop-product-quick-view.html" class="quick-view text-uppercase font-weight-semibold text-2">
									QUICK VIEW
								</a>
								<a href="shop-product-sidebar-left.html">
									<div class="product-thumb-info-image">
										<img alt="" class="img-fluid" src="img/products/product-grey-2.jpg">

									</div>
								</a>
							</div>
							<div class="d-flex justify-content-between">
								<div>
									<a href="#" class="d-block text-uppercase text-decoration-none text-color-default text-color-hover-primary line-height-1 text-0 mb-1">sports</a>
									<h3 class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0"><a href="shop-product-sidebar-right.html" class="text-color-dark text-color-hover-primary">Golf Bag</a></h3>
								</div>
								<a href="#" class="text-decoration-none text-color-default text-color-hover-dark text-4"><i class="far fa-heart"></i></a>
							</div>
							<div title="Rated 5 out of 5">
								<input type="text" class="d-none" value="5" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'default', 'size':'xs'}">
							</div>
							<p class="price text-5 mb-3">
								<span class="sale text-color-dark font-weight-semi-bold">$29,00</span>
								<span class="amount">$19,00</span>
							</p>
						</div>

						<div class="product mb-0">
							<div class="product-thumb-info border-0 mb-3">

								<div class="product-thumb-info-badges-wrapper">

									<span class="badge badge-ecommerce text-bg-danger">27% OFF</span>
								</div>

								<div class="addtocart-btn-wrapper">
									<a href="shop-cart.html" class="text-decoration-none addtocart-btn" title="Add to Cart">
										<i class="icons icon-bag"></i>
									</a>
								</div>

								<div class="countdown-offer-wrapper">
									<div class="text-color-light text-2" data-plugin-countdown data-plugin-options="{'textDay': 'DAYS', 'textHour': 'HRS', 'textMin': 'MIN', 'textSec': 'SEC', 'date': '2025/01/01 12:00:00', 'numberClass': 'text-color-light', 'wrapperClass': 'text-color-light', 'insertHTMLbefore': '<span>OFFER ENDS IN </span>', 'textDay': 'DAYS', 'textHour': ':', 'textMin': ':', 'textSec': '', 'uppercase': true}"></div>
								</div>

								<a href="ajax/shop-product-quick-view.html" class="quick-view text-uppercase font-weight-semibold text-2">
									QUICK VIEW
								</a>
								<a href="shop-product-sidebar-left.html">
									<div class="product-thumb-info-image">
										<img alt="" class="img-fluid" src="img/products/product-grey-3.jpg">

									</div>
								</a>
							</div>
							<div class="d-flex justify-content-between">
								<div>
									<a href="#" class="d-block text-uppercase text-decoration-none text-color-default text-color-hover-primary line-height-1 text-0 mb-1">sports</a>
									<h3 class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0"><a href="shop-product-sidebar-right.html" class="text-color-dark text-color-hover-primary">Workout</a></h3>
								</div>
								<a href="#" class="text-decoration-none text-color-default text-color-hover-dark text-4"><i class="far fa-heart"></i></a>
							</div>
							<div title="Rated 5 out of 5">
								<input type="text" class="d-none" value="5" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'default', 'size':'xs'}">
							</div>
							<p class="price text-5 mb-3">
								<span class="sale text-color-dark font-weight-semi-bold">$40,00</span>
								<span class="amount">$30,00</span>
							</p>
						</div>

						<div class="product mb-0">
							<div class="product-thumb-info border-0 mb-3">

								<div class="addtocart-btn-wrapper">
									<a href="shop-cart.html" class="text-decoration-none addtocart-btn" title="Add to Cart">
										<i class="icons icon-bag"></i>
									</a>
								</div>

								<a href="ajax/shop-product-quick-view.html" class="quick-view text-uppercase font-weight-semibold text-2">
									QUICK VIEW
								</a>
								<a href="shop-product-sidebar-left.html">
									<div class="product-thumb-info-image">
										<img alt="" class="img-fluid" src="img/products/product-grey-4.jpg">

									</div>
								</a>
							</div>
							<div class="d-flex justify-content-between">
								<div>
									<a href="#" class="d-block text-uppercase text-decoration-none text-color-default text-color-hover-primary line-height-1 text-0 mb-1">accessories</a>
									<h3 class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0"><a href="shop-product-sidebar-right.html" class="text-color-dark text-color-hover-primary">Luxury Bag</a></h3>
								</div>
								<a href="#" class="text-decoration-none text-color-default text-color-hover-dark text-4"><i class="far fa-heart"></i></a>
							</div>
							<div title="Rated 5 out of 5">
								<input type="text" class="d-none" value="5" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'default', 'size':'xs'}">
							</div>
							<p class="price text-5 mb-3">
								<span class="sale text-color-dark font-weight-semi-bold">$99,00</span>
								<span class="amount">$79,00</span>
							</p>
						</div>

						<div class="product mb-0">
							<div class="product-thumb-info border-0 mb-3">

								<div class="addtocart-btn-wrapper">
									<a href="shop-cart.html" class="text-decoration-none addtocart-btn" title="Add to Cart">
										<i class="icons icon-bag"></i>
									</a>
								</div>

								<a href="ajax/shop-product-quick-view.html" class="quick-view text-uppercase font-weight-semibold text-2">
									QUICK VIEW
								</a>
								<a href="shop-product-sidebar-left.html">
									<div class="product-thumb-info-image">
										<img alt="" class="img-fluid" src="img/products/product-grey-5.jpg">

									</div>
								</a>
							</div>
							<div class="d-flex justify-content-between">
								<div>
									<a href="#" class="d-block text-uppercase text-decoration-none text-color-default text-color-hover-primary line-height-1 text-0 mb-1">accessories</a>
									<h3 class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0"><a href="shop-product-sidebar-right.html" class="text-color-dark text-color-hover-primary">Styled Bag</a></h3>
								</div>
								<a href="#" class="text-decoration-none text-color-default text-color-hover-dark text-4"><i class="far fa-heart"></i></a>
							</div>
							<div title="Rated 5 out of 5">
								<input type="text" class="d-none" value="5" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'default', 'size':'xs'}">
							</div>
							<p class="price text-5 mb-3">
								<span class="sale text-color-dark font-weight-semi-bold">$199,00</span>
								<span class="amount">$119,00</span>
							</p>
						</div>

						<div class="product mb-0">
							<div class="product-thumb-info border-0 mb-3">

								<div class="addtocart-btn-wrapper">
									<a href="shop-cart.html" class="text-decoration-none addtocart-btn" title="Add to Cart">
										<i class="icons icon-bag"></i>
									</a>
								</div>

								<a href="ajax/shop-product-quick-view.html" class="quick-view text-uppercase font-weight-semibold text-2">
									QUICK VIEW
								</a>
								<a href="shop-product-sidebar-left.html">
									<div class="product-thumb-info-image">
										<img alt="" class="img-fluid" src="img/products/product-grey-6.jpg">

									</div>
								</a>
							</div>
							<div class="d-flex justify-content-between">
								<div>
									<a href="#" class="d-block text-uppercase text-decoration-none text-color-default text-color-hover-primary line-height-1 text-0 mb-1">hat</a>
									<h3 class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0"><a href="shop-product-sidebar-right.html" class="text-color-dark text-color-hover-primary">Blue Hat</a></h3>
								</div>
								<a href="#" class="text-decoration-none text-color-default text-color-hover-dark text-4"><i class="far fa-heart"></i></a>
							</div>
							<div title="Rated 5 out of 5">
								<input type="text" class="d-none" value="5" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'default', 'size':'xs'}">
							</div>
							<p class="price text-5 mb-3">
								<span class="sale text-color-dark font-weight-semi-bold">$299,00</span>
								<span class="amount">$289,00</span>
							</p>
						</div>

						<div class="product mb-0">
							<div class="product-thumb-info border-0 mb-3">

								<div class="addtocart-btn-wrapper">
									<a href="shop-cart.html" class="text-decoration-none addtocart-btn" title="Add to Cart">
										<i class="icons icon-bag"></i>
									</a>
								</div>

								<a href="ajax/shop-product-quick-view.html" class="quick-view text-uppercase font-weight-semibold text-2">
									QUICK VIEW
								</a>
								<a href="shop-product-sidebar-left.html">
									<div class="product-thumb-info-image">
										<img alt="" class="img-fluid" src="img/products/product-grey-8.jpg">

									</div>
								</a>
							</div>
							<div class="d-flex justify-content-between">
								<div>
									<a href="#" class="d-block text-uppercase text-decoration-none text-color-default text-color-hover-primary line-height-1 text-0 mb-1">accessories</a>
									<h3 class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0"><a href="shop-product-sidebar-right.html" class="text-color-dark text-color-hover-primary">Adventurer Bag</a></h3>
								</div>
								<a href="#" class="text-decoration-none text-color-default text-color-hover-dark text-4"><i class="far fa-heart"></i></a>
							</div>
							<div title="Rated 5 out of 5">
								<input type="text" class="d-none" value="5" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'default', 'size':'xs'}">
							</div>
							<p class="price text-5 mb-3">
								<span class="sale text-color-dark font-weight-semi-bold">$99,00</span>
								<span class="amount">$79,00</span>
							</p>
						</div>

						<div class="product mb-0">
							<div class="product-thumb-info border-0 mb-3">

								<div class="addtocart-btn-wrapper">
									<a href="shop-cart.html" class="text-decoration-none addtocart-btn" title="Add to Cart">
										<i class="icons icon-bag"></i>
									</a>
								</div>

								<a href="ajax/shop-product-quick-view.html" class="quick-view text-uppercase font-weight-semibold text-2">
									QUICK VIEW
								</a>
								<a href="shop-product-sidebar-left.html">
									<div class="product-thumb-info-image">
										<img alt="" class="img-fluid" src="img/products/product-grey-9.jpg">

									</div>
								</a>
							</div>
							<div class="d-flex justify-content-between">
								<div>
									<a href="#" class="d-block text-uppercase text-decoration-none text-color-default text-color-hover-primary line-height-1 text-0 mb-1">sports</a>
									<h3 class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0"><a href="shop-product-sidebar-right.html" class="text-color-dark text-color-hover-primary">Baseball Ball</a></h3>
								</div>
								<a href="#" class="text-decoration-none text-color-default text-color-hover-dark text-4"><i class="far fa-heart"></i></a>
							</div>
							<div title="Rated 5 out of 5">
								<input type="text" class="d-none" value="5" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'default', 'size':'xs'}">
							</div>
							<p class="price text-5 mb-3">
								<span class="sale text-color-dark font-weight-semi-bold">$399,00</span>
								<span class="amount">$299,00</span>
							</p>
						</div>

					</div>
				</div>
			</div> -->
	<div>
		<?php include 'footer.php'; ?>
	</div>


	<!-- Vendor -->
	<script src="vendor/plugins/js/plugins.min.js"></script>
	<script src="vendor/bootstrap-star-rating/js/star-rating.min.js"></script>
	<script src="vendor/bootstrap-star-rating/themes/krajee-fas/theme.min.js"></script>
	<script src="vendor/jquery.countdown/jquery.countdown.min.js"></script>

	<!-- Theme Base, Components and Settings -->
	<script src="js/theme.js"></script>

	<!-- Current Page Vendor and Views -->
	<script src="js/views/view.shop.js"></script>

	<!-- Theme Custom -->
	<script src="js/custom.js"></script>

	<!-- Theme Initialization Files -->
	<script src="js/theme.init.js"></script>
	<!-- 
					// Assuming you have a variable selectedProductCount that represents the count
const selectedProductCount = 1;

// Update the count badge text
document.querySelector('.count-badge').textContent = selectedProductCount.toString(); -->

	<script>
		//Get all elements with the class 'product-thumbnail-remove'
		var removeButtons = document.querySelectorAll('.product-thumbnail-remove');

		// Loop through each remove button and attach a click event listener
		removeButtons.forEach(function(button) {
			button.addEventListener('click', function(event) {
				event.preventDefault(); // Prevent the default behavior of the anchor tag

				// Get the parent element of the remove button (the product thumbnail wrapper)
				var productThumbnailWrapper = button.closest('.product-thumbnail-wrapperr');

				// Remove the product thumbnail wrapper from the DOM
				productThumbnailWrapper.remove();
			});
		});
	</script>
</body>

</html>