<?php
session_start();
ob_start();
include_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/af-2.3.7/date-1.1.0/r-2.2.9/rg-1.1.3/sc-2.0.4/sp-1.3.0/datatables.min.css"/>
    <title>GWR - Atualizar Senha</title>
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
    $chave = filter_input(INPUT_GET, 'chave', FILTER_DEFAULT);


    if (!empty($chave)) {
        //var_dump($chave);

        $query_usuario = "SELECT id 
                            FROM usuarios 
                            WHERE recuperar_senha =:recuperar_senha  
                            LIMIT 1";
        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario->bindParam(':recuperar_senha', $chave, PDO::PARAM_STR);
        $result_usuario->execute();

        if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            //var_dump($dados);
            if (!empty($dados['SendNovaSenha'])) {
                $senha_usuario = password_hash($dados['senha_usuario'], PASSWORD_DEFAULT);
                $recuperar_senha = 'NULL';

                $query_up_usuario = "UPDATE usuarios 
                        SET senha_usuario =:senha_usuario,
                        recuperar_senha =:recuperar_senha
                        WHERE id =:id 
                        LIMIT 1";
                $result_up_usuario = $conn->prepare($query_up_usuario);
                $result_up_usuario->bindParam(':senha_usuario', $senha_usuario, PDO::PARAM_STR);
                $result_up_usuario->bindParam(':recuperar_senha', $recuperar_senha);
                $result_up_usuario->bindParam(':id', $row_usuario['id'], PDO::PARAM_INT);

                if ($result_up_usuario->execute()) {
                    $_SESSION['msg'] = "<p class='alert alert-success' style='color:green'>Senha atualizada com sucesso!</p>";
                    header("Location: index.php");
                } else {
                    echo "<p class='alert alert-danger' style='color: #f28d77'>Erro: Tente novamente!</p>";
                }
            }
        } else {
            $_SESSION['msg_rec'] = "<p class='alert alert-danger' style='color: #f28d77'>Erro: Link inválido, solicite novo link para atualizar a senha!</p>";
            header("Location: recuperar_senha.php");
        }
    } else {
        $_SESSION['msg_rec'] = "<p class='alert alert-danger' style='color: #f28d77'>Erro: Link inválido, solicite novo link para atualizar a senha!</p>";
        header("Location: recuperar_senha.php");
    }

    ?>
    <div  class="wrapper">
    <form class="p-3 mt-3" method="POST" action="">
        <?php
        $usuario = "";
        if (isset($dados['senha_usuario'])) {
            $usuario = $dados['senha_usuario'];
        } ?>
        <label>Senha</label>
        <div class="form-field d-flex align-items-center"> <span class="fas fa-key"></span> <input type="password" name="senha_usuario" placeholder="Digite a nova senha" value="<?php echo $usuario; ?>"></div>
        <input class="btn mt-3" type="submit" value="Atualizar" name="SendNovaSenha">
        Lembrou? <a href="index.php">clique aqui</a> para logar
    </form>
</div>
</body>

</html>