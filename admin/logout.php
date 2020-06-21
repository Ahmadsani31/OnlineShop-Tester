<?php
session_start();
session_destroy();
unset( $_SESSION['username'] );
?>
<?php
   header('location:../login.php?logout');
   ?>