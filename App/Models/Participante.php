<?php

    namespace App\Models;

    use App\Models\Usuario;

    class Participante extends Usuario {

        private $nome;
        private $email;
        private $escola;
        private $area;
        private $telefone;

        public function __get($atributo) {
            return $this->$atributo;
        }

        public function __set($atributo, $valor) {
            $this->$atributo = $valor;
        }

        public function criarParticipante() {
            $query = "
                insert into participante(nome, email, escola, area, telefone) values ( :nome, :email, :escola, :area, :telefone);
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':nome', $this->__get('nome'));
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':escola', $this->__get('escola'));
            $stmt->bindValue(':area', $this->__get('area'));
            $stmt->bindValue(':telefone', $this->__get('telefone'));
            $stmt->execute();

            return $this;
        }

    }

?>