<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function index(){
        // membuat session yand di ambil dari userdata dan memberi nama isLogin
        $session = $this->session->userdata('isLogin');
            //jika session salah 
            if($session == FALSE){
                redirect('login/login_form');   
            }else{
                //jika session benar 
                redirect('home');
            }
    }
	public function table_user($user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
        $data['main_view'] = 'profile/v_profile';
		$this->load->view('grand_template',$data);
		
	}
	
   public function add($user,$pass)
	{
		 $data['pass'] = $pass;
		$data['user'] = $user;
        $data['main_view'] = 'profile/v_add_account';
		$this->load->view('grand_template',$data);
		
	}
	
	
	public function insert_account($user,$pass)
	{	
	    $data['user'] = $user;
		$data['pass'] = $pass;
		$usr=$this->input->post('usr');
	$pass2=$this->input->post('pass');
	$password=md5($this->input->post('pass'));
	$email= $this->input->post('email');
	$telp= $this->input->post('telp');
	
	$gambar_name=$_FILES['gambar']['name'];
	$gambar_asal=$_FILES['gambar']['tmp_name'];
	if(empty($gambar_name)){
	    $acak="kosong";
	}else{
		$acak	  = rand(000000,999999);
	}
	$pg = '/[\s]+/';
    $f_gambar =  preg_replace($pg,'', $gambar_name);
	$namafoto=$acak.$f_gambar;
	
	$sentence = "$email"; //Kalimatnya
    $value = "1";//Berapa kata yang ingin diambil
    $limit_sentence = implode("@", array_slice(explode("@", $sentence), 0, $value));
    //echo $limit_sentence;

	!move_uploaded_file($gambar_asal,"foto/$namafoto");
	$this->db->query("insert into login (user, password, nama, email, bp, foto)
	           values ('$usr','$password','$limit_sentence','$email','$pass2','$namafoto')");
      
      $status= $this->input->post('status');
        for($i=0; $i<count($status); $i++){      
           
            $sql2 = $this->db->query("insert into akses_user (url_kode,nama_user)VALUES ('$status[$i]','$usr')");
		}
	redirect('profile/table_user/'.$user."/".$pass);
	}
	
	 public function edit_profile($id,$user,$pass)
	{
		$data['pass'] = $pass;
		$data['user'] = $user;
		$data['id'] = $id;
        $data['main_view'] = 'profile/v_edit_profile';
		$this->load->view('grand_template',$data);
		
	}
	
	public function update_account($user,$pass)
	{	
	    $data['user'] = $user;
		$data['pass'] = $pass;
		$usr=$_POST['usr'];
		$email=$_POST['email'];
	    $hak=$_POST['hak'];
		$telp=$_POST['telp'];										  							
$sentence = "$email"; //Kalimatnya
$value = "1";//Berapa kata yang ingin diambil
$limit_sentence = implode("@", array_slice(explode("@", $sentence), 0, $value));
echo $limit_sentence;


	$pass2=$_POST['pass'];
	$password=md5($_POST['pass']);
	$acak	  = rand(000000,999999);
	$gambar_name=$_FILES['gambar']['name'];
	if (empty($gambar_name)){
		$acak	  = rand(000000,999999);
		$data = array(		
		"user" => $usr,
        "password" => $password,
		"telp" => $telp,
        "bp" => $pass2,
		"email" => $email,
		"hakakses" => $hak,
		"nama" => $limit_sentence
               );
	   $this->load->model('m_progres');
       $this->m_progres->update_log($data, $usr); 
		
	}else{
	$acak	  = rand(000000,999999);
	$gambar_name=$_FILES['gambar']['name'];
	$gambar_asal=$_FILES['gambar']['tmp_name'];
	$pg = '/[\s]+/';
    $f_gambar =  preg_replace($pg,'', $gambar_name);
	$namafoto=$acak.$f_gambar;

	!move_uploaded_file($gambar_asal,"foto/$namafoto");
	   $data = array(		
		"user" => $usr,
        "password" => $password,
		"telp" => $telp,
        "bp" => $pass2,
		"email" => $email,
		"hakakses" => $hak,
		"nama" => $limit_sentence,
		"foto" => $namafoto
               );
	   $this->load->model('m_progres');
       $this->m_progres->update_log($data, $usr); 
	}
	
	  $status= $this->input->post('status');
	  $status2= $this->input->post('status2');
        for($i=0; $i<count($status); $i++){      
             $sql2 = $this->db->query("update akses_user set nama_user='$usr' where nama_user='$usr'");
			 print_r ($status[$i]);
		}
		       if(isset($status2)){
			   for($u=0; $u<count($status2); $u++){      
                 $sqlu = $this->db->query("insert into akses_user (url_kode,nama_user)VALUES ('$status2[$u]','$usr')");
		       }
	}
	$akses=$this->db->query("delete from akses_user where url_kode='0'");
redirect('profile/table_user/'.$user."/".$pass);
	}
	
	public function del_profile($id,$user,$pass) {
		$data['user'] = $user;
		$data['id'] = $id;
		$data['pass'] = $pass;
        $login=$this->db->query("delete from login where user='$id'");
       	$akses=$this->db->query("delete from akses_user where nama_user='$id'");
        redirect('profile/table_user/'.$user."/".$pass);
        }
		public function del_akses($kembali,$id,$user,$pass) {
		$data['user'] = $user;
		$data['id'] = $id;
		$data['kembali'] = $kembali;
		$data['pass'] = $pass;
       	$akses=$this->db->query("delete from akses_user where id_kode='$id'");
        redirect('profile/edit_profile/'.$kembali."/".$user."/".$pass);
        }
		
	 public function add_menu($user,$pass)
	{
		 $data['pass'] = $pass;
		$data['user'] = $user;
        $data['main_view'] = 'profile/v_add_menu';
		$this->load->view('grand_template',$data);
		
	}
	
	public function logout($user,$pass)
    {
        $YYYXM=mysql_query("SELECT * FROM login  where user='$user' and password='$pass'");
        $SSXMX=mysql_fetch_array($YYYXM);
		
		 $sql = $this->db->query("UPDATE login SET
				                   qpa='Keluar'
											   where user='$user' and password='$pass'
				                              ");
        redirect('index.php');
    }
}