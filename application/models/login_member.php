<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
class Login_member extends CI_Model {

/*	function __construct()
	{
		parent::__construct();
	}
*/
    function LoginMember()
	{
		parent::Model();
	}

	var $table = 'advent';
	
	function check($user, $password)
	
	{
		
		$query = $this->db->get_where($this->table, array('email' => $user, 'password' => $password), 1, 0);
		//echo $query['hakakses'];
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		
		else
		{
			return FALSE;
		}	
	}
	public function get_user($user) {
        
        $data = $this->db->get_where($this->table, array('email' => $user));
        return $data->result_array();
    }
	
}
//end Login_model	
	