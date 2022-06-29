<?php
if ( isset( $_POST['submit'] ) ) {
    $login = @($_POST['login']);
    $haslo = @($_POST['haslo']);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cashflow2";
    $dopasowano = false;

    $conn = new mysqli( $servername, $username, $password, $dbname );

    if ( $conn->connect_error ) {
        die( "Błąd połączenia: " . $conn->connect_error );
    }

    $sql = "SELECT id, login, haslo, email FROM konta_uzytkownikow";
    $result = $conn->query( $sql );

    if ( @($result->num_rows > 0) ) {
        while( $row = $result->fetch_assoc() ) {
            if ( ( ( $login == $row["login"] ) || ( $login == $row["email"] ) ) && ( $haslo == $row["haslo"] ) ) {
                $dopasowano = true;
                echo '<form id="prawidlowe" action="dashboard.php" method="post">';
                echo '<input name="login1" type="hidden" value="'.$login.'">';
                echo '<input name="password1" type="hidden" value="'.$haslo.'">';
                echo '</form>';
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