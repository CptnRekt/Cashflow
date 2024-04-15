<?php
//jesli przeslano posta z danymi logowania
if ( isset( $_POST['submit'] ) ) {
    $login = @($_POST['login']);
    $haslo = @($_POST['haslo']);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cashflow2";
    $dopasowano = false;

    $conn = new mysqli( $servername, $username, $password, $dbname );

    //jesli polaczenie zwraca blad, to wyswietl blad i skipnij reszte skryptu php
    if ( $conn->connect_error ) {
        die( "Błąd połączenia: " . $conn->connect_error );
    }

    //tu mozna zdefiniowac zapytanie albo nazwe procedury (czyli na przyklad call "nazwa procedury")
    $sql = "SELECT id, login, haslo, email FROM konta_uzytkownikow";
    //tu wykonujemy zapytanie i przechowujemy jego wynik
    $result = $conn->query( $sql );
    //jesli ilosc zwroconych wierszy z obiektu mysqli jest wieksza od 0 
    if ( @($result->num_rows > 0) ) {
        //uzycie "fetch_assoc" powoduje wywolanie kolejnego wiersza z obiektu klasy mysqli, jesli nie ma juz wiecej wierszy to zwrocimy null
        while( $row = $result->fetch_assoc() ) {
                //jesli login z formularza oraz haslo pokrywaja sie z danymi z zapytania to przeslij ukryty formularz z wartosciami loginu i hasla do nastepnej strony
                $dopasowano = true;
                echo '<form id="prawidlowe" action="dashboard.php" method="post">';
                echo '<input name="login1" type="hidden" value="'.$login.'">';
                echo '<input name="password1" type="hidden" value="'.$haslo.'">';
                echo '</form>';
                //ustaw dane logowania jako globalne
                $_SESSION['zalogowany']=true;
                $_SESSION['id_konta']=$row["id"];
                $_SESSION['login']=$row["login"];
                $_SESSION['haslo']=$row["haslo"];
                $_SESSION['email']=$row["email"];
                header('Location: dashboard.php');
                ?>
                <script type="text/javascript">
                    document.getElementById('blad').style.visibility="hidden";
                    document.getElementById('blad').style.position="absolute";
                    document.getElementById('prawidlowe').submit();
                </script>
                <?php
            }
        }
        if ( $dopasowano == false ) {
            ?>
            <script type="text/javascript">
                document.getElementById('blad').style.visibility="visible";
                document.getElementById('blad').style.position="static";
            </script>
            <?php
        }
    }
    $conn->close();
}
?>