<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>
<!doctype html> <!--
paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!-->

	<!--<![endif]--><head>


                       
						    
                             
                        
       
	                    <?php $this->load->view($main_view); ?>
					
                       
                        
                             
           