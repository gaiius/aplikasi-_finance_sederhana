
      
      <?php                     				  
	  if (isset($_GET['input']))
	{
		$input = $this->input->get('input');
		echo "<h2 align=center>Quick Seach</h2>";
		$query = mysql_query("SELECT kode FROM po_out WHERE kode LIKE '%$input%'"); //query mencari hasil search
		$hasil1 = mysql_num_rows($query);
		if ($hasil1 > 0)
		{
			while ($data = mysql_fetch_row($query))
			{
				?>
				<a class="cari" href="javascript:autoInsert1('<?=$data[0]?>');"><?=$data[0]?><hr /><BR> <!-- hasil search -->
				<?php
			}
		}
		else
		{
			echo "Data tidak ditemukan";
		}
	
	}


					
					?>