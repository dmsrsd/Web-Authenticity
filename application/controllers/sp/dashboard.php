
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class Dashboard extends SpController {
	function __construct() {
        parent::__construct();
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfosp"];
		//$this->load->library('dompdf_gen');
    }

	public function index(){ 
		$c = $this->session->all_userdata();
		$c = $c["userinfosp"];		
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['user'] = $this->model_global->get_data(array('data' => 'row','table' => 'usersp', 'where' => array('id_usersp' => $c['_id']))); 
		$this->template['tiket'] = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array('id_ticket' => $this->template['user']['id_ticket'])));
		$query = $this->db->query("select sum(qty) as total from `order` where paid='1' and  id_ticket='".$this->template['tiket']['id_ticket']."'")->result_array(); 
		$total1 =  $query[0]['total'];
		$query = $this->db->query("select count(a.id_point) as total from point a
		left join orderdetail b on b.id_orderdetail = a.id_resource
		left join `order` c on c.id_order = b.id_order
		where a.id_jenis_point='5' and c.paid='1'  and c.id_ticket='".$this->template['tiket']['id_ticket']."'")->result_array(); 
		$total2 =  $query[0]['total'];
		
		$this->template['totalbeli'] = $total1;
		$this->template['totalscan'] = $total2;
		$this->rendersp('sp/sp');
 
		//echo $this->template['url'];
	}
	public function scantiket(){ 
		$ret['status'] = "true";
		$ret['hasil'] = ""; 
		$ret['in'] = "false"; 
		if (!$this->session->userdata('userinfosp')) {
			$ret['status'] = "true";
			$ret['hasil'] = "No user login"; 
		}else{		 
			$c = $this->session->all_userdata();
			$c = $c["userinfosp"];				
			$cek = $_POST['qr'];
			$dec = $this->encrypt->decode($cek);
			$dec = str_replace("--","-",$dec);
			$dec = str_replace("---","-",$dec);
			$dec = str_replace("----","-",$dec);
			$x = explode("-clm-",$dec);
			$jenis = $x[0];
			$idtiket = $x[2];
			
			$sp = $this->model_global->get_data(array('data' => 'row','table' => 'usersp', 'where' => array('id_usersp' => $c['_id']))); 
			
			if($jenis=="item"){
				$item = $x[4];
				if(count($x)<6){
					$ret['status'] = "true";
					$ret['hasil'] = "NOT QR SimplyAuthentic ";
				}else{
					$inv = $x[5];
					$ticketitem = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array( 'id_ticket' =>$idtiket)));
					if($sp['id_ticket']!=$idtiket){
						$ret['status'] = "true";
						$ret['hasil'] = "<h2>Kesalahan Akses!</h2><h3>Akses ini untuk event :</h3>"; 
						$ret['hasil'].= "<table width='100%' class='table'>";
						$ret['hasil'].= "<tr><th>".$ticketitem['judul']."</th> </tr>"; 
						$ret['hasil'].= "<tr><th>".$ticketitem['dimana']."</th> </tr>"; 
						$ret['hasil'].= "<tr><th>".$ticketitem['tanggal']."</th> </tr>"; 
						$ret['hasil'].= "</table>"; 
						$ret['hasil'].= "<br><br>Cek kembali akses login, atau barcode event." ;
					}else{
					
						if(count($ticketitem)==0){
							$ret['status'] = "true";
							$ret['hasil'] = "Data tidak ada! ";
						}else{
							if($ticketitem['tanggal']!=date("Y-m-d")){
							//if(1!=1){
								$ret['status'] = "true"; 
								$ret['hasil'] = "<h2>Kesalahan Akses!</h2><h3>Tanggal tidak sesuai.</h3>";
								$ret['hasil'].= "<table width='100%' class='table'>";
								$ret['hasil'].= "<tr><th>".$ticketitem['judul']."</th> </tr>"; 
								$ret['hasil'].= "<tr><th>".$ticketitem['dimana']."</th> </tr>"; 
								$ret['hasil'].= "<tr><th>".$ticketitem['tanggal']."</th> </tr>"; 
								$ret['hasil'].= "</table>"; 
							}else{
								$order = $this->model_global->get_data(array('data' => 'row','table' => 'order', 'where' => array( 'inv' =>$inv)));
								if(count($order)==0){
									$ret['status'] = "true";
									$ret['hasil'] = "<h2>Kesalahan Akses!</h2>QR Code tidak valid!<br><em>Status code : 1 </em>".$dec;
								}else{
									$orderd = $this->model_global->get_data(array('data' => 'row','table' => 'orderdetail', 'where' => array( 'id_order' =>$order['id_order'],'idx' =>$item)));
									if(count($orderd)==0){
										$ret['status'] = "true";
										$ret['hasil'] = "<h2>Kesalahan Akses!</h2>QR Code tidak valid!<br><em>Status code : 2</em>";
									}else{
										if($order['paid']=="1"){
											$point = $this->model_global->get_data(array('data' => 'row','table' => 'point', 'where' => array( 'id_member' =>$x[1],'id_resource' =>$orderd['id_orderdetail'],'id_jenis_point' =>"5")));
											if(count($point)>0){
												$head1 = "Akses Tidak Berhasil!";
												$head = "Barcode sudah di pakai ";
											}else{
												$head1 = "Akses Berhasil! ";
												$head = "Silahkan masuk";
												$p["id_member"] = $x[1];
												$p["id_resource"] = $orderd['id_orderdetail'];
												$p["id_jenis_point"] = "5";
												$p["created_date"] = date('Y-m-d H:i:s');
												$this->model_global->insert($p, 'point');
											}
											$ret['status'] = "true"; 
											$ret['hasil'] = "<h2 align='center'>$head1</h2><h3 align='center'>$head</h3><br>"; 
											$ret['hasil'].= "Silahkan periksa kembali bahwa data berikut valid : <br><br>";
											$ret['hasil'].= "<table width='100%' class='table'>";
											$ret['hasil'].= "<tr><th colspan='3'>".$ticketitem['judul']."</th></tr>"; 
											$ret['hasil'].= "<tr><th>Nama</th><td width='10' align='center'>:</td><td>$orderd[nama]</td></tr>"; 
											$ret['hasil'].= "<tr><th>Email</th><td width='10' align='center'>:</td><td>$orderd[email]</td></tr>"; 
											$ret['hasil'].= "<tr><th>HP</th><td width='10' align='center'>:</td><td>0$orderd[hp]</td></tr>"; 
											$ret['hasil'].= "<tr><th>Tgl Order</th><td width='10' align='center'>:</td><td>$order[paid_date]</td></tr>"; 
											$ret['hasil'].= "</table>"; 
											
											$ret['in'] = "true"; 
											
										}else{
											$ret['status'] = "true";
											$ret['hasil'] = "<h2>Scan QR Gagal..!</h2>Anda belum melakukan pembayaran untuk Tiket ini";
										}
									}
								}
							}
						}
					}
				}
			}else{
				$ret['status'] = "true";
				$ret['hasil'] = "Anda belum membeli tiket ini! ";
			}
			
			/*
			$id =  end($x);
			*/
		}
		echo json_encode($ret);	
	}
	public function tiketmasuk(){ 
		$c = $this->session->all_userdata();
		$c = $c["userinfosp"];		
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['user'] = $this->model_global->get_data(array('data' => 'row','table' => 'usersp', 'where' => array('id_usersp' => $c['_id']))); 
		$this->template['tiket'] = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array('id_ticket' => $this->template['user']['id_ticket'])));
		//echo base_url();
		$this->rendersp('sp/tiketmasuk');
 
		//echo $this->template['url'];
	}
	public function validate_slug($table, $column, $slug, $id = 0) {
		if ($id > 0)
			$this->db->where('id !=', $id);

		$this->db->where($column." REGEXP '^".$slug."(\-[0-9]+)?$'");
		
		$this->db->order_by($column, 'desc');
		$this->db->limit(1, 0);
		$res = $this->db->get($table);
		if ($res->num_rows() == 0) {
			return $slug;
		} else {
			$row = $res->row_array();
			$slug2 = $row[$column];
			preg_match('/^(.+)([0-9]+)$/', $slug2, $found);
			if (empty($found)) {
				return $slug.'-1';
			} else {
				return $slug.'-'.((int)$found[2]+1);
			}
		}
	}
	public function reroute() {
		$action = str_replace('-', '_', $this->uri->segment(3));
		// echo $action;
		// die();
		$c = $this->session->all_userdata(); 
		if (method_exists($this, $action)) {
			call_user_func_array(array($this, $action), array());
		} else {
			show_404();
		} 
	}
	
}
/*
	$actual_link = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	echo $actual_link;
	echo "<br>";
	$url = $_SERVER['REQUEST_URI'];
	$parts = explode('/',$url);
	$dir = $_SERVER['SERVER_NAME'];
	for ($i = 0; $i < count($parts) - 1; $i++) {
		$dir .= $parts[$i] . "/";
	}
	echo $dir;*/
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */