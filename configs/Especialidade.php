<?php
    require_once "configs/BancoDados.php";

    class Especialidade {
        public static function getId($id) {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("SELECT id, nome from especialidades WHERE id = ?");
                $stmt->execute([$id]);
                $resultado = $stmt->fetchAll();
                if (count($resultado) == 1) {
                    return $resultado[0];
                } else {
                    return null;
                }
            } catch (Exception $e) {
                echo json_encode([
                    "status" => $e->getMessage()
                ]);
            }
        }
    }
?>