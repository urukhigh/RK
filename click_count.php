<?php
    session_start();
?>
<html>
    <head>
        <meta charset="utf-8" />

    </head>
    <body>
        <h1>Считаем щелчки</h1>
        <form>
            <button id="btn1">Щелкни здесь</button>
        </form>
        <?php
            $i = 0;
            // Вспомним переменную счетчика
            // (если она существует)
            // if(isset($_SESSION["clicks"]))
            //     $i = $_SESSION["clicks"];
            //     $i += 1;
            // // Запомним текущее значение счетчика сессии
            // // в сессионной переменной clicks 
            // $_SESSION["clicks"] = $i;

            if(isset($_COOKIE['clicks']))
                $i = $_COOKIE['clicks'];
                $i += 1;
                setcookie("clicks", $i, time() + 20);

            echo("Всего щелчков: $i");
        ?>
    </body>
</html>