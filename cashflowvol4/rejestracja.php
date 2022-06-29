<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashyflow.pl - rejestracja</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/style.css">
    <style>
        label { color:white; }
        input { max-width: 60%; margin: auto; }
    </style>
</head>

<body>

<div class="row justify-content-center" style="min-height: 500px;">
    <div class="text-center col-md-5 ml-5 mr-5 mt-5 panele2 bg-secondary">
        <br>    
    <div class="">
        <h2 class="login-h2">Cashyflow.pl</h2>
        <p>Ekran rejestracji</p>
    </div>
        <form action="rejestracja.php" method="post">
         <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" size="64" maxLength="64" required class="form-control" name="email" placeholder="Podaj email">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Login</label>
            <input type="login" class="form-control" name="login" required placeholder="Wpisz login">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Hasło</label>
            <input type="password" class="form-control" name="haslo" required placeholder="Wpisz hasło">
          </div>
            
            <?php
                require("skrypty_php/rejestracja_sql.php");
            ?>
        
          <button type="submit" class="btn btn-primary mt-3" name="rejestruj">Załóż konto</button>
          <br> <br>
          <p>lub</p>
            <p><a class="lokacja" style="text-decoration:underline;" href="index.php">zaloguj się</a></p><br>
        </form>
    </div>
</div>

<script>
$(".lokacja").css("color","white");
</script>

</body>

</html>