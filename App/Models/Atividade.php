<?php

    namespace App\Models;

    use MF\Model\Model;

    class Atividade extends Model {
        private $id;
        private $eventoId;
        private $tema;
        private $tipo;
        private $hora;
        private $local;
        private $descricao;

        public function __get($atributo) {
            return $this->$atributo;
        }

        public function __set($atributo, $valor) {
            $this->$atributo = $valor;
        }

        public function adicionarAtividade() {
            $query = "
                insert into atividade(eventoID, tema, tipo, hora, local, descricao) 
                values (:eventoID, :tema, :tipo, :hora, :local, :descricao)
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':eventoID', $this->__get('eventoId'));
            $stmt->bindValue(':tema', $this->__get('tema'));
            $stmt->bindValue(':tipo', $this->__get('tipo'));
            $stmt->bindValue(':hora', $this->__get('hora'));
            $stmt->bindValue(':local', $this->__get('local'));
            $stmt->bindValue(':descricao', $this->__get('descricao'));
            $stmt->execute();

            return $this;
        }

        public function listarAtividades() {
            $query = "
                select a.id, a.eventoID, a.tema, a.tipo, TIME_FORMAT(a.hora, '%h:%i') as hora, a.local, a.descricao 
                from atividade as a, evento as e 
                where a.eventoID = :id
                order by a.data;
            ";

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $this->__get('id'));
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function deletarAtividade() {
            $query = "
                delete from atividade where id = :id;
            ";

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $this->__get('id'));
            $stmt->execute();

            return true;
        }
    }

?>