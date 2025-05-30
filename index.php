<?php

include('libreria/principal.php');
plantilla::aplicar();
?>

                <div class="text-end mb-3">
                    <a href="editar.php" class="btn btn-primary">Agregar</a>
            
                </div>


                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Foto</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Pais</th>
                            <th scope="col">Acciones</th>
                            
                        </tr>
                    </thead>

                    <tbody>
                       
                        <?php

                        if (is_dir(filename:'datos')){

                            $archivo = scandir(directory:'datos');

                            foreach($archivo as $archivo){
                                $ruta = 'datos/'.$archivo;
                                if (is_file(filename:$ruta)){

                                    $json = file_get_contents(filename: $ruta);
                                    $Obra = json_decode(json: $json);
                                    ?>
                                       <tr>
                                          <td>
                                            <img src="<?= $Obra-> foto_url?>" alt="<?= $Obra-> foto_url?>" height="100">
                                          </td>
                                          <td><?= Datos::Tipos_de_Obra() [$Obra->tipo] ?></td>
                                          <td><?= $Obra-> nombre?></td>
                                          <td><?= $Obra-> autor?></td>
                                          <td><?= $Obra-> pais?></td>
                                          <td>
                                              <a href="editar.php?id=<?= $Obra->codigo ?>"class="btn btn-warning">Editar</a>
                                              <a href="personajes.php?id=<?= $Obra->codigo ?>" class="btn btn-info">personaje</a>
                                              <a href="detalle.php?id=<?= $Obra->codigo ?>"class="btn btn-danger">Detalle</a>
                                          </td>                                       
                                        </tr>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
           