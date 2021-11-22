<?php
session_start();
ob_start();
include_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
     <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/af-2.3.7/date-1.1.0/r-2.2.9/rg-1.1.3/sc-2.0.4/sp-1.3.0/datatables.min.css"/>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-ico">
    <title>GWR</title>
</head>
<style type="text/css">
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif
}

body {
    background: white;
}

.wrapper {
    max-width: 350px;
    min-height: 500px;
    margin: 80px auto;
    padding: 40px 30px 30px 30px;
    background-color: #ecf0f3;
    border-radius: 15px;
    box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff
}

.logo {
    width: 80px;
    margin: auto
}

.logo img {
    width: 100%;
    height: 80px;
    object-fit: cover;
    border-radius: 50%;
    box-shadow: 0px 0px 3px #5f5f5f, 0px 0px 0px 5px #ecf0f3, 8px 8px 15px #a7aaa7, -8px -8px 15px #fff
}

.wrapper .name {
    font-weight: 600;
    font-size: 1.4rem;
    letter-spacing: 1.3px;
    padding-left: 10px;
    color: #555
}

.wrapper .form-field input {
    width: 100%;
    display: block;
    border: none;
    outline: none;
    background: none;
    font-size: 1.2rem;
    color: #666;
    padding: 10px 15px 10px 10px
}

.wrapper .form-field {
    padding-left: 10px;
    margin-bottom: 20px;
    border-radius: 20px;
    box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff
}

.wrapper .form-field .fas {
    color: #555
}

.wrapper .btn {
    box-shadow: none;
    width: 100%;
    height: 40px;
    background-color: #03A9F4;
    color: #fff;
    border-radius: 25px;
    box-shadow: 3px 3px 3px #b1b1b1, -3px -3px 3px #fff;
    letter-spacing: 1.3px
}

.wrapper .btn:hover {
    background-color: #039BE5
}

.wrapper a {
    text-decoration: none;
    font-size: 0.8rem;
    color: #03A9F4
}

.wrapper a:hover {
    color: #039BE5
}

@media(max-width: 380px) {
    .wrapper {
        margin: 30px 20px;
        padding: 40px 15px 15px 15px
    }
}
</style>
<body>
    <?php
    //Exemplo criptografar a senha
    //echo password_hash(123456, PASSWORD_DEFAULT);
    ?>

    

    <?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (!empty($dados['SendLogin'])) {
        //var_dump($dados);
        $query_usuario = "SELECT id, nome, usuario, senha_usuario 
                        FROM usuarios 
                        WHERE usuario =:usuario  
                        LIMIT 1";
        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);
        $result_usuario->execute();

        if(($result_usuario) AND ($result_usuario->rowCount() != 0)){
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            //var_dump($row_usuario);
            if(password_verify($dados['senha_usuario'], $row_usuario['senha_usuario'])){
                $_SESSION['id'] = $row_usuario['id'];
                $_SESSION['nome'] = $row_usuario['nome'];
                header("Location: dashboard.php");
            }else{
                $_SESSION['msg'] = "<p class='alert alert-danger' style='color:#f28d77'>Erro: Usuário ou senha inválida!</p>";
            }
        }else{
            $_SESSION['msg'] = "<p class='alert alert-danger' style='color: #f28d77'>Erro: Usuário ou senha inválida!</p>";
        }

        
    }

    //if(isset($_SESSION['msg'])){
    //  echo $_SESSION['msg'];
    //    unset($_SESSION['msg']);
    //}
    ?>
    <div  class="wrapper">
    <img style="width:100px;heigth:100px;padding:20px;" src="images/" alt="">
    <div class="text-center mt-4 name">Login</div>
        <form  class="p-3 mt-3" method="POST" action="">
        <div class="form-field d-flex align-items-center"> <span class="far fa-user"></span> <input type="text" name="usuario" id="userName" placeholder="Digite o usuário" value="<?php if(isset($dados['usuario'])){ echo $dados['usuario']; } ?>"></div>
        <div class="form-field d-flex align-items-center"> <span class="fas fa-key"></span> <input type="password" name="senha_usuario" id="pwd" placeholder="Digite a senha"value="<?php if(isset($dados['senha_usuario'])){ echo $dados['senha_usuario']; } ?>"></div> 
        <input type="submit" class="btn mt-3"value="Acessar"name="SendLogin"><a href="recuperar_senha.php">Esqueceu a senha?</a> ou <a href="#">Cadastrar</a>
        <?php
            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
        ?>
        <?php
            if(isset($_SESSION['msg_send'])){
                echo $_SESSION['msg_send'];
                unset($_SESSION['msg_send']);
            }
        ?>
        </form>
 </div>
 
</body>
</html>