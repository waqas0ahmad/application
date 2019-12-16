<?php
require "helper.php"
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">
	<?php
echo Helper::GetFile("head-tag.html");
?>
<body id="service">
<?php
echo Helper::GetFile("header.html");
?>
	
	<div class="canvus_menu">
		<div class="container">
			<div class="toggle_icon" title="Menu Bar">
				<span></span>
			</div>
		</div>
	</div>
	<!--================ End Canvus Menu Area =================-->

	<!--================Home Banner Area =================-->
	<section class="banner_area ">
		<div class="banner_inner overlay d-flex align-items-center">
			<div class="container">
				<div class="banner_content text-left">
					<div class="page_link">
						<a href="index.html">Home</a>
						<a href="service.html">Service</a>
					</div>
					<h2>Our Services</h2>
				</div>
			</div>
		</div>
	</section>
	<!--================End Home Banner Area =================-->

	<!--================ Start Service Area =================-->
	<section class="service-area section-gap">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9 text-center">
					<div class="section-title">
						<p>We Are Providing these services</p>
						<h1>We Are <span>Crafted.</span> We Provide These <br> Services to Our Customers</h1>
					</div>
				</div>
			</div>
			<div class="row">
				<!-- single-features -->
				<div class="col-lg-3 col-sm-6 col-md-6">
					<div class="single-service">
						<div class="service-icon">
							<img src="img/service/shape1.png" alt="">
							<img class="s-icon" src="img/service/icon1.png" alt="">
							<img class="clr-icon" src="img/service/clr-icon1.png" alt="">
						</div>
						<div class="service-content">
							<h4>Story Boarding</h4>
							<p>inappropriate behavior is often laughed off as boys will be boys,” women face higher conduct standards
								especially in the workplace that’s why.</p>
						</div>
					</div>
				</div>
				<!-- single-features -->
				<div class="col-lg-3 offset-lg-1 col-sm-6 col-md-6">
					<div class="single-service">
						<div class="service-icon">
							<img src="img/service/shape1.png" alt="">
							<img class="s-icon" src="img/service/icon2.png" alt="">
							<img class="clr-icon" src="img/service/clr-icon2.png" alt="">
						</div>
						<div class="service-content">
							<h4>Story Boarding</h4>
							<p>inappropriate behavior is often laughed off as boys will be boys,” women face higher conduct standards
								especially in the workplace that’s why.</p>
						</div>
					</div>
				</div>
				<!-- single-features -->
				<div class="col-lg-3 offset-lg-1 col-sm-6 col-md-6">
					<div class="single-service">
						<div class="service-icon">
							<img src="img/service/shape1.png" alt="">
							<img class="s-icon" src="img/service/icon3.png" alt="">
							<img class="clr-icon" src="img/service/clr-icon3.png" alt="">
						</div>
						<div class="service-content">
							<h4>Story Boarding</h4>
							<p>inappropriate behavior is often laughed off as boys will be boys,” women face higher conduct standards
								especially in the workplace that’s why.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ End Service Area =================-->

	<!--================ Start Testimonial Area =================-->
	<section class="testimonial-area section-gap-bottom">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10 text-center">
					<div class="section-title">
						<p>We Are Providing these services</p>
						<h1>We Are <span>Crafted.</span> Design & Development<br> <span>Services</span> Provider.</h1>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-8 text-center">
					<div class="owl-carousel active-testi-carousel">
						<!-- single carousel -->
						<div class="single-testi-item">
							<div class="author-title">
								<div class="thumb"><img src="img/about-author.png" alt=""></div>
								<div class="a-desc">
									<h6>Marvel Maison</h6>
									<p>Chief Executive, Amazon</p>
								</div>
							</div>
							<div class="author-desc">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
									dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
									commodo consequat.</p>
							</div>
						</div>
						<!-- single carousel -->
						<div class="single-testi-item">
							<div class="author-title">
								<div class="thumb"><img src="img/about-author.png" alt=""></div>
								<div class="a-desc">
									<h6>Marvel Maison</h6>
									<p>Chief Executive, Amazon</p>
								</div>
							</div>
							<div class="author-desc">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
									dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
									commodo consequat.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ End Testimonial Area =================-->

	<!--================ start footer Area  =================-->
<?php
echo Helper::GetFile("footer.html");
?>
</body>

</html>