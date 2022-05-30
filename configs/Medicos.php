<?php
    require_once "configs/BancoDados.php";

    class Medicos {
        public static function addMedico($nome, $idEspecialidade) {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("INSERT INTO medicos(nome, dataCadastro, idEspecialidade) VALUES (?, NOW(), ?)");
                $stmt->execute([$nome, $idEspecialidade]);
                if ($stmt->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo json_encode([
                    "status" => "Error"
                ]);
            }
        }

        public static function getId($id) {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("SELECT id, nome, dataCadastro, idEspecialidade from medicos WHERE id = ?");
                $stmt->execute([$id]);
                $resultado = $stmt->fetchAll();
                if (count($resultado) == 1) {
                    return $resultado[0];
                } else {
                    return null;
                }
            } catch (Exception $e) {
                echo json_encode([
                    "status" => "Error"
                ]);
            }
        }

        public static function listaMedicos(){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("SELECT id, nome, dataCadastro, idEspecialidade from medicos ORDER BY id"); //order by ja da sort bunitin, só botar o campo
                $stmt->execute();
                $resultado = $stmt->fetchAll(); //retorna lista associativa
                return $resultado;
    
            }catch(Exception $e){
                echo json_encode([
                    "msg" => "Error"
                ]);
                exit;
            }
        }

        public static function getMedico($id) {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("SELECT id, nome, dataCadastro, idEspecialidade from medicos WHERE id = ?");
                $stmt->execute([$id]);
                $resultado = $stmt->fetchAll();
                if (count($resultado) == 1) {
                    return $resultado[0];
                } else {
                    return null;
                }
            } catch (Exception $e) {
                echo json_encode([
                    "msg" => "Error"
                ]);
            }
        }

        public static function updateMedico($id, $nome, $idEspecialidade) {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("UPDATE medicos set nome=?, idEspecialidade=? WHERE id = ?");
                $stmt->execute([$nome, $idEspecialidade, $id]);
                if ($stmt->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo json_encode([
                    "msg" => "Error"
                ]);
            }
        }

        public static function deleteMedico($id) {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("DELETE from medicos WHERE id = ?");
                $stmt->execute([$id]);
                $resultado = $stmt->fetchAll();
                if ($stmt->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo json_encode([
                    "msg" => "Error"
                ]);
            }
        }
    }
?>