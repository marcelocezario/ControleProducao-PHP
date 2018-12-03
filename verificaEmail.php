

<?php
#Verifica se tem um email para pesquisa
if(isset($_POST['email'])){ 

    #Recebe o Email Postado
    $emailPostado = $_POST['email'];

    #Conecta banco de dados 
    $con = mysqli_connect("localhost", "root", "", "ecommerce");
    $sql = mysqli_query($con, "SELECT * FROM cliente WHERE email = '{$emailPostado}'") or print mysql_error();

    #Se o retorno for maior do que zero, diz que já existe um.
    if(mysqli_num_rows($sql)>0) 
        echo json_encode(array('email' => 'E-mail invalido ou em uso ')); 
    else 
        echo json_encode(array('email' => 'E-mail valido.' )); 
}
?>