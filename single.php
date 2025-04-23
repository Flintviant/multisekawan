<?php 
session_start();

// Database connection
$conn = new mysqli("localhost", "u608883328_sekaone", "Sekaone_0423", "u608883328_sekaone");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Generate CSRF Token
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

// Validate post ID
if (isset($_GET['nid']) && is_numeric($_GET['nid']) && $_GET['nid'] > 0) {
    $postid = intval($_GET['nid']);
} else {
    echo "ID postingan tidak valid.";
    exit;
}

// Handle Comment Submission
if (isset($_POST['submit'])) {
    if (!empty($_POST['csrftoken']) && hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
        $name = $conn->real_escape_string(trim($_POST['name']));
        $email = $conn->real_escape_string(trim($_POST['email']));
        $comment = $conn->real_escape_string(trim($_POST['comment']));
        $status = 0;

        $stmt = $conn->prepare("INSERT INTO tblcomments (postId, name, email, comment, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isssi", $postid, $name, $email, $comment, $status);

        if ($stmt->execute()) {
            echo "<script>alert('Komentar berhasil dikirim. Komentar akan ditampilkan setelah ditinjau admin.');</script>";
            unset($_SESSION['token']);
        } else {
            echo "<script>alert('Terjadi kesalahan. Silakan coba lagi.');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Token tidak valid. Silakan refresh halaman.');</script>";
    }
}

// View Counter Update
$stmt = $conn->prepare("SELECT viewCounter FROM tblposts WHERE id = ?");
$stmt->bind_param("i", $postid);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $visits = $row["viewCounter"] + 1;

    $update = $conn->prepare("UPDATE tblposts SET viewCounter = ? WHERE id = ?");
    $update->bind_param("ii", $visits, $postid);
    $update->execute();
    $update->close();
} else {
    echo "<script>alert('Postingan tidak ditemukan.');</script>";
}
$stmt->close();

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


  <title>Article - SekaOne</title>
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

  
  <div class="container-fluid">
      <?php include 'nav.php'; ?>

      <?php
      // Validasi dan sanitasi input
      $pid = isset($_GET['nid']) ? intval($_GET['nid']) : 0;
      $currenturl = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

      // Ambil data postingan
      $query = mysqli_query($conn, "SELECT 
          tblposts.PostTitle AS posttitle,
          tblposts.PostImage,
          tblcategory.CategoryName AS category,
          tblcategory.id AS cid,
          tblsubcategory.Subcategory AS subcategory,
          tblposts.PostDetails AS postdetails,
          tblposts.PostingDate AS postingdate,
          tblposts.PostUrl AS url,
          tblposts.postedBy,
          tblposts.lastUpdatedBy,
          tblposts.UpdationDate
          FROM tblposts 
          LEFT JOIN tblcategory ON tblcategory.id = tblposts.CategoryId 
          LEFT JOIN tblsubcategory ON tblsubcategory.SubCategoryId = tblposts.SubCategoryId 
          WHERE tblposts.id = '$pid'");

      if ($query && mysqli_num_rows($query) > 0) {
          while ($row = mysqli_fetch_array($query)) {
      ?>

      <!-- HERO SECTION -->
      <div class="site-cover site-cover-sm same-height overlay single-page"
           style="background-image: url('newsportal/admin/postimages/<?php echo htmlentities($row['PostImage']); ?>');"
           alt="<?php echo htmlentities($row['posttitle']); ?>">
          <div class="container">
              <div class="row same-height justify-content-center">
                  <div class="col-md-6">
                      <div class="post-entry text-center">
                          <h1 class="mb-4"><?php echo htmlentities($row['posttitle']); ?></h1>
                          <div class="post-meta align-items-center text-center">
                              <figure class="author-figure mb-0 me-3 d-inline-block"><i class="bi bi-person"></i></figure>
                              <span class="d-inline-block mt-1">By <?php echo htmlentities($row['postedBy']); ?></span>
                              <span>&nbsp;-&nbsp; <?php echo htmlentities(date('d-m-Y', strtotime($row['postingdate']))); ?></span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- CONTENT SECTION -->
      <section class="section">
          <div class="container">
              <div class="row blog-entries element-animate">

                  <!-- Breadcrumb -->
                  <nav aria-label="breadcrumb" class="mt-3">
                    <ol class="breadcrumb bg-light p-2 rounded">
                      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                      <li class="breadcrumb-item"><a href="category.php?catid=<?= $row['cid']; ?>">
                        <?= htmlentities($row['category']); ?>
                      </a></li>
                      <?php if (!empty($row['subcategory'])) { ?>
                        <li class="breadcrumb-item"><a href="#"><?= htmlentities($row['subcategory']); ?></a></li>
                      <?php } ?>
                      <li class="breadcrumb-item active" aria-current="page"><?= htmlentities($row['posttitle']); ?></li>
                    </ol>
                  </nav>

                  <!-- Main Artikel -->

                  <div class="col-md-12 col-lg-8 main-content">
                      <div class="post-content-body">
                          <p><?php echo strip_tags($row['postdetails'], '<p><a><strong><em><ul><ol><li><br><img>'); ?></p>
                      </div>
                      <?php } // end while ?>
                      <?php } else { echo "<p>Post not found.</p>"; } ?>

                      <!-- COMMENT FORM -->
                      <div class="pt-5 comment-wrap">
                          <div class="comment-form-wrap pt-5">
                              <h3 class="mb-5">Leave a comment</h3>
                              <form action="#" class="p-5 bg-light">
                                  <div class="form-group">
                                      <label for="name">Name *</label>
                                      <input type="text" class="form-control" id="name">
                                  </div>
                                  <div class="form-group">
                                      <label for="email">Email *</label>
                                      <input type="email" class="form-control" id="email">
                                  </div>
                                  <div class="form-group">
                                      <label for="website">Website</label>
                                      <input type="url" class="form-control" id="website">
                                  </div>
                                  <div class="form-group">
                                      <label for="message">Message</label>
                                      <textarea id="message" cols="30" rows="10" class="form-control"></textarea>
                                  </div>
                                  <div class="form-group">
                                      <input type="submit" value="Post Comment" class="btn btn-primary">
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
                  <!-- SIDEBAR -->
                  <div class="col-md-12 col-lg-4 sidebar">
                      <div class="sidebar-box">
                          <h3 class="heading">Popular Posts</h3>
                          <div class="post-entry-sidebar">
                              <ul>
                                  <?php
                                  $popular = mysqli_query($conn, "SELECT tblposts.id as pid, tblposts.PostImage, tblposts.PostingDate as postingdate, tblposts.PostTitle as posttitle FROM tblposts ORDER BY tblposts.PostingDate DESC LIMIT 8");
                                  while ($row = mysqli_fetch_array($popular)) {
                                  ?>
                                      <li>
                                          <a href="single.php?nid=<?php echo htmlentities($row['pid']) ?>">
                                              <img src="newsportal/admin/postimages/<?php echo htmlentities($row['PostImage']); ?>" alt="Image placeholder" class="me-4 rounded">
                                              <div class="text">
                                                  <h4><?php echo htmlentities($row['posttitle']); ?></h4>
                                                  <div class="post-meta">
                                                      <span class="mr-2"><?php echo htmlentities(date('d-m-Y', strtotime($row['postingdate']))); ?></span>
                                                  </div>
                                              </div>
                                          </a>
                                      </li>
                                  <?php } ?>
                              </ul>
                          </div>
                      </div>

                      <!-- TAGS -->
                      <div class="sidebar-box">
                          <h3 class="heading">Tags</h3>
                          <ul class="tags">
                              <?php
                              $tags = [];
                              $query_tags = "SELECT tags FROM tblposts WHERE id = '$pid'";
                              $result = mysqli_query($conn, $query_tags);
                              if ($result) {
                                  while ($row = mysqli_fetch_assoc($result)) {
                                      $tags_raw = explode(" ", $row['tags']);
                                      $tags = array_merge($tags, $tags_raw);
                                  }
                              }
                              foreach (array_unique($tags) as $tag) {
                                  $clean_tag = htmlentities(trim($tag));
                                  if (!empty($clean_tag)) {
                                      echo "<li><a href=\"search.php?tag=$clean_tag\">$clean_tag</a></li>";
                                  }
                              }
                              ?>
                          </ul>
                      </div>
                  </div>
              </div>
      </section>
  </div>


    <?php include 'footer_artikel.php'; ?>

  </body>
</html>