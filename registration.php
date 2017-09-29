<?php
    require_once('server-request-route.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Registration</title>

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

            <form class="form-horizontal" action="" method="post"  id="registerationForm">
                
                <input type="hidden" name="registerationForm" value="<?php echo time(); ?>">
                
                <!-- Success message -->
                <div class="alert alert-success success_message" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Success!.</div>

                <!-- Error message -->
                <?php 
                    $err_class = $err_msg = '';
                    if (isset($_GET['error']) && $_GET['error'] == 'exist') {
                        $err_class = 'alert alert-danger';
                        $err_msg = 'User already exist';
                    }
                    elseif (isset($_GET['error']) && $_GET['error'] == 'error') {
                        $err_class = 'alert alert-danger';
                        $err_msg = 'Service currently unavailable';
                    }
                ?>
                <div class=" <?php echo $err_class; ?>" role="alert"><?php echo $err_msg; ?></div>

                <center><h2><b>Registration Form</b></h2></center><br>

                <!-- Full name -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Full Name</label>  
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="full_name" placeholder="Full Name" class="form-control" type="text" id="full_name" autofocus>
                        </div>
                        <div id="full_nameErr"></div>
                    </div>
                </div>

                <!-- Email ID -->
                <div class="form-group">
                    <label class="col-md-4 control-label">E-Mail</label>  
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input name="email" placeholder="E-Mail Address" class="form-control" type="text" id="email">
                        </div>
                        <div id="emailErr"></div>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="col-md-4 control-label" >Password</label> 
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input name="user_password" placeholder="Password" class="form-control" type="password" id="user_password">
                        </div>
                        <div id="user_passwordErr"></div>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label class="col-md-4 control-label" >Confirm Password</label> 
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input name="confirm_password" placeholder="Confirm Password" class="form-control" type="password" id="confirm_password">
                        </div>
                        <div id="confirm_passwordErr"></div>
                    </div>
                </div>

                <!-- Contact Number -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Mobile Number</label>  
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                            <input name="contact_no" placeholder="(639)" class="form-control" type="text" id="contact_no">
                        </div>
                        <div id="contact_noErr"></div>
                    </div>
                </div>

                <!-- Age -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Age</label>  
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                            <input  name="age" placeholder="Age" class="form-control"  type="number" id="age">
                        </div>
                        <div id="ageErr"></div>
                    </div>
                </div>

                <!-- Gender -->
                <div class="form-group"> 
                    <label class="col-md-4 control-label">Gender</label>
                    <div class="col-md-4 selectContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                            <select name="gender" class="form-control selectpicker" id="gender">
                                <option value="">Select your Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div id="genderErr"></div>
                    </div>
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Address</label>  
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <textarea name="address" class="form-control" id="address" rows="3" cols="100"></textarea>
                        </div>
                        <div id="addressErr"></div>
                    </div>
                </div>

                <!-- Country -->
                <div class="form-group"> 
                    <label class="col-md-4 control-label">Country</label>
                    <div class="col-md-4 selectContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                            <select name="country" class="form-control selectpicker" id="country">
                                <?php
                                    $country = new registerLogin();
                                    $country_result = $country->getCountries();
                                    $country_size = count($country_result);
                                    if (is_array($country_result) && $country_size) {
                                        for ($i = 0; $i < $country_size; $i++)
                                            echo $country_result[$i];
                                    }
                                ?>
                            </select>
                        </div>
                        <div id="countryErr"></div>
                    </div>
                </div>

                <!-- State -->
                <div class="form-group state_display"> 
                    <label class="col-md-4 control-label">State</label>
                    <div class="col-md-4 selectContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                            <select name="state" class="form-control selectpicker" id="state">
                            </select>
                        </div>
                        <div id="stateErr"></div>
                    </div>
                </div>

                <!-- City -->
                <div class="form-group city_display"> 
                    <label class="col-md-4 control-label">City</label>
                    <div class="col-md-4 selectContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                            <select name="city" class="form-control selectpicker" id="city">
                            </select>
                        </div>
                        <div id="cityErr"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label"></label>
                    <div class="col-md-4"><br>
                        <button type="button" class="btn btn-warning" id="registerSubmitButton" >SUBMIT <span class="glyphicon glyphicon-send"></span></button>
                        <a href="login.php" class="login-btn"><button type="button" class="btn btn-default" >Login <span class="glyphicon glyphicon-login"></span></button></a>
                    </div>
                </div>

            </form>
        </div>
        <script type="text/javascript">
            var alert_status = 0;
            <?php
                if (isset($_GET['error']) && ($_GET['error'] == 'error' || $_GET['error'] == 'exist')) {?>
                    alert_status = 1;   
                <?php }
            ?>
        </script>
        <script type="text/javascript" src="javascript files/form.js?cache=<?php echo time();?>"></script>
    </body>
</html>