<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data-Submit-".$type.".xls");
?>
<table>
	<thead>
		<tr>
			<th width='35'>No</th>
			<th>Tanggal</th> 
			<th>Nama</th> 
			<th>Tempat Beli / No Resi</th>
			<th>Gambar</th>
			<th>Type</th>
			<th>Status</th>
			<th>Kota</th> 	
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
		</tr>
	</thead>
	<tbody>
	<?php
		$no=1;
		if(isset($datas) && count($datas) > 0): foreach($datas as $row):
	?>
		<tr>
			<td align='center'><?=$no;?></td>
			<td><?=isset($row['created_date']) ? $row['created_date'] : ''?></td> 
			<td><?=isset($row['member']) ? $row['member'] : $row['fullname']?></td>
			<td><?=isset($row['lokasi_pembelian']) ? $row['lokasi_pembelian'] : ''?></td>
			<td><?=isset($row['resi']) ? base_url('uploads/resi/'.$row['resi']) : 'tidak upload gambar'?></td> 
			
				<?php if($row['type']=="silver"){?>
					<td> Event </td>
				<?php } else if($row['type']=="purple"){?>
					<td> Lab </td>
				<?php } else {?>
					<td> Horeka </d>
				<?php } ?>
			<td align='center'>
				<?= ($row['status']==0)? 'Belum Konfirm' : 'Selesai Konfirm</a>';?>				
			</td>
			<td><?=isset($row['kota']) ? $row['kota'] : ''?></td>	
			<td><?=isset($row['email']) ? $row['email'] : ''?></td> 
			<td><?=isset($row['address']) ? $row['address'] : ''?></td>
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
			<td><?=isset($row['instagram']) ? $row['instagram'] : ''?></td>
		</tr>
		<?php $no++;endforeach; endif; ?>
	</tbody>
</table>
	