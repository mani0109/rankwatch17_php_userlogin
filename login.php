<?php
    require_once('server-request-route.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <?php 
        if (!file_exists('libraries.php'))
            echo '<h2>Site is under maintainence...</h2>';
        else
            require_once('libraries.php');
    ?>

    <link rel="stylesheet" type="text/css" href="CSS files/form.css?cache=<?php echo time();?>">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form class="form-signin loginFrom" method="post" action="" name="login" id="loginFrom">

                    <!-- Error message -->
                    <?php 
                        $succ_class = $succ_msg = '';
                        if (isset($_GET['register']) && $_GET['register'] == 'success') {
                            $succ_class = 'alert alert-success';
                            $succ_msg = 'User registered successfully';
                        }
                    ?>
                    <div class=" <?php echo $succ_class; ?>" role="alert"><?php echo $succ_msg; ?></div>

                    <h2 class="form-signin-heading login-head">Please sign in</h2>
                    <br>
                
                    <input type="hidden" name="loginFrom" value="<?php echo time(); ?>">
                    
                    <!-- Email ID -->
                    <label for="email" class="sr-only">E-Mail</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required autofocus>
                    <div id="emailErr"></div>
                    
                    <br>
                    
                    <!-- Password -->
                    <label for="user_password" class="sr-only">Password</label>
                    <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Password" required>
                    <div id="user_passwordErr"></div>

                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-lg btn-primary btn-block" type="button" id="loginSubmitButton">Sign in</button>  
                        </div>
                        <div class="col-md-6">
                            <a href="registration.php"><button class="btn btn-lg btn-default btn-block" type="button">Register</button> </a>
                        </div>
                    </div>
                </form>  
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var alert_status = 0;
        <?php
            if (isset($_GET['register']) && $_GET['register'] == 'success') {?>
                alert_status = 1;   
            <?php }
        ?>
    </script>
    <script type="text/javascript" src="javascript files/form.js?cache=<?php echo time();?>"></script>

</body>
</html>