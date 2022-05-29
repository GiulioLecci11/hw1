<?php
    session_start();
    if(isset($_SESSION["username"])){
        header("Location: home.php");
        exit;
    }
    $error = array();
    if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"])){
        $conn=mysqli_connect("localhost","root","","hw1");
        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])) {
            $error[] = "Username non valido";
        } else {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $res = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Username già utilizzato";
            }
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        } else {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Email già utilizzata";
            }
        }
        
        if (strlen($_POST["password"]) < 8 || strlen($_POST["password"]) > 20) {
            $error[] = "Lunghezza password non adatta";
        }
        
        if (count($error) == 0) {
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT); 
            $query = "INSERT INTO users(username, password, email) VALUES('$username', '$password','$email')";
            
            if (mysqli_query($conn, $query)) {
                $_SESSION["username"] = $_POST["username"];
                mysqli_close($conn);
                header("Location: home.php");
                exit;
            } else {
                $error[] = "Errore nella connessione al Database";
                echo"query non riuscita";
            }
        }
        mysqli_close($conn);
    }
?>
<html>
    <head>
        <script src='signin.js' defer></script>
        <link rel='stylesheet' href='signin.css'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Sign In </title>
    </head>
    <body>    
    <div class="container">
        <div class="card">
            <div class="card-image">	
                <h2 class="card-heading">
                    Sign in
                    <p class="small">Crea il tuo account</p>
                    <p class="smaller">L'unico social dove nessuno può giudicarti</p>
                </h2>
            </div>
            <form class="card-form" method="post" autocomplete="off">
                <div class="input username">
                    <input type="text" class="input-field" name="username" <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
                    <label class="input-label"> Username</label>
                    <span></span>
                </div>
                <div class="input email">
                    <input type="text" class="input-field" name="email" <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>>
                    <label class="input-label">Email</label>
                    <span></span>
                </div>
                <div class="input password">
                    <input type="password" class="input-field" id="password" name="password" <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
                    <label class="input-label">Password</label>
                    <img id="showpass" src="imgs/eye.png">
                    <span></span>
                </div>
                <div class="action">
                    <input type="submit" class="action-button"></button>
                </div>
            </form>
            <div class="card-info">
            <p>Registrandoti qui stai accettando i nostri <a href="#">Termini e Condizioni</a></p>
            <p>Se invece hai già un account <a href="login.php">Accedi</a></p>
            </div>
            <div><?php
    for($i=0;$i<count($error);$i++){
        echo("<p> '$error[$i]' </p>");
        }?>
    </div>
            <div id="error"></div>
        </div>
    </div>
    
    </body>
</html>