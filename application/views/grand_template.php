<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>
<!doctype html> <!--

<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!-->

<head>

<?php
$this->load->library('session');
$w=$session_id = $this->session->userdata('session_id');
//print_r ($w);


$username = $this->session->userdata('username');

$YYYXM=mysql_query("SELECT * FROM login  where user='$user' and password='$pass'");
$SSXMX=mysql_fetch_array($YYYXM);
if($SSXMX['qpa'] == 'Login'){				   
$data['username']=$username;   
$this->load->view('header',$data);
$this->load->view($main_view); 
}else{
	echo "Maaf anda harus login Ulang<hr>";?>
    <a href="<?=$base_url?>">
<img src="<?=$base_url?>public/log.gif">;
</a>
<?php }

?>
                       
						    
                             
                       
       
	                  
					
                       
                        
                             
           