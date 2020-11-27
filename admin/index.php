

<?php
//WebApp By : I M C O D E
session_start();
$noNavBar="";
$title="Login";
if(isset($_SESSION["username"]))
{
    $_SESSION["username"]=$user;
            header("Location:Dashboard.php");
}
include 'init.php'; 

//check request
    if($_SERVER['REQUEST_METHOD']==="POST")
   {
        $user=$_POST["user"];
        $pass=$_POST["pass"];
        $hashed=sha1($pass);
        $stmt=$con->prepare("SELECT user_ID,username,pass_word FROM users WHERE username = ? AND pass_word = ? and group_Id=1 LIMIT 1");
        $stmt->execute(array($user,$hashed));
        $row=$stmt->fetch();
        $count=$stmt->rowCount();
        if($count>0)
        {
            
            $_SESSION["username"]=$user;
             $_SESSION["userid"]=$row["user_ID"];
             header("Location:Dashboard.php");
             exit();
        }
    }
    
?>
<div class="bg-index">
    <div class="login info">
   <form class="" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
       <h3 class='text-center'>Admin Login</h3>
        <input type="text" class="form-control" name='user' placeholder='username' autocomplete='off'/>
        <input type="password" class="form-control" name='pass' placeholder='password' autocomplete='new-password'/>
        <input type="submit" class="btn btn-success btn-block" value="Login">
   </form>
   </div>
</div>
<?php include $tpl.'footer.php';?>