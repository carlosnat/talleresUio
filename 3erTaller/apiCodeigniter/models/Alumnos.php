<?php

class Alumnos extends CI_Model {

        public $nombre;
        public $dni;

        public function get_all()
        {
                $query = $this->db->get('alumnos');
                return $query->result();
        }

        public function insert()
        {
                $this->nombre = $_POST['nombre'];
                $this->dni    = $_POST['dni'];

                $this->db->insert('alumnos', $this);
        }

        public function update()
        {
                $this->nombre    = $_POST['nombre'];
                $this->dni       = $_POST['dni'];
                $this->db->update('alumnos', $this, array('id' => $_POST['id']));
        }

        public function delete($id)
        {
            $this->db->where('id', $id);
            $this->db->delete('alumnos');
        }

}


?>