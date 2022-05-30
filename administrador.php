<?php
    session_start();
    require_once "configs/header.php";
    require_once "configs/utils.php";
    require_once "configs/verbs.php";
    require_once "configs/Admin.php";

    if (isMetodo("PUT")) {
        if (parametrosValidos($_PUT, ["login", "senha"])) {
            $login = $_PUT["login"];
            $senha = $_PUT["senha"];
            $hashSenha = password_hash($senha, PASSWORD_BCRYPT, ["cost" => 11]);
            $res = Admin::addAdmin($login, $hashSenha);
            if ($res) {
                echo json_encode([
                    "msg" => "Success"
                ]);
            } else {
                echo json_encode([
                    "msg" => "Failed"
                ]);
            }
        }
    }

    if (isMetodo("POST")) {
        if (parametrosValidos($_POST, ["login", "senha"])) {
            $login = $_POST["login"];
            $senha = $_POST["senha"];
            $res = Admin::getAdmin($login);
            if ($res) {
                if (password_verify($senha, $res["senha"])) {
                    $_SESSION["login_user"] = $res["login"];
                    $_SESSION["password_user"] = $res["senha"];
                    echo json_encode([
                        "status" => "Unblocked"
                    ]);
                } else {
                    echo json_encode([
                        "status" => "Invalid password"
                    ]);
                }
            } else {
                echo json_encode([
                    "status" => "Invalid login"
                ]);
            }
        }
    }
    

    if (isMetodo("DELETE")) {
        if (parametrosValidos($_DELETE, ["login"])) {
            $login = $_DELETE["login"];
            $res = Admin::deleteAdmin($login);
            if ($res) {
                session_destroy();
                echo json_encode([
                    "status" => "Wiped out"
                ]);
            } else {
                echo json_encode([
                    "status" => "Invalid login"
                ]);
            }
        }
    }
?>