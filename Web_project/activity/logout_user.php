

<?php
//ksekinaei to session
session_start();

//katharizei oles tis session metavlites
session_unset();

//termatizei to session
session_destroy();

//redirect sto index_user.php
header("Location: index.php");
?>




