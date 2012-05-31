<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ck extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $this->load->model('user/user', 'user');
        $this->user->userNameIsExist('asd');
		$this->load->view('ck');
        //$db = this->load->database('aaa,',false)
        //this->db->query
	}

	public function aa()
	{
		//echo 'aa';
		echo $this->input->get('bt');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */