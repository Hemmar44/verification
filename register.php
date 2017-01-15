<?php
require_once 'core/initialize.php';
//print_r($_SESSION);

//$pdo = new Database();

$check = new Registration; 

if($check->submitted()){
$nick = $check->checkNick($_POST["nick"]);
$email = $check->checkEmail($_POST["email"]);
$password = $check->checkPassword($_POST["password"], $_POST["password_again"]);
$terms = $check->checkTerms($_POST,"terms");

if(!empty($check->errors())){
errorReporting($check->errors());
}


else {
    $check->insert("users",[
        "nick"=>$nick,
        "email"=>$email,
        "password"=>$password,
        "joined"=>date("Y-m-d H:i:s")
    ]);
    redirect_to("index.php");
}

}




?>


<form action="" method="post">
    <div class="field">
        <label for="nick">Nick</label>
        <input type="text" name="nick" id="nick" value=""/>
    </div>
    <div class="field">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value=""/>
    </div>
    <div class="field">
        <label for="password">Choose a password</label>
        <input type="password" name="password" id="password"/>
    </div>
    <div class="field">
        <label for="password_again">Repeat your password</label>
        <input type="password" name="password_again" id="password_again"/>
    </div>
    <div class="field">
        <label for="terms">Terms of use</label>
        <input type="radio" name="terms" id="terms"/>
    </div>
    <input type="submit" value="Register" name="submit"/>
</form>

