<?php
require_once('includes/admin_header.php');


if (!isset($_SESSION['admin_id'])) {
    echo "<h3 class='text-center mt-3 text-danger'> <strong> Du skal være logget ind for at få adgang til denne side. </strong></h3>";
    require_once('includes/footer.php');
    die();
  }
  
else {

?>


<!-- Her indsættes overskriften samt den korte guide til billed-upload-->
<section class="py-5">
            <div class="container px-5 my-5">
                    <div class="text-center mb-5">
                        <h1 class="fw-bolder">Opret en nyhed</h1>
                        <p class="lead fw-normal text-muted mb-0">Opret nyheder dynamisk direkte til hjemmesiden </p> <br>
                        <strong>Husk dette <em>før</em> du opretter en nyhed</strong> <br> <br>

                        <strong>1.</strong> Billeder skal helst uploades i størrelsen 600x350 pixels. <br>
                        <strong>2.</strong> Vær opmærksom på at læse korrektur før nyheden oprettes. Nyheder kan <strong>kun</strong> slettes fra databasen.
                        <br>
                        <br>
                        <br>
                      
                    
                      




  <?php
  //Checks if the image name and the image file have been posted
  if (isset($_POST['img_name']) && isset($_FILES['image']) && isset($_POST['title']) && isset($_POST['content']) && isset($_POST['forfatter'])) {
    //Assigns the posted values to the corresponding variables
    $img_name = mysqli_real_escape_string($con, $_POST['img_name']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $content = mysqli_real_escape_string($con, $_POST['content']);
    $forfatter = mysqli_real_escape_string($con, $_POST['forfatter']);


    //Starts the processing of images
    $current_dir = getcwd(); //Identifies the current directory
    $upload_directory = "/images/nyheder_img/"; //Sets the path for the uploaded images to the folder images/uploads
    $errors = []; // Stores all foreseen and unforseen errors in an array

    $file_extensions = ['jpeg', 'jpg', 'png', 'JPEG', 'JPG', 'PNG']; // Declares all the approved file extensions
    $file_name = $_FILES['image']['name']; //Gets the original name of the file
    $file_size = $_FILES['image']['size']; //Gets the size of the file
    $file_tmp_name  = $_FILES['image']['tmp_name']; //Gets the temporary name assigned to the file while processing
    $file_type = $_FILES['image']['type']; //Gets the file type
    $tmp = explode('.', $file_name);
    $file_extension = end($tmp);

    //Sets the upload path from the current directory, adds a random number to the beginning of the filename of the returned filename from the specified pathto avoid duplicated names 
    $upload_path = $current_dir . $upload_directory . rand(1, 1000) . basename($file_name);
    $target_file = $upload_directory . rand(1, 1000) . basename($file_name);

    //Checks if the submit button has been pressed and performs the necessary tests on the file
    /*if (isset($_POST['submit'])) {
      //Checks the file extension agains the approved ones, if the user tries to upload a file type that is not in the list stores an error message in the errors array
      if (!in_array($file_extension, $file_extensions)) {
        $errors[] = "This file extension is not allowed. Please upload a JPEG, JPG or PNG file";
      }*/

      //Checks the file size against 2000000 (2MB), if the user tries to upload a file that is larger than 2MB stores an error message in the errors array
      if ($file_size > 2000000) {
        $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
      }

      //Checks if the errors array is empty and if so, moves the file to the given path
      if (empty($errors)) {
        $did_upload = move_uploaded_file($file_tmp_name, $upload_path);
        //Checks if the file was moved and gives the user a message about it
        if ($did_upload) {
          $filename = basename($upload_path); //extracts the new filename

          //Vi bruger substract-metoden til at slettet et vist antal tegn i begyndelse af pathen. Vi skulle have fjernet en enkelt skråstreg og derfor anvendes substr 1, så pathen passer og billedet uploades til databasen. 
          $image_path = substr($upload_directory, 1) . $filename; //creates the path to be added to the database

          //if the file moving failed gives an error (this error normally means that the folder doesn't have Read/Write permissions)
        } else {
          echo "An error occurred somewhere. Try again.";
        }

        //Inserts the image name, image description and image path to the table upload and gives the user a message
        $query = "INSERT INTO nyheder(img_path, img_name, title, content, forfatter) VALUES('$image_path','$img_name', '$title', '$content', '$forfatter')";
        $result = mysqli_query($con, $query);
        if (!$result) die(mysqli_error($con));
        else {
          echo "<div class='message'> <br>";
          echo "<img src='" . $image_path . "' alt='" . $img_name . "' class='img-thumbnail'> <br> <br>";
          echo "<h2 class='success'>Nyheden er nu uprettet og er synlig på index-siden</h2> <br>";
          echo "</div>";
        }
      } else {
        //If the file is not an image or larger than 2MB it informs the user and returns to the form.
        foreach ($errors as $error) {
          echo "<script>alert('" . $error . "');
				window.location.href='opret_nyheder_rigtig.php';
				</script>";
          die();
        }
      }
    }
  }

  ?>

  <!-- Forms that are used to process files require the enctype="multipart/form-data" attribute to be able to process the files -->
  <form action="opret_nyheder_rigtig.php" method="post" enctype="multipart/form-data" class="form form-upload">
    <!--The file will be contained in a $_FILE[] variable called image -->
    <div class="input-group mb-3">
      <input type="file" class="form-control" id="inputGroupFile02" name="image">
    </div>
    <div class="input-group mb-3">
      <input type="text" class="form-control" name="img_name" placeholder="Billednavn" required>
    </div>
    <div class="input-group mb-3">
      <input type="text" class="form-control" name="title" placeholder="Nyhedstitel">
    </div>
    <div class="input-group mb-3">
      <textarea class="form-control" name="content" placeholder="Brødtekst" required></textarea>
    </div>
    <div class="input-group mb-3">
      <input type="text" class="form-control" name="forfatter" value="StrainMonitoring" required>
    </div>
 
    <br>
    <div class="row">
      <button class="btn btn-warning" type="submit" name="submit">Upload</button>
    </div>
  </form>
  </div>
</main>
</body>

                    </div>

             </div>
</section>




<?php 
  /*}*/
require_once('includes/footer.php');
?>