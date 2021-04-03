
<?php

require_once 'includes/header.php';


?>
<div>
<h1>Register</h1>
<p><a href="login.php">Already have an account ? Login.</a></p>

<form action="includes/register-inc.php" method = "post">
<input type="text" name = "username" placeholder = "Username">
<input type="password" name = "password" placeholder = "Password">
<input type="password" name = "confirmpassword" placeholder = "Confirm Passwpord">
<button type="submit" name = "submit">Register</button>
</form>
</div>
    <?php

require_once 'includes/footer.php';


?>