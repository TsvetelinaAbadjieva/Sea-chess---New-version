<?php //session_start(); ?>
<?php require_once "common/init.php";

$username   = isset($_POST['username'])?htmlspecialchars(trim($_POST['username']),ENT_QUOTES):'';
$password   = isset($_POST['password'])?htmlspecialchars(trim($_POST['password']),ENT_QUOTES):'';
//
if(isset($_POST['username']) && isset($_POST['password'])){
//if(isset($_POST['submit'])) {
    $user = new UserEntity($username, $password);
    $errors = $user->validateLogin();
    $flag=false;
    foreach($errors as $key =>$value){
        if($value!='')
            $flag=true;
    }
    if(!$flag){
        $collection = new UserCollection();

        if ($collection->checkExistingUser($user))
            if($collection->checkUserCredentials($user)) {
                $_SESSION['logged_in'] = 1;
                $_SESSION['username'] = $user->getUsername();
                $_SESSION['flash'] = "{$_SESSION['username']}, You logged in succesfully!";
                $userExists = true;
                redirect("game.php");
            }else {
                 $userExists=false;
                redirect('login.php?userExists='.$userExists);
                echo "<span style='color:red;'>Sorry username already taken !!!</span>";

            }

        else  {
                $userExists=false;
            redirect('login.php?userExists='.$userExists);
            echo "<span style='color:red;'>Sorry username already taken !!!</span>";

        }
    }
}



