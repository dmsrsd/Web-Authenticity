<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ticket extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
		//$this->load->helper('informasi');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));
		$this->kategori = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status' => 1), 'order_by' => 'head_kategori asc'));
		$this->ticket = $this->model_global->get_data(array('select' => '*', 'table' => 'ticket','where' => array('status' => 1), 'order_by' => 'tanggal desc'));;

	}
	public function index(){
		$data['website'] = $this->website;
		$data['kategori'] = $this->kategori;
		$data['ticket'] = $this->ticket;
		//echo $this->cekode();
		$this->load->view('front/podcast/header',$data);
		$this->load->view('front/ticket',$data);
	}
	public function submitbuy(){
		$config['protocol'] = 'smtp';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['smtp_host'] = 'smtp.zoho.com';
		$config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
		$config['smtp_timeout'] = '7';
		$config['smtp_user'] = 'noreply@simplyauthentic.id';
		$config['smtp_pass'] = 'Simple-Tapi-t4k-simpels';
		//sendinblue
        // $config['smtp_host'] = 'smtp-relay.sendinblue.com';
        // $config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
        // $config['smtp_timeout'] = '7';
        // $config['smtp_user'] = 'admin@simplyauthentic.id';
        // $config['smtp_pass'] = '13rBws6z9I7WvtDq';
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['newline'] = "\r\n";
		$config['smtp_crypto'] = 'ssl';
		$this->load->library('email');
		if(empty($this->datamember)){
			redirect(base_url()."login");
		}else{
			$pesan = "";
			if(isset($_POST['buy'])){
				$ticket = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array( 'id_ticket' =>$_POST['xcode'])));
				if($_POST['qty']==2){
					if(count($ticket)==0){
						redirect(base_url()."ticket");
					}else{
						$go = "ya";
						if($_POST["nama"][0]==$_POST["nama"][1]){
							$pesan.= "Nama 1 tidak boleh sama dengan Nama 2<br>";
							$go = "tidak";
						}
						if($_POST["email"][0]==$_POST["email"][1]){
							$pesan.= "Email 1 tidak boleh sama dengan Email 2<br>";
							$go = "tidak";
						}
						if($_POST["hp"][0]==$_POST["hp"][1]){
							$pesan.= "No. Whatsapp 1 tidak boleh sama dengan No. Whatsapp 2<br>";
							$go = "tidak";
						}

					/*
					for($x=0; $x<$_POST['qty'];$x++){
						$detil['nama'] = $_POST["nama"][$x];
						$detil['email'] = $_POST["email"][$x];
						$detil['hp'] = $_POST["hp"][$x];
					}*/
					}
				}else{
					$go = "ya";
				}
				if($go=="tidak"){
					$pesan = rtrim($pesan, "<br>");
					$this->response = $this->session->flashdata('response');
					$this->session->set_flashdata('response', array('status' => 'error', 'message' => $pesan));
					redirect(base_url().'ticket/buy/'.$ticket['slug']);

				}else{
					$eo = $this->model_global->get_data(array('data' => 'row','table' => 'eo', 'where' => array( 'id_eo' =>$ticket['id_eo'])));

					$member = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array( 'id_member' =>$this->datamember['id'])));
					//$paymentmethod = $this->model_global->get_data(array('data' => 'row', 'table' => 'doku_payment_channel','where' => array('status' => 1,'code'=>$channel)));
					$judul = ucwords($ticket['judul']);
					$tanggal = namadatetime($ticket['tanggal'],FALSE);
					$di = ucwords($ticket['dimana']);

					$emailheader="";

					if(count($ticket)==0){
						redirect(base_url()."ticket");
					}else{
						$kode = $this->cekode();
						if($ticket['mode']=="0"){
							$ticket['harga']="7000";
						}

						$total = $ticket['harga'] * $_POST['qty'];
						$encode = "head-clm-".$this->datamember['id']."-clm-".$ticket['id_ticket']."-clm-".$total."-clm-".$kode;
						$code = $this->encrypt->encode($encode);
						$order['id_member'] = $this->datamember['id'];
						$order["created_date"] = date('Y-m-d H:i:s');
						$order['id_ticket'] = $_POST['xcode'];
						$order['code'] = $code;
						$order['qty'] = $_POST['qty'];
						$order['total'] = $total;
						$order['inv'] = $kode;
						$order['status'] = "1";
						$order['paid'] = "0";
						$order['AMOUNT'] = $total;
						$order['SESSIONID'] = $kode.rand();
						$order['PAYMENTDATETIME'] = date("YmdHis");
						//testing item,20000.00,2,10000.00
						$words = sha1($total.".00".$eo['mallid'].$eo['sharedkey'].$kode);
						$order['WORDS'] = $words;
						$order['trxstatus'] = "Requested";
						$order['BASKET'] = ucwords(str_replace("-"," ",$ticket["slug"])).",".$total.",1,".$total;
						$this->model_global->insert($order, 'order');
						$last = $this->db->insert_id();
						file_put_contents("uploads/qr/head-".$last.".png", file_get_contents(base_url()."ticket/genqr/".$encode."/320x320"));
						$emailheader="<div align='left'>Hi <b>".ucwords($member['fullname'])."</b>.<br>Pembelian tiket <b>$judul</b> di <b>$di</b> Tanggal <b>$tanggal</b> Telah <b>BERHASIL</b><br>";
						$emailheader.="Berikut data pembelian tiket : ";






						$detil['id_order'] = $last;
						for($x=0; $x<$_POST['qty'];$x++){
							$emaildetail="";
							$idx = $x + 1;
							$encoded = "item-clm-".$this->datamember['id']."-clm-".$ticket['id_ticket']."-clm-".$total."-clm-".$idx."-clm-".$kode;
							$coded = $this->encrypt->encode($encoded);
							$detil['code'] = $coded;
							$detil['nama'] = $_POST["nama"][$x];
							$detil['email'] = $_POST["email"][$x];
							$detil['hp'] = $_POST["hp"][$x];
							$detil['idx'] = $idx;
							file_put_contents("uploads/qr/item-".$detil['id_order']."-".$idx.".png", file_get_contents(base_url()."ticket/genqr/".$encoded."/320x320"));
							$siapa = ucwords($_POST['nama'][$x]);
							$text = "Pembayaran atas nama ".$siapa." telah Kami terima. Terimakasih telah melakukan pembelian tiket melalui SimplyAuthentic.ID *Jangan Hapus Pesan ini Gunakan QR Code untuk tiket masuk pada Event $judul $di $tanggal";

							$emailheader.= "<div align='left'>";
							$emailheader.= "<h3>Data $idx</h3>";
							$emailheader.= "<table>";
							$emailheader.= "<tr>";
							$emailheader.= "<td rowspan='3'><img src='".base_url()."uploads/qr/item-".$detil['id_order']."-".$idx.".png'></td>";
							$emailheader.= "<td width='100'>Nama</td>";
							$emailheader.= "<td width='10' align='center'>:</td>";
							$emailheader.= "<td><b>$detil[nama]</b></td>";
							$emailheader.= "</tr><tr><td>Email</td>";
							$emailheader.= "<td align='center'>:</td>";
							$emailheader.= "<td><b>$detil[email]</b></td>";
							$emailheader.= "</tr><tr><td>HP/WA</td>";
							$emailheader.= "<td align='center'>:</td>";
							$emailheader.= "<td><b>$detil[hp]</b></td>";
							$emailheader.= "</tr>";
							$emailheader.= "</table>";
							$emailheader.= "</div>";

							$emaildetail.="<div align='left'>Hi <b>".ucwords($detil['nama'])."</b>.<br>Pembayaran atas nama <b>".$siapa."</b> untuk pembelian tiket <b>$judul</b> di <b>$di</b> Tanggal <b>$tanggal</b>  telah Kami terima.<br>";
							$emaildetail.="Berikut data pembelian tiket :";
							$emaildetail.= "<div align='left'>";
							$emaildetail.= "<table>";
							$emaildetail.= "<tr>";
							$emaildetail.= "<td rowspan='3'><img src='".base_url()."uploads/qr/item-".$detil['id_order']."-".$idx.".png'></td>";
							$emaildetail.= "<td width='100'>Nama</td>";
							$emaildetail.= "<td width='10' align='center'>:</td>";
							$emaildetail.= "<td><b>$detil[nama]</b></td>";
							$emaildetail.= "</tr><tr><td>Email</td>";
							$emaildetail.= "<td align='center'>:</td>";
							$emaildetail.= "<td><b>$detil[email]</b></td>";
							$emaildetail.= "</tr><tr><td>HP/WA</td>";
							$emaildetail.= "<td align='center'>:</td>";
							$emaildetail.= "<td><b>$detil[hp]</b></td>";
							$emaildetail.= "</tr>";
							$emaildetail.= "</table>";
							$emaildetail.= "</div></div>";
							$emaildetail.= "Terimakasih telah melakukan pembelian tiket melalui <b><a href='".base_url()."'>SimplyAuthentic.ID</a></b> *Jangan Hapus Pesan ini Gunakan QR Code untuk tiket masuk pada Event <b>$judul $di $tanggal</b>";
							$emd['data'] = $emaildetail;
							$pesand = $this->load->view('front/email-template',$emd,TRUE);

							$this->email->initialize($config);
							$this->email->from("noreply@simplyauthentic.id", 'Simply Authentic');
							$this->email->to($member['email']);
							$this->email->subject('Simply Authentic : Pembelian Tiket '.$judul.' '.$tanggal.' '.$di);
							$this->email->message($pesand);
							//$this->email->send();

							$this->model_global->insert($detil, 'orderdetail');

							$my_apikey = "S2CMPIX23FKWSKM76S6Z";
							$number = "6281387588349";
							$destination = "62".$detil['hp'];
							$message = $text;
							$api_url = "http://panel.apiwha.com/send_message.php";
							$api_url .= "?apikey=". urlencode ($my_apikey);
							$api_url .= "&number=". urlencode ($destination);
							$api_url .= "&text=". urlencode ($message);

							$message = base_url()."uploads/qr/item-".$detil['id_order']."-".$idx.".png";
							//$my_result_object = json_decode(file_get_contents($api_url, false));
							$api_url2 = "http://panel.apiwha.com/send_message.php";
							$api_url2 .= "?apikey=". urlencode ($my_apikey);
							$api_url2 .= "&number=". urlencode ($destination);
							$api_url2 .= "&text=". urlencode ($message);
							//$my_result_object = json_decode(file_get_contents($api_url2, false));

						}
						$emailheader.="</div>Terimakasih telah melakukan pembelian tiket melalui <b><a href='".base_url()."'>SimplyAuthentic.ID</a></b>";
						$em['data'] = $emailheader;
						$pesan = $this->load->view('front/email-template',$em,TRUE);


						$this->email->initialize($config);
						$this->email->from("info@simplyauthentic.id", 'Simply Authentic');
						$this->email->to($member['email']);
						$this->email->subject('Simply Authentic : Pembelian Tiket '.$judul.' '.$tanggal.' '.$di);
						$this->email->message($pesan);
						//$this->email->send();

						//redirect(base_url()."ticket/success");
						redirect(base_url()."dpay/method/".$kode);
					}
				}
			}
		}
	}
	public function success(){
		$data['website'] = $this->website;
		$data['kategori'] = $this->kategori;
		$data['ticket'] = $this->ticket;
		$this->load->view('front/podcast/header',$data);
		$this->load->view('front/ticket-success',$data);

	}
	public function buy($slug){
		//echo $this->encrypt->decode("PaoVHxDnWo/c/0X+wBk798NBRZhhTI/g9oHwU1uLH4AyHy2/LhT/vl3+Nqt1jx0sbOSFx+KyeT0WvJS65xyK+g==");
		//echo "<hr>";
		//echo $this->encrypt->decode("8pf5qt0FRlZ2z4mH3XNmauJkDa4D9R7TcVX7FR6SsVNFzasAPNJkGIZSZJAYGd6ZZEu4Li9Os40qOb4dYqe8SXnY5Cc5AdHMbECfDKzjFjVua15vvS+fNeneKTJOHsFu");
		$my_apikey = "S2CMPIX23FKWSKM76S6Z";
		$number = "6281387588349";
		$destination = "6281283355710";
		$message = "[MESSAGE TO SEND]";
		$api_url = "http://panel.apiwha.com/send_message.php";
		$api_url .= "?apikey=". urlencode ($my_apikey);
		$api_url .= "&number=". urlencode ($destination);
		$api_url .= "&text=". urlencode ($message);
		//$my_result_object = json_decode(file_get_contents($api_url, false));
		//echo "<pre>";
		//print_r($my_result_object);
		//echo "</pre>";
		if(empty($this->datamember)){
			redirect(base_url()."login");
		}else{
			$data['website'] = $this->website;
			$data['kategori'] = $this->kategori;
			$data['ticket'] = $this->ticket;
			$data['ticketitem'] = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array( 'slug' =>$slug,'status'=>'1')));
			if(count($data['ticketitem'])==0){
				redirect(base_url()."ticket");
			}
			$data['subtitle'] = " | ".$data['ticketitem']['judul'];
			$data['website']['meta_description'] = $data['ticketitem']['judul'];
			$this->load->view('front/podcast/header',$data);
			if($data['ticketitem']['qty_online']<="0"){
				$this->load->view('front/ticket-habis',$data);
			}else{
				if($data['ticketitem']['urlbuyother']!=""){
					$this->load->view('front/ticket-habis',$data);
				}else{
					$this->load->view('front/ticket-buy',$data);
				}
			}
		}
	}
	public function genqr($code,$size){
		//$data = 'ClephH5mXADRiWeuBaJNFcmBIUp822AoKz1MTq4W1PgA0HeGu2a+xXPNgkL7lMTkvAaq3PtlDV1WZ6b9vl67qsxzC6etT3Gk4ebUsgXZ4Pf0GAl0DBEJGSU3GJpITCHoDUFQPj9fVKkR5IfJPGK5m4i0QxBnRqx3Po6+815wjoU=';
		$data = $this->encrypt->encode($code);
		//$size = '320x320';
		$logo = base_url().'assets/front/img/icon.png';
		header('Content-type: image/png');
		//$QR = imagecreatefrompng(base_url().'assets/front/img/qrlogo.png');
		$QR = imagecreatefrompng('http://chart.googleapis.com/chart?cht=qr&chld=L|1&chs='.$size.'&chl='.urlencode($data));
		if($logo !== FALSE){
			$logo = imagecreatefromstring(file_get_contents($logo));
			$QR_width = imagesx($QR);
			$QR_height = imagesy($QR);
			$logo_width = imagesx($logo);
			$logo_height = imagesy($logo);
			$logo_qr_width = $QR_width/4;
			$scale = $logo_width/$logo_qr_width;
			$logo_qr_height = $logo_height/$scale;
			imagecopyresampled($QR, $logo, $QR_width/2.65, $QR_height/2.65, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
		}
		imagepng($QR);
		imagedestroy($QR);
	}
	public function cekode(){
		$query = $this->db->query("SELECT CASE WHEN MAX(SUBSTRING(inv,-5)) IS NULL THEN 0 ELSE MAX(SUBSTRING(inv,-5)) END AS nilai FROM `order` where SUBSTRING(created_date,6,2)='".date('m')."'  LIMIT 1 OFFSET 0")->result_array();
		//print_r($query);
		//SN17PMXXXX
		$dapet =  $query[0]['nilai'];
		$last = $dapet + 1;
		$panjang = strlen($last *1 );
		$t = substr(date('Y'),2,2);
		$kode = $this->getKodeRand('18',$panjang, $last,"INV".date('Ymd')."SA");

		return $kode;
	}
	public function getKodeRand($lenght_max,$panjang, $laju_kode,$initial){
		$nol = $lenght_max - $panjang;
		$nol_lagi = str_repeat("0", $nol - strlen($initial));
		$kode = $initial . $nol_lagi . $laju_kode;
		return $kode;
	}

}