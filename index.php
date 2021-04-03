
<?php

require_once 'includes/header.php';


?>

<?php

if(isset($_SESSION['id']))
{

echo "You are logged in!";
}
else{

    "Home :)";
}

?>
    
    <?php

require_once 'includes/footer.php';


?>
    