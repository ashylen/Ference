<?php
session_start();

if (!isset($_SESSION['zalogowany'])) {
    header('Location: Twoje-konto');
    exit();
}
?>


<!DOCTYPE html>

<html lang="pl-PL">
    <head>
        <title>Ference - udane wydarzenia.</title>
        <meta charset="UTF-8">
        <meta name="description" content="Organizacja wydarzeń, konferencji oraz spotkań w jednym miejscu!"/>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="X-UA-Comaptible" content="IE=edge, chrome=1"/>

        <link rel="stylesheet" href="css/style.css" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Lato&amp;subset=latin-ext" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  
    </head>
    <body >

          <!-- NAWIGACJA POCZĄTEK-->
                     <nav role='navigation'>
            <div id="logo"><a href="index.php" class="tilelinkhtml5">Ference</a></div>
            <ul>
                <li class="dropdown">
                    <a href="Nadchodzace-wydarzenia" class="dropdown-toggle" data-toggle="dropdown">Wydarzenia<b class="caret"></b></a>
                    <ul class="dropdown-menu animated fadeInUp">
                        <li><a href="Nadchodzace-wydarzenia">Nadchodzące</a></li>
                        <li><a href="Wyszukaj-wydarzenie">Wyszukaj</a></li>
                        <li><a href="Organizacja-wydarzen">Organizuj</a></li>
                        <li><a href="Zakonczone-wydarzenia">Zakończone</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="Twoje-konto" class="dropdown-toggle" data-toggle="dropdown">Mój profil<b class="caret"></b></a>
                    <ul class="dropdown-menu animated fadeInUp">
                        <li><a href="Twoje-konto">Edytuj profil</a></li>
                        <li><a href="Moje-wydarzenia">Moje wydarzenia</a></li>
                        <li><a href="Jestem-uczestnikiem">Jestem uczestnikiem</a></li>
                    </ul>
                </li>

                <li><a href="wyloguj.php">Wyloguj się (<?php
                    echo $_SESSION['login'];
                    ?>)</a></li>
            </ul>
        </nav>
 <!-- NAWIGACJA KONIEC-->
        <br/>  <br/>
      
        <!-- KONTENER POCZĄTEK-->
        <div id="container">
            <!-- RECTANGLE POCZĄTEK-->
            <div class="rectangle">
                <div id="logobezfloata" class="tilelinkhtml5" style="padding-right: 170px;">Szczegóły wydarzenia</div>
                <div style="clear:both"></div>
            </div>
             
<!-- PHP TABELA POCZĄTEK-->
  <div class="rectangle" style="float:left;">
            <?php
            header('Content-Type: text/html; charset=utf-8');
            require_once "connect.php";
            $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
            if ($polaczenie->connect_errno != 0) {
                echo "Error: " . $polaczenie->connect_error;
            } else {

                $_SESSION['konf_id'] = $_GET["id"];
                $polaczenie->query("SET NAMES utf8");

                $sql = 'Select * from wydarzenia where id_kon like ' . $_GET["id"] . '  ';

                $dane = $polaczenie->query($sql)

                        or die("Query failed"); 
             

                if (isset($_GET["id"])) {


                    while ($wiersz = $dane->fetch_array()) {
                        echo '
               <table class="tg" style="undefined;table-layout: fixed; width: 369px; margin: auto; ">
                    <colgroup>
                    <col style="width: 89px">
                    <col style="width: 280px">
                    </colgroup>
                        <tr>
                          <th class="tg-baqh">Id</th>
                          <TD class="tg-baqh">' . $wiersz["id_kon"] . ' </TD>
                        </tr>
                                <tr>
                                 <td class="tg-baqh">Nazwa</td>
                                   <TD class="tg-baqh">' . $wiersz["nazwa_kon"] . ' </TD>
                                </tr>
                       <tr>
                       <td class="tg-baqh">Login autora</td>
                          <TD class="tg-baqh">' . $wiersz["login"] . ' </TD>
                        </tr>
                                 <tr>
                                   <td class="tg-baqh">Opis</td>
                                    <TD class="tg-baqh">' . $wiersz["opis"] . ' </TD>
                                 </tr>
                        <tr>
                          <td class="tg-baqh">Data rozpoczęcia</td>
                            <TD class="tg-baqh">' . $wiersz["data_rozp"] . ' </TD>
                        </tr>
                                <tr>
                                  <td class="tg-baqh">Data zakończenia</td>
                                  <TD class="tg-baqh">' . $wiersz["data_zak"] . ' </TD>
                                </tr>
                        <tr>
                          <td class="tg-baqh">Godzina</td>
                          <TD class="tg-baqh">' . $wiersz["godzina_rozp"] . ' </TD>
                        </tr>
                                   
                        <tr>
                          <td class="tg-baqh">Miasto</td>
                         <TD class="tg-baqh">' . $wiersz["miasto"] . ' </TD>
                        </tr>
                                    <tr>
                                      <td class="tg-baqh">Ulica</td>
                                       <TD class="tg-baqh">' .$wiersz["ulica"] . ' </TD>
                                    </tr>
                                     <tr>
                                      <td class="tg-baqh">Miejsce</td>
                                       <TD class="tg-baqh">' . $wiersz["miejsce_kon"] . ' </TD>
                                    </tr>
                        <tr>
                          <td class="tg-baqh">Ilość miejsc</td>
                           <TD class="tg-baqh">' . $wiersz["ilosc_miejsc"] . ' </TD>
                        </tr>
                                    <tr>
                                      <td class="tg-baqh">Cena</td>
                                      <TD class="tg-baqh">' . $wiersz["cena"] . ' </TD>
                                    </tr>
                        <tr>
                          <td class="tg-baqh">Dodatkowe informacje</td>
                        <TD class="tg-baqh">' . $wiersz["info"] . ' </TD>
                        </tr>
                        
                                    <tr>
                                      <td class="tg-baqh">Tematyka</td>
                                       <TD class="tg-baqh">' . $wiersz["tematyka"] . ' </TD>
                                           
                                    </tr>
                       
                        
                    </table>
                    </a>';
                    }
                } else {
                    echo "Błąd pobierania identyfikatora konferencji.";
                }
 
                $polaczenie->query("SET NAMES utf8");


                $sql = 'SELECT us.login from users as us WHERE EXISTS (SELECT u.id_uzyt, u.id_uzyt FROM uczestnicy AS u WHERE u.id_uzyt = us.id AND u.id_konf like '. $_GET["id"]. ') ';

                $dane = $polaczenie->query($sql)

                        or die("Query failed"); //pobranie wynik�w zapytania
                
                 if (isset($_GET["id"])) {


                   echo ' <table class="tg" style="undefined;table-layout: fixed; width: 369px; margin: auto;">
                               <colgroup>
                    <col style="width: 89px">
                    <col style="width: 280px">
                    </colgroup>
                   
                       <tr>
                                      <td class="tg-baqh">Uczestnicy</td>
                    <td class="tg-baqh"> 
                    ';
                                                                                  
                       
                    while ($wiersz = $dane->fetch_array()) {
                        
                        echo "(";
                   echo  $wiersz["login"]; echo ") ";
       
                    }
                           echo' </td>  </tr>
                    </table>';
                             
            }
   
            
            
            }
            $polaczenie->close();
            ?>
<!-- PHP TABELA KONIEC-->


 <?php
                if (isset($_GET["msg"]) && $_GET["msg"] == 'success') {
                    echo '<div style="text-align: center; color:green;">Pomyślnie zapisano Ciebie do wydarzenia.</div>';
                }
                ?>
 <?php
                if (isset($_GET["msg"]) && $_GET["msg"] == 'failed') {
                    echo '<div style="text-align: center; color:red;">Już jesteś uczestnikiem tego wydarzenia!</div>';
                }
                ?>


</div>
<div class="mapa" style="float:left;">

<input id="pac-input" class="controls" type="text" placeholder="Wprowadź lokalizację">
    <div id="map"></div>
    <script>
      // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 50.040618, lng: 21.999501},
          zoom: 13,
          mapTypeId: 'roadmap'
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
      }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXu42PNT3v327DHzbClPoi7SsbAE2cta4&libraries=places&callback=initAutocomplete"
         async defer></script>
</div>  
    <div style="clear:both; margin-left: 10px;">
        <form action="dodaj_uczestnika.php" method="post">

<input  type="submit"   style="width:889px;" value="Dołącz do wydarzenia" />
</form>
        </div>
</div>
    
            <div style="clear: both;"></div>
       

            <footer>
            <div class="rectangle" style="padding-right: 100px;">2018 &copy; Dominik Urban -  Ference </div>
     </footer>
    </body>
</html>
