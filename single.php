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

// Handle Comment Submission
if (isset($_POST['submit'])) {
    if (!empty($_POST['csrftoken']) && hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
        $name = $conn->real_escape_string(trim($_POST['name']));
        $email = $conn->real_escape_string(trim($_POST['email']));
        $comment = $conn->real_escape_string(trim($_POST['comment']));
        $postid = intval($_GET['nid']);
        $st1 = 0;

        $stmt = $conn->prepare("INSERT INTO tblcomments (postId, name, email, comment, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isssi", $postid, $name, $email, $comment, $st1);

        if ($stmt->execute()) {
            echo "<script>alert('Comment successfully submitted. Comment will be displayed after admin review.');</script>";
            unset($_SESSION['token']);
        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
        }

        $stmt->close();
    }
}

// View Counter Update
$postid = intval($_GET['nid']);
$stmt = $conn->prepare("SELECT viewCounter FROM tblposts WHERE id = ?");
$stmt->bind_param("i", $postid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $visits = $row["viewCounter"];
    $visits++;

    $update = $conn->prepare("UPDATE tblposts SET viewCounter = ? WHERE id = ?");
    $update->bind_param("ii", $visits, $postid);
    $update->execute();
    $update->close();
} else {
    echo "no results";
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

    <div 
         class="site-cover site-cover-sm same-height overlay single-page"
         style="background-image: url('newsportal/admin/postimages/<?php echo htmlentities($row['PostImage']);?>');" alt="<?php echo htmlentities($row['posttitle']);?>"
    >
      <div class="container">
        <div class="row same-height justify-content-center">
          <div class="col-md-6">
            <div class="post-entry text-center">
              <h1 class="mb-4"><?php echo htmlentities($row['posttitle']);?></h1>
              <div class="post-meta align-items-center text-center">
                <figure class="author-figure mb-0 me-3 d-inline-block"><i class="bi bi-person"></i></figure>
                <span class="d-inline-block mt-1">By <?php echo htmlentities($row['postedBy']);?></span>
                <span>&nbsp;-&nbsp; <?php echo htmlentities(date('d-m-Y', strtotime($row['postingdate']))); ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <section class="section">
      <div class="container">

        <div class="row blog-entries element-animate">

          <div class="col-md-12 col-lg-8 main-content">

            <div class="post-content-body">
              <p><?php $pt=$row['postdetails']; echo (substr($pt,0));?></p>
              <!-- <div class="row my-4">
                <div class="col-md-12 mb-4">
                  <img src="images/hero_1.jpg" alt="Image placeholder" class="img-fluid rounded">
                </div>
                <div class="col-md-6 mb-4">
                  <img src="images/img_2_horizontal.jpg" alt="Image placeholder" class="img-fluid rounded">
                </div>
                <div class="col-md-6 mb-4">
                  <img src="images/img_3_horizontal.jpg" alt="Image placeholder" class="img-fluid rounded">
                </div>
              </div> -->
              <!-- <p>Quibusdam autem, quas molestias recusandae aperiam molestiae modi qui ipsam vel. Placeat tenetur veritatis tempore quos impedit dicta, error autem, quae sint inventore ipsa quidem. Quo voluptate quisquam reiciendis, minus, animi minima eum officia doloremque repellat eos, odio doloribus cum.</p>
              <p>Temporibus quo dolore veritatis doloribus delectus dolores perspiciatis recusandae ducimus, nisi quod, incidunt ut quaerat, magnam cupiditate. Aut, laboriosam magnam, nobis dolore fugiat impedit necessitatibus nisi cupiditate, quas repellat itaque molestias sit libero voluptas eveniet omnis illo ullam dolorem minima.</p>
              <p>Porro amet accusantium libero fugit totam, deserunt ipsa, dolorem, vero expedita illo similique saepe nisi deleniti. Cumque, laboriosam, porro! Facilis voluptatem sequi nulla quidem, provident eius quos pariatur maxime sapiente illo nostrum quibusdam aliquid fugiat! Earum quod fuga id officia.</p>
              <p>Illo magnam at dolore ad enim fugiat ut maxime facilis autem, nulla cumque quis commodi eos nisi unde soluta, ipsa eius aspernatur sint atque! Nihil, eveniet illo ea, mollitia fuga accusamus dolor dolorem perspiciatis rerum hic, consectetur error rem aspernatur!</p>

              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus magni explicabo id molestiae, minima quas assumenda consectetur, nobis neque rem, incidunt quam tempore perferendis provident obcaecati sapiente, animi vel expedita omnis quae ipsa! Obcaecati eligendi sed odio labore vero reiciendis facere accusamus molestias eaque impedit, consequuntur quae fuga vitae fugit?</p> -->
            </div>
    <?php } ?>

            <div class="pt-5 comment-wrap">
              <!-- <h3 class="mb-5 heading">6 Comments</h3>
              <ul class="comment-list">
                <li class="comment">
                  <div class="vcard">
                    <img src="images/person_1.jpg" alt="Image placeholder">
                  </div>
                  <div class="comment-body">
                    <h3>Jean Doe</h3>
                    <div class="meta">January 9, 2018 at 2:21pm</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                    <p><a href="#" class="reply rounded">Reply</a></p>
                  </div>
                </li>

                <li class="comment">
                  <div class="vcard">
                    <img src="images/person_2.jpg" alt="Image placeholder">
                  </div>
                  <div class="comment-body">
                    <h3>Jean Doe</h3>
                    <div class="meta">January 9, 2018 at 2:21pm</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                    <p><a href="#" class="reply rounded">Reply</a></p>
                  </div>

                  <ul class="children">
                    <li class="comment">
                      <div class="vcard">
                        <img src="images/person_3.jpg" alt="Image placeholder">
                      </div>
                      <div class="comment-body">
                        <h3>Jean Doe</h3>
                        <div class="meta">January 9, 2018 at 2:21pm</div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                        <p><a href="#" class="reply rounded">Reply</a></p>
                      </div>


                      <ul class="children">
                        <li class="comment">
                          <div class="vcard">
                            <img src="images/person_4.jpg" alt="Image placeholder">
                          </div>
                          <div class="comment-body">
                            <h3>Jean Doe</h3>
                            <div class="meta">January 9, 2018 at 2:21pm</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                            <p><a href="#" class="reply rounded">Reply</a></p>
                          </div>

                          <ul class="children">
                            <li class="comment">
                              <div class="vcard">
                                <img src="images/person_5.jpg" alt="Image placeholder">
                              </div>
                              <div class="comment-body">
                                <h3>Jean Doe</h3>
                                <div class="meta">January 9, 2018 at 2:21pm</div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                                <p><a href="#" class="reply rounded">Reply</a></p>
                              </div>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li>

                <li class="comment">
                  <div class="vcard">
                    <img src="images/person_1.jpg" alt="Image placeholder">
                  </div>
                  <div class="comment-body">
                    <h3>Jean Doe</h3>
                    <div class="meta">January 9, 2018 at 2:21pm</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                    <p><a href="#" class="reply rounded">Reply</a></p>
                  </div>
                </li>
              </ul> -->
              <!-- END comment-list -->

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
                    <textarea name="" id="message" cols="30" rows="10" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <input type="submit" value="Post Comment" class="btn btn-primary">
                  </div>

                </form>
              </div>
            </div>

          </div>

          <!-- END main-content -->

          <div class="col-md-12 col-lg-4 sidebar">
            <!-- <div class="sidebar-box search-form-wrap">
              <form action="#" class="sidebar-search-form">
                <span class="bi-search"></span>
                <input type="text" class="form-control" id="s" placeholder="Type a keyword and hit enter">
              </form>
            </div> -->
            <!-- END sidebar-box -->
            <!-- <div class="sidebar-box">
              <div class="bio text-center">
                <img src="images/person_2.jpg" alt="Image Placeholder" class="img-fluid mb-3">
                <div class="bio-body">
                  <h2>Hannah Anderson</h2>
                  <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam fuga sit molestias minus.</p>
                  <p><a href="#" class="btn btn-primary btn-sm rounded px-2 py-2">Read my bio</a></p>
                  <p class="social">
                    <a href="#" class="p-2"><span class="fa fa-facebook"></span></a>
                    <a href="#" class="p-2"><span class="fa fa-twitter"></span></a>
                    <a href="#" class="p-2"><span class="fa fa-instagram"></span></a>
                    <a href="#" class="p-2"><span class="fa fa-youtube-play"></span></a>
                  </p>
                </div>
              </div>
            </div> -->
            <!-- END sidebar-box -->  
            <div class="sidebar-box">
              <h3 class="heading">Popular Posts</h3>
              <div class="post-entry-sidebar">
                <ul>
                  <?php
                        $query=mysqli_query($conn,"SELECT tblposts.id as pid, tblposts.PostImage, tblposts.PostingDate as postingdate,tblposts.PostTitle as posttitle from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId limit 8");
                  
                    while ($row=mysqli_fetch_array($query)) {

                  ?>
                  <li>
                    <a href="single.php?nid=<?php echo htmlentities($row['pid'])?>">
                      <img src="newsportal/admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="Image placeholder" class="me-4 rounded">
                      <div class="text">
                        <h4><?php echo htmlentities($row['posttitle']);?></h4>
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
            <!-- END sidebar-box -->

            <!-- <div class="sidebar-box">
              <h3 class="heading">Categories</h3>
              <ul class="categories">
                <li><a href="#">Food <span>(12)</span></a></li>
                <li><a href="#">Travel <span>(22)</span></a></li>
                <li><a href="#">Lifestyle <span>(37)</span></a></li>
                <li><a href="#">Business <span>(42)</span></a></li>
                <li><a href="#">Adventure <span>(14)</span></a></li>
              </ul>
            </div> -->
            <!-- END sidebar-box -->

            <div class="sidebar-box">
              <h3 class="heading">Tags</h3>
              <ul class="tags">
                <?php 

                  $tagsid=intval($_GET['nid']);
                  $query_tags="SELECT tags FROM tblposts WHERE id = '$tagsid'";
                  $result = $conn->query($query_tags);
                  if ($result === false) {
                      die("Error saat menjalankan query: " . $mysqli->error);
                  }

                  // Mengambil hasil query dalam bentuk array
                  while ($row = $result->fetch_assoc()) {
                      $tags[] = $row['tags'];
                  }

                  // Membebaskan hasil query
                  $result->free();

                  // Menutup koneksi database
                  $conn->close();

                ?>

                <?php 
                foreach ($tags as $tag) {
                    $tag = explode(" ", $tag); // Pisahkan kata-kata berdasarkan spasi
                    foreach ($tag as $word) {
                ?>
                        <li><a href="<?=$word?>"><?=$word?></a></li>
                <?php } } ?>
              </ul>
            </div>
          </div>
          <!-- END sidebar -->

        </div>
      </div>
    </section>


    <!-- Start posts-entry -->
    <!-- <section class="section posts-entry posts-entry-sm bg-light">
      <div class="container">
        <div class="row mb-4">
          <div class="col-12 text-uppercase text-black">More Blog Posts</div>
        </div>
        <div class="row">
          <div class="col-md-6 col-lg-3">
            <div class="blog-entry">
              <a href="single.html" class="img-link">
                <img src="images/img_1_horizontal.jpg" alt="Image" class="img-fluid">
              </a>
              <span class="date">Apr. 14th, 2022</span>
              <h2><a href="single.html">Thought you loved Python? Wait until you meet Rust</a></h2>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
              <p><a href="#" class="read-more">Continue Reading</a></p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="blog-entry">
              <a href="single.html" class="img-link">
                <img src="images/img_2_horizontal.jpg" alt="Image" class="img-fluid">
              </a>
              <span class="date">Apr. 14th, 2022</span>
              <h2><a href="single.html">Startup vs corporate: What job suits you best?</a></h2>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
              <p><a href="#" class="read-more">Continue Reading</a></p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="blog-entry">
              <a href="single.html" class="img-link">
                <img src="images/img_3_horizontal.jpg" alt="Image" class="img-fluid">
              </a>
              <span class="date">Apr. 14th, 2022</span>
              <h2><a href="single.html">UK sees highest inflation in 30 years</a></h2>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
              <p><a href="#" class="read-more">Continue Reading</a></p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="blog-entry">
              <a href="single.html" class="img-link">
                <img src="images/img_4_horizontal.jpg" alt="Image" class="img-fluid">
              </a>
              <span class="date">Apr. 14th, 2022</span>
              <h2><a href="single.html">Don’t assume your user data in the cloud is safe</a></h2>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
              <p><a href="#" class="read-more">Continue Reading</a></p>
            </div>
          </div>
        </div>
      </div>
    </section> -->
    <!-- End posts-entry -->
  </div>

    <?php include 'footer_artikel.php'; ?>

  </body>
</html>