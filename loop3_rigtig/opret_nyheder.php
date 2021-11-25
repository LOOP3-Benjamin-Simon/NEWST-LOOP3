<?php
require_once('includes/admin_header.php');
require_once('conn.php');

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
                      <form action="opret_nyheder.php" method="post" class="form form-upload">
                        <div class="input-group mb-3">
                          <input type="file" class="form-control" id="img" name="img" required>
                        </div>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" name="img_title" placeholder="Billedtitel" required>
                        </div>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" name="title" placeholder="Nyhedstitel">
                        </div>
                        <div class="input-group mb-3">
                          <textarea class="form-control" name="content" placeholder="Brødtekst" rows=10 required></textarea>
                        </div>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" name="forfatter" placeholder="StrainMonitoring" required>
                        </div>

                        <br><br>
                          
                        <div class="row">
                          <input class="btn btn-secondary" type="submit" name="submit" value="upload">
                        </div>
                      </form>
                    </div>

             </div>
</section>


<?php                                           
  }
    //HANDLE FORM SUBMIT

    //Only if form was actually submitted
    if (isset($_POST['submit'])){
        echo 'form submitted';
    
        //get image info
        $file = $_FILES['img'];
        $file_name = $_FILES['img']['name'];

        //get current dir in web hotel
        $current_dir = getcwd();
        $target_dir = "/images/nyheder_img";

        //concat with target path
        $target_path = $current_dir . $target_dir . rand(1,1000) . basename($file_name);
        echo $target_path;

        //get temp file
        $temp_file = $_FILES['img']['tmp_name'];

        //move to target path
        $did_upload = move_uploaded_file($temp_file, $target_path);

        //only if uploaded, enter all info into DB
        if($did_upload){

            $img_title = $_POST['img_title'];
            
            //the relative path goes into the <img src="$relative_path">, so you may need to adjust that, so it fits the structure in your webhotel
            $relative_path = "." . $target_dir . basename($file_name);
            echo $relative_path;

            //upload all info to DB
            mysqli_query($con,"
                INSERT INTO nyheder(img_path,img_name,content,forfatter, title)
                VALUES ($relative_path,$img_title,'".$_POST['content']."','".$_POST['forfatter']."','".$_POST['title']."');
            ");
            echo "Successfully uploaded image";
        }
    }
    
require_once('includes/footer.php');
?>
