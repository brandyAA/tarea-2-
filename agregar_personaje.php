<?php

include('libreria/principal.php');

$personaje = new personajes();
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

if($_POST){
    $personaje->cedula = $_POST['cedula'];
    $personaje->foto_url = $_POST['foto_url'];
    $personaje->nombre = $_POST['nombre'];
    $personaje->apellido = $_POST['apellido'];
    $personaje->fecha_nacimiento = $_POST['fecha_nacimiento'];
    $personaje->sexo = $_POST['sexo'];
    $personaje->habilidades = $_POST['habilidades'];
    $personaje->comida_favorita = $_POST['comida_favorita'];

    if(!isset($Obra->personajes)){
        $Obra->personajes = [];
    }

    $Obra->personajes[] = $personaje;


        if(!is_dir('datos')) {
            echo "div class='alert alert-danger'>Error al crear la carpeta de datos</div>";
            echo "<a href='index.php' class='btn btn-primary' >Volver</a>";
            exit();
        }
       
    $ruta = 'datos/'.$Obra->codigo.'.json';

       
    file_put_contents(filename: $ruta, data: json_encode(value: $Obra));

    echo "<div class='alert alert-success'>Personaje guardada correctamente</div>";
    echo "<a href='personajes.php?id=" .$Obra->codigo."' class='btn btn-primary' >Volver</a>";
    exit();



}



?>

<div class="row">
     <div class="col-md-4">
     <h2><?= $Obra->nombre ?></h2>
     <img src="<?= $Obra->foto_url ?>" alt="<?= $Obra->nombre ?>" height="200">
     <p><strong>Tipo:</strong> <?= Datos:: Tipos_de_Obra() [$Obra->tipo] ?></p>
     <p><strong>Autor:</strong> <?= $Obra->autor ?></p>
     <p><strong>País:</strong> <?= $Obra->pais ?></p>
     <p><strong>Descripción:</strong> <?= $Obra->descripcion ?></p>
    </div>
    <div class="col-md-8">
       <h2>Datos del personaje</h2>
       <form method="post" action="agregar_personaje.php?id=<?= $Obra->codigo ?>" enctype="multipart/form-data">

            <div class="mb-3">
               <label for="cedula" class="form-label">Cédula</label>
               <input type="text" class="form-control" id="cedula" name="cedula" value="<?= $personaje->cedula ?>" required>
           </div>

           <div class="mb-3">
               <label for="foto_url" class="form-label">Foto</label>
               <input type="text" class="form-control" id="foto_url" name="foto_url" accept=".jpg, .jpeg, .png, .gif" required>
           </div>

           <div class="mb-3">
               <label for="nombre" class="form-label">Nombre</label>
               <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $personaje->cedula ?>" required>
           </div>

           <div class="mb-3">
               <label for="apellido" class="form-label">Apellido</label>
               <input type="text" class="form-control" id="apellido" name="apellido" value="<?= $personaje->cedula ?>" required>
           </div>

           <div class="mb-3">
               <label for="fecha_nacimiento" class="form-label">Fecha_nacimiento</label>
               <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= $personaje->cedula ?>" required>
           </div>

           <div class="mb-3">
               <label for="sexo" class="form-label">Sexo</label>
                  <select class="form-select" id="sexo" name="sexo">
                  <option value="">Selecione</option>
                  <option value="masculino" <?= ($personaje->sexo == 'masculino') ? 'selected' : '' ?>>Masculino</option>
                  <option value="femenino" <?= ($personaje->sexo == 'femenino') ? 'selected' : '' ?>>Femenino</option>
               </select>
           </div>

           <div class="mb-3">
               <label for="habilidades" class="form-label">Habilidades</label>
               <textarea type="text" class="form-control" id="habilidades" name="habilidades" rows=""><?= $personaje->cedula ?></textarea>
           </div>

           <div class="mb-3">
               <label for="comida_favorita" class="form-label">Comida Favorita</label>
               <input type="text" class="form-control" id="comida_favorita" name="comida_favorita" value="<?= $personaje->cedula ?>" required>
           </div>

           <div class="text-center mb-3">
              <button type="submit" class="btn btn-primary">Guardar</button>
              <a href="personaje.php?id=<?= $Obra->codigo ?>" class="btn btn-danger">Cancelar</a>
          </div>
       </form>
    </div>
</div>   


