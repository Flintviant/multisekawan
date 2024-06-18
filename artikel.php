<!-- /*
* Template Name: Blogy
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<?php 
session_start();
include('config.php');

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Untree.co">
	<link rel="shortcut icon" href="assets/logotanpateks.webp">

	<meta name="description" content="" />
	<meta name="keywords" content="bootstrap, bootstrap5" />

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;600;700&display=swap" rel="stylesheet">


	<link rel="stylesheet" href="fonts/icomoon/style.css">
	<link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

	<link rel="stylesheet" href="css/artikel/tiny-slider.css">
	<link rel="stylesheet" href="css/artikel/aos.css">
	<link rel="stylesheet" href="css/artikel/glightbox.min.css">
	<link rel="stylesheet" href="css/artikel/style.css">

	<link rel="stylesheet" href="css/artikel/flatpickr.min.css">

	<title>
		<?php
	        if(isset($_GET["home"])){ echo "Sekaone - Home";}
	        else if(isset($_GET["about"])){ echo "Sekaone - About Us";}
	        else if(isset($_GET["services"])){ echo "Sekaone - Services";}
	        else if(isset($_GET["artikel"])){ echo "Sekaone - Artikel";}
	        else if(isset($_GET["contact"])){ echo "Sekaone - Contact Us";}
	        else { echo "Home"; }
    	?>
    </title>
</head>
<body>

	<div class="site-mobile-menu site-navbar-target">
		<div class="site-mobile-menu-header">
			<div class="site-mobile-menu-close">
				<span class="icofont-close js-menu-toggle"></span>
			</div>
		</div>
		<div class="site-mobile-menu-body"></div>
	</div>

	<!-- <nav class="site-nav">
		<div class="container">
			<div class="menu-bg-wrap">
				<div class="site-navigation">
					<div class="row g-0 align-items-center">
						<div class="col-2">
							<a href="index.html" class="logo m-0 float-start">Blogy<span class="text-primary">.</span></a>
						</div>
						<div class="col-8 text-center">
							<form action="#" class="search-form d-inline-block d-lg-none">
								<input type="text" class="form-control" placeholder="Search...">
								<span class="bi-search"></span>
							</form>

							<ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu mx-auto">
								<li class="active"><a href="index.html">Home</a></li>
								<li class="has-children">
									<a href="category.html">Pages</a>
									<ul class="dropdown">
										<li><a href="search-result.html">Search Result</a></li>
										<li><a href="blog.html">Blog</a></li>
										<li><a href="single.php">Blog Single</a></li>
										<li><a href="category.html">Category</a></li>
										<li><a href="about.html">About</a></li>
										<li><a href="contact.html">Contact Us</a></li>
										<li><a href="#">Menu One</a></li>
										<li><a href="#">Menu Two</a></li>
										<li class="has-children">
											<a href="#">Dropdown</a>
											<ul class="dropdown">
												<li><a href="#">Sub Menu One</a></li>
												<li><a href="#">Sub Menu Two</a></li>
												<li><a href="#">Sub Menu Three</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li><a href="category.html">Culture</a></li>
								<li><a href="category.html">Business</a></li>
								<li><a href="category.html">Politics</a></li>
							</ul>
						</div>
						<div class="col-2 text-end">
							<a href="#" class="burger ms-auto float-end site-menu-toggle js-menu-toggle d-inline-block d-lg-none light">
								<span></span>
							</a>
							<form action="#" class="search-form d-none d-lg-inline-block">
								<input type="text" class="form-control" placeholder="Search...">
								<span class="bi-search"></span>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav> -->

	<?php include 'nav.php'; ?>

	<!-- Start retroy layout blog posts -->
	
	<section class="section bg-light">
	    <div class="container">
	        <div class="row align-items-stretch retro-layout">
	            <?php
	            // Get the current page number
	            if (isset($_GET['pageno'])) {
	                $pageno = $_GET['pageno'];
	            } else {
	                $pageno = 1;
	            }

	            $no_of_records_per_page = 8;
	            $offset = ($pageno - 1) * $no_of_records_per_page;

	            // Database connection
	            $conn = new mysqli("localhost", "root", "", "newsportal");

	            // Check connection
	            if ($conn->connect_error) {
	                die("Connection failed: " . $conn->connect_error);
	            }

	            // Total pages calculation
	            $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
	            $result = $conn->query($total_pages_sql);
	            $total_rows = $result->fetch_array()[0];
	            $total_pages = ceil($total_rows / $no_of_records_per_page);

	            // Fetch posts
	            $query = $conn->prepare(
	                "SELECT 
	                    tblposts.id as pid,
	                    tblposts.PostTitle as posttitle,
	                    tblposts.PostImage,
	                    tblcategory.CategoryName as category,
	                    tblcategory.id as cid,
	                    tblsubcategory.Subcategory as subcategory,
	                    tblposts.PostDetails as postdetails,
	                    tblposts.PostingDate as postingdate,
	                    tblposts.PostUrl as url 
	                FROM 
	                    tblposts 
	                LEFT JOIN 
	                    tblcategory ON tblcategory.id = tblposts.CategoryId 
	                LEFT JOIN 
	                    tblsubcategory ON tblsubcategory.SubCategoryId = tblposts.SubCategoryId 
	                WHERE 
	                    tblposts.Is_Active = 1 
	                ORDER BY 
	                    tblposts.id DESC 
	                LIMIT ?, ?"
	            );
	            $query->bind_param("ii", $offset, $no_of_records_per_page);
	            $query->execute();
	            $result = $query->get_result();

	            // Display posts
	            while ($row = $result->fetch_assoc()) {
	                ?>
	                <div class="col-md-4 mb-4">
	                    <a href="single.php?nid=<?php echo htmlentities($row['pid']); ?>" class="h-entry v-height gradient">
	                        <div class="featured-img" style="background-image: url('newsportal/admin/postimages/<?php echo htmlentities($row['PostImage']); ?>');"></div>
	                        <div class="text">
	                            <span class="date"><?php echo htmlentities(date('M. d, Y', strtotime($row['postingdate']))); ?></span>
	                            <h2><?php echo htmlentities($row['posttitle']); ?></h2>
	                        </div>
	                    </a>
	                </div>
	                <?php
	            }

	            // Close connection
	            $conn->close();
	            ?>
	        </div>
	    </div>
	</section>

	<!-- End retroy layout blog posts -->


	<?php include 'footer_artikel.php'; ?>

    
  </body>
  </html>