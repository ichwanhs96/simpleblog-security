<?php
include('auth.php');
require_once('class/userManagement.php');
require_once('class/utils.php');
$_SESSION['token'] = $tokenHandler->regenerateToken(session_id(),"edit_post");
$id = $_GET['id'];
$userManagement = new userManagement();
if($userManagement->isPostBelongsToUser($_SESSION['userId'], $id)){
	$db = new Db();
	$id = $db->quote($id);
	$query = "SELECT * FROM info_post WHERE ID=".$id."";
	$results = $db->select($query);
	$result = null;
	foreach ($results as $r) {
		$result = $r;
	}
} else {
	$utils = new utils();
	$utils->redirect("index.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="Deskripsi Blog">
<meta name="author" content="Judul Blog">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="omfgitsasalmon">
<meta name="twitter:title" content="Simple Blog">
<meta name="twitter:description" content="Deskripsi Blog">
<meta name="twitter:creator" content="Simple Blog">
<meta name="twitter:image:src" content="{{! TODO: ADD GRAVATAR URL HERE }}">

<meta property="og:type" content="article">
<meta property="og:title" content="Simple Blog">
<meta property="og:description" content="Deskripsi Blog">
<meta property="og:image" content="{{! TODO: ADD GRAVATAR URL HERE }}">
<meta property="og:site_name" content="Simple Blog">

<link rel="stylesheet" type="text/css" href="assets/css/screen.css" />
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<title>Simple Blog | Edit Post</title>


</head>

<body class="default">
<div class="wrapper">

<nav class="nav">
    <a style="border:none;" id="logo" href="index.php"><h1>Simple<span>-</span>Blog</h1></a>
	<ul class="nav-primary">
        <li><a href="new_post.php">+ Tambah Post</a></li>
        <li><?php echo $_SESSION['username']; ?></a></li>
        <li><a href="logout.php"> logout</a></li>
    </ul>
</nav>

<article class="art simple post">
    
    
    <h2 class="art-title" style="margin-bottom:40px">-</h2>

    <div class="art-body">
        <div class="art-body-inner">
            <h2>Edit Post</h2>
            <p>
              <?php 
              if (isset($_SESSION['Status'])){
                echo "<p>".$_SESSION['Status']."</p>";
                unset($_SESSION['Status']);
              }
              ?>
            </p>
			<?php
				echo "
				<div id='contact-area'>
				<form method='post' id='form_post' name='form_post' action='edit_post_redirect.php' onsubmit='return postValidation();' enctype='multipart/form-data'>
					<input type='hidden' name='ID' id='ID' value=".$id.">
					<label for='Judul'>Judul:</label>
					<input type='text' name='Judul' id='Judul' value=".htmlspecialchars($result['judul']).">

					<input type='hidden' name='token' id='token' value=".$_SESSION['token'].">


                    <label for='Konten'>Gambar:</label><br>
                    <input type='file' id='Gambar' name='Gambar' accept='image/*'>
					
					<label for='Konten'>Konten:</label><br>
					<textarea name='Konten' rows='20' cols='20' id='Konten'>".htmlspecialchars($result['konten'])."</textarea>

					<input type='submit' name='submit' value='Simpan' class='submit-button'>
				</form>
				</div>
				";
			
			?>
        </div>
    </div>

</article>

</div>

<script type="text/javascript" src="assets/js/fittext.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>
<script type="text/javascript" src="assets/js/respond.min.js"></script>
<script type="text/javascript">
  var ga_ua = '{{! TODO: ADD GOOGLE ANALYTICS UA HERE }}';

  (function(g,h,o,s,t,z){g.GoogleAnalyticsObject=s;g[s]||(g[s]=
      function(){(g[s].q=g[s].q||[]).push(arguments)});g[s].s=+new Date;
      t=h.createElement(o);z=h.getElementsByTagName(o)[0];
      t.src='//www.google-analytics.com/analytics.js';
      z.parentNode.insertBefore(t,z)}(window,document,'script','ga'));
      ga('create',ga_ua);ga('send','pageview');
</script>
<script type="text/javascript" src="assets/js/validasi.js"></script>

</body>
</html>