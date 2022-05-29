<?php
    session_start();
    if(!isset($_SESSION["username"])){
        header("Location: login.php");
        exit;
    }
?>
<html>
<?php
        $conn=mysqli_connect("localhost","root","","hw1");
        $user=mysqli_real_escape_string($conn,$_SESSION["username"]);
        $res=mysqli_query($conn,"SELECT * FROM users WHERE username='$user'");
        $userinfo=mysqli_fetch_assoc($res);
    ?>
    <head>
        <script src='prefer.js' defer></script>
        <link rel='stylesheet' href='prefer.css'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Prefer</title>
    </head>
<body>
<header>
      <nav>
          <div class="l_nav">
            <h1>JustWrite</h1>
              <a href="./" <?php if(!isset($_GET['user'])) echo "class='here'"; ?> >Home</a>
              <a href="logout.php">Logout</a><br><br>
          </div>
          <div class="r_nav">
            <a href="home.php">Torna alla home</a>
            <div id="menu" class='menu'>
                    <div></div>
                    <div></div>
                    <div></div>
                    </div>
                    <div class='hidden' id='show_menu'>
                    <a href="home.php">Home </a>
                    <a href="logout.php">Logout</a>
                    <div id='close_menu'>Close menu ✖</div>
                    </div>
          </div>
      </nav>
</header>
      <main class="fixed">
        <section id="profile">
          <div class="avatar" style="background-image: url(<?php 
            if($userinfo["postnumber"]<=0){
                echo"imgs/1.jpg";
            }
            else if ($userinfo["postnumber"]>0 && $userinfo["postnumber"]<=4){
                echo"imgs/2.jpg";
            }
            else if ($userinfo["postnumber"]>4 && $userinfo["postnumber"]<=9){
                echo"imgs/3.jpg";
            }
            else{echo"imgs/4.jpg";}?>)">
          </div>
          <div class="username">
            @<?php echo $userinfo['username'] ?>
          </div>
          <div class="stats">
              <div>
                  <span class="count"><?php echo $userinfo['postnumber'] ?></span><br>Posts
              </div>
             </div>
             <img src=<?php 
            if($userinfo["postnumber"]<=0){
                echo"imgs/1.jpg";
            }
            else if ($userinfo["postnumber"]>0 && $userinfo["postnumber"]<=4){
                echo"imgs/2.jpg";
            }
            else if ($userinfo["postnumber"]>4 && $userinfo["postnumber"]<=9){
                echo"imgs/3.jpg";
            }
            else{echo"imgs/4.jpg";}?> class="mini" >
        </section>
      </main>    
<div class="container">
  <h2>Utenti iscritti</h2>
  <ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">Username</div>
      <div class="col col-2">Email</div>
      <div class="col col-3">Post creati</div>
      <div class="col col-4">Aggiungi ai Preferiti</div>
    </li>
    <section id="users">
  </section>
  </ul>
</div>           
<div class="container">
  <h2>I tuoi preferiti</h2>
  <ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">Username</div>
      <div class="col col-2">Email</div>
      <div class="col col-3">Post creati</div>
      <div class="col col-4">Rimuovi dai Preferiti</div>
    </li>
    <section id="prefe">
  </section>
  </ul>
</div>
    </body>
</html>




