<?php
    require_once "configs/Pacientes.php";

    if (isset($_POST["cadastrar"])) {
        if (isset($_POST["nome"]) and !empty($_POST["nome"]) and isset($_POST["data"])
        and !empty($_POST["data"])) {
            $nome = $_POST["nome"];
            $data = $_POST["data"];
            $res = Pacientes::addPaciente($nome, $data);
            if ($res) {
                echo "<div class='alert alert-success d-flex align-items-center' role='alert'>
                    <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
                    <div>
                        Cadastrado com sucesso
                    </div>
                </div>";
            } else {
                echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
                    <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
                    <div>
                        Erro ao cadastrar
                    </div>
                </div>";
            }
        }
    }
?>