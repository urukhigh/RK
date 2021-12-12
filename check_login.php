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
            // $sql = "SELECT ID, UserName FROM users 
            // WHERE UserName=? AND PwdHash=?";
            $sql_select = "SELECT ID, UserName
            FROM users WHERE UserName='$user'";
            $sql_insert = "INSERT INTO users
            SET UserName='$user', PwdHash='$hash'";
            $conn = mysqli_connect($DB_URL,$DB_USER,$DB_PWD,$DB_NAME);
            // Нудьга. Передача параметров в sql выражения.
            // Противодействие sql injection.
            // $statement = mysqli_prepare($conn,$sql);
            // mysqli_stmt_bind_param($statement,"ss",$user,$hash);
            // mysqli_stmt_execute($statement);
            // $cursor = mysqli_stmt_get_result($statement);
            // $result = mysqli_fetch_all($cursor);
            // echo(mysqli_error($conn));
            //var_dump($result);
            $cursor = mysqli_query($conn,$sql_select);
            $result = mysqli_fetch_all($cursor);
            echo (mysqli_error($conn));
            // mysqli_close($conn);

            if (!empty($result['id'])) {
                // echo ("<h1>Hello, $user!</h1>");
                // $_SESSION["user"] = $user;
                // echo('<meta http-equiv="refresh" content="2; URL=calc.php">');
                exit("Логин существует");
            }
            // else {
                // echo ("<h2>BAD LOGIN!</h2>");
            // }
            $conn1 = mysqli_connect($DB_URL,$DB_USER,$DB_PWD,$DB_NAME);
            $result1 = mysqli_query($conn1,$sql_insert);
                
            if ($result1 == 'True') {
                echo("Регистрация успешна <a href='index_.html'>На центральный портал</a>");
            }
            else {
                echo("Ошибка в регистрации!");
            }
        
        ?>
    </body>
</html>