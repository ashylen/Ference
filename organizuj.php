<?php
session_start();

if (!isset($_SESSION['zalogowany'])) {
    header('Location: twojekonto.php');
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
        <br/>
        <br/>
      <!-- KONTENER POCZĄTEK-->
        <div id="container">
            <!-- RECTANGLE POCZĄTEK-->
            <div class="rectangle">
                <div id="logobezfloata" class="tilelinkhtml5">Stwórz własne wydarzenie</div>
                    <!-- FORMULARZ POCZĄTEK-->
                <form action="organizuj_formularz.php" method="post">
                    <input type="text" class="hour_arr" name="nazwa_konf"  maxlength="60" placeholder="Nazwa wydarzenia"  required="" />
                    <textarea class="hour_arr" rows="10" id="comment" name="opis"  maxlength="1000" placeholder="Opis wydarzenia"></textarea>
                    <br> <br>Rozpoczęcie:<br>
                    <input type="date" class="hour_arr" name="data_rozp" id="data_rozp" onchange="TDate()" placeholder="Data rozpoczęcia" required="" pattern="\d\d\d\d-\d\d-\d\d"  title="Przykładowy format daty: 2018-02-30"/>
                    <input type="time" class="hour_arr" Name="godzina_rozp"  placeholder="Godzina rozpoczęcia" required=""   pattern="\d\d:\d\d"  title="Przykładowy format godziny: 12:30" />
                    <br> <br>Zakończenie:<br>
                    <input type="date" class="hour_arr" name="data_zak"  id="data_zak"   onchange="TDate2()"placeholder="Data zakończenia"  />
               
                    <br><br>Lokalizacja:<br>
                    <div id="locationField">
                        <input id="autocomplete" class="hour_arr" placeholder="Wprowadź adres" onFocus="geolocate()" type="text"></input>
                        <br>
                        <input type="text" class="hour_arr" name="miasto" placeholder="Miasto"  id="locality" required="" />
                        <input type="text" class="hour_arr" name="ulica" placeholder="Ulica"  id="route" required=""/>
                        <input type="text" class="hour_arr" name="miejsce" placeholder="Miejsce lub numer lokalu" id="street_number" required=""/>
                    </div>
 <!-- JS DO WYPEŁNIANIA LOKALIZACJI W FORMULARZU-->
                    <script>
                        // This example displays an address form, using the autocomplete feature
                        // of the Google Places API to help users fill in the information.

                        // This example requires the Places library. Include the libraries=places
                        // parameter when you first load the API. For example:
                        // <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXu42PNT3v327DHzbClPoi7SsbAE2cta4&libraries=places">

                        var placeSearch, autocomplete;
                        var componentForm = {

                            route: 'long_name',
                         //   street_number: 'short_name',
                            locality: 'long_name'

                        };

                        function initAutocomplete() {
                            // Create the autocomplete object, restricting the search to geographical
                            // location types.
                            autocomplete = new google.maps.places.Autocomplete(
                                    /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                                    {types: ['geocode']});

                            // When the user selects an address from the dropdown, populate the address
                            // fields in the form.
                            autocomplete.addListener('place_changed', fillInAddress);
                        }

                        function fillInAddress() {
                            // Get the place details from the autocomplete object.
                            var place = autocomplete.getPlace();

                            for (var component in componentForm) {
                                document.getElementById(component).value = '';
                                document.getElementById(component).disabled = false;
                            }

                            // Get each component of the address from the place details
                            // and fill the corresponding field on the form.
                            for (var i = 0; i < place.address_components.length;
                                    i++
                                    ) {
                                var addressType = place.address_components[i].types[0];
                                if (componentForm[addressType]) {
                                    var val = place.address_components[i][componentForm[addressType]];
                                    document.getElementById(addressType).value = val;
                                }
                            }

                        }

                        // Bias the autocomplete object to the user's geographical location,
                        // as supplied by the browser's 'navigator.geolocation' object.
                        function geolocate() {
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(function (position) {
                                    var geolocation = {
                                        lat: position.coords.latitude,
                                        lng: position.coords.longitude
                                    };
                                    var circle = new google.maps.Circle({
                                        center: geolocation,
                                        radius: position.coords.accuracy
                                    });
                                    autocomplete.setBounds(circle.getBounds());
                                });
                            }
                        }
                    </script>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXu42PNT3v327DHzbClPoi7SsbAE2cta4&libraries=places&callback=initAutocomplete" async defer></script>
 <!-- KONIEC - JS DO WYPEŁNIANIA LOKALIZACJI W FORMULARZU-->
 <br>
   
 
 
                    <br>Dodatkowe informacje<br>
                    <input type="number" class="hour_arr" name="ilosc_miejsc" placeholder="Ilość miejsc" required=""/>
                    <input type="number" class="hour_arr" name="cena" placeholder="Cena"  />
                    <input type="text" class="hour_arr" name="info" placeholder="Dodatkowe informacje"  />
                    <input type="text" class="hour_arr" name="tematyka" placeholder="Tematyka" required="" />
                    <br>
                    <input type="submit" onclick="TDate()"style="font-size: 20px"  value="Utwórz" />
                </form>
<!-- KONIEC FORMULARZA-->

                <div style="clear: both"></div>    <!--   CLEAR   -->
            </div>
        <!-- KONIEC RECTANGLE-->
    </div>
 <!-- KONIEC FORMULARZA-->
            <div style="clear: both; "></div>
            <br /><br />
            <div class="rectangle">2017 &copy; Dominik Urban</div>
            
            
            
            
            <script> function TDate() {
    var UserDate = document.getElementById("data_rozp").value;
    var ToDate = new Date();

    if (new Date(UserDate).getTime() <= ToDate.getTime()) {
          alert("Musisz wprowadzić datę późniejszą niż dzisiaj.");
          return false;
     }
    return true;
}
</script>
<script> function TDate2() {
    var UserDate = document.getElementById("data_zak").value;
    var ToDate = new Date();

    if (new Date(UserDate).getTime() <= ToDate.getTime()) {
          alert("Musisz wprowadzić datę późniejszą niż dzisiaj.");
          return false;
     }
    return true;
}
</script>

    </body>
</html>
