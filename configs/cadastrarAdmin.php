<?php
    require_once "configs/Admin.php";
    if (isset($_POST["cadastrar"])) {
        if (isset($_POST["login"]) and !empty($_POST["login"]) and isset($_POST["senha"])
        and !empty($_POST["senha"])) {
            $login = $_POST["login"];
            $senha = $_POST["senha"];
            $hashSenha = password_hash($senha, PASSWORD_BCRYPT, ["cost" => 11]);
            $verificaLogin = Admin::getAdmin($login);
            if ($verificaLogin != null) {
                echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
                    <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
                    <div>
                        Login já existe
                    </div>
                </div>";
            } else {
                $res = Admin::addAdmin($login, $hashSenha);
                if ($res) {
                    echo "<div class='alert alert-success d-flex align-items-center' role='alert'>
                    <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
                    <div>
                        Cadastrado com sucesso
                    </div>
                </div>";
                } else {
                    echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
                        <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
                        <div>
                            Erro
                        </div>
                    </div>";
                }
            }
        }
    }
    
?>