<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://unicons.iconscout.com/release/v2.1.9/css/unicons.css'>
    <link rel="stylesheet" href="../css/style-post.css">
    <link rel="stylesheet" href="../css/style-admin.css">
</head>

<body>
    <div id="wrapper-admin" class="body-content">
        <div class="container">
            <div class="row full-height justify-content-center">
                <div class="col-12 text-center align-self-center py-5">
                    <div class="section pb-5 pt-5 text-center">
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <!-- Form Start -->
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                            <div class="form-group">
                                                <input type="text" name="username" class="form-style" placeholder="Usuario" required>
                                                <i class="input-icon uil uil-at"></i>
                                            </div>
                                            <div class="form-group mt-2">
                                                <input type="password" name="password" class="form-style" placeholder="Contraseña" required>
                                                <i class="input-icon uil uil-lock-alt"></i>
                                            </div>
                                            <input type="submit" name="login" class="btn mt-4" value="Enviar" />
                                        </form>
                                        <!-- /Form End -->
                                        <?php
                                        if (isset($_POST['login'])) {
                                            include "config.php";
                                            $username = mysqli_real_escape_string($connection, $_POST['username']);
                                            $password = md5($_POST['password']);
                                            $query = "SELECT user_id, username, role FROM user WHERE username='{$username}' AND password='{$password}'";
                                            $result = mysqli_query($connection, $query) or die("Query Failed.");
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $_SESSION['username'] = $row['username'];
                                                    $_SESSION['user_id'] = $row['user_id'];
                                                    $_SESSION['user_role'] = $row['role'];
                                                    header("location: post.php");
                                                }
                                            } else {
                                                echo "<p>Credenciales no válidas.</p>";
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
