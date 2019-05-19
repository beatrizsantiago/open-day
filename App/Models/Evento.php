<?php

    namespace App\Models;

    use MF\Model\Model;

    class Evento extends Model {
        private $id;
        private $administradorId = 1;
        private $nome;
        private $local = "Unifanor|Dunas";
        private $respGeralId = 6;
        private $diaInicio = 00;
        private $mesInicio = 00;
        private $anoInicio = 00;
        private $dataFim = "00/00/00";
        private $descricao;
        private $imgEvento = './img/evento.jpg';
        
        public function __get($atributo) {
            return $this->$atributo;
        }

        public function __set($atributo, $valor) {
            $this->$atributo = $valor;
        }

        public function adicionarEvento() {
            $query = "
                insert into evento(administradorId, titulo, local, respGeralID, diaInicio, mesInicio, anoInicio, dataFim, descricao, imgEvento) 
                values (:administradorId, :titulo, :local, :respGeralID, :diaInicio, :mesInicio, :anoInicio, STR_TO_DATE(:dataFim, '%d/%m/%Y'), :descricao, :imgEvento);
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':administradorId', $this->__get('administradorId'));
            $stmt->bindValue(':titulo', $this->__get('titulo'));
            $stmt->bindValue(':local', $this->__get('local'));
            $stmt->bindValue(':respGeralID', $this->__get('respGeralId'));
            $stmt->bindValue(':diaInicio', $this->__get('diaInicio'));
            $stmt->bindValue(':mesInicio', $this->__get('mesInicio'));
            $stmt->bindValue(':anoInicio', $this->__get('anoInicio'));
            $stmt->bindValue(':dataFim', $this->__get('dataFim'));
            $stmt->bindValue(':descricao', $this->__get('descricao'));
            $stmt->bindValue(':imgEvento', $this->__get('imgEvento'));
            $stmt->execute();

            return $this;
        }

        public function listarEventos() {
            $query = "
                select e.id, e.titulo, e.descricao
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