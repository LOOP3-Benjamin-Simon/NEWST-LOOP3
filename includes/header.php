<?php
//ob_start koden tænder for 'output-buffering'. Der kan ikke være flere headere i headeren, så derfor skal den anvendes for ikke at få fejlen "header has already been sent"
ob_start();
//med følgende koder undersøger vi, om der er startet en session. Hvis ikke, så skal den startes
if (!isset($_SESSION)) session_start();
require_once('conn.php');
?>

<!DOCTYPE html>
<html lang="da">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="StrainMonitoring tilbyder overvågningsløsninger til bygningskonstruktioner. Ved hjælp af Strain Gauges monitorerer vi din konstruktion og forbedrer sikkerheden markant" />
        <meta name="Strain Monitoring" content="" />
        <title>StrainMonitoring</title>

        <!-- Favicon, dvs. det lille ikon/logo, der vises af browseren i fanevisningen-->
        <link rel="icon" type="image/x-icon" href="assets/favicon2.ico" />

        <!-- Bootstrap ikoner - et helt bibliotek af bootstrap-ikoner, f.eks. login/logud symboler-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/bootstrap.css" rel="stylesheet" />

        <!-- Her overwriter vi med egne styles -->
        <link href="css/styles.css" type="text/css" rel="stylesheet" />

         <!-- Her tilføjer vi vores footers JavaScript-løsning, så footeren tilpasser sig efter behov-->
        <script defer src="js/position_footer.js"></script>
    </head>


    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0">
            <!-- Navigation-->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container px-5">
                    <a class="navbar-brand" href="index.php">Strain <span style="color: #FFCC00"> | </span> Monitoring</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul id = "tekstfarvenav" class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <li class="nav-item"><a class="nav-link" href="produkter.php">Produkter</a></li>
                                <li class="nav-item"><a class="nav-link" href="blivkunde.php">Bliv kunde</a></li>
                                <li class="nav-item"><a class="nav-link" href="kontakt_os.php">Kontakt os</a></li>

                                <!-- I følgende login-link ønsker vi et lille ikon af et mennneske. Dette ikon tages fra bootstrap icons og skal indsættes i et svg-tag. SVG-tagget er et sprog til at beskrive 2D grafik-->
                                
                                <li class="nav-item"><a class="nav-link" href="kunde_login.php">Log ind
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FFCC00" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
                                </svg></a></li>  
                        </ul>
                    </div>
                </div>
            </nav>
        

        


