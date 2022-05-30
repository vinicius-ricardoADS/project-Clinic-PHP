<?php
    require_once "configs/BancoDados.php";

    class Pacientes {
        public static function addPaciente($nome, $dataNasc) {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("INSERT INTO pacientes(nome, dataNascimento, dataCadastro) VALUES (?, ?, NOW())");
                $stmt->execute([$nome, $dataNasc]);

                if($stmt->rowCount() > 0){
                    return true;
                }
                else{
                    return false;
                }
            } catch (Exception $e) {
                echo json_encode([
                    "msg" => "Erro ao cadastrar novo paciente"
                ]);
                exit;
            }
        }

        public static function listaPacientes(){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("SELECT id, nome, dataNascimento, dataCadastro FROM pacientes ORDER BY id"); //order by ja da sort bunitin, só botar o campo
                $stmt->execute();
                $resultado = $stmt->fetchAll(); //retorna lista associativa
                return $resultado;
    
            }catch(Exception $e){
                echo json_encode([
                    "msg" => "Erro"
                ]);
                exit;
            }
        }

        public static function getPessoa($id) {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("SELECT id, nome, dataNascimento, dataCadastro from pacientes WHERE id = ?");
                $stmt->execute([$id]);
                $resultado = $stmt->fetchAll();
                if (count($resultado) == 1) {
                    return $resultado[0];
                } else {
                    return null;
                }
            } catch (Exception $e) {
                echo json_encode([
                    "msg" => "Erro"
                ]);
            }
        }

        public static function verificaSeExisteId($id) {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("SELECT * FROM pacientes WHERE id = ?");
                $stmt->execute([$id]);
                if ($stmt->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo json_encode([
                    "msg" => "Não existe esse id"
                ]);
                exit;
            }
        }

        public static function updatePaciente($id, $nome, $dataNasc) {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("UPDATE pacientes SET nome=?, dataNascimento=? WHERE id = ?");
                $stmt->execute([$nome, $dataNasc, $id]);
                if ($stmt->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo json_encode([
                    "msg" => "Erro"
                ]);
                exit;
            }
        }

        public static function dropPaciente($id) {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("DELETE FROM pacientes WHERE id = ?");
                $stmt->execute([$id]);
                if ($stmt->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo json_encode([
                    "msg" => "Erro"
                ]);
                exit;
            }
        }
    }
?>