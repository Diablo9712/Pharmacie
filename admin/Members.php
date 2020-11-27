<?php
session_start();
$title="Members";
$userid=$_SESSION['userid'];
if(isset($_SESSION["username"]))
{
    include 'init.php';
    $actn=isset($_GET["actn"])?$_GET["actn"]:'Edit';
   
    switch($actn)
{
     
    case "Edit":
            $user_id=isset($_GET["userid"]) && is_numeric($_GET["userid"]) && $_GET["userid"]==$userid?$userid:0;
            $stmt=$con->prepare("SELECT * FROM users WHERE username = ? AND user_ID= ? LIMIT 1");
            $stmt->execute(array($_SESSION["username"],$user_id));
            $row=$stmt->fetch();
            $count=$stmt->rowCount();
            if($count>0)
            {         
        ?>

                <div class="container">
                    <h1 class="text-center">ADMIN SETTING</h1>
                    <form class="form-horizontal" action="Members.php?actn=Update&userid="<?php echo $row["user_ID"]?> method="POST">
                    <!--start username -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">username</label>
                            <div class="col-sm-10 col-md-4">
                            <input type="text" name="userid" value='<?php echo $row["user_ID"]?>' class="hidden" autocomplete='off' />
                                <input type="text" name="username" class="form-control" value='<?php echo $row["username"]?>' autocomplete="off"required="required"/>
                            </div>
                        </div>
                    <!--end username -->
                    <!--start Email -->
                    <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="email" name="Email" value='<?php echo $row["email"]?>' class="form-control" autocomplete='off' required="required"/>
                            </div>
                        </div>
                    <!--end Email -->
                        <!--start Current password -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Current password</label>
                            <div class="col-sm-10 col-md-4">
                            <input type="hidden" name="o_pass" value='<?php echo $row["pass_word"]?>'/>
                                <input type="password" name="C_pass" class="form-control" autocomplete='new-password' required="required"/>
                            </div>
                        </div>
                        <!--end Current password -->
                        <!--start New password -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">New password</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="password" name="N_pass" class="form-control" autocomplete='new-password' placeholder="Live it blank  to keep same password "/>
                            </div>
                        </div>
                    <!--end New password -->
                    <!--start Confirme password -->
                    <div class="form-group">
                            <label class="col-sm-2 control-label">Confirme password</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="password" name="CF_pass" class="form-control" autocomplete='new-password' placeholder="Live it blank to keep same password "/>
                            </div>
                        </div>
                    <!--end Confirme password -->
                    <!--start save button-->
                    <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit"  value="Save" class="btn btn-primary"/>
                            </div>
                        </div>
                    <!--end save button -->
                    </form>
                </div>
<?php 
            }else{

                
            }
    break;
    case "Update":
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {   
        
        $userid=filter_var($_POST["userid"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $username=filter_var(strip_tags ($_POST["username"]),FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email=filter_var(strip_tags($_POST["Email"]),FILTER_SANITIZE_EMAIL);
        $c_pass=sha1(strip_tags($_POST["C_pass"]));
        $N_pass=sha1(strip_tags($_POST["N_pass"]));
        $CF_pass=sha1(strip_tags($_POST["CF_pass"]));
        //check fied 
        echo "<div class='container'>";
        include $func."checkinputM.php";
        $stmt=$con->prepare("UPDATE users set username=? , email=? ,pass_word=? WHERE user_ID=?");
        if(empty($_POST["N_pass"])==true && empty($_POST["CF_pass"])==true)
        {
            $N_pass=$c_pass;
        }
        elseif(empty($_POST["N_pass"])==false && empty($_POST["CF_pass"])!==false &&  $N_pass==$CF_pass)
         {
            $N_pass=$CF_pass;
         }
           
            if($c_pass==$_POST["o_pass"])
            {
                if(count($HE)==0)
                {    
                    $stmt->bindParam(1,$username,PDO::PARAM_STR, 255);
                    $stmt->bindParam(2,$email,PDO::PARAM_STR, 255);
                    $stmt->bindParam(3,$N_pass,PDO::PARAM_STR, 255);
                    $stmt->bindParam(4,$userid,PDO::PARAM_INT);
                    $stmt->execute();
                    if($stmt->rowCount()>=0)
                    {
                       
                        $_SESSION["username"]=$username;
                       header("Location:Members.php");
                    }else{
                         header("Location:Members.php");
                    }
                
                }
           
            echo "</div>";
            }
        
    }else{
       echo "page not found";
    }
    ?>
 <?php  break;
    default:
    echo "Page notfound ???";
    break;
}
    include $tpl.'footer.php';
}else{

header("Location:index.php");
exit();    
}?>