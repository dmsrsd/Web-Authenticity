<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data-Pemenang.xls");
?>
<table>
	<tr>
		<th colspan="8">Data pemenang lucky whell</th>
	</tr>
	<tr>
		<th width='35'>No</th>
		<th>Kota</th> 	
		<th>Fullname</th> 
		<th>Email</th>
		<th>Address</th>
		<th>Gender</th>
		<th>Age</th>
		<th>Hp</th>
		<th>Aboutme</th>
		<th>Dob</th>
		<th>Issmoke</th>
		<th>Rokok</th>
		<th>Dari</th>
		<th>Status	</th>
		<th>Last_login</th>
		<th>Last_ip</th>
		<th>Last_browser</th>
		<th>Instagram </th>
		<th>Nama Hadiah</th> 	
		<th>Alamat</th> 
		<th>Tanggal Spinner</th> 
	</tr>
	<?php
		$no=1;
		foreach($itemdata as $row): 
		?>
		<tr>
			<td align='center'><?=$no;?></td>
			<td><?=isset($row['kota']) ? $row['kota'] : ''?></td>	
			<td><?=isset($row['nama_user']) ? $row['nama_user'] : $row['fullname']?></td>
			<td><?=isset($row['email']) ? $row['email'] : ''?></td> 
			<td><?=isset($row['alamat']) ? $row['alamat'] : $row['address']?></td>
			<td><?=isset($row['gender']) ? $row['gender'] : ''?></td>
			<td><?=isset($row['age']) ? $row['age'] : '-'?></td>
			<td><?=isset($row['hp']) ? $row['hp'] : ''?></td> 
			<td><?=isset($row['aboutme']) ? $row['aboutme'] : ''?></td>
			<td><?=isset($row['dob']) ? $row['dob'] : ''?></td>
			<td><?=isset($row['issmoke']) ? $row['issmoke'] : ''?></td>
			<td><?=isset($row['rokok']) ? $row['rokok'] : ''?></td>
			<td><?=isset($row['dari']) ? $row['dari'] : ''?></td>
			<td><?=isset($row['status']) ? $row['status'] : ''?></td>
			<td><?=isset($row['last_login']) ? $row['last_login'] : ''?></td>
			<td><?=isset($row['last_ip']) ? $row['last_ip'] : ''?></td>
			<td><?=isset($row['last_browser']) ? $row['last_browser'] : ''?></td>
			<td><?=isset($row['akun_ig']) ? $row['akun_ig'] : $row['instagram']?></td>
			<td><?=isset($row['nama_hadiah']) ? $row['nama_hadiah'] : ''?></td> 
			<td><?=isset($row['alamat']) ? $row['alamat'] : ''?></td> 
			<td><?=isset($row['created_date']) ? $row['created_date'] : ''?></td> 
		</tr>
		<?php 
		$no++;endforeach;
	?>
</table>