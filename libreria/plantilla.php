<?php


class plantilla{

    public static $instancia = null;

    public static function aplicar(): plantilla{

        if (self::$instancia == null) {
            self::$instancia = new plantilla();
        }
        return self::$instancia;
    }


    public function __construct()
    {        
      ?>
      <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lo que he visto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

</head>


    <body>
        <div class="conteiner">
           <a href="index.php">
           <h1 class="mt-3">Lo que he visto</h1>
           </a>
           <p>Listado de pelicula y series en la que he invertido mi tiempo</p>
        

            <div style="min-height: 500px;">

      <?php
    }

    
    
    public function __destruct()
    {
        ?>
        </div>
            <div class="text-center">
                <hr>
                Derechos reservados &copy; <? date(format: 'Y') ?> - Lo que he Visto 

            </div>

        </div> 
    </body>

</html>
        <?php
    }


}