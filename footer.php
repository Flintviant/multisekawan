<!-- Start Footer Section -->
		<footer class="footer-section container-fluid">
			<div class="relative">

				<!--<div class="sofa-img">
					<img src="assets/open.webp" alt="Image" class="img-fluid">
				</div>-->

				<?php
                    if(isset($_POST['kirim'])){
                    $name  = $_POST['name'];
                    $email  = $_POST['email'];
                    $message     = $_POST['message'];

                    echo "<script>window.location = 'https://wa.me/6281292314213?&text=Name:+$name%20Email:+$email%20Message:+$message&source=&data='</script>";

                    }
                ?>

				<div class="row">
					<div class="col-lg-8">
						<div class="subscription-form">
							<h3 class="d-flex align-items-center"><span class="me-1"><img src="images/envelope-outline.svg" alt="Image" class="img-fluid"></span><span>Send Your Message</span></h3>

							<form action="" class="row g-3" method="post" target="blank__">
								<div class="col-6">
									<input type="text" name="name" class="form-control" placeholder="Enter your name" required>
								</div>
								<div class="col-6">
									<input type="email" name="email" class="form-control" placeholder="Enter your email">
								</div>
								<div class="col-12">
									<textarea type="text" name="message" class="form-control" placeholder="Enter your message" required></textarea>
								</div>
								<div class="d-grid gap-2">
									<button class="btn btn-primary" type="submit" name="kirim">
										<span class="fa fa-paper-plane"></span>
									</button>
								</div>
							</form>
						</div>
					</div>

					<div class="col-lg-4 mb-5">
						<img src="assets/sekawanbuilding.jpg" alt="Image" class="img-fluid">
					</div>

				</div>

				<div class="row g-5 mb-5">
					<div class="col-lg-4">
						<div class="mb-2 footer-logo-wrap"><a href="#" class="footer-logo">SekaOne<span>.</span></a></div>

						<div class="col-lg-10 mb-5">
							<div class="row links-wrap">
								<div class="col-6 col-sm-6 col-md-5">
									<ul class="list-unstyled">
										<li><a href="<?=$defaulturl?>">Home</a></li>
										<li><a href="about.php">About us</a></li>
										<li><a href="services.php">Product</a></li>
									</ul>
								</div>

								<div class="col-6 col-sm-6 col-md-5">
									<ul class="list-unstyled">
										<li><a href="newsportal" target="blank__">Blog</a></li>
										<li><a href="contact.php">Contact us</a></li>
									</ul>
								</div>
							</div>
						</div>

						<ul class="list-unstyled custom-social">
							<li><a href="https://web.facebook.com/profile.php?id=100092223199967" target="blank__"><span class="fa fa-brands fa-facebook-f"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
							<li><a href="https://www.instagram.com/sekaoneid/" target="blank__"><span class="fa fa-brands fa-instagram"></span></a></li>
							<li><a href="https://www.linkedin.com/in/pt-multi-sekawan-internasional-bb3b4726b/" target="blank__"><span class="fa fa-brands fa-linkedin"></span></a></li>
						</ul>
					</div>

				</div>

				<div class="border-top copyright">
					<div class="row pt-4">
						<div class="col-lg-6">
							<p class="mb-2 text-center text-lg-start">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; Designed with love by <a href="https://www.instagram.com/dion_arfian14/" target="blank__">SekaOne</a> <!-- License information: https://untree.co/license/ -->
            				</p>
						</div>

						<div class="col-lg-6 text-center text-lg-end">
							<ul class="list-unstyled d-inline-flex ms-auto">
								<li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div>

					</div>
				</div>

			</div>

			<div id="whatsapp-logo">
			    <a href="https://wa.me/6281292314213?" target="_blank">
			        <span class="fa fa-brands fa-whatsapp fa-4x" style="color: green;"></span>
			    </a>
			</div>

		</footer>
		<!-- End Footer Section -->

		<script src="<?=$defaulturl?>js/main.js"></script>
		<script src="<?=$defaulturl?>js/owl.caraousel.min.js"></script>
		<script src="<?=$defaulturl?>js/aos.js"></script>

		<script type="application/ld+json">
			{
			  "@context": "https://schema.org",
			  "@type": "Organization",
			  "name": "Sekaone",
			  "url": "https://sekaone.com",
			  "logo": "https://sekaone.com/assets/logotanpateks.webp",
			  "sameAs": [
			    "https://www.instagram.com/sekaone",
			    "https://www.linkedin.com/company/sekaone",
			    "https://www.facebook.com/sekaone"
			  ],
			  "description": "Sekaone is a premium manufacturer and exporter of handcrafted rattan webbing and sustainable rattan furniture from Indonesia.",
			  "contactPoint": [{
			    "@type": "ContactPoint",
			    "telephone": "+62 8129-2314-213",
			    "contactType": "Marketing",
			    "areaServed": "Worldwide",
			    "availableLanguage": ["English", "Indonesian", "Japanese", "Arabic"]
			  }]
			}
		</script>

		<script type="application/ld+json">
			{
			  "@context": "https://schema.org",
			  "@type": "Product",
			  "name": "Rattan Cane Webbing",
			  "image": "https://sekaone.com/assets/rattan-cane-webbing.jpg",
			  "description": "High-quality, handcrafted rattan cane webbing made from sustainable natural rattan.",
			  "sku": "RW-001",
			  "brand": {
			    "@type": "Brand",
			    "name": "Sekaone"
			  },
			  // "offers": {
			  //   "@type": "Offer",
			  //   "priceCurrency": "USD",
			  //   "price": "50.00",
			  //   "itemCondition": "https://schema.org/NewCondition",
			  //   "availability": "https://schema.org/InStock",
			  //   "url": "https://sekaone.com/product/rattan-cane-webbing"
			  // }
			}
		</script>

		<script type="application/ld+json">
			{
			  "@context": "https://schema.org",
			  "@type": "BreadcrumbList",
			  "itemListElement": [
			    {
			      "@type": "ListItem",
			      "position": 1,
			      "name": "Home",
			      "item": "https://sekaone.com"
			    },
			    {
			      "@type": "ListItem",
			      "position": 2,
			      "name": "About Us",
			      "item": "https://sekaone.com/about.php?about"
			    },
			    {
			      "@type": "ListItem",
			      "position": 3,
			      "name": "Product",
			      "item": "https://sekaone.com/services.php?services"
			    },
			    {
			      "@type": "ListItem",
			      "position": 4,
			      "name": "Artikel",
			      "item": "https://sekaone.com/artikel.php?artikel"
			    },
			    {
			      "@type": "ListItem",
			      "position": 5,
			      "name": "Contact Us",
			      "item": "https://sekaone.com/contact.php?contact"
			    }
			  ]
			}
		</script>
