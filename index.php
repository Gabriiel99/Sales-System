<!doctype HTML>
<html>
    <head><br><br><br><br>
        <meta charset="utf-8">
        <title>Inicio</title>
        <link rel="stylesheet" type="text/css" href="bootstrap.css">
    </head>
    <body>
        <h2 class="text-center">Inicio de Sesion</h2> 
        <form action="validar.php" method="POST" style="width: 50%; margin: 0 auto; border: 4px #005 solid; padding: 20px; border-radius: 10px; webkit-border-radius: 10px; mos-border-radius: 10px;">
        <div>
            <label>Usuario</label>
            <input type="text" class="form-control" name="usuario" placeholder="ingrese usuario" required="">
        </div>
        <div>
            <label>Contraseña</label>
            <input type="password" class="form-control" name="password" placeholder="ingrese contraseña" required="">
        </div>
            <br>
            <div style="text-align: center">
                <button type="submit" class="btn btn-success">Entrar</button>
            </div>
        </form>
    </body>
</html>
