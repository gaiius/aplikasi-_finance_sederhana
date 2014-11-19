<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index()
	{
		 $data['main_view'] = 'cek/v_log';
		$this->load->view('template_blank',$data);
	}
	public function masuk()
	{
        $data['main_view'] = 'cek/v_log';
		$this->load->view('template_blank',$data);
		
	}
	public function login_akses()
	{
        $this->form_validation->set_rules("username", "Username", "required");
        $this->form_validation->set_rules("password", "Password", "required");

        if ($this->form_validation->run() == TRUE)
        {
            
            $user = $this->input->post('username');
            $password = $this->input->post('password');
            
            $password=md5($password);
             $this->load->model('login_model');
			
            if
            
            ($this->login_model->check($user, $password) == TRUE)
            {
                $data = array('user' => $user, 'password' => $password, 'login' => TRUE);
                $this->session->set_userdata($data);
		
               if($data['login'] == 1){
				 
				   $sql = $this->db->query("UPDATE login SET
				                               qpa='Login'
											   where user='$user' and password='$password'
				                              ");
											    
                 exit("<script>window.alert('Proses Login Berhasil..!!');
				window.location='../purchase/out/$user/$password';</script>");
              }
            }

            else
            {
                $this->session->set_flashdata('message', 'Username or password invalid.');
                redirect('login');
            }
        }
 
        else
      {
            $this->load->view('login/v_login');
      }

    }
	
		public function add_pop()
	{
		 $data['main_view'] = 'profile/v_add_pop';
		 $this->load->view('template_blank',$data);
		
	}
	
	
	public function insert()
	{	
        $nama = $this->input->post('nama');
        $jabatan = $this->input->post('jabatan');
	$keterangan = $this->input->post('keterangan');;
	$acak	  = rand(000000,999999);
	$gambar_name=$_FILES['gambar']['name'].$acak;
	$gambar_asal=$_FILES['gambar']['tmp_name'];
	!move_uploaded_file($gambar_asal,"foto/$gambar_name");
	   $data = array(		
		"nama" => $nama,
                "jabatan" => $jabatan,
                "keterangan" => $keterangan,
		"foto" => $gambar_name
               );
	   $this->load->model('m_profile');
            $this->m_profile->insert($data);      
	redirect('progres/add');
	}
	
		public function update()
	{
		$input = $this->input->get('allin');
		
		$pg = '/[\,]/';
        $hasil =  preg_replace($pg,' ', $input);
								
		$word = explode(" ", $hasil);
        
		$file = fopen("test.txt","w");
        echo fwrite($file,"email='$word[1]' where user=$word[0]");
        fclose($file);
		
		$sql1 = $this->db->query("UPDATE log_user SET nama='$word[1]' where id_log='$word[0]'");
										
		
		
	}
}