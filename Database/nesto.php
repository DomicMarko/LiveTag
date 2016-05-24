<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>

<style type="text/css">
    body{
        margin:100px auto;
    }
    .container{
        margin:auto;
        width:173px;
    }
    .button{
        margin-left:60px;
    }
    form input{
        margin-top:10px;
    }

    ;
</style>
<body>
<div class="container">
    <div class="form">
        <form method="POST" action="get_all_zaposlene.php">
            <input type="text" value="username" name="username"/>
            <input type="password" value="password" name="password"/>
            <br>
            <input class="button" type="Submit" value="Login" name="submit"></input>
        </form>
    </div>
</div>
</body>
</html>             