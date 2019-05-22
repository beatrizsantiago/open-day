<?php

    namespace App\Models;

    use MF\Model\Model;

    class Atividade extends Model {
        private $id;
        private $eventoId;
        private $tema;
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
                insert into atividade(eventoID, tema, hora, local, descricao) values (:eventoID, :tema, :hora, :local, :descricao)
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':eventoID', $this->__get('eventoId'));
            $stmt->bindValue(':tema', $this->__get('tema'));
            $stmt->bindValue(':hora', $this->__get('hora'));
            $stmt->bindValue(':local', $this->__get('local'));
            $stmt->bindValue(':descricao', $this->__get('descricao'));
            $stmt->execute();

            return $this;
        }

        public function listarAtividades() {
            $query = "
                select a.id as idAtv, a.eventoID, a.tema, a.local, TIME_FORMAT(a.hora, '%H:%i') as hora, a.descricao, e.id, e.nome
                from atividade as a, evento as e
                where a.eventoID = :id and e.id = a.eventoID
                order by a.tema;
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