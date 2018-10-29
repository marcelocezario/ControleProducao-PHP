<?php
require_once "funcoes.php";


?>
<!DOCTYPE html>
<?php    
        include_once("header.php");
?>
<body>
    <main>

    <label >Produto:</label>
        <select name="insumo" id="insumo" >
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