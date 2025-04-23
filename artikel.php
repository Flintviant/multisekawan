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

	<?php include 'nav.php'; ?>

	<!-- Start retroy layout blog posts -->
	
	<section class="section bg-light">
	    <div class="container">
	        <div class="row align-items-stretch retro-layout">
	            <?php
	            // Get current page number, default to 1
	            $pageno = isset($_GET['pageno']) && is_numeric($_GET['pageno']) ? intval($_GET['pageno']) : 1;

	            $no_of_records_per_page = 8;
	            $offset = ($pageno - 1) * $no_of_records_per_page;

	            // Database connection
	            $conn = new mysqli("localhost", "u608883328_sekaone", "Sekaone_0423", "u608883328_sekaone");

	            // Check connection
	            if ($conn->connect_error) {
	                die("Connection failed: " . $conn->connect_error);
	            }

	            // Get total number of records
	            $result = $conn->query("SELECT COUNT(*) FROM tblposts WHERE Is_Active = 1");
	            $total_rows = $result->fetch_array()[0];
	            $total_pages = ceil($total_rows / $no_of_records_per_page);

	            // Fetch paginated posts
	            $query = $conn->prepare("
	                SELECT 
	                    tblposts.id AS pid,
	                    tblposts.PostTitle AS posttitle,
	                    tblposts.PostImage,
	                    tblcategory.CategoryName AS category,
	                    tblcategory.id AS cid,
	                    tblsubcategory.Subcategory AS subcategory,
	                    tblposts.PostDetails AS postdetails,
	                    tblposts.PostingDate AS postingdate,
	                    tblposts.PostUrl AS url 
	                FROM 
	                    tblposts 
	                LEFT JOIN tblcategory ON tblcategory.id = tblposts.CategoryId 
	                LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId = tblposts.SubCategoryId 
	                WHERE tblposts.Is_Active = 1 
	                ORDER BY tblposts.id DESC 
	                LIMIT ?, ?
	            ");
	            $query->bind_param("ii", $offset, $no_of_records_per_page);
	            $query->execute();
	            $result = $query->get_result();

	            // Display each post
	            while ($row = $result->fetch_assoc()) {
	                ?>
	                <div class="col-md-4 mb-4">
	                    <a href="single.php?nid=<?php echo intval($row['pid']); ?>" class="h-entry v-height gradient">
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