<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');
$base_url = $this->config->item('base_url');
?>
 <html>
<head>
<title>Pagination + Search Engine with CodeIgniter</title>
</head>
<body>
<form method="post" action="<?php echo base_url().'progres/search';?>" />
<input type="text" name="keyword">
<input type="submit" name="submit" value="Search!">
</form>
 
 
 
<?php foreach($posting as $retrieved){ ?>
<h4><?php echo $retrieved->judul;?></h4>
<p><?php echo $retrieved->isi;?></p>
 
 
 
<?php } ?>
</body>
</html>