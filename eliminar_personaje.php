<?php

include('libreria/principal.php');

$id = $_GET['id'];
$cedula = $_GET['cedula'];

$Obra = new Obra();
$ruta = 'datos/'.$id.'.json';
if(!is_file(filename: $ruta)){
    plantilla::aplicar();
    echo "<div class='alert alert-danger'>Error al cargar la obra</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver</a>";
    exit();
}


$json = file_get_contents(filename: $ruta);
$Obra = json_decode(json: $json);


$personaje = null;

foreach($Obra->personajes as $p){
    if ($p->cedula == $cedula){
    $personaje = $p;
    break;
    }
}

if($personaje == null){
    plantilla::aplicar();
    echo "<div class='alert alert-danger'>Error al cargar el personaje</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver</a>";
    exit();
    
}

$Obra->personajes = array_filter(array: $Obra->personajes, callback: function($p) use ($cedula): bool {
    return $p->cedula != $cedula;
    
});

file_put_contents(filename: $ruta, data: json_encode(value: $Obra));
plantilla::aplicar();

echo "<div class='alert alert-success'>Personaje eliminado correctamente</div>";
echo "<a href='personajes.php?id=".$Obra->codigo."' class='btn btn-primary'>Volver</a>";
exit();
