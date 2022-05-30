<?php
    session_start();
    require_once "configs/header.php";
    require_once "configs/utils.php";
    require_once "configs/verbs.php";
    require_once "configs/Pacientes.php";

    if (isset($_SESSION["login_user"])) {
        if (isMetodo("GET")) {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            if (isset($id) and !empty($id)) {
                if (Pacientes::verificaSeExisteId($id)) {
                    $paciente = Pacientes::getPessoa($id);
                    echo json_encode([$paciente]);
                } else {
                    echo json_encode([
                        "msg" => "Este id não existe"
                    ]);
                }
            } else {
                $lista = Pacientes::listaPacientes();
                echo json_encode($lista);
            }
        }
        if (isMetodo("POST")) {
            if (parametrosValidos($_POST, ["nome", "dataNascimento"])) {
                $nome = $_POST["nome"];
                $dataNasc = $_POST["dataNascimento"];
                $res = Pacientes::addPaciente($nome, $dataNasc);
                if ($res) {
                    echo json_encode([
                        "status" => "Sucesso"
                    ]);
                } else {
                    echo json_encode([
                        "status" => "Failed"
                    ]);
                }
            }
        }
        if (isMetodo("PUT")) {
            if (parametrosValidos($_PUT, ["id", "nome", "dataNascimento"])) {
                $id = $_PUT["id"];
                $nome = $_PUT["nome"];
                $dataNasc = $_PUT["dataNascimento"];
                if (Pacientes::verificaSeExisteId($id)) {
                    $res = Pacientes::updatePaciente($id, $nome, $dataNasc);
                    if ($res) {
                        echo json_encode([
                            "msg" => "Atualizado"
                        ]);
                    } else {
                        echo json_encode([
                            "status" => "Failed"
                        ]);
                    }
                } else {
                    echo json_encode([
                        "msg" => "Id inválido"
                    ]);
                }
            }
        }
        if (isMetodo("DELETE")) {
            if (parametrosValidos($_DELETE, ["id"])) {
                $id = $_DELETE["id"];
                if (Pacientes::verificaSeExisteId($id)) {
                    $res = Pacientes::dropPaciente($id);
                    if ($res) {
                        echo json_encode([
                            "status" => "Success"
                        ]);
                    } else {
                        echo json_encode([
                            "status" => "Failed"
                        ]);
                    }
                } else {
                    echo json_encode([
                        "msg" => "Id inválido"
                    ]);
                }
            }
        }
    } else {
        echo json_encode([
            "status" => "Negado"
        ]);
    }
?>