<?php
    require_once "configs/Consultas.php";

    if (isset($_POST["cadastrar"])) {
        if (isset($_POST["idMedico"]) and !empty($_POST["idMedico"]) and isset($_POST["idPaciente"])
        and !empty($_POST["idPaciente"]) and isset($_POST["data"]) and !empty($_POST["data"]) and isset($_POST["time"])
        and !empty($_POST["time"])) {
            date_default_timezone_set('America/Sao_Paulo');
            $idMedico = $_POST["idMedico"];
            $idPaciente = $_POST["idPaciente"];
            $data = $_POST["data"];
            $time = $_POST["time"];
            $datetime = "$data "."$time";
            $atualData = date("Y-m-d");
            $horaAtual = date("H:i");
            $timestamp_dt_atual = strtotime($atualData);
            $timestamp_data = strtotime($data);
            if ($timestamp_data > $timestamp_dt_atual) {
                    $res = Consulta::addConsulta($idMedico, $idPaciente, $datetime);
                    if ($res) {
                        echo "<div class='alert alert-success d-flex align-items-center' role='alert'>
                            <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
                            <div>
                                Consulta adicionada com sucesso
                            </div>
                        </div>";
                    } else {
                        echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
                            <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
                            <div>
                                Consulta não foi adicionada
                            </div>
                        </div>";
                    }
            } elseif ($timestamp_data == $timestamp_dt_atual) {
                if ($time >= $horaAtual) {
                    $res = Consulta::addConsulta($idMedico, $idPaciente, $datetime);
                    if ($res) {
                        echo "<div class='alert alert-success d-flex align-items-center' role='alert'>
                            <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
                            <div>
                                Consulta adicionada com sucesso
                            </div>
                        </div>";
                    } else {
                        echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
                            <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
                            <div>
                                Consulta não foi adicionada
                            </div>
                        </div>";
                    }
                } else {
                    echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
                        <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
                        <div>
                            Hora inválida
                        </div>
                    </div>";
                }
            } else {
                echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
                    <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
                    <div>
                        Data inválida
                    </div>
                </div>";
            }
        }
    }
?>
