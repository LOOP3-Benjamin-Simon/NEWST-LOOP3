<?php
require_once('includes/admin_login_header.php');

if(isset($_POST['admin_email']) && isset($_POST['admin_password'])){
    //just checking if the email exists in the DB
    $user = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM admin_login WHERE admin_email='".$_POST['admin_email']."';"));
    
    //if email is found in DB, check for password
    if($user){

        //password not hashed
        
        //if the password matches, then render the kunde_index.php
        if($_POST['admin_password'] == $user['admin_password']){
            $_SESSION['admin_id'] = $user['admin_id'];
            header("Refresh:0; url=admin_index.php");
            die();
        } 

        //if password doesnt match ->pass out of if statement
    }

    // if not even the email matches
    echo "<p class='error'>Invalid username/password combination.</p>";
}
?>


<section class="py-5">
                <div class="container px-5">
                    <!-- Contact form-->
                    <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
                        <div class="text-center mb-5">
                            <h1 class="fw-bolder">Administrator login</h1>
                            <p class="lead fw-normal text-muted mb-0">Udfyld venligst email og kodeord for at logge ind på administratorsiden</p>
                        </div>
                        <main class="flex-shrink-0"></main>
    <fieldset>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="admin_email">
                </div>
            </div>

            <br>

            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="admin_password">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 py-4 justify-content-center">
                    <button type="submit" class="btn btn-warning">Login</button>
                </div>
            </div>
        </form>
        

    </fieldset>
</main>
                    </div>
                </div>
</section>


<?php
require_once('includes/footer.php');
?>