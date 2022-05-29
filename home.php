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
        <script src='home.js' defer></script>
        <link rel='stylesheet' href='home.css'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    <section id="modal-view" class="hidden">
        <div class="container">
            <form name='text_form' method='post' autocomplete="off">
                 <img id="x" src="imgs/x.jpg">
                    <input id="text" type='textarea' name='text' placeholder="Scrivi il tuo post..">
                <p>
                    <label>&nbsp;<input type='submit' class="action-button"></label>
                </p>
            </form>
        </div>
    </section>
    <header>
            <nav>
                <div class="l_nav">
                    <h1>JustWrite</h1>
                    <a href="./" <?php if(!isset($_GET['user'])) echo "class='here'"; ?> >Home</a>
                    <a href="logout.php">Logout</a><br><br>
                </div>
                <div class="r_nav">
                    <a href="prefer.php">Aggiungi utenti ai preferiti</a>
                    <a href="#" id="createPost">Nuovo post</a>
                    <div id="menu" class='menu'>
                    <div></div>
                    <div></div>
                    <div></div>
                    </div>
                    <div class='hidden' id='show_menu'>
                    <a href="home.php">Home </a>
                    <a href="prefer.php">Preferiti</a>
                    <a href="logout.php">Logout</a>
                    <div id='close_menu'>Close menu ✖</div>
                    </div>
                </div>
            </nav>
        </header>
        <main class="fixed">
            <section id="profile">
            </section>
        </main>

        <main>
            <!-- poi mi copio questo e lo modifico-->
        <template id="post_template">
                    <article class="post">
                        <div class="userinfo">
                            <div class="avatar">
                                <img src="">
                            </div>
                            <div class="names">
                                <a href="#">
                                <div class="username"></div>
                                </a>
                            </div>
                            <div class="time"></div>
                        </div>
                        <div class="content"></div>
                        <div class="text"></div>
                        <div class="actions">
                            <div class="elimina"></div>
                        </div>
                    </article>
                </template>
            <section id="feed">
            </section>
        </main>
        <section id="posts"></section>
        <section id="tracks"></section>
    </body>     
</html>