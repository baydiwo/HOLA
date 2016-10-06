<?php
ini_set('display_errors', 1);
session_start();
require_once("login/class.user.php");
$login = new USER();

if($login->is_loggedin()!="")
{
    $login->redirect('admin.php');
}

if(isset($_POST['btn-login']))
{
    $uname = strip_tags($_POST['txt_uname_email']);
    $umail = strip_tags($_POST['txt_uname_email']);
    $upass = strip_tags($_POST['txt_password']);

    if($login->doLogin($uname,$umail,$upass))
    {
        $login->redirect('admin.php');
    }
    else
    {
        $error = "Wrong Details !";
    }
}
?>
<?php include 'incl/head.php'; ?>
<div class="container">
    <!-- <div class="row">
        <div class="col-md-4 col-md-offset-4"> -->
            <form class="login-form" method="post" id="login-form">
                <div id="error">
                <?php
                    if(isset($error))
                    {
                        ?>
                        <div class="alert alert-danger">
                           <i class="fa fa-exclamation-triangle"></i> &nbsp; <?php echo $error; ?> !
                        </div>
                        <?php
                    }
                ?>
                </div>
                <div class="form-group">
                    <img src="assets/img/Hola_Logo-red.jpg" class="img-responsive">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="userName" placeholder="User Name" name="txt_uname_email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" placeholder="Password" name="txt_password">
                </div>
                <button type="submit" name="btn-login" class="btn btn-default"><i class="fa fa-sign-in"></i> Login</button>
            </form>
        <!-- </div>
    </div> -->
</div>
<?php include 'incl/footer.php'; ?>
