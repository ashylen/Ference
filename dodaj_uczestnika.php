<?php

session_start();

if (!isset($_SESSION['zalogowany'])) {
    header('Location: Twoje-konto');
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
  $login = $_SESSION['login'];
  $id_konferencji = $_SESSION['konf_id'];
  
  $sqldata = "Select data_rozp from wydarzenia where data_rozp < curdate() AND  id_kon like $id_konferencji ";
  $result = $polaczenie->query($sqldata);

             if ($result->num_rows < 1) 
                 { //Zewnętrzny if dla prewencji dołączania do zakończonych wydarzeń
                    $sql_ilosc_miejsc = "SELECT ilosc_miejsc from wydarzenia where ilosc_miejsc = 0 and id_kon like '$id_konferencji'";
                    $result_ilosc_miejsc = $polaczenie->query($sql_ilosc_miejsc)
                                                                                 or die("Nie udało się nawiązać połączenia z bazą.");
                    if($result_ilosc_miejsc ->num_rows < 1){

                                            $sql = "Select * from uczestnicy where id_konf = '$id_konferencji' and id_uzyt = (Select id from users where login like '$login')" ;
                                            $result = $polaczenie->query($sql)
                                                         or die("Nie udało się nawiązać połączenia z bazą.");

                                          if ($result->num_rows < 1) 
                                                     {
                                                                                $sql = "insert into uczestnicy (id_uzyt, id_konf) values ((Select id from users where login like '$login') ,  $id_konferencji  )" ;
                                                                                $dane = $polaczenie->query($sql)
                                                                                            or die("Nie udało Ci się zapisać do wydarzenia, skontaktuj się z administratorem.");   

                                                                                $sql2= "UPDATE `wydarzenia` SET `ilosc_miejsc` = `ilosc_miejsc`-1 WHERE `wydarzenia`.`id_kon` = $id_konferencji;";

                                                                                $dane2 = $polaczenie->query($sql2);

                                                                                $strona = "Szczegoly-konferencji?id=$id_konferencji";  
                                                                                echo '<script language="javascript">';
                                                                                echo 'alert("Pomyślnie zapisałeś/łaś się do wydarzenia.");';
                                                                                echo '</script>';
                                                                                echo "<script>location.href='$strona'</script>";

                                                     }else{

                                                            $strona = "Szczegoly-konferencji?id=$id_konferencji";  
                                                            echo '<script language="javascript">';
                                                            echo 'alert("Jesteś już zapisany do tego wydarzenia!");';
                                                            echo '</script>';
                                                            echo "<script>location.href='$strona'</script>";
                                                             }
                                                     
                                                                        }else {
                                                                                echo '<script language="javascript">';
                                                                                echo 'alert("Nie możesz zapisać się do tego wydarzenia, gdyż nie ma już wolnych miejsc!");';
                                                                                echo '</script>';
                                                                                echo "<script>location.href='Nadchodzace-wydarzenia'</script>";
                    }
                 
                  } else { //Zewnętrzny else dla prewencji dołączania do zakończonych wydarzeń
        
                            echo '<script language="javascript">';
                            echo 'alert("Nie możesz zapisać się do tego wydarzenia, gdyż minął już czas na dołączenie!");';
                            echo '</script>';
                            echo "<script>location.href='Nadchodzace-wydarzenia'</script>";
      
                            }

    }
    

$polaczenie->close();
?>