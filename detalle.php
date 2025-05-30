<?php

include('libreria/principal.php');


$Obra = new Obra();



if (isset($_GET['id'])) {
    $ruta = 'datos/'.$_GET['id'].'.json';
    if (is_file(filename: $ruta)) {
        $json = file_get_contents(filename:$ruta);
        $Obra = json_decode($json);
    }

}else{
    plantilla::aplicar();
    echo "<div class='text-center'><div class='alert alert-danger'>Error al cargar la obra</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver</a></div>";
    exit();
}

plantilla::aplicar();

?>

<div class="text-end">
    <button onclick="window.print()" class="btn btn-primary">Imprimir</button>

</div>


<div class="row">
    <div class="col-md-12">
         <h2><?= $Obra->nombre ?></h2>
         <img src="<?= $Obra->foto_url ?>" alt="<?= $Obra->nombre ?>" height="200">
         <p><strong>Tipo:</strong> <?= Datos:: Tipos_de_Obra() [$Obra->tipo] ?></p>
         <p><strong>Autor:</strong> <?= $Obra->autor ?></p>
         <p><strong>País:</strong> <?= $Obra->pais ?></p>
         <p><strong>Descripción:</strong> <?= $Obra->descripcion ?></p>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h2>Personaje</h2>
        <div class="text-end mb-3">
           <a href="agregar_personaje.php?id=<?= $Obra->codigo ?>" class="btn btn-primary">Agregar</a>
        </div>



        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">Foto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Fecha de Nacimiento</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                foreach($Obra->personajes as $personaje){
                    echo "<tr>";
                    echo "<td><img src='".$personaje->foto_url."' alt='".$personaje->nombre."' height='100'></td>";
                    echo "<td>".$personaje->nombre."</td>";
                    echo "<td>".$personaje->apellido."</td>";
                    echo "<td>".$personaje->fecha_nacimiento."</td>";
                    echo "</tr>";
                }
                ?>

            </tbody>

        </table>
    </div>

</div>
