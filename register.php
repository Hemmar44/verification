<?php
require_once 'core/initialize.php';
//print_r($_SESSION);

//$pdo = new Database();
global $nick ;
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
    $to = $email;
    $subject = "Signup to my site";
    $hash = md5($email.md5($nick));
    $message = 'Click this link to verify your email: http://127.0.0.1/verification/register.php?email='.$email.'&verify='.$hash.' ';
    $headers = 'From:noreply@localhost.com';
    Mail::send($to, $subject, $message, $headers);
    
        $check->insert("users",[
        "nick"=>$nick,
        "email"=>$email,
        "password"=>$password,
        "joined"=>date("Y-m-d H:i:s"),
        "hash"=>$hash,
    ]);
}
    
}

if(isset($_GET) && isset($_GET["verify"])) {
    $email = $_GET["email"];
    
    $verify = $_GET["verify"];
    
    if($user=($check->selectSome("users", ["id", "email", "hash", "active"], ['email'=>$email])[0])) {
        $db_hash = $user["hash"];
        $active = $user["active"];
        if($active === 0){
        if($verify === $db_hash) {
            $check->update("users", $user["id"], ["active" => 1]);
            Session::setNews("Your account is now active, you can login to your account");
            redirect_to("index.php");
            }
        else 
            {
            echo "Ooops something is wrong";
             
            }
    }
    else {
        Session::setNews("Your account has already been activated you can login straight away");
        redirect_to("index.php");
    }
    
}

    else{
        die("We can't create your account at the moment, please try again later");
    }
    
}


?>


<form action="" method="post">
    <div class="field">
        <label for="nick">Nick</label>
        <input type="text" name="nick" id="nick" value="<?php if(isset($_POST["nick"])) {echo $_POST["nick"];} ?>"/>
    </div>
    <div class="field">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?php if(isset($_POST["email"])) {echo $_POST["email"];} ?>"/>
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

<p>Already have an account ? <a href="index.php"/>Sign in here</a></p>