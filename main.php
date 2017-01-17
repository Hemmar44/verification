<?php
require_once 'core/initialize.php';
$update = new Registration();
//just to make sure that we have a correct user.
if(Session::isLogged($_SESSION, "key") && $_SESSION["key"] === Session::key($_SESSION["nick"], $_SESSION["id"])){
//Session::flashNews();


}

else {
    redirect_to("index.php");
}

if($update->submitted()) {
if(array_key_exists("nick", $_POST)){
   $nick = $update->checkNick($_POST["nick"]);
      
if(!empty($update->errors())){
    errorReporting($update->errors());
}
else {
   if($update->update("users", $_SESSION["id"], ["nick" => $nick])){;
    Session::setNews("Your nick has been succesfully changed");
   }
   else {
       Session::setNews("Database maintanance in progress please try again later");
   }
    
}
}
elseif (array_key_exists("email", $_POST)) {
$email = $update->checkEmail($_POST["email"]);
      
if(!empty($update->errors())){
    errorReporting($update->errors());
}
else {
   if($update->update("users", $_SESSION["id"], ["email" => $email])){;
       Session::setNews("Your email has been succesfully changed");
   }
   else {
       Session::setNews("Database maintanance in progress please try again later");
   }
}
}
elseif (array_key_exists("password", $_POST)) {
$password = $update->checkPassword($_POST["password"], $_POST["password_again"]);
      
if(!empty($update->errors())){
    errorReporting($update->errors());
}
else {
   if($update->update("users", $_SESSION["id"], ["password" => $password])){
       Session::setNews("Your password has been succesfully changed");
   }
   else {
       Session::setNews("Database maintanance in progress please try again later");
   }
}
}

}
 
Session::flashNews();

?>
<h3>Update data</h3>

<form action="" method="post">
    <div class="field">
        <label for="nick">Nick</label>
        <input type="text" name="nick" id="nick" value=""/>
    </div>
    <input type="submit" value="Update nick" name="submit"/>
</form>
<form action="" method="post">
    <div class="field">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value=""/>
    </div>
    <input type="submit" value="Update email" name="submit"/>
</form>
<form action="" method="post">
    <div class="field">
        <label for="password">New password</label>
        <input type="password" name="password" id="password"/>
    </div>
    <div class="field">
        <label for="password_again">Repeat your password</label>
        <input type="password" name="password_again" id="password_again"/>
    </div>
    <input type="submit" value="Update password" name="submit"/>
</form>

<p><a href="logout.php"/>Logout</p>


