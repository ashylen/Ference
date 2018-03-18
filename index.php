<?php
session_start();
if ((isset($_SESSION['zalogowany']) ) && ($_SESSION['zalogowany'] == true)) {
    header('Location: zalogowany.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pl-PL">
    <head>
        <title>Ference - udane wydarzenia.</title>
        <meta charset="UTF-8">
        <meta name="description" content="Organizacja wydarzeń, konferencji oraz spotkań w jednym miejscu!"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Comaptible" content="IE=edge, chrome=1"/>

       
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Lato&amp;subset=latin-ext" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="plugins/owl/assets/owl.carousel.css"  />
        <link rel="stylesheet" href="css/style.css" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Lato&amp;subset=latin-ext" rel="stylesheet">
       
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="jquery.min.js"></script>
        <script src="owlcarousel/owl.carousel.min.js"></script>
        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        
       
        
     </head>
    
      <body>
        <!-- SKRYPTY DO KARUZELI POCZATEK -->
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.js"><\/script>')</script>
        <script src="js/main.js"></script>
        <script src="js/owl.carousel.min.js" type="text/javascript"></script>
        <script src="js/additional-methods.min.js" type="text/javascript"></script>
         <!-- SKRYPTY DO KARUZELI KONIEC -->

        <!-- NAWIGACJA POCZATEK -->
                <nav role='navigation'>
                    <div id="logo" class="tilelinkhtml5">Ference</div>
                    <ul>
                        <li><a href="Szybkie-tworzenie-darmowych-wydarzen">Strona główna</a></li>
                        <li><a href="Logowanie">Zaloguj się</a></li>
                        <li><a href="Rejestracja">Rejestracja</a></li>
                    </ul>
                </nav>
        <!-- NAWIGACJA KONIEC -->

        <!-- ALE ZIMNO-->   <br/><br/><br/><br>  <!-- BRRR!-->
         
         <!-- KARUZELA POCZATEK -->
            <?php
            if (isset($_GET["msg1"]) && $_GET["msg1"] == 'success') {
                echo '<a href="zalogujstrona.php"><div class="karuzela"  >Rejestracja przebiegła pomyślnie, kliknij tutaj, aby się zalogować.</div></a>';
            }
            ?>
         <br>
        <div class="owl-carousel">
        
            <div> <img src="img/1.png" /> </div>
            <div> <img src="img/2.png" /> </div>
            <div> <img src="img/3.png" /> </div>
        </div>

         <!-- KARUZELA KONIEC-->
    
        <div class="srodek">Organizacja spotkań nigdy nie była tak łatwa. Dołącz do naszej społeczności już dziś!</div>
            
        <div class="srodek">
            <a href="Rejestracja"><input type="submit2" class="btrejestracja" value="Załóż konto" />     </a>
        </div>

       <!-- JS DO KARUZELI POCZATEK -->
   <script>
                    $('.owl-carousel').owlCarousel({

                        rtl: true,
                        loop: true,
                        center: true,
                        autoplay: true,
                        autoWidth: true,
                        nav: true,
                        navText : ['&gt;', '&lt;'],
                        autoplayTimeout: 2500,
                        autoplayHoverPause: true,
                        responsive: {
                            0: {
                                items: 1
                            },
                            600: {
                                items: 1
                            },
                            1000: {
                                items: 1
                            }
                        }
                    });
            </script>
            
           
  
              <!-- JS DO KARUZELI KONIEC -->
</body>
        <footer>
                 <br><br>
            <div class="rectangle">2018 &copy; Dominik Urban -  Ference </div>
        </footer>
</html>
