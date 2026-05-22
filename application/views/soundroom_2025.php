<h2 class="page-header">
	<?php echo $judul;?>
</h2>

<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class='col-sm-6'>Top 10</div>
			<div class='col-sm-6' align='right'>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover dataTables" >
				<thead>
					<tr>
						<th width='35'>No</th>
						<th width=''>Member</th>
						<th width=''>Nama Band</th>
						<th width='100'>Rank</th>
						<th width='100'>Image</th>
						<th width='100'>Sound</th>
						<th width='70'>Status</th>
						<th width='100'></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no=1;
						if(isset($data3) && count($data3) > 0): foreach($data3 as $row):
					?>
					<tr>
						<td align='center'><?=$no;?></td>
						<td><?=isset($row['member']) ? $row['member'] : ''?></td>
						<td><?=isset($row['judul']) ? $row['judul'] : ''?></td>
						<td><?=isset($row['rank']) ? $row['rank'] : ''?></td>
						<!--<td><?=isset($row['votes']) ? $row['votes'] : ''?></td>-->
						<!--<td><?=isset($row['votes5']) ? $row['votes5'] : ''?></td>-->
						<!--<td><?=isset($row['deskripsi']) ? substr(strip_tags($row['deskripsi']),0,100)." ..." : ''?></td>  -->
						<td>
							<div class='thumbnail'>
							<a class='fancybox ' href='<?php echo base_url()."uploads/soundroom/".$row['image'];?>'><img src='<?=isset($row['image']) ? base_url()."uploads/soundroom/".$row['image'] : base_url().'uploads/no_image.png'?>'></a>
							</div>
						</td>
						<td><?=isset($row['sound']) ? "<a href='".base_url()."uploads/soundroom/".$row['sound']."' target='_blank'>".$row['sound']."</a>" : ''?></td>
						<td align='center'>
							<a href='javascript:void(0);' class="label label-success" id='st-<?php echo $row['id_soundroom'];?>' onclick="change_status('st-<?php echo $row['id_soundroom'];?>','<?=isset($row['status']) ?  $status[$row['status']] : '-'?>','<?=$row['id_soundroom']?>','<?=base_url()?>cms/logic/delete_ajax/soundroom_2025/<?=$row['id_soundroom']?>')">
								<?php echo isset($row['status']) ?  $status[$row['status']] : '-'?>
							</a>
						</td>
						<td align='center'>
							<a href="<?=$url?>soundroom-new?_id=<?=$row['id_soundroom']?>&_year=2025" class='btn btn-xs btn-success  '><i class="fa fa-edit "></i></a>
							<a class='btn btn-xs btn-danger' onclick="return confirm('Are you sure you want to delete this item?');" href="<?=base_url()?>cms/logic/delete/soundroom_2025/<?=$row['id_soundroom']?>?part=write" class="text-danger"><i class="fa fa-trash-o"></i></a>
						</td>
					</tr>
					<?php $no++; endforeach; endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class='col-sm-6'><?php echo $judul;?> List</div>
			<div class='col-sm-6' align='right'>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover dataTables" >
				<thead>
					<tr>
						<th width='35'>No</th>
						<th width=''>Member</th>
						<th width=''>Nama Band</th>
						<th width='100'>Sosmed</th>
						<!--<th width='200'>Deskripsi Singkat</th> -->
						<th width='100'>Image</th>
						<th width='100'>Sound</th>
						<th width='100'>Submit Date</th>
						<th width='130'>Approve</th>
						<th width='70'>Status</th>
						<th width='100'></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no=1;
						if(isset($data) && count($data) > 0): foreach($data as $row):
					?>
					<tr>
						<td align='center'><?=$no;?></td>
						<td><?=isset($row['member']) ? $row['member'] : ''?></td>
						<td><?=isset($row['judul']) ? $row['judul'] : ''?></td>
						<td>
							<?php
								if( isset($row['instagram']) && $row['instagram']!='' ){
									$ret = 'IG : '.$row['instagram'];
									if( preg_match('/^http(s)?:\/\/[a-z0-9-]+(\.[a-z0-9-]+)*(:[0-9]+)?(\/.*)?$/i', str_replace(' ', '', $row['instagram'])) ){
										$ret = '<a href="'.$row['instagram'].'" target="blank">INSTAGRAM</a>';
									}

									echo $ret;
								}

								if( isset($row['spotify']) && $row['spotify']!='' ){

									echo (isset($row['instagram']))? '<br />':'';

									$ret = 'SPOTIFY : '.$row['spotify'];
									if( preg_match('/^http(s)?:\/\/[a-z0-9-]+(\.[a-z0-9-]+)*(:[0-9]+)?(\/.*)?$/i', str_replace(' ', '', $row['spotify'])) ){
										$ret = '<br /><a href="'.$row['spotify'].'" target="blank">SPOTIFY</a>';
									}

									echo $ret;
								}

								if( isset($row['youtube']) && $row['youtube']!='' ){

									echo (isset($row['instagram']) || isset($row['spotify']))? '<br />':'';

									$ret = 'YT : '.$row['youtube'];
									if( preg_match('/^http(s)?:\/\/[a-z0-9-]+(\.[a-z0-9-]+)*(:[0-9]+)?(\/.*)?$/i', str_replace(' ', '', $row['youtube'])) ){
										$ret = '<a href="'.$row['youtube'].'" target="blank">YOUTUBE</a>';
									}

									echo $ret;
								}
							?>
						</td>
						<td>
							<div class='thumbnail'>
								<a class='fancybox ' href='<?php echo base_url()."uploads/soundroom/".$row['image'];?>'>[view image]</a>
							</div>
						</td>
						<td>
							<?php
								if( isset($row['sound']) && $row['sound']!='' ){
									$sound_name = str_replace('_', ' ', $row['sound']);
									echo "<a href='".base_url()."uploads/soundroom/".$row['sound']."' target='_blank'>".$sound_name."</a>";
								}
							?>
						</td>
						<td><?=isset($row['created_date']) ? $row['created_date'] : ''?></td>
						<td><?=isset($row['approve']) ? $approve[$row['approve']] : ''?></td>
						<td align='center'>
							<a href='javascript:void(0);' class="label label-success" id='st-<?php echo $row['id_soundroom'];?>' onclick="change_status('st-<?php echo $row['id_soundroom'];?>','<?=isset($row['status']) ?  $status[$row['status']] : '-'?>','<?=$row['id_soundroom']?>','<?=base_url()?>cms/logic/delete_ajax/soundroom_2025/<?=$row['id_soundroom']?>')">
								<?php echo isset($row['status']) ?  $status[$row['status']] : '-'?>
							</a>
						</td>
						<td align='center'>
							<a href="<?=$url?>soundroom-new?_id=<?=$row['id_soundroom']?>&_year=2025" class='btn btn-xs btn-success  '><i class="fa fa-edit "></i></a>
							<a class='btn btn-xs btn-danger' onclick="return confirm('Are you sure you want to delete this item?');" href="<?=base_url()?>cms/logic/delete/soundroom_2025/<?=$row['id_soundroom']?>?part=write" class="text-danger"><i class="fa fa-trash-o"></i></a>
						</td>
					</tr>
					<?php $no++; endforeach; endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
