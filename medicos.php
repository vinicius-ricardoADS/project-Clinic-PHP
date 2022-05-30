<?php
    session_start();
    require_once "configs/header.php";
    require_once "configs/utils.php";
    require_once "configs/verbs.php";
    require_once "configs/Medicos.php";
    require_once "configs/Especialidade.php";

    if (isset($_SESSION["login_user"])) {
        if (isMetodo("GET")) {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            if (isset($id) and !empty($id)) {
                if (Medicos::getId($id)) {
                    $medico = Medicos::getMedico($id);
                    echo json_encode([$medico]);
                } else {
                    echo json_encode([
                        "msg" => "This ID not exist"
                    ]);
                }
            } else {
                $lista = Medicos::listaMedicos();
                echo json_encode($lista);
            }
        }
        if (isMetodo("POST")) {
            if (parametrosValidos($_POST, ["nome", "idEspecialidade"])) {
                $nome = $_POST["nome"];
                $idEspecialidade = $_POST["idEspecialidade"];
                if (Especialidade::getId($idEspecialidade)) {
                    $res = Medicos::addMedico($nome, $idEspecialidade);
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
                        "msg" => "This ID not exist"
                    ]);
                }
            }
        }
        if (isMetodo("PUT")) {
            if (parametrosValidos($_PUT, ["id", "nome", "idEspecialidade"])) {
                $id = $_PUT["id"];
                $nome = $_PUT["nome"];
                $idEspecialidade = $_PUT["idEspecialidade"];
                if (Medicos::getId($id)) {
                    if (Especialidade::getId($idEspecialidade)) {
                        $res = Medicos::updateMedico($id, $nome, $idEspecialidade);
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
                            "msg" => "This specialty ID not exist"
                        ]);
                    }
                } else {
                    echo json_encode([
                        "msg" => "This ID not exist"
                    ]);
                }
            }
        }
        if (isMetodo("DELETE")) {
            if (parametrosValidos($_DELETE, ["id"])) {
                $id = $_DELETE["id"];
                if (Medicos::getId($id)) {
                    $res = Medicos::deleteMedico($id);
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
                        "msg" => "This ID not exist"
                    ]);
                }
            }
        }
    } else {
        echo json_encode([
            "status" => "Blocked"
        ]);
    }
?>