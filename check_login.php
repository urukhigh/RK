<?php
    session_start();
    include(getenv("MYAPP_CONFIG"));
?>

<html>
    <head>
        <title>Страница входа</title>
    </head>
    <body>
        <?php
            $user = $_REQUEST["user"];
            $pwd = $_REQUEST["pwd"];
            $hash = hash('sha256',$pwd);
            $sql = "SELECT ID, UserName FROM users 
            WHERE UserName=? AND PwdHash=?";
            $conn = mysqli_connect($DB_URL,$DB_USER,$DB_PWD,$DB_NAME);
            // Нудьга. Передача параметров в sql выражения.
            // Противодействие sql injection.
            $statement = mysqli_prepare($conn,$sql);
            mysqli_stmt_bind_param($statement,"ss",$user,$hash);
            mysqli_stmt_execute($statement);
            $cursor = mysqli_stmt_get_result($statement);
            $result = mysqli_fetch_all($cursor);
            echo(mysqli_error($conn));
            //var_dump($result);
            mysqli_close($conn);

            if (count($result) > 0) {
                echo ("<h1>Hello, $user!</h1>");
                $_SESSION["user"] = $user;
                echo('<meta http-equiv="refresh" content="2; URL=calc.php">');
            }
            else {
                echo ("<h2>BAD LOGIN!</h2>");
            }
        ?>
    </body>
</html>