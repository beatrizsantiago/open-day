<?php

    namespace App\Models;

    use MF\Model\Model;

    class Atividade extends Model {
        private $id;
        private $eventoId;
        private $tema;
        private $tipo;
        private $vagasMinimas = 0;
        private $vagasMaximas = 0;
        private $respAtividadeId = 1;
        private $data = "00/00/0000";
        private $hora;
        private $duracao = "00:00";
        private $local;
        private $pontosPex = 0;
        private $palestrante = "Palestrante";
        private $descricao;

        public function __get($atributo) {
            return $this->$atributo;
        }

        public function __set($atributo, $valor) {
            $this->$atributo = $valor;
        }

        public function adicionarAtividade() {
            $query = "
                insert into atividade(eventoID, tema, tipo, vagasminimas, vagasmaximas, respAtividadeID, data, hora, duracao, local, pontospex, palestrante, descricao) 
                values (:eventoID, :tema, :tipo, :vagasminimas, :vagasmaximas, :respAtividadeID, :data, :hora, :duracao, :local, :pontospex, :palestrante, :descricao)
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':eventoID', $this->__get('eventoId'));
            $stmt->bindValue(':tema', $this->__get('tema'));
            $stmt->bindValue(':tipo', $this->__get('tipo'));
            $stmt->bindValue(':vagasminimas', $this->__get('vagasMinimas'));
            $stmt->bindValue(':vagasmaximas', $this->__get('vagasMaximas'));
            $stmt->bindValue(':respAtividadeID', $this->__get('respAtividadeId'));
            $stmt->bindValue(':data', $this->__get('data'));
            $stmt->bindValue(':hora', $this->__get('hora'));
            $stmt->bindValue(':duracao', $this->__get('duracao'));
            $stmt->bindValue(':local', $this->__get('local'));
            $stmt->bindValue(':pontospex', $this->__get('pontosPex'));
            $stmt->bindValue(':palestrante', $this->__get('palestrante'));
            $stmt->bindValue(':descricao', $this->__get('descricao'));
            $stmt->execute();

            return $this;
        }

        public function listarAtividades() {
            $query = "
                select a.id, a.eventoID, a.tema, a.tipo, a.local, TIME_FORMAT(a.hora, '%H:%i') as hora, a.descricao, e.id, e.titulo
                from atividade as a, evento as e
                where a.eventoID = :id and e.id = a.eventoID
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