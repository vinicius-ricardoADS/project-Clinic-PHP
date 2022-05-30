<?php
    require_once "configs/Pacientes.php";

    if  (isset($_GET["deletarPaciente"]) and !empty($_GET["deletarPaciente"])) {
        $id = $_GET["deletarPaciente"];
        if (Pacientes::verificaSeExisteId($id)) {
            $res = Pacientes::dropPaciente($id);
            if ($res) {
                echo "<div class='alert alert-success d-flex align-items-center' role='alert'>
                    <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
                    <div>
                        Deletado com sucesso
                    </div>
                </div>";
            } else {
                echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
                    <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
                    <div>
                        Erro ao deletar
                    </div>
                </div>";
            }
        } else {
            echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
                <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
                <div>
                    Esta pessoa não existe
                </div>
            </div>";
        }
    }
?>