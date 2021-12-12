<!DOCTYPE html>
<html>
    <head>
        <script>
            function add_user() {               
                var username = document.getElementById("user").value;
                var password = document.getElementById("pwd").value;
                
                var url = "api/add_user.php?user=" + username + "&pwd=" + password;
                var xhr = new XMLHttpRequest();
                xhr.open("GET",url,false);
                xhr.send();
                
                document.getElementById("btn1").className = "pressed";
            }                
        </script>
    </head>
    <body>        
        <h1>Registration</h1>        
        <input id="user" /> <br />
        <input id="pwd" type="password"/> <br />
        <button id="btn1" onclick="add_user();
        window.location.href = 'login.php' ">Register</button>
            
    </body>
</html>