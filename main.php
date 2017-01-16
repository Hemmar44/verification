<?php
require_once 'core/initialize.php';

//just to make sure that we have a correct user.
if(Session::isLogged($_SESSION, "key") && $_SESSION["key"] === Session::key($_SESSION["nick"], $_SESSION["id"])){

Session::flashNews();
}

else {
    redirect_to("index.php");
}


?>

<p><a href="logout.php"/>Logout</p>


