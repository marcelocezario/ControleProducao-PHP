<?php
require_once "funcoes.php";


?>
<!DOCTYPE html>
<?php    
        include_once("header.php");
?>
<body>
    <main>
    <form action="estoqueInsumo.php" method="POST">
        <br>
        <br>
    <div class="form-group">
    <label class="form-group">Insumo:</label>
    <select class="form-control" id="insumo" name="insumo"  value="<?=$insumo?>">
    <option value="" disabled selected>Selecione um insumo </option>

        <?php
            $resultado = listarInsumos();
        
        if(!empty($resultado)){
            foreach ($resultado as $res) {
        ?>                                             
        <option  value="<?php echo $res['id'];?>" ><?php echo $res['nomeInsumo'];?></option> 
        <?php      
        }
        }
        ?>
        </select>
    </div>
    </form>
    </main>
    <?php    
        include_once("footer.php");
    ?>
        <!-- JavaScript-->
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>