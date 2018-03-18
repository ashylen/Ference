<?php

session_start();

if (!isset($_SESSION['zalogowany'])) {
    header('Location: twojekonto.php');
    exit();
}
?>


<?php

header('Content-Type: text/html; charset=utf-8');
require_once "connect.php";


$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
if ($polaczenie->connect_errno != 0) {
    echo "Error: " . $polaczenie->connect_error;
} else {
  $polaczenie->query("SET NAMES utf8");

    $sqld = "Select * from wydarzenia";
    $result = mysqli_query($polaczenie, $sqld)
    
    or die("Błąd wyświetlania wydarzeń.");

    $row_cnt = mysqli_num_rows($result);
    
    @$id_kon = $row_cnt + 1;

    @$nazwa_konf = $_POST['nazwa_konf'];
    @$opis = $_POST['opis'];
    @$data_rozp = $_POST['data_rozp'];
    @$data_zak = $_POST['data_zak'];
    @$godzina_rozp = $_POST['godzina_rozp'];
@$miejsce_kon = $_POST['miejsce'];
    @$miasto = $_POST['miasto'];
    @$ulica = $_POST['ulica'];
    @$ilosc_miejsc = $_POST['ilosc_miejsc'];
    @$cena = $_POST['cena'];
    @$info = $_POST['info'];
    @$tematyka = $_POST['tematyka'];
    
    //Żeby podczas tworzenia wydarzenia wrzucało takze login aktualnego użytkownika.
    $login = $_SESSION['login'];

    
    if ($data_zak == "") {
       $sql = "INSERT INTO `wydarzenia` (`id_kon`, `login`, `nazwa_kon`, `opis`, `data_rozp`, `data_zak`, `godzina_rozp`, `miejsce_kon`, `ulica`, `ilosc_miejsc`, `cena`, `info`, `tematyka`, `miasto`)
                         VALUES ('$id_kon', '$login', '$nazwa_konf', '$opis', '$data_rozp', '$data_rozp', '$godzina_rozp', '$miejsce_kon', '$ulica', '$ilosc_miejsc', '$cena', '$info', '$tematyka', '$miasto'); ";

        
    } else {
        $sql = "INSERT INTO `wydarzenia` (`id_kon`, `login`, `nazwa_kon`, `opis`, `data_rozp`, `data_zak`, `godzina_rozp`, `miejsce_kon`, `ulica`, `ilosc_miejsc`, `cena`, `info`, `tematyka`, `miasto`)
                            VALUES ('$id_kon', '$login', '$nazwa_konf', '$opis', '$data_rozp', '$data_zak', '$godzina_rozp', '$miejsce_kon', '$ulica', '$ilosc_miejsc', '$cena', '$info', '$tematyka', '$miasto'); ";

    }
    
    $dane = $polaczenie->query($sql)

            or die("Nie udało się stworzyć wydarzenia.");
}

$przekierowanie = '<a href = "Szczegoly-konferencji?id=' . $id_kon . '  " > tutaj </a> ';
echo ' <div  style="padding: 10px;
width:99%; 
font-size: 30px; 
text-align: center; 
color:green;
margin-top:100px;

background:#99ff99;
  box-shadow: 0 3px 10px -2px rgba(0,0,0,.1);
  border: 1px solid rgba(0,0,0,.1);">Twoje wydarzenie zostało utworzone pomyślnie!<br> Zostaniesz automatycznie przekierowany na docelową stronę za 5 sekund, jeżeli nie chcesz czekać kliknij ' . $przekierowanie . ' . </div>';
header("refresh:5;url=Szczegoly-konferencji?id=$id_kon");
exit;

$polaczenie->close();
?>