<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class add extends CI_Controller {
	public function __construct() {
        parent::__construct();

        $this->load->database();

        header("Access-Control-Allow-Origin: *");
        header('Content-type: application/json');
        header('Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, X_FILENAME");
	}

	public function index() {
		echo 'Welcome';
	}

	public function location() {

	    $submissionData = $this->input->post();

        $postCode = $this->input->post('postcode');
        $name = $this->input->post('name');
        $address = $this->input->post('address');
        $category = $this->input->post('category');
        $description = $this->input->post('description');
        $website = $this->input->post('website');
        $twitter_handle_url = $this->input->post('twitter');

        $data = array(
            'name' => $name,
            'address' => $address.', '.$postCode,
            'category' => $category,
            'description' => $description,
            'website' => $website,
            'twitter' => $twitter_handle_url,
            'status' => '1'
        );

        $this->db->insert('locations', $data);

        if (! $submissionData) {
            $response['status'] = 'error';
            $response['code'] = '500';
            $response['reason'] = 'No post data sent';
            
            echo json_encode($response);
            return;
        }

        $response['status'] = 'success';
        $response['code'] = '200';
        $response['data'] = $submissionData;

        echo json_encode($response);
        return;
	}
}
