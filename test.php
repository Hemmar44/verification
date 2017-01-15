<?php
require_once 'core/initialize.php';
//tutorial from https://phpdelusions.net/pdo

$dsn = "mysql:host=".DB_SERVER.";dbname=".DB_NAME.";charset=".DB_CHARSET;


echo "<hr/>";


$pdo = new Database();

$users = $pdo -> selectAll("users");
//this will only display the query
foreach($users as $user) {
    echo $user["id"].": " .$user["nick"]."<br/>";
}
echo "<hr/>";

if($user = $pdo -> selectOne("users", "nick", "Aneczka")) {
    print_r($user);
}
else {
    echo "Uzytkownik nie istnieje";
}

echo "<hr/>";

if(($count = $pdo->delete("users", "id", 12))>0){
    echo "removed {$count} row";
}
else {
    echo "nothing to remove";
}

echo "<hr/>";

$pdo->insert("users", [
    
    "nick" => "Rafalio",
    "email" => "jasss@asd.pl",
    "password" => "pasl",
    "joined" => date("Y-m-d H:i:s")
    ]);

$pdo->update("users", 11, [
    "nick" => "Krysia",
    "password" => "lepsze"
])
    


//error mode can also be set after instance of an pdo object not needed here cause we set it in options.
//$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
//no try and catch or other special error handling needed
//development server
//ini_set('display_errors', 1);
//production server
//ini_set('display_errors', 0);
//ini_set('log_errors', 1);



/*



echo "<hr/>";
//if named placeholders then we must use a associative array, keys must match the placeholders names in the query :is required
$sql = "SELECT * FROM users WHERE id > :id AND nick = :nick";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => 0, 'nick' => 'Aneczka']);
$user = $stmt->fetch();
print_r($user);
echo "<hr/>";
//if quetionmarks no associative array needed, the order must be identical in the array an in the query
$sql = "SELECT * FROM users WHERE id > ? AND nick = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([0, "hemmar"]);
$user = $stmt->fetch();
print_r($user);
//when using execute metho all data will be send to us as strings (save for null)
echo "<hr/>";
$sql = "SELECT * FROM users WHERE id > ? LIMIT ? ";
$stmt = $pdo->prepare($sql);
$stmt->execute([0, 4]);
//in print_r we get always only one result we need to loop with print_r or var_dump to get all of them
while($user = $stmt->fetch()) {
    
    print_r($user);
};

echo "<hr/>";

//updatin query is very similiar can be run in one line cause it doesn't return any value;
$sql = "UPDATE users SET nick = ? WHERE id = ?";
if($stmt = $pdo->prepare($sql)->execute(["Bozyn", 4])) { echo "zmienione" ;}

echo "<hr/>";

$sql ="DELETE FROM users WHERE id > :id";
$stmt = $pdo->prepare($sql);
if($stmt->execute(["id" => 5])) {
    //gives info how many have been deleted
   if($deleted =  $stmt->rowCount()>0){
       echo "{$deleted} row/s have been removed";
   }
   else {
       echo "Nothing to remove";
   }
}

echo "<hr/>";

//foreach
$sql = "SELECT nick FROM users";
$stmt = $pdo->query($sql);
foreach($stmt as $row) {
    echo "Nick: {$row["nick"]} <br/>";
}
echo "<hr/>";
// Getting the nick based on id
$stmt = $pdo->prepare("SELECT nick FROM users WHERE id>?");
$stmt->execute([2]);
//echo $name = $stmt->fetchColumn();
while($name = $stmt->fetchColumn()){
    echo "$name <br/>";
}
echo "<hr/>";
// getting number of rows in the table utilizing method chaining
$count = $pdo->query("SELECT count(*) FROM users")->fetchColumn();
echo $count;
echo "<hr/>";

$stmt = $pdo->query("SELECT email,id FROM users")->fetchAll();
var_export($stmt);

echo "<hr/>";
//getting plain one dimensional array (if more than one parameters only first returned);

$stmt = $pdo->query("SELECT email,id FROM users")->fetchAll(PDO::FETCH_COLUMN);
var_export($stmt);
echo "<hr/>";
//getting pair of results
$stmt = $pdo->query("SELECT id,email FROM users")->fetchAll(PDO::FETCH_KEY_PAIR);
foreach($stmt as $id => $email) {
    echo "{$id}: {$email} <br/>";
}
echo "<hr/>";
$stmt = $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_UNIQUE);
foreach($stmt as $id =>$array) {
    echo "<ul>$id";
    foreach($array as $key => $value) {
        echo "<li>$key: $value </li>";
    }
    echo "</ul>";
}
echo "<hr/>";
//to check if there is any data we dont need rowCount we can do as follow
$sql = "SELECT 1 FROM users WHERE nick = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute(["Aneczka"]);
$data = $stmt->fetchAll();

if($data){
    echo "istnieje";
}
else {
    echo "nie istnieje";
}

echo "<hr/>";

$sql = "SELECT count(*) FROM users";
$stmt = $pdo->query($sql)->fetchColumn();
print_r($stmt);

echo "<hr/>";

$sql = "SELECT count(*) FROM users where id > :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(["id"=>2]);
$count = $stmt->fetchColumn();
print_r($count);
echo "<hr/>";
//LIKE

$sql = "SELECT * FROM users WHERE nick LIKE :nick";
$stmt = $pdo->prepare($sql);
$stmt->execute(["nick"=>"%czka"]);
$data = $stmt->fetchAll();
print_r($data);
echo "<hr/>";

$arr = [1,4];
$in  = str_repeat('?,', count($arr) - 1) . '?';
//print_r($in);
$sql = "SELECT * FROM users WHERE id IN ($in)";
$stm = $pdo->prepare($sql);
$stm->execute($arr);
$data = $stm->fetchAll();
var_dump($data);

echo "<hr/>";

$arr = ["Aneczka", "Majeczka", "Bozyn"];
$in = str_repeat("?,", count($arr) -1)."?";
$sql = "SELECT * FROM users WHERE nick IN ($in)";
$stmt = $pdo->prepare($sql);

$stmt->execute($arr);
$data = $stmt->fetchAll();
print_r($data);
echo "<hr/>";

$arr = ["Aneczka", "Majeczka", "Bozyn"];
$in = str_repeat("?,", count($arr) -1)."?";
$sql = "SELECT * FROM users WHERE nick IN ($in) AND id > ?";
$stmt = $pdo->prepare($sql);
$params = array_merge($arr, [2]);
print_r($params);
$stmt->execute($params);
$data = $stmt->fetchAll();
print_r($data);
echo "<hr/>";
 * 
 */
?>

<!---
<form action="" method="post">
    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value=""/>
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
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value=""/>
    </div>
    
    <input type="submit" value="Register" name="submit"/>
</form>

-->