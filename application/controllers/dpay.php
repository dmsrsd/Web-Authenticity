<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dpay extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));
		$this->kategori = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status' => 1), 'order_by' => 'head_kategori asc'));

	}
	function url_get_contents ($Url) {
		if (!function_exists('curl_init')){
			die('CURL is not installed!');
		}
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $Url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}
	public function index(){
		$data['website'] = $this->website;
		$data['kategori'] = $this->kategori;
		$date = date("YmdH");
		redirect(base_url()."ticket");
		//echo date('MMddHHmmss');
		//echo sha1("150000.00"."11304934"."bZD2lbKxfkCW"."INV20190513SA00010");
		//echo $this->cekode();
		//echo "INV".$date."00001";
		//$data['slide'] = $this->model_global->get_data(array('select' => '*', 'table' => 'slide','where' => array('status' => 1,'kategori'=>'home'), 'order_by' => 'id_slide desc'));

		//$this->load->view('front/'.$data['website']['theme'].'/header',$data);
		//$this->load->view('front/'.$data['website']['theme'].'/home',$data);

		//if ($_SERVER['REMOTE_ADDR'] =='103.10.128.11') {
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/dpay',$data);
		//}
	}
	public function method($kode){
		$data['website'] = $this->website;
		$data['kategori'] = $this->kategori;
		$data['order'] = $this->model_global->get_data(array('data' => 'row','table' => 'order', 'where' => array( 'inv' =>$kode,'id_member'=>$this->datamember['id'])));
		if(isset($_GET['m'])){
			$ticket = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array( 'id_ticket' =>$data['order']['id_ticket'],'status'=>1)));
		}else{
			$ticket = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array( 'id_ticket' =>$data['order']['id_ticket'],'status'=>1,'btnbuy'=>1)));
		}
		$data['ticket'] = $ticket;
		$data['eo'] = $this->model_global->get_data(array('data' => 'row','table' => 'eo', 'where' => array( 'id_eo' =>$ticket['id_eo'])));

		$data['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array( 'id_member' =>$data['order']['id_member'])));
		$data['paymentmethod'] = $this->model_global->get_data(array('select' => '*', 'table' => 'doku_payment_channel','where' => array('status' => 1), 'order_by' => 'description asc'));
		if(count($data['order']) > 0 ){
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/dpay',$data);
		}else{
			redirect(base_url()."ticket");
		}

	}
	public function changechannel(){
		$kode = $_POST['kode'];
		$channel = $_POST['channel'];
		$data['website'] = $this->website;
		$data['order'] = $this->model_global->get_data(array('data' => 'row','table' => 'order', 'where' => array( 'inv' =>$kode,'id_member'=>$this->datamember['id'])));
		$ticket = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array( 'id_ticket' =>$data['order']['id_ticket'])));
		$eo = $this->model_global->get_data(array('data' => 'row','table' => 'eo', 'where' => array( 'id_eo' =>$ticket['id_eo'])));
		$data['paymentmethod'] = $this->model_global->get_data(array('data' => 'row', 'table' => 'doku_payment_channel','where' => array('status' => 1,'code'=>$channel)));
		$ret['status'] = 'false';
		$ret['message'] = '';
		$ret['total'] = '0';
		$ret['dokam'] = '0';
		$ret['WORDS'] = $data['order']['WORDS'];
		if(count($data['order']) > 0 ){
			$data['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array( 'id_member' =>$data['order']['id_member'])));
			if(count($data['paymentmethod']) > 0 ){
				$ammount = ($ticket['harga']*$data['order']['qty']) + $data['paymentmethod']['biaya'];
				$ret['status'] = 'true';
				$ret['message'] = '';
				$up["biaya"] = $data['paymentmethod']['biaya'];
				$up["AMOUNT"] = $ammount;
				$up["total"] = $ticket['harga']*$data['order']['qty'];
				$up["PAYMENTCHANNEL"] = $channel;
				$ret['total'] = number_format($ammount);
				$ret['dokam'] = $ammount;
				$words = sha1($ammount.".00".$eo['mallid'].$eo['sharedkey'].$kode);
				$up['WORDS'] = $words;
				$ret['WORDS'] = $words;
				$ret['prev'] = $ammount.".00".$eo['mallid'].$eo['sharedkey'].$kode;
				$up['BASKET'] = ucwords(str_replace("-"," ",$ticket["slug"])).",".$ammount.",1,".$ammount;
				$ret['BASKET'] = $up['BASKET'];

				if($channel=="35"){ // alfa
					$exp = date('Y-m-d H:i:s', strtotime("+20 minutes"));
				}else{ // VA
					$exp = date('Y-m-d H:i:s', strtotime("+20 minutes"));
				}
				$now = date('Y-m-d H:i:s');
				$up["expired_pay"] = $exp;
				$up["request_pay"] = $now;
				$up["expired_status"] = "0";
				$up['PAYMENTDATETIME'] = date("YmdHis");
				$this->model_global->update($up, 'order', array('inv' => $kode));
			}else{
				$ret['status'] = 'false';
				$ret['message'] = 'Failed retrieve payment method';

			}
		}else{
			$ret['status'] = 'false';
			$ret['message'] = 'Failed retrieve INVOICE data';
		}
		echo json_encode($ret);

	}
	public function identify(){
		//if ($_SERVER['REMOTE_ADDR'] =='103.10.129.16') {
			echo "Continue";
		//}
	}
	public function verify(){
		//if ($_SERVER['REMOTE_ADDR'] =='103.10.129.16') {
			echo "Continue";
		//}
	}
	public function checkstatus(){
		$inv = $_POST['TRANSIDMERCHANT'];
		$data['website'] = $this->website;
		$data['order'] = $this->model_global->get_data(array('data' => 'row','table' => 'order', 'where' => array( 'inv' =>$inv,'id_member'=>$this->datamember['id'])));
		$ret['status'] = "false";
		$ret['message'] = "";
		if(count($data['order']) > 0 ){
			/*$wordcek = sha1($this->website['malid'].$this->website['sharedkey'].$inv);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "http://staging.doku.com/Suite/CheckStatus");
			curl_setopt($ch, CURLOPT_POSTFIELDS,
						"MALLID=".$this->website['malid']."&CHAINMERCHANT=NA&TRANSIDMERCHANT=".$inv."&SESSIONID=".$data['order']['SESSIONID']."&WORDS=".$wordcek."&CURRENCY=IDR");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
			$output = curl_exec($ch);
			curl_close($ch);
			print_r($output);*/
			$ret['status'] = "true";

		}else{
			$ret['status'] = "false";
			$ret['message'] = "Data tidak ditemukan";
		}
		echo json_encode($ret);

	}
	public function balikin(){
		$ord = $this->model_global->get_data(array('select' => '*','table' => 'order', 'where' => array( 'paid !=' =>"1")));
		foreach($ord as $data){
			$ticket = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array( 'id_ticket' =>$data['id_ticket'])));
			if($data['expired_pay'] < date("Y-m-d H:i:s")){
				if($data['expired_status']=="0"){
					$up["expired_status"]="1";
					//$this->model_global->update($up, 'order', array('id_order' => $data['id_order']));
					$upt['qty_online'] = $ticket['qty_online'] + $data['qty'];
					echo $upt['qty_online']."<br>";
					//$this->model_global->update($upt, 'ticket', array('id_ticket' => $ticket['id_ticket']));
				}
			}
		}

	}
	public function status($inv){
		$data['website'] = $this->website;
		$data['order'] = $this->model_global->get_data(array('data' => 'row','table' => 'order', 'where' => array( 'inv' =>$inv,'id_member'=>$this->datamember['id'])));
		if(count($data['order']) > 0 ){
			if($data['order']['paid']=="0"){
				redirect(base_url()."dpay/method/".$data['order']['inv']);
			}else{
				$ticket = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array( 'id_ticket' =>$data['order']['id_ticket'])));
				$eo = $this->model_global->get_data(array('data' => 'row','table' => 'eo', 'where' => array( 'id_eo' =>$ticket['id_eo'])));
				$data['eo'] = $eo;

				$wordcek = sha1($eo['mallid'].$eo['sharedkey'].$inv);
//				echo "MALLID=".$this->website['malid']."&CHAINMERCHANT=NA&TRANSIDMERCHANT=".$inv."&SESSIONID=".$data['order']['SESSIONID']."&WORDS=".$data['order']['WORDS']."&CURRENCY=IDR";
				/*
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "http://staging.doku.com/Suite/CheckStatus");
				curl_setopt($ch, CURLOPT_POSTFIELDS,
							"MALLID=".$this->website['malid']."&CHAINMERCHANT=NA&TRANSIDMERCHANT=".$inv."&SESSIONID=".$data['order']['SESSIONID']."&WORDS=".$wordcek."&CURRENCY=IDR");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
				$output = curl_exec($ch);
				curl_close($ch);
				print_r($output);*/

				if($data['order']['PAYMENTCHANNEL']==""){
					redirect(base_url()."dpay/method/".$data['order']['inv']);
				}else{
					if($data['order']['expired_pay'] < date("Y-m-d H:i:s")){
						if($data['order']['expired_status']!="1"){
							$up["expired_status"]="1";
							$this->model_global->update($up, 'order', array('id_order' => $data['order']['id_order']));
							$upt['qty_online'] = $ticket['qty_online'] + $data['order']['qty'];
							$this->model_global->update($upt, 'ticket', array('id_ticket' => $ticket['id_ticket']));
						}
					}
					$data['ticket'] = $ticket;
					$this->load->view('front/podcast/header',$data);
					$this->load->view('front/dpay-status',$data);
				}
			}
		}else{
			redirect(base_url()."ticket");
		}

	}
	public function result(){
		//if ($_SERVER['REMOTE_ADDR'] =='103.10.129.16') {
			if(isset($_POST['inv'])){
				$up["STATUSCODE"] = $_POST['STATUSCODE'];
				$up["PAYMENTCHANNEL"] = $_POST['PAYMENTCHANNEL'];
				$up["PAYMENTCODE"] = $_POST['PAYMENTCODE'];
				$order = $this->model_global->get_data(array('data' => 'row','table' => 'order', 'where' => array( 'inv' =>$_POST['inv'])));
				$ticket = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array( 'id_ticket' =>$order['id_ticket'])));
				$member = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array( 'id_member' =>$order['id_member'])));
				$upqty = "false";
				if($_POST['STATUSCODE']=="0000"){
					$up["paid"] = "1";
					$upqty = "true";
				}else{
					if($_POST['PAYMENTCHANNEL']==""){
						$up["paid"] = "0";
					}else{
						$up["paid"] = "2";
						$upqty = "true";

						if($_POST['PAYMENTCHANNEL']=="35"){ // alfa
							$exp = date('Y-m-d H:i:s', strtotime("+20 minutes"));
						}else{ // VA
							$exp = date('Y-m-d H:i:s', strtotime("+20 minutes"));
						}
						$now = date('Y-m-d H:i:s');
						$up["expired_pay"] = $exp;
						$up["request_pay"] = $now;
						$up["expired_status"] = "0";

						$bank = $this->model_global->get_data(array('data' => 'row','table' => 'doku_payment_channel', 'where' => array( 'code' =>$order['PAYMENTCHANNEL'])));
						$emd['data'] = "<div  align='left'><h3><i class='fa fa-shopping-cart'></i> Silahkan Untuk Melakukan Pembayaran</h3></div>";
						$emd['data'].= "<table width='100%'>";
						$emd['data'].= "<tr><th width='200' align='left'>Pembelian </th><td width='10' align='center'>:</td><td><b>$ticket[judul]</b></td></tr>";
						$emd['data'].= "<tr><th align='left'>No. Tagihan </th><td width='10' align='center'>:</td><td>$order[inv]</td></tr>";
						$emd['data'].= "<tr><th align='left'>Pembayaran </th><td width='10' align='center'>:</td><td>$bank[description]</td></tr>";
						$emd['data'].= "<tr><th align='left'>Code Pembayaran / No. VA</th><td width='10' align='center'>:</td><td>$_POST[PAYMENTCODE] </td></tr>";
						$emd['data'].= "<tr><th align='left'>Total Pembayaran</th><td width='10' align='center'>:</td><td>Rp. ".number_format($order['AMOUNT'])." </td></tr>";
						$emd['data'].= "<tr><th align='left'>Batas Pembayaran</th><td width='10' align='center'>:</td><td>".namadatetime($exp)." </td></tr>";
						$emd['data'].= "<tr><th align='left' colspan='3'>Cara Pembayaran</th></tr>";
						$emd['data'].= "<tr><td colspan='3'>$bank[petunjuk] </td></tr>";
						$emd['data'].= "</table>";
						$pesand = $this->load->view('front/email-template',$emd,TRUE);
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
						$this->email->initialize($config);
						$this->email->from("noreply@simplyauthentic.id", 'Simply Authentic');
						$this->email->to($member['email']);
						$this->email->subject('Simply Authentic : Silahkan Untuk Melakukan Pembayaran '.$order['inv']);
						$this->email->message($pesand);
						@$se = $this->email->send();
						if(!$se){
							$log["type"] = "ticket";
							$log["email"] = $member['email'];
							$log["id_member"] = $member['id_member'];
							$log["created_date"] = date('Y-m-d H:i:s');
							//$log["log"] = $cek[0]." message: ".$cek[1];
							$this->model_global->insert($log, 'log');
						}
						//sleep(2);
					}
				}
				$this->model_global->update($up, 'order', array('inv' => $_POST['inv']));
				if($upqty == "true"){

					$upt['qty_online'] = $ticket['qty_online'] - $order['qty'];
					$this->model_global->update($upt, 'ticket', array('id_ticket' => $ticket['id_ticket']));
				}
				redirect(base_url()."dpay/status/".$_POST['inv']);
			}
		//}
	}
	public function notify(){  // back to merchant / bayar / feedback api
		$no['desc'] = "akses";
		//$this->model_global->insert($no, 'notify');
		//if ($_SERVER['REMOTE_ADDR'] =='103.10.129.16') {
			if($_POST['TRANSIDMERCHANT']) {
				$order_number = $_POST['TRANSIDMERCHANT'];
			}else{
				$order_number = 0;
			}
			$totalamount = $_POST['AMOUNT'];
			$words    = $_POST['WORDS'];
			$statustype = $_POST['STATUSTYPE'];
			$response_code = $_POST['RESPONSECODE'];
			$approvalcode   = $_POST['APPROVALCODE'];
			$status         = $_POST['RESULTMSG'];
			$paymentchannel = $_POST['PAYMENTCHANNEL'];
			$paymentcode = $_POST['PAYMENTCODE'];
			$session_id = $_POST['SESSIONID'];
			$bank_issuer = $_POST['BANK'];
			$cardnumber = $_POST['MCN'];
			$payment_date_time = $_POST['PAYMENTDATETIME'];
			$verifyid = $_POST['VERIFYID'];
			$verifyscore = $_POST['VERIFYSCORE'];
			$verifystatus = $_POST['VERIFYSTATUS'];
			$order = $this->model_global->get_data(array('data' => 'row','table' => 'order', 'where' => array( 'inv' =>$order_number,'trxstatus'=>'Requested')));
			if(count($order) > 0 ){
				$hasil = $order['inv'];
				$amount = $order['AMOUNT'];
			}else{
				$hasil = "";
				$amount = "";
			}
			if($hasil == ""){
				$no2['desc'] = "kosong -".$_POST['TRANSIDMERCHANT'];
				$no2["tanggal"] = date('Y-m-d H:i:s');
				//$this->model_global->insert($no2, 'notify');
				echo "Stop1";
			}else{
				if ($status=="SUCCESS"){
					$no3['desc'] = "sukses -".$_POST['TRANSIDMERCHANT'];
					$no3["tanggal"] = date('Y-m-d H:i:s');
					$this->model_global->insert($no3, 'notify');
					//$sql = "UPDATE doku SET trxstatus='Success', words='$words', statustype='$statustype', response_code='$response_code', approvalcode='$approvalcode',
					//trxstatus='$status', payment_channel='$paymentchannel', paymentcode='$paymentcode', session_id='$session_id', bank_issuer='$bank_issuer', creditcard='$cardnumber',
					//payment_date_time='$payment_date_time', verifyid='$verifyid', verifyscore='$verifyscore', verifystatus='$verifystatus' where transidmerchant='$order_number'";

					if($order['PAYMENTCODE']==""){
						$ticket = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array( 'id_ticket' =>$order['id_ticket'])));
						$upt['qty_online'] = $ticket['qty_online'] - $order['qty'];
						$this->model_global->update($upt, 'ticket', array('id_ticket' => $ticket['id_ticket']));
					}

					$up["trxstatus"] = "SUCCESS";
					$up["paid"] = "1";
					$up["RESULTMSG"] = $status;
					$up["STATUSTYPE"] = $statustype;
					$up["STATUSCODE"] = $response_code;
					$up["RESPONSECODE"] = $response_code;
					$up["APPROVALCODE"] = $approvalcode;
					$up["PAYMENTCODE"] = $paymentcode;
					$up["BANK"] = $bank_issuer;
					$up["VERIFYID"] = $verifyid;
					$up["VERIFYSCORE"] = $verifyscore;
					$up["VERIFYSTATUS"] = $verifystatus;
					$up["PAYMENTCHANNEL"] = $paymentchannel;
					$up["paid_date"] = date('Y-m-d H:i:s');
					$this->model_global->update($up, 'order', array('inv' => $order_number));

					$lastorder = $this->model_global->get_data(array('data' => 'row','table' => 'order', 'where' => array( 'inv' =>$order_number,'id_member'=>$order['id_member'])));
					$point['id_member'] = $order['id_member'];
					$point['id_jenis_point'] = "4";
					$point['id_resource'] = $lastorder['id_order'];
					$point["created_date"] = date('Y-m-d H:i:s');

					$j = $this->db->query("select count(id_point) as total from point where id_resource in(
											select a.id_order from `order` a
											left join ticket b on b.id_ticket = a.id_ticket
											where a.id_ticket='".$order['id_ticket']."' and a.id_member='".$order['id_member']."')
											and  id_member='".$order['id_member']."' and id_jenis_point='4'")->result_array();
					$total =  $j[0]['total'];
					if($total > 0){

					}else{
						$this->model_global->insert($point, 'point');
					}


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
					$ticket = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array( 'id_ticket' =>$order['id_ticket'])));
					$member = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array( 'id_member' =>$order['id_member'])));
					$judul = ucwords($ticket['judul']);
					$tanggal = namadatetime($ticket['tanggal'],FALSE);
					$di = ucwords($ticket['dimana']);

					$emailheader="";
					$emailheader ="<div align='left'>Hi <b>".ucwords($member['fullname'])."</b>.<br>Pembelian tiket <b>$judul</b> di <b>$di</b> Tanggal <b>$tanggal</b> Telah <b>BERHASIL</b><br>";
					$emailheader.="Berikut data pembelian tiket : ";
					$det = $this->model_global->get_data(array('select' => '*', 'table' => 'orderdetail','where' => array('id_order' => $order['id_order'])));
					if(isset($det) && count($det) > 0){ foreach($det as $detil){
						$emaildetail="";
						$idx = $detil['idx'];
						$siapa = ucwords($detil['nama']);
						$text = "Pembayaran atas nama ".$siapa." telah Kami terima. Terimakasih telah melakukan pembelian tiket melalui SimplyAuthentic.ID *Jangan Hapus Pesan ini Gunakan QR Code untuk tiket masuk pada Event $judul $di $tanggal";
						$emailheader.= "<div align='left'>";
						$emailheader.= "<h3>Data $detil[idx]</h3>";
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
						$emaildetail.= "Terimakasih telah melakukan pembelian tiket melalui <b><a href='".base_url()."'>SimplyAuthentic.ID</a></b><br>*Jangan Hapus Pesan ini Gunakan QR Code untuk tiket masuk pada Event <b>$judul $di $tanggal</b>";
						$emd['data'] = $emaildetail;
						$pesand = $this->load->view('front/email-template',$emd,TRUE);

						$this->email->initialize($config);
						$this->email->from("noreply@simplyauthentic.id", 'Simply Authentic');
						$this->email->to($detil['email']);
						$this->email->subject('Simply Authentic : Pembelian Tiket '.$judul.' '.$tanggal.' '.$di);
						$this->email->message($pesand);
						/*@$se = $this->email->send();
						if(!$se){
							$log["type"] = "pay-item";
							$log["email"] = $detil['email'];
							$log["id_member"] = $member['id_member'];
							$log["id_resource"] = $detil['id_orderdetail'];
							$log["created_date"] = date('Y-m-d H:i:s');
							$this->model_global->insert($log, 'log');
						}*/
						sleep(2);
						$my_apikey = "S2CMPIX23FKWSKM76S6Z";
						$number = "6281387588349";
						$destination = "62".trim($detil['hp']);
						$message = $text;
						$api_url = "http://panel.capiwha.com/send_message.php";
						$api_url .= "?apikey=". urlencode ($my_apikey);
						$api_url .= "&number=". urlencode ($destination);
						$api_url .= "&text=". urlencode ($message);
						//@$my_result_object = json_decode(file_get_contents($api_url, false));
						@$my_result_object = json_decode($this->url_get_contents($api_url));
						if(!$my_result_object){
							$logwa["type"] = "wa";
							$logwa["email"] = $detil["email"];
							$logwa["id_member"] = $member['id_member'];
							$logwa["id_resource"] = $detil['id_orderdetail'];
							$logwa["created_date"] = date('Y-m-d H:i:s');
							$logwa["log"] = $detil['hp']."-clm-".$message;
							$this->model_global->insert($log, 'log');
						}
						//sleep(1);

						$message = base_url()."uploads/qr/item-".$detil['id_order']."-".$idx.".png";
						$api_url2 = "http://panel.capiwha.com/send_message.php";
						$api_url2 .= "?apikey=". urlencode ($my_apikey);
						$api_url2 .= "&number=". urlencode ($destination);
						$api_url2 .= "&text=". urlencode ($message);
						//@$my_result_object = json_decode(file_get_contents($api_url2, false));
						@$my_result_object = json_decode($this->url_get_contents($api_url2));
						if(!$my_result_object){
							$logwa["type"] = "wa";
							$logwa["email"] = $detil["email"];
							$logwa["id_member"] = $member['id_member'];
							$logwa["id_resource"] = $detil['id_orderdetail'];
							$logwa["created_date"] = date('Y-m-d H:i:s');
							$logwa["log"] = $detil['hp']."-clm-".$message;
							$this->model_global->insert($log, 'log');
						}
						//sleep(1);
					}}
					$emailheader.="</div>Terimakasih telah melakukan pembelian tiket melalui <b><a href='".base_url()."'>SimplyAuthentic.ID</a></b>";
					$em['data'] = $emailheader;
					$pesan = $this->load->view('front/email-template',$em,TRUE);


					$this->email->initialize($config);
					$this->email->from("noreply@simplyauthentic.id", 'Simply Authentic');
					$this->email->to($member['email']);
					$this->email->subject('Simply Authentic : Pembelian Tiket '.$judul.' '.$tanggal.' '.$di);
					$this->email->message($pesan);
					@$se = $this->email->send();
					if(!$se){
						$log["type"] = "pay-head";
						$log["email"] = $member['email'];
						$log["id_member"] = $member['id_member'];
						$log["id_resource"] = $order['id_order'];
						$log["created_date"] = date('Y-m-d H:i:s');
						//$log["log"] = $cek[0]." message: ".$cek[1];
						$this->model_global->insert($log, 'log');
					}

					sleep(2);

				}else{
					$no4['desc'] = "failed -".$_POST['TRANSIDMERCHANT'];
					$no4["tanggal"] = date('Y-m-d H:i:s');
					$this->model_global->insert($no4, 'notify');
					$up["paid"] = "0";
					$up["trxstatus"] = "FAILED";
					$this->model_global->update($up, 'order', array('inv' => $order_number));

				}
				echo 'Continue';
			}

		//}
	}
	public function redirect(){
		$data['website'] = $this->website;
		$data['kategori'] = $this->kategori;
		$this->load->view('front/podcast/header',$data);
		$this->load->view('front/dpay-redirect',$data);
	}
	public function webhook(){
		$data = json_decode($_POST["data"]);

		if ($data->event=="INBOX")
		{
		  $my_answer = "This is an autoreply!. You (". $data->from .") wrote: ". $data->text;

		  if(!(strpos(strtoupper($data->text), "QR")===false)){
			$my_answer = $data->from. " Bentar dikirim qr nya";

		  }

		  $response = new StdClass();
		  $response->autoreply = $my_answer;

		  echo json_encode($response);

		}elseif ($data->event=="MESSAGEPROCESSED") {


		}elseif ($data->event=="MESSAGEFAILED") {


		}
	}
	public function testwa($ke){
		$message = $_GET['p'];
		$my_apikey = "S2CMPIX23FKWSKM76S6Z";
		$number = "6281387588349";
		$destination = "62".$ke;
		$api_url = "http://panel.capiwha.com/send_message.php";
		$api_url .= "?apikey=". urlencode ($my_apikey);
		$api_url .= "&number=". urlencode ($destination);
		$api_url .= "&text=". urlencode ($message);
		//@$my_result_object = json_decode(file_get_contents($api_url, false));
		@$my_result_object = json_decode($this->url_get_contents($api_url));
		if(!$my_result_object){
			echo "aseuh";
		}else{
			print_r($my_result_object);
		}
	}
	public function cancel(){
		if ($_SERVER['REMOTE_ADDR'] =='103.10.129.16') {
			echo "Continue";
		}
	}
	public function qrpay(){
		$encoded = "item-clm-2-clm-20-clm-10000-clm-1-clm-INV20190906SA00026";
		echo $this->encrypt->encode($encoded);
		echo "<br>";
		echo base_url()."ticket/genqr/".$encoded."/320x320";
	}
}