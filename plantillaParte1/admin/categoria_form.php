<?php include "includes/head.php"; ?>
<?php 
    if(isset($_POST["name"])){
        $response = $categories->create($_POST);
        if($response["state"]){ 
            header("location: categorias.php");
        } else{ 
            header("location: categoria_form.php");
        }
        exit;
    }  
?>

<body>
    <?php include "includes/menu.php"; ?>
    <div class="contenido divinicio">
        <h1 class="titles pad-left pad-right"><span>Categorías</span></h1>
        <div class="container">
            <div class="migaPan">
                <a href="" class="active"><i class="fa fa-home"></i> Inicio</a> <i class="fas fa-angle-right"></i> <a href="categorias.php"><i class="fas fa-biohazard" aria-hidden="true"></i> Categorías</a> <i class="fas fa-angle-right"></i> <span>Crear categoría</span>                
            </div>
            <div class="divContInterno">
                <div class="formularios">
                    <form action="" method="POST" class="pequenio">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="nombre" name="name" placeholder="Nombre">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug:</label>
                            <input type="slug" name="slug" placeholder="Slug">
                        </div>
                        <div class="form-group">
                            <label for="padre">Padre:</label>
                            <select name="father" id="padre">
                                <option value=''>Seleccionar</option>
                                <?php 
                                    foreach ($categories->listFathers() as $key => $item) {
                                ?>
                                    <option value="<?php echo $item["id"] ?>" ><?php echo $item['name'] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea name="description" id="descripcion"></textarea>
                        </div>
                        <?php include "helpers/messageError.php"; ?>
                        <div class="form-group text-center" >
                            <a href="categorias.php" class="btn">Cancelar</a>
                            <button class="btn green">Guardar</button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/footer.php"; ?>
</body>
</html>
