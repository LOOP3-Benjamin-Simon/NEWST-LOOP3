<?php
require_once('includes/header.php');


// Dette er PHP-koden til at få kontaktformularen til at virke

//Først undersøger vi, om der er indtastet oplysninger i felterne
if (isset($_POST['fornavn']) && isset($_POST['efternavn']) && isset($_POST['email']) && isset($_POST['telefonnummer']) && isset($_POST['besked'])) {
    $fornavn = $_POST['fornavn'];
    $efternavn = $_POST['efternavn'];
    $email = $_POST['email'];
    $telefonnummer = $_POST['telefonnummer'];
    $besked = $_POST['besked'];


//Nu opretter vi en request/anmodning/query om at indsætte disse data i de korrekte tabeller i databasen

    $query = "INSERT INTO kontakt_os (fornavn, efternavn, email, telefonnummer, besked) VALUES ('$fornavn', '$efternavn', '$email', '$telefonnummer', '$besked')";
    $result = mysqli_query($con, $query);
    

// Hvis ovenstående lykkes, så skal der vises en besked til brugeren. Hvis det ikke lykkes, så vises formularen og vi bruger længere nede JavaScript til at håndtere det.
   
    if ($result === TRUE) {
        $besked_id = mysqli_insert_id($con);
        $query = "INSERT INTO kontakt_os (besked_id, fornavn, efternavn, email, telefonnummer, besked) VALUES ('$besked_id', '$fornavn', '$efternavn', '$email', '$telefonnummer', '$besked')";
        $result = mysqli_query($con, $query);
        echo " 
                <div class='container px-5 my-5'>
                    <div class='text-center'>
                        <h1 class='fw-bolder'>Tak for din besked.</h1>
                        <p class='lead fw-normal text-muted mb-5'> Vi vender tilbage hurtigst muligt. Bemærk at der i øjeblikket er ventetid på ca. 7 år </p>
                    </div>
                </div>";
        header("Refresh:9; url=index.php");
    } 

} else {
    
?>


<!--Her er selve kontaktformularen-->

<main class="flex-shrink-0">
    <section class="py-5 bg-light">
        <div class="container px-5 my-5">
            
                <div class="text-center mb-5">
                    <h1 class="fw-bolder">Kontakt os</h1>
                    <p class="lead fw-normal text-muted mb-0">Udfyld venligst nedenstående formular for alle slags henvendelser</p>
                </div>

                <fieldset>
                    <br>
                        <form class="row g-3 needs-validation" novalidate action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        
                            <div class="row">
                                <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">Fornavn</label>
                                        <input type="text" class="form-control" id="validationCustom01" name="fornavn" placeholder="Skriv her" required>
                                        <div class="valid-feedback"></div>
                                </div>

                                <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">Efternavn</label>
                                        <input type="text" class="form-control" id="validationCustom01" name="efternavn" placeholder="Skriv her" required>
                                        <div class="valid-feedback"></div>
                                </div>
                            </div>

                            <div class="row py-4">
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">E-mail</label>
                                        <input type="email" class="form-control" id="validationCustom01" name="email" placeholder="Skriv her" required>
                                        <div class="invalid-feedback"> Dette er ikke en email</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">Telefonnummer</label>
                                        <input type="text" class="form-control" id="validationCustom01" name="telefonnummer" placeholder="Skriv her" required>
                                        <div class="valid-feedback"></div>
                                    </div>
                            </div>

                            <div class="row">
                                    <div class="form-floating mb-3 py-5">
                                        <label for="message">Skriv din besked her</label>
                                        <textarea class="form-control" id="message" name="besked" type="text" style="height: 10rem" data-sb-validations="required"></textarea>
                                        <div class="invalid-feedback" data-sb-feedback="message:required">Du skal skrive en besked.</div>
                                    </div>
                            </div>
           
                            <br>
                            <br>
                            <div class="col-12">
                                <button class="btn btn-warning" type="submit">Send besked</button>
                            </div>
                
                        </form>
                </fieldset>
            
        </div>
    </section>
   

<!-- Her kommer sektionen med alle vores kontaktoplysninger inkl. billeder-->

            <section class="py-5 bg-light">
                <div class="container px-5 my-5">
                    <div class="text-center">
                        <h2 class="fw-bolder">Kontakt vores team direkte</h2>
                        <p class="lead fw-normal text-muted mb-5">Her kan du få direkte kontakt til den ønskede medarbejder</p>
                    </div>        
                    <div class="row gx-5 row-cols-1 row-cols-sm-2 row-cols-xl-5 justify-content-center">
                        <div class="col mb-5 mb-5 mb-xl-0">
                            <div class="text-center">
                                <img class="img-fluid rounded-circle mb-4 px-4" src="images/benjamin.jpg" alt="..." />
                                <h5 class="fw-bolder">Benjamin Longerich</h5>
                                <h6 class="">+45 12 34 56 5€</h6>
                                <h6 class="">benjamin@strainmonitoring.dk</h6>
                                <div class="fst-italic text-muted">Founder</div>
                            </div>
                        </div>
                        <div class="col mb-5 mb-5 mb-xl-0">
                            <div class="text-center">
                                <img class="img-fluid rounded-circle mb-4 px-4" src="images/simon.jpg" alt="..." />
                                <h5 class="fw-bolder">Simon Schou</h5>
                                <h6 class="">+45 12 34 56 6€</h6>
                                <h6 class="">simon@strainmonitoring.dk</h6>
                                <div class="fst-italic text-muted">Founder</div>
                            </div>
                        </div>
                        <div class="col mb-5 mb-5 mb-sm-0">
                            <div class="text-center">
                                <img class="img-fluid rounded-circle mb-4 px-4" src="images/alex.jpg" alt="..." />
                                <h5 class="fw-bolder">Alex Madsen</h5>
                                <h6 class="">+45 12 34 56 7€</h6>
                                <h6 class="">alex@strainmonitoring.dk</h6>
                                <div class="fst-italic text-muted">Founder</div>
                            </div>
                        </div>
                        <div class="col mb-5">
                            <div class="text-center">
                                <img class="img-fluid rounded-circle mb-4 px-4" src="images/asbjørn.jpg" alt="..." />
                                <h5 class="fw-bolder">Asbjørn Pank</h5>
                                <h6 class="">+45 12 34 56 8€</h6>
                                <h6 class="">asbjoern@strainmonitoring.dk</h6>
                                <div class="fst-italic text-muted">Founder</div>
                            </div>
                        </div>
                        <div class="col mb-5 mb-5 mb-xl-0">
                            <div class="text-center">
                                <img class="img-fluid rounded-circle mb-4 px-4" src="images/esben.jpg" alt="..." />
                                <h5 class="fw-bolder">Esben Glerup</h5>
                                <h6 class="">+45 12 34 56 9€</h6>
                                <h6 class="">esben@strainmonitoring.dk</h6>
                                <div class="fst-italic text-muted">Founder</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

</main>



<!-- Her bruges Javascript til at undgå at formularen sendes af sted, hvis der er ugyldige felter - f.eks. manglende udfylding-->

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>

<?php
}
require_once('includes/footer.php');
?>