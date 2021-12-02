<?php

require_once('includes/kunde_header.php');

if (!isset($_SESSION['kunde_id'])) {
    echo "<h3 class='text-center mt-3 text-danger'> <strong> Du skal være logget ind for at få adgang til denne side. </strong></h3>";
    require_once('includes/footer.php');
    die();
}

$kunde = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM kunde_id WHERE kunde_id=".$_SESSION['kunde_id'].";"));

if ($kunde['kunde_status'] == '0' ) {
    echo "<p class='error'>Du har ikke kunde-rettigheder og har derfor ikke adgang til denne side.</p>";
    require_once('includes/footer.php');
    die();
} else {


?>


<section class='py-5'>
    <div class='container px-5 my-5'>
        <div class='text-center mb-5'>
            <h1 class='fw-bolder'>Kundeoplysninger</h1>
                <p class='lead fw-normal text-muted mb-0'>Her kan du se dine kundeoplysninger</p>
        </div>
    </div>
</section>


<?php
}
require_once('includes/footer.php');
?>