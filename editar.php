<?php

include('libreria/principal.php');

$Obra = new Obra();

if (isset($_GET['id'])) {
    $ruta = 'datos/'.$_GET['id'].'.json';
    if (is_file(filename: $ruta)) {
        $json = file_get_contents(filename:$ruta);
        $Obra = json_decode($json);
    }
}



if($_POST){
    $Obra->codigo = $_POST['codigo'];
    $Obra->foto_url = $_POST['foto_url'];
    $Obra->tipo = $_POST['tipo'];
    $Obra->nombre =$_POST['nombre'];
    $Obra->descripcion = $_POST['descripcion'];
    $Obra->pais = $_POST['pais'];
    $Obra->autor = $_POST['autor'];


    if(!is_dir(filename: 'datos')){
        mkdir(directory: 'datos');
    }
        if(!is_dir(filename: 'datos')) {
            plantilla::aplicar();
            echo "Error al crear el directorio, no se puede guardar la obra";
            echo "<a href='index.php' class='btn btn-primary' >Volver</a>";
            exit();
        }
       
    $ruta = 'datos/'.$Obra->codigo.'.json';
       
    $json = json_encode(value: $Obra);
       
    file_put_contents(filename: $ruta, data: $json);

    plantilla::aplicar();
    echo "<div class='alert alert-success'>Obra guardada correctamente</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver</a>";
    exit();

}


plantilla::aplicar();
?>

<form method="post" action="editar.php">
    <!-- codigo de la obra -->
    
    <div class="mb-3">
        <label for="codigo" class="form-label">Código</label>
        <input type="text" class="form-control" id="codigo" name="codigo" value="<?= $Obra->codigo ?>" required>
    </div>

    <div class="mb-3">
        <label for="foto_url" class="form-label">Foto</label>
        <input type="text" class="form-control" id="foto_url" name="foto_url" value="<?= $Obra->foto_url ?>" required>
    </div>
         
    <div class="mb-3">
         <label for="tipo" class="form-label">Tipo</label>
         <select class="form-select" id="tipo" name="tipo">
           <option value="">Seleccione</option>
           <?php
               $selecte = $Obra->tipo;
               foreach (Datos:: Tipos_de_Obra() as $key => $value) {
                    $iSselected = ($key == $selected) ? 'selected' : '';
                     echo "<option value='$key' $isSelected>$value</option>";
                }
            ?>
       </select>
    </div>

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $Obra->nombre ?>" required>
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?= $Obra->descripcion ?>" required>
    </div>

    <div class="mb-3">
        <label for="pais" class="form-label">País</label>
        <input type="text" class="form-control" id="pais" name="pais" value="<?= $Obra->pais ?>" required>
    </div>

    <div class="mb-3">
        <label for="autor" class="form-label">Autor</label>
        <input type="text" class="form-control" id="autor" name="autor" value="<?= $Obra->autor ?>" required>
    </div>

    <div class="text-center">
          <button type="submit" class="btn btn-primary">Guardar</button>
         <a href="index.php" class="btn btn-secondary">Cancelar</a>

    </div>



</form>