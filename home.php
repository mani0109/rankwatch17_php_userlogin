<?php
    require_once('classes/loginStatus.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>

    <?php 
        if (!file_exists('libraries.php'))
            echo '<h2>Site is under maintainence...</h2>';
        else
            require_once('libraries.php');
    ?>

    <link rel="stylesheet" type="text/css" href="CSS files/form.css?cache=<?php echo time();?>">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="heading-main">
					<a href="logout.php">Logout</a>
				</div>
			</div>
		</div>
		<div class="row vertical-center-row">
			<div class="text-center col-md-12">
				<span>Welcome <b><?php echo $_SESSION['login_name']; ?></b></span>
			</div>
		</div>
	</div>
</body>
</html>