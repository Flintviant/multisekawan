<?php include_once 'head-database.php'; ?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="index, follow">

  <title>
    <?php
      if (isset($_GET["home"])) echo "Sekaone - Home";
      elseif (isset($_GET["about"])) echo "Sekaone - About Us";
      elseif (isset($_GET["services"])) echo "Sekaone - Services";
      elseif (isset($_GET["artikel"])) echo "Sekaone - Artikel";
      elseif (isset($_GET["contact"])) echo "Sekaone - Contact Us";
      else echo "Sekaone - Home";
    ?>
  </title>

  <meta name="description" content="<?= htmlspecialchars($meta_description ?? 'Multisekawan Official Website') ?>" />
  <meta name="keywords" content="<?= htmlspecialchars($meta_keywords ?? 'multisekawan, sekaone, store, rattan webbing') ?>" />
  <meta name="author" content="admin multisekawan">
  <link rel="shortcut icon" href="assets/logotanpateks.webp">

  <!-- Open Graph / Facebook -->
  <meta property="og:title" content="<?= htmlspecialchars($page_name ?? 'Sekaone') ?> | Sekawan">
  <meta property="og:site_name" content="Multisekawan Official Store">
  <meta property="og:url" content="<?= htmlspecialchars($defaulturl ?? '') ?>">
  <meta property="og:description" content="<?= htmlspecialchars(mb_strimwidth($meta_description ?? '', 0, 159, '')) ?>">
  <meta property="og:type" content="website">
  <meta property="og:image" content="assets/logotanpateks.webp">

  <!-- CSS Dependencies -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="<?= $defaulturl ?? '' ?>/css/style.css">
  <link rel="stylesheet" href="<?= $defaulturl ?? '' ?>/css/galeri.css">
  <link rel="stylesheet" href="css/slider-baru.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">

  <!-- JS Dependencies -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

  <style>
    .orange-bg {
      background-color: #3C7945;
    }
  </style>

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-8DBYWGQGPP"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-8DBYWGQGPP');
  </script>
</head>