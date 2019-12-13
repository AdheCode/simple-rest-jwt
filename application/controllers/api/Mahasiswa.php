<?php

use Restserver\Libraries\REST_Controller_Definitions;

defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends BD_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Mahasiswa_model', 'mahasiswa');
        $this->auth();

        $this->methods['index_get']['limit'] = 100;
    }

    public function index_get(){

    	$id = $this->get('id');
    	if ($id === null) {
    		$mahasiswa = $this->mahasiswa->get_mahasiswa();
    	} else {
    		$mahasiswa = $this->mahasiswa->get_mahasiswa($id);
    	}
    		
    	
    	if ($mahasiswa) {

    		// Set the response and exit
    		$this->response([
    			'status' => true,
    			'data' => $mahasiswa
    		], REST_Controller_Definitions::HTTP_OK);

    	} else {    		

    		$this->response([
    			'status' => false,
    			'message' => 'id not found'
    		], REST_Controller_Definitions::HTTP_NOT_FOUND);

    	}

    }

    public function index_delete(){

    	$id = $this->delete('id');
    	if ($id === null) {    		

    		$this->response([
    			'status' => false,
    			'message' => 'provide on id!'
    		], REST_Controller_Definitions::HTTP_BAD_REQUEST);


    	} else {

    		if ($this->mahasiswa->delete_mahasiswa($id) > 0) {

    			$this->response([
    				'status' => true,
    				'id' => $id,
    				'message' => 'data deleted success'
    			], REST_Controller_Definitions::HTTP_NO_CONTENT);
    			
    		} else {

    			$this->response([
    				'status' => false,
    				'message' => 'id not found!'
    			], REST_Controller_Definitions::HTTP_BAD_REQUEST);

    		}
    	}

    }

    public function index_post(){

    	$data = [
			'nrp'     => $this->post('nrp'),
			'nama'    => $this->post('nama'),
			'email'   => $this->post('email'),
			'jurusan' => $this->post('jurusan')
    	];

    	if ($this->mahasiswa->create_mahasiswa($data) > 0) {
    		
    		$this->response([
    			'status' => true,
    			'message' => 'new data has been created.'
    		], REST_Controller_Definitions::HTTP_CREATED);

    	} else {

    		$this->response([
    			'status' => false,
    			'message' => 'failed create data!'
    		], REST_Controller_Definitions::HTTP_BAD_REQUEST);

    	}

    }

    public function index_put(){
    	
    	$id = $this->put('id');
    	$data = [
			'nrp'     => $this->put('nrp'),
			'nama'    => $this->put('nama'),
			'email'   => $this->put('email'),
			'jurusan' => $this->put('jurusan')
    	];

    	if ($this->mahasiswa->update_mahasiswa($data, $id) > 0) {
    		
    		$this->response([
    			'status' => true,
    			'message' => 'Data has been updated.'
    		], REST_Controller_Definitions::HTTP_NO_CONTENT);

    	} else {

    		$this->response([
    			'status' => false,
    			'message' => 'failed update data!'
    		], REST_Controller_Definitions::HTTP_BAD_REQUEST);

    	}

    }


}