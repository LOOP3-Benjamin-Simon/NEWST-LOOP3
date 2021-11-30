<?php

require_once('includes/kunde_header.php');

//Her undersøger vi, om der er en session med brugerne. Hvis der ikke er, så får brugeren følgende fejlmeddelelse. 

if (!isset($_SESSION['kunde_id'])) {
    echo "<h3 class='text-center mt-3 text-danger'> <strong> Du skal være logget ind for at få adgang til denne side. </strong></h3>";
    require_once('includes/footer.php');
    die();
}

$kunde = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM kunde_id WHERE kunde_id=".$_SESSION['kunde_id'].";"));

//Vi sætter '' rundt om 0-tallet fordi den ellers vil sammenligne en string med en integer, hvilket den ikke kan. Nu sammenligner den en string med en string. 
if ($kunde['kunde_status'] == '0') {
    echo "<p class='error'>Du har ikke kunde-rettigheder og har derfor ikke adgang til denne side.</p>";
    require_once('includes/footer.php');
    die();
} else {

$user_id = $_SESSION['kunde_id'];
$query = "SELECT * FROM kunde_info WHERE kunde_id=$user_id;";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$kunde_id = $row['kunde_id'];
$fornavn = $row['fornavn'];
$efternavn = $row['efternavn'];


//Følgende er en dynamisk velkomsthilsen til den kunde, der er logget ind. Fornavn og efternavn på kunden vil blive vist. 

if ($_SESSION) {
    echo "
        <section class='py-5'>
            <div class='container px-5 my-5'>
                    <div class='text-center mb-5'>
                        <h1 class='fw-bolder'>Velkommen, " . $fornavn . " " . $efternavn . "</h1>
                        <p class='lead fw-normal text-muted mb-0'>Du er nu logget ind som kunde</p>
                    </div>
            </div>
        </section>
    ";
    
}


?>


<!-- her indsættes et billede af vores bud på, hvordan kunde-index-siden kan komme til at se ud -->

<main>
    <div class="col-lg-6 order-first order-lg-last">
        <img class="rounded mb-5 mb-lg-0" src="images/kunde_index.png" alt="..." />
    </div>
    <br>
    <br>
</main>




<?php
}
require_once('includes/footer.php');
?>