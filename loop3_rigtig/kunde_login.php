<?php

require_once('includes/header.php');

if(isset($_POST['email']) && isset($_POST['password'])){
    //just checking if the email exists in the DB
    $user = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM kunde_id WHERE email='".$_POST['email']."';"));
    
    //if email is found in DB, check for password
    if($user){

        //get the hashed password as token
        $token = (password_verify($_POST['password'], $user['password']));
        
        //if the hashed password matches, then render the kunde_index.php
        if($token == $user['password']){
            $_SESSION['kunde_id'] = $user['kunde_id'];
            header("Refresh:0; url=kunde_index.php");
            die();
        } 

        //if password doesnt match
        //echo "<p class='error'>Invalid username/password combination.</p>";
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
                            <h1 class="fw-bolder">Log ind</h1>
                            <p class="lead fw-normal text-muted mb-0">Udfyld venligst email og kodeord for at logge ind på kundesiden</p>
                        </div>
                        <main class="flex-shrink-0"></main>
    <fieldset>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email">
                </div>
            </div>

            <br>

            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
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