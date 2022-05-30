<?php
    require_once "configs/Admin.php";
    if (isset($_POST["logar"])) {
        if (isset($_POST["login"]) and !empty($_POST["login"]) and isset($_POST["senha"]) and 
        !empty($_POST["senha"])) {
            $login = $_POST["login"];
            $password = $_POST["senha"];
            $res = Admin::getAdmin($login);
            if ($res) {
                if(password_verify($password, $res["senha"])) {
                    $_SESSION["login_user"]= $res["login"];
                    $_SESSION["password_user"] = $res["senha"];
                    header("Location: index.php");
                    exit;
                } else {
                    echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
                        <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
                        <div>
                            Senha inválida
                        </div>
                    </div>";
                }
            } else {
                echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
                    <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
                    <div>
                        Login inválido
                    </div>
                </div>";
            }
        }
    }
    
?>