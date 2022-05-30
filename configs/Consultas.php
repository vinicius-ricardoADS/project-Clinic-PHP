<?php
    require_once "configs/BancoDados.php";

    class Consulta {
        public static function addConsulta($idMedico, $idPaciente, $datetime) {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("INSERT INTO consultas (idPaciente, idMedico, data) VALUES (?, ?, ?)");
                $stmt->execute([$idPaciente, $idMedico, $datetime]);
                if ($stmt->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public static function listaConsultas($id){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("SELECT id, idPaciente, idMedico, data FROM consultas WHERE idPaciente = ?"); //order by ja da sort bunitin, só botar o campo
                $stmt->execute([$id]);
                $resultado = $stmt->fetchAll(); //retorna lista associativa
                return $resultado;
    
            }catch(Exception $e){
                echo json_encode([
                    "msg" => "Erro"
                ]);
                exit;
            }
        }

        public static function getConsulta($id) {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("SELECT id, idPaciente, idMedico, data from consultas WHERE idPaciente = ?");
                $stmt->execute([$id]);
                $resultado = $stmt->fetchAll();
                if (count($resultado) == 1) {
                    return $resultado[0]["idPaciente"];
                } else {
                    return null;
                }
            } catch (Exception $e) {
                echo json_encode([
                    "msg" => "Erro"
                ]);
            }
        }
    }
?>