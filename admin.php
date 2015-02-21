<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="css/estilos.css">
    </head>
    <body>
        <div class="contenedor">
            <form action="ajax/index.php" method="POST">
                <label for="user">Usuario:</label>
                <input type="text" name="user" autofocus=""><br>
                <label for="password">Password:</label>
                <input type="password" name="password"><br>
                <input type="submit" value="Log in">
            </form>
        </div>
    </body>
</html>
