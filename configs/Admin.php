<?php
    require_once "configs/BancoDados.php";

    class Admin {
        public static function addAdmin($login, $senha) {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("INSERT INTO administradores(login, senha) VALUES (?, ?)");
                $stmt->execute([$login, $senha]);

                if($stmt->rowCount() > 0){
                    return true;
                }
                else{
                    return false;
                }
            } catch (Exception $e) {
                echo json_encode([
                    "msg" => "Error"
                ]);
                exit;
            }
        }

        public static function getAdmin($login) {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("SELECT login, senha from administradores WHERE login = ?");
                $stmt->execute([$login]);
                $resultado = $stmt->fetchAll();
                if (count($resultado) == 1) {
                    return $resultado[0];
                } else {
                    return null;
                }
            } catch (\Throwable $th) {
                echo json_encode([
                    "msg" => "Error"
                ]);
                exit;
            }
        }

        public static function deleteAdmin($login) {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("DELETE FROM administradores WHERE login = ?");
                $stmt->execute([$login]);
                if ($stmt->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } catch (\Throwable $th) {
                echo json_encode([
                    "msg" => "Error"
                ]);
            }   exit;
        }
    }
?>