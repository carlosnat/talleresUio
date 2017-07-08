<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Restserver extends REST_Controller {

    public function __construct() {
        parent::__construct();
		
        $this->load->database();
        $this->load->helper('url');
    }

    public function users_get() {
        $this->load->model('alumnos');
        $this->response($this->alumnos->get_all());
    }
 
    function user_post()
    {

        $this->load->model('alumnos');

        $result = $this->alumnos->insert( array(
            'nombre' => $this->post('nombre'),
            'dni' => $this->post('dni')
        ));
         
        if($result === FALSE)
        {
            $this->response(array('status' => 'failed'));
        }
         
        else
        {
            $this->response(array('status' => 'success'));
        }
    }
 
    function updateuser_post()
    {       

        $this->load->model('alumnos');

        $result = $this->alumnos->update( $this->post('id'), array(
            'nombre' => $this->post('nombre'),
            'dni' => $this->post('dni')
        ));
         
        if($result === FALSE)
        {
            $this->response(array('status' => 'failed'));
        }
         
        else
        {
            $this->response(array('status' => 'success'));
        }
    }
 
    function user_delete($id)
    {
        $this->load->model('alumnos');

        $result = $this->alumnos->delete($this->delete($id));

        if($result === FALSE)
        {
            $this->response(array('status' => 'failed'));
        }
        else
        {
            $this->response(array('status' => 'success'));
        }

    }

}

?>