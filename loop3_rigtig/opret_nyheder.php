<?php
require_once('includes/admin_header.php');


if (!isset($_SESSION['admin_status'])) {
    echo "<p class='error'>You need to be logged in to get access to this page.</p>";
    require_once('includes/footer.php');
    die();
  }
  
  
  
  if ($_SESSION['admin_status'] == '1' ) {
    echo "<p class='error'>Du har ikke administrator-rettigheder og har derfor ikke adgang til denne side.</p>";
    require_once('includes/footer.php');
    die();
  } else {

?>



<section class="py-5">
            <div class="container px-5 my-5">
                    <div class="text-center mb-5">
                        <h1 class="fw-bolder">Opret nyhed</h1>
                        <p class="lead fw-normal text-muted mb-0">Opret nyheder dynamisk direkte til hjemmesiden</p>
                        <form action='opret_nyheder.php' method='post' class='form'>
                            <div class='row'>
                                <label for='image'>Billede</label>
                                <input type='file' name='fileToUpload' id='fileToUpload'>
                            </div>
                            <div class='row'>
                                <label for='title'>Nyhed title</label>
                                <input type='text' name='title'>
                            </div>
                            <div class='row'>
                                <label for='content'>Indhold</label>
                                <textarea name='content' cols='30' rows='10'></textarea>
                            </div>
                            <div class='row'>
                                <label for='author'>Forfatter</label>
                                <input type='text' name='author'>
                            </div>
                            <div class='row'>
                                <input type="submit" value="Submit" name="submit">
                            </div>
                        </form>
                    </div>

             </div>
</section>


<?php
    //get image
    $file = $_FILES[''];

    if (isset($_POST['submit'])){
        echo 'form submitted';
    }
    echo $file;

    //get current dir in web hotel
    $current_dir = getcwd();
    $target_dir = "images/nyheder_img";

    //concat with target path
    $target_path = $current_dir."images/nyheder_img".$_FILES['fileToUpload']['name']; //check if includes files extension .png .jpg

    //get temp file
    $temp_file = $_FILES['fileToUpload']['tmp_name'];

    //move to target path
    move_uploaded_file($temp_file, $target_path);
    
?>



<?php 
  }
require_once('includes/footer.php');
?>