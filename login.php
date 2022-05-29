<?php
    session_start();
    if(isset($_SESSION["username"])){
        header("Location:home.php");
        exit;
    }
    if(isset($_POST["username"]) && isset($_POST["password"])){
        $conn=mysqli_connect("localhost","root","","hw1");
        $username=mysqli_real_escape_string($conn,$_POST["username"]);
        $password=mysqli_real_escape_string($conn,$_POST["password"]);
        $query="SELECT username,password FROM users WHERE username= '$username'";
        $res=mysqli_query($conn,$query);
        if(mysqli_num_rows($res)>0){
            $entry = mysqli_fetch_assoc($res);
            if(password_verify($_POST['password'], $entry['password'])){
                $_SESSION["username"]=$username; 
                header("Location: home.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
            else {$errp=TRUE;}
        }
        else $err=TRUE;
    }
?>
<html>
    <head>
        <link rel='stylesheet' href='login.css'>
        <script src='login.js' defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
    </head>
    <body>
        <div class="container">
        <div class="card">
            <div class="card-image">	
                <h2 class="card-heading">
                    Get in
                    <p class="small">Accedi al tuo account</p>
                    <p class="smaller">L'unico social dove nessuno può giudicarti</p>
                </h2>
            </div>
            <form class="card-form" name="form" method="post" autocomplete="off">
                <div class="input">
                    <input type="text" class="input-field"  id= "username" name="username" <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?> >
                    <label class="input-label"> Username</label>
                </div>
                <div class="input">
                    <input type="password" class="input-field" id="password" name="password" <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];}?> >
                    <label class="input-label">Password</label>
                    <img id="showpass" src="imgs/eye.png">
                </div>
                <div class="action">
                    <input type="submit" class="action-button"></button>
                </div>
            </form>
            <div id="error"></div>
            <div><?php
            if(isset($err)){
                echo"<p class='errore'>Credenziali non valide.</p>";
            }
            if(isset($errp)){
                echo"<p class='errore'>La password non corrisponde.</p>";
            }
        ?></div>
            <div class="card-info">
                <p>Se non possiedi ancora un account effettua <a href="signin.php">QUI</a> la tua registrazione</p>
            </div>
        </div>
    </div>
    
    </body>
</html>