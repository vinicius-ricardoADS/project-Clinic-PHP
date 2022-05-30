<?php
    require_once "configs/Admin.php";
    if (isset($_POST["cadastrar"])) {
        if (isset($_POST["login"]) and !empty($_POST["login"]) and isset($_POST["senha"])
        and !empty($_POST["senha"])) {
            $login = $_POST["login"];
            $senha = $_POST["senha"];
            $hashSenha = password_hash($senha, PASSWORD_BCRYPT, ["cost" => 11]);
            $res = Admin::addAdmin($login, $hashSenha);
            if ($res) {
                header("Location: index.php");
                exit;
            } else {
                echo "<p>Deu errado</p>";
            }
        }
    }
    
?>