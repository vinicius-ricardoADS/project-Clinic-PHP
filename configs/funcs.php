<?php
    require_once "configs/Pacientes.php";
    require_once "configs/Consultas.php";
    require_once "configs/Medicos.php";

    if  (isset($_GET["deletarPaciente"]) and !empty($_GET["deletarPaciente"])) {
        $id = $_GET["deletarPaciente"];
        if (Pacientes::verificaSeExisteId($id)) {
            $verificaConsulta = Consulta::verificaSeExisteIdPaciente($id);
            foreach ($verificaConsulta as $consulta) {
                $removeConsulta = Consulta::dropConsulta($consulta["id"]);
            }
            if ($removeConsulta) {
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

    if  (isset($_GET["deletarMedico"]) and !empty($_GET["deletarMedico"])) {
        $id = $_GET["deletarMedico"];
        if (Medicos::getId($id)) {
            $verificaConsulta = Consulta::verificaSeExisteIdMedico($id);
            foreach ($verificaConsulta as $consulta) {
                $removeConsulta = Consulta::dropConsulta($consulta["id"]);
            }
            if ($removeConsulta) {
                $res = Medicos::deleteMedico($id);
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
            }
            
        } else {
            echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
                <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
                <div>
                    Este médico não existe
                </div>
            </div>";
        }
    }

    if  (isset($_GET["deletarConsulta"]) and !empty($_GET["deletarConsulta"])) {
        $id = $_GET["deletarConsulta"];
        if (Consulta::verificaSeExisteId($id)) {
            $res = Consulta::dropConsulta($id);
            if ($res) {
                echo "<div class='alert alert-success d-flex align-items-center' role='alert'>
                    <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
                    <div>
                        Cancelado com sucesso
                    </div>
                </div>";
            } else {
                echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
                    <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
                    <div>
                        Erro ao cancelar
                    </div>
                </div>";
            }
        } else {
            echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
                <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
                <div>
                    Esta consulta não existe
                </div>
            </div>";
        }
    }
?>