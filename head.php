<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="assets/logotanpateks.webp">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<!-- <link href="css/tiny-slider.css" rel="stylesheet"> -->
		<link href="css/style.css" rel="stylesheet">
    <link href="css/galeri.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/slider-baru.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<title>
			<?php
        if(isset($_GET["home"])){ echo "Sekaone - Home";}
        else if(isset($_GET["about"])){ echo "Sekaone - About Us";}
        else if(isset($_GET["services"])){ echo "Sekaone - Services";}
        else if(isset($_GET["contact"])){ echo "Sekaone - Contact Us";}
        else { echo "Home"; }
    	?>
    </title>

    <style type="text/css">
      .orange-bg{
      background-color: #3C7945;
    }
    </style>
    
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-P7ZCTV7ECH"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-P7ZCTV7ECH');
    </script>
</head>