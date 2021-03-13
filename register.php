<?php
	include("includes/config.php");
	include("includes/classes/Account.php");
	include("includes/classes/Constants.php");

	$account = new Account($con);

	include("includes/handlers/register-handler.php");
	include("includes/handlers/login-handler.php");

	function getInputValue($name) {
		if(isset($_POST[$name])) {
			echo $_POST[$name];
		}
	}
?>

<html>
<head>
    <title>Music PLayer</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>


</head>
<body>
    <?php 
        if(isset($_POST["registerButton"])) {
          echo '<script>
          $(document).ready(function() {
  
              $("#loginForm").hide();
              $("#registerForm").show();
           });
      </script>';
        } else {
            echo '<script>
            $(document).ready(function() {
    
                $("#loginForm").show();
                $("#registerForm").hide();
             });
        </script>';
        }
    ?> 
    <!-- <script>
        $(document).ready(function() {

            $("#loginForm").show();
            $("#registerForm").hide();
         });
    </script> -->
<div id="background">
	<div class="banner container">
		<img src="assets/images/icons/music-logo.png" alt="Home">
		<h1>Music Player</h1>
	</div>
    <div id="loginContainer">
	<div id="inputContainer">
		<form id="loginForm" action="register.php" method="POST">
			<h2>Login to start listening!</h2>
			<p>
            <?php echo $account->getError(Constants::$loginFailed); ?>
				<input id="loginUsername" name="loginUsername" type="text" placeholder="Username" required>
			</p>
			<p>
				
				<input id="loginPassword" name="loginPassword" type="password" placeholder="Password" required>
			</p>
		 	<div class="btn-container">

			 <button id="logbtn" type="submit" name="loginButton" class="button button-green">LOG IN</button>
			 </div>
            
            <div class="hasAccountText">
                <span id="hideLogin">Don't have an account yet? Signup <span class="underline">here.</span></span>
            </div>
			
		</form>



		<form id="registerForm" action="register.php" method="POST">
			<h2>Create your free account</h2>
			<p>
                <?php echo $account->getError(Constants::$usernameCharacters); ?>
                <?php echo $account->getError(Constants::$usernameTaken); ?>
				<label for="username">Username</label>
				<input id="username" name="username" type="text" placeholder="e.g. bartsimpson" value="<?php getInputValue('username') ?>" required>
			</p>

			<p>
				<?php echo $account->getError(Constants::$firstNameCharacters); ?>
				<label for="firstName">First name</label>
				<input id="firstName" name="firstName" type="text" placeholder="e.g. Bart" value="<?php getInputValue('firstName') ?>" required>
			</p>

			<p>
				<?php echo $account->getError(Constants::$lastNameCharacters); ?>
				<label for="lastName">Last name</label>
				<input id="lastName" name="lastName" type="text" placeholder="e.g. Simpson" value="<?php getInputValue('lastName') ?>" required>
			</p>

			<p>
				<?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                <?php echo $account->getError(Constants::$emailInvalid); ?>
                <?php echo $account->getError(Constants::$emailTaken); ?>
				<label for="email">Email</label>
				<input id="email" name="email" type="email" placeholder="e.g. bart@gmail.com" value="<?php getInputValue('email') ?>" required>
			</p>

			<p>
				<label for="email2">Confirm email</label>
				<input id="email2" name="email2" type="email" placeholder="e.g. bart@gmail.com" value="<?php getInputValue('email2') ?>" required>
			</p>

			<p>
				<?php echo $account->getError(Constants::$passwordsDoNoMatch); ?>
				<?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
				<?php echo $account->getError(Constants::$passwordCharacters); ?>
				<label for="password">Password</label>
				<input id="password" name="password" type="password" placeholder="Your password" required>
			</p>

			<p>
				<label for="password2">Confirm password</label>
				<input id="password2" name="password2" type="password" placeholder="Your password" required>
			</p>
		 	<div class="btn-container">
			 	<button id="regbtn" type="submit" name="registerButton" class="button button-green">SIGN UP</button>
			 </div>
			
			<div class="hasAccountText">
                <span id="hideRegister">Already have an account? Login <span class="underline">here.</span></span>
            </div>
		</form>


    
    </div>
</body>
</html>