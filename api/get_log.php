<?php
    session_start();

    // Если жетона безопасности нет, не пускаем
    if(!isset($_SESSION["user"])) {
        echo('<meta http-equiv="refresh" content="2; URL=../login.php">');
        die("Требуется логин!");
    }

    $user = $_SESSION["user"];

    include(getenv("MYAPP_CONFIG"));
    
            $sql = "SELECT ID, Number1, Number2, Result, UserID 
            FROM log WHERE UserID='$user'";
            $conn = mysqli_connect($DB_URL,$DB_USER,$DB_PWD,$DB_NAME);
            // Нудьга. Передача параметров в sql выражения.
            // Противодействие sql injection.
            $statement = mysqli_prepare($conn,$sql);
            mysqli_stmt_execute($statement);
            // echo(mysqli_error($conn));
            $cursor = mysqli_stmt_get_result($statement);
            $result = mysqli_fetch_all($cursor);
            //var_dump($result);
            mysqli_close($conn);
            echo(json_encode($result));
?>