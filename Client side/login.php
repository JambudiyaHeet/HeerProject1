<?php
// session_start();
require_once('top.php');
if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']=='yes'){
    ?>
    <script>
    window.location.href='index.php';
    </script>
    <?php
}
?>

<!-- Start Breadcrumb Area -->
<div class="ht__bradcaump__area" style="background: url(images/bg/4.jpg) no-repeat center center / cover;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.php">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Login/Register</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumb Area -->

<!-- Start Contact Area -->
<section class="htc__contact__area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <!-- Login Form -->
            <div class="col-md-6">
                <div class="contact-form-wrap mt--60">
                    <div class="contact-title">
                        <h2 class="title__line--6">Login</h2>
                    </div>
                    <form id="login-form" method="post">
                        <div class="single-contact-form">
                            <input type="text" name="login_email" id="login_email" placeholder="Your Email*" required>
                        </div>
                        <div class="single-contact-form">
                            <input type="password" name="login_password" id="login_password" placeholder="Your Password*" required>
                        </div>
                        <div class="contact-btn">
                            <button type="submit" name="login_submit" class="fv-btn">Login</button>
                        </div>
                    </form>
                </div> 
            </div>
            
            <!-- Register Form -->
            <div class="col-md-6">
                <div class="contact-form-wrap mt--60">
                    <div class="contact-title">
                        <h2 class="title__line--6">Register</h2>
                    </div>
                    <form id="register-form" method="post">
                        <div class="single-contact-form">
                            <input type="text" name="name" id="name" placeholder="Your Name*" required>
                        </div>
                        <div class="single-contact-form">
                            <input type="email" name="email" id="email" placeholder="Your Email*" required>
                        </div>
                        <div class="single-contact-form">
                            <input type="text" name="mobile" id="mobile" placeholder="Your Mobile*" required>
                        </div>
                        <div class="single-contact-form">
                            <input type="password" name="password" id="password" placeholder="Your Password*" required>
                        </div>
                        <div class="contact-btn">
                            <button type="submit" name="register_submit" class="fv-btn">Register</button>
                        </div>
                    </form>
                </div> 
            </div>
        </div>
    </div>
</section>

<?php
// Handle Login
if(isset($_POST['login_submit'])){
    $email = mysqli_real_escape_string($con, $_POST['login_email']);
    $password = mysqli_real_escape_string($con, $_POST['login_password']);
    
    $query = "SELECT * FROM users WHERE email='$email' AND password='".md5($password)."'";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['USER_ID'] = $row['id'];
        $_SESSION['USER_NAME'] = $row['name'];
        $_SESSION['USER_LOGIN'] = 'yes';
        $_SESSION['USER_EMAIL'] = $email;
        echo "<script>window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Invalid login credentials');</script>";
    }
}

// Handle Registration
if(isset($_POST['register_submit'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $password = mysqli_real_escape_string($con, md5($_POST['password']));
    
    // Check if email exists
    $check_email = mysqli_query($con, "SELECT * FROM users WHERE email='$email'");
    if(mysqli_num_rows($check_email) > 0){
        echo "<script>alert('Email already exists');</script>";
    } else {
        $insert_query = "INSERT INTO users (name, email, mobile, password) VALUES ('$name', '$email', '$mobile', '$password')";
        if(mysqli_query($con, $insert_query)){
            echo "<script>alert('Registration successful. Please login!'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Registration failed. Try again!');</script>";
        }
    }
}
?>

<?php require('footer.php'); ?>
