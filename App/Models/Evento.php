<?php

    namespace App\Models;

    use MF\Model\Model;

    class Evento extends Model {
        private $id;
        private $nome;
        private $descricao;
        
        public function __get($atributo) {
            return $this->$atributo;
        }

        public function __set($atributo, $valor) {
            $this->$atributo = $valor;
        }

        public function adicionarEvento() {
            $query = "
                insert into evento(nome, descricao) values (:nome, :descricao);
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':nome', $this->__get('nome'));         
            $stmt->bindValue(':descricao', $this->__get('descricao'));
            $stmt->execute();

            return $this;
        }

        public function listarEventos() {
            $query = "
                select e.id, e.nome, e.descricao
                from evento as e
            ";

            $stmt = $this->db->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function deletarEvento() {
            $query = "
                delete from evento where id = :id;
            ";

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $this->__get('id'));
            $stmt->execute();

            return true;
        }

    }

?>