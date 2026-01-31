<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class Mpay extends MY_Controller { 
	function __construct() {
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->library('session');  
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));
		$this->kategori = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status' => 1), 'order_by' => 'head_kategori asc'));
		
        $params = array('server_key' => $this->website['mpaysec'], 'production' => true);
		$this->load->library('midtrans');
		$this->midtrans->config($params);		
		$this->load->library('veritrans');
		$this->veritrans->config($params);		
	}
	public function index(){ 
		redirect(base_url());	
	}
 
    public function token(){
		if(isset($_POST['slug'])){
			$slug = strip_tags($_POST['slug']);
			$data = $this->model_global->get_data(array('data' => 'row','table' => 'darbotz', 'where' => array( 'slug' =>$slug,'status' =>1)));
			$coltags = "";
			if(count($data)==0){
				echo "";
			}else{
				if(empty($this->datamember)){
					echo "";
				}else{
					$mem = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array( 'id_member' =>$this->datamember['id'])));
					$kota = $this->model_global->get_data(array('data' => 'row','table' => 'kota', 'where' => array( 'id_kota' =>$_POST['id_kota'])));
					$kotam = $this->model_global->get_data(array('data' => 'row','table' => 'kota', 'where' => array( 'id_kota' =>$mem['id_kota'])));
					if(count($kotam)==0){
						$kotam = $kota;
					}
					$kode = $this->cekode();
					$order['id_member'] = $this->datamember['id'];
					$order["created_date"] = date('Y-m-d H:i:s');
					$order['first_name'] = $_POST['first_name'];
					$order['last_name'] = $_POST['last_name'];
					$order['hp'] = $_POST['hp'];
					$order['id_kota'] = $_POST['id_kota'];
					$order['alamat'] = $_POST['alamat'];
					$order['kode_pos'] = $_POST['kode_pos'];
					$order['id_darbotz'] = $data['id_darbotz'];
					$order['darbotz_name'] = $data['nama'];
					$order['qty'] = 1;
					$order['harga'] = $data['harga'];
					$order['total'] = $data['harga'];
					$order['inv'] = $kode;
					$order['status'] = "";
					
	 
						// Required
					$transaction_details = array(
					  'order_id' => rand(),
					  'gross_amount' => $data['harga'], // no decimal allowed for creditcard
					);

					$item = array(
						'id' => "DRB".$data['id_darbotz'],
						'price' => $data['harga'],
						'quantity' => 1,
						'name' => $data['nama']
					);
					$item_details = array ($item);

					// Optional
					$billing_address = array(
					  'first_name'    => $mem['fullname'],
					  'last_name'     => "",
					  'address'       => $mem['address'],
					  'city'          => $kotam['provinsi'].", ".$kotam['kota'],
					  'postal_code'   => "",
					  'phone'         => $mem['hp'],
					  'country_code'  => 'IDN'
					);

					// Optional
					$shipping_address = array(
					  'first_name'    => $_POST['first_name'],
					  'last_name'     => $_POST['last_name'],
					  'address'       => $_POST['alamat'],
					  'city'          => $kota['provinsi'].", ".$kota['kota'],
					  'postal_code'   => $_POST['kode_pos'],
					  'phone'         => $_POST['hp'],
					  'country_code'  => 'IDN'
					);

					// Optional
					$customer_details = array(
					  'first_name'    => $_POST['first_name'],
					  'last_name'     => $_POST['last_name'],
					  'email'         => $mem['email'],
					  'phone'         => $_POST['hp'],
					  'billing_address'  => $billing_address,
					  'shipping_address' => $shipping_address
					);

					// Data yang akan dikirim untuk request redirect_url.
					$credit_card['secure'] = true;
					//ser save_card true to enable oneclick or 2click
					//$credit_card['save_card'] = true;

					$time = time();
					$custom_expiry = array(
						'start_time' => date("Y-m-d H:i:s O",$time),
						'unit' => 'minute', 
						'duration'  => 60
					);
					
					$transaction_data = array(
						'transaction_details'=> $transaction_details,
						'item_details'       => $item_details,
						'customer_details'   => $customer_details,
						'credit_card'        => $credit_card,
						'expiry'             => $custom_expiry
					);
 
					
					$order['status'] = 0;
					if($_POST['result_type']!=""){
						$order['result_type'] = $_POST['result_type'];
						/*if($_POST['result_type']=="success"){
							$order['pay_date'] = date('Y-m-d H:i:s');
						}*/
						$result = json_decode($_POST['result_data']);
						if($result){
							$notif = $this->veritrans->status($result->order_id);
							$order['result_data'] = json_encode($notif);
							$order['mtransaction_id'] = $notif->transaction_id;
							$order['mtransaction_time'] = $notif->transaction_time;
							$order['mtransaction_status'] = $notif->transaction_status;
							$order['mstatus_message'] = $notif->status_message;
							$order['mstatus_code'] = $notif->status_code;
							$order['mpayment_type'] = $notif->payment_type;
							$order['morder_id'] = $notif->order_id;
							$order['mpdf'] = $result->pdf_url;
							file_put_contents("uploads/invoice/".$order['inv'].".pdf", file_get_contents($result->pdf_url)); 
							switch($notif->transaction_status){
								case "settlement":$order['status']=1;break;
								case "pending":$order['status']=2;break;
								case "deny":$order['status']=3;break;
								case "expire":$order['status']=4;break;
								default:$order['status']=0;break;
							} 						
							$this->model_global->insert($order, 'darbotzorder`');
							$last = $this->db->insert_id();
							$this->status($notif->order_id,"");
						}else{
							$this->model_global->insert($order, 'darbotzorder`');
							$last = $this->db->insert_id();
							
						}
						
					}else{
						$snapToken = $this->midtrans->getSnapToken($transaction_data);
						//error_log($snapToken);
						echo $snapToken; 
					}
				}
			}
		}
    }


    public function finish(){
    	$result = json_decode($this->input->post('response'));
    	echo 'RESULT <br><pre>';
    	print_r($result);
    	echo '</pre>' ;
	}
	
    public function unfinish(){
    	echo "unfinish" ;

    } 
    
	public function error(){
    	echo "error" ;

    } 
	
	public function notification(){ 
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result);

		if($result){
			$this->status($result->order_id,"");
			//$notif = $this->veritrans->status($result->order_id);
		}
	}	
	
	public function status($oid,$page){ 
		if($page!=""){
			if($oid==""){
				redirect(base_url());
			}
		}
		$notif = $this->veritrans->status($oid); 
		$transaction = $notif->transaction_status;
		$type = $notif->payment_type;
		$order_id = $notif->order_id;
		$fraud = $notif->fraud_status;
		
		$txtemail = "";
		
		if ($transaction == 'capture') { 
		  if ($type == 'credit_card'){
		    if($fraud == 'challenge'){ 
		      $txtemail =  "Transaction order_id: " . $order_id ." is challenged by FDS";
		      } 
		      else { 
		      $txtemail =  "Transaction order_id: " . $order_id ." successfully captured using " . $type;
		      }
		    }
		  }
		else if ($transaction == 'settlement'){
			$txtemail =  "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
		}else if($transaction == 'pending'){
			$txtemail =  "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
		}else if ($transaction == 'deny') {
			$txtemail =  "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
		}else if ($transaction == 'expire') {
			$txtemail =  "Payment using " . $type . " for transaction order_id: " . $order_id . " is expire.";
		}
		
		$order = $this->model_global->get_data(array('data' => 'row','table' => 'darbotzorder', 'where' => array( 'morder_id' =>$order_id)));
		if(count($order)>0){
			$member = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array( 'id_member' =>$order['id_member'])));
			$darbotz = $this->model_global->get_data(array('data' => 'row','table' => 'darbotz', 'where' => array( 'id_darbotz' =>$order['id_darbotz'])));
			if($transaction=="settlement" || $transaction=="pending" ){
				if($transaction=="pending"){
					$emd['data'] = "<div  align='left'><h3><i class='fa fa-shopping-cart'></i> Silahkan Untuk Melakukan Pembayaran</h3></div>";
					$emd['data'].= "<table width='100%'>";
					$emd['data'].= "<tr><th width='200' align='left'>Pembelian </th><td width='10' align='center'>:</td><td><b>$darbotz[nama]</b></td></tr>";
					$emd['data'].= "<tr><th align='left'>No. Tagihan </th><td width='10' align='center'>:</td><td>$order[inv]</td></tr>";
					$emd['data'].= "<tr><th align='left'>Pembayaran </th><td width='10' align='center'>:</td><td>$order[mpayment_type]</td></tr>";
					//$emd['data'].= "<tr><th align='left'>Code Pembayaran / No. VA</th><td width='10' align='center'>:</td><td>$_POST[PAYMENTCODE] </td></tr>";
					$emd['data'].= "<tr><th align='left'>Total Pembayaran</th><td width='10' align='center'>:</td><td>Rp. ".number_format($order['total'])." </td></tr>";
					//$emd['data'].= "<tr><th align='left'>Batas Pembayaran</th><td width='10' align='center'>:</td><td>".namadatetime($exp)." </td></tr>";
					//$emd['data'].= "<tr><th align='left' colspan='3'>Cara Pembayaran</th></tr>";
					//$emd['data'].= "<tr><td colspan='3'>$bank[petunjuk] </td></tr>";
					$emd['data'].= "</table>";
				}else if($transaction=="settlement"){
					$emd['data'] = "";
					$emd['data'].="<div align='left'>Hi <b>".ucwords($member['fullname'])."</b>.<br>Pembelian Darbotz <b>$darbotz[nama]</b> Telah <b>BERHASIL</b><br>";
					$emd['data'].= "<table width='100%'>";
					$emd['data'].= "<tr><th width='200' align='left'>Pembelian </th><td width='10' align='center'>:</td><td><b>$darbotz[nama]</b></td></tr>";
					$emd['data'].= "<tr><th align='left'>No. Tagihan </th><td width='10' align='center'>:</td><td>$order[inv]</td></tr>";
					$emd['data'].= "<tr><th align='left'>Pembayaran </th><td width='10' align='center'>:</td><td>$order[mpayment_type]</td></tr>";
					$emd['data'].= "<tr><th align='left'>Total Pembayaran</th><td width='10' align='center'>:</td><td>Rp. ".number_format($order['total'])." </td></tr>";
					$emd['data'].= "</table>";

				}
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
				$this->email->from("noreply@simplyauthentic.id", 'Authenticity'); 
				$this->email->to($member['email']);
				$this->email->subject('Authenticity : Notification Darbotz '.$order['inv']);
				$this->email->message($pesand);
				if($transaction=="pending"){
					$this->email->attach("uploads/invoice/".$order['inv'].".pdf");
				}
				//jika belum terima email 
				if($page==""){
					@$se = $this->email->send();
				}
				sleep(3);
				
				if($transaction=="settlement"){
					if($order['pay_date']==""){
						if(!$se){
							$log["type"] = "darbotz";
							$log["email"] = $member['email'];
							$log["id_member"] = $member['id_member'];
							$log["created_date"] = date('Y-m-d H:i:s'); 
							$this->model_global->insert($log, 'log');
						}
						
						//jika belum dapat point
						$sudah = $this->model_global->get_data(array('data' => 'row','table' => 'point', 'where' => array( 'id_member' =>$order['id_member'],"id_jenis_point"=>'29',"id_resource"=>$order['id_darbotzorder'])));
						//if(count($sudah)>0){
						//}else{
							$point['id_member'] = $order['id_member'];
							$point['id_jenis_point'] = "29";
							$point['id_resource'] = $order['id_darbotzorder'];
							$point["created_date"] = date('Y-m-d H:i:s');
							$this->model_global->insert($point, 'point');
						//}
					}
					//update qty
					$upt['qty'] = $darbotz['qty'] - 1;
					$this->model_global->update($upt, 'darbotz', array('id_darbotz' => $darbotz['id_darbotz']));					
					
				}
			}
			$orderup['mtransaction_id'] = $notif->transaction_id;
			$orderup['mtransaction_time'] = $notif->transaction_time;
			$orderup['mtransaction_status'] = $notif->transaction_status;
			$orderup['mstatus_message'] = $notif->status_message;
			$orderup['mstatus_code'] = $notif->status_code;
			$orderup['mpayment_type'] = $notif->payment_type;
			$orderup['morder_id'] = $notif->order_id;		
			$orderup['result_data'] = json_encode($notif);
			$orderup['result_type'] = $notif->transaction_status;
			switch($notif->transaction_status){
				case "settlement":
					if($order['status']!=1){
						$orderup['status']=1;
						$orderup['pay_date'] = $notif->settlement_time;
					}
				break;
				case "pending":$orderup['status']=2;break;
				case "deny":$orderup['status']=3;break;
				case "expire":$orderup['status']=4;break;
				default:$orderup['status']=0;break;
			} 
			$this->model_global->update($orderup, 'darbotzorder', array('id_darbotzorder' => $order['id_darbotzorder'])); 
 
			if($page!=""){
				redirect(base_url().$page);
			} 
			
			//echo "<pre>";
			//print_r($notif);
			
		}	
	}
	public function cekode(){ 
		$query = $this->db->query("SELECT CASE WHEN MAX(SUBSTRING(inv,-5)) IS NULL THEN 0 ELSE MAX(SUBSTRING(inv,-5)) END AS nilai FROM `darbotzorder` where SUBSTRING(created_date,6,2)='".date('m')."'  LIMIT 1 OFFSET 0")->result_array();
		//print_r($query);
		//SN17PMXXXX
		$dapet =  $query[0]['nilai'];
		$last = $dapet + 1; 
		$panjang = strlen($last *1 );
		$t = substr(date('Y'),2,2);
		$kode = $this->getKodeRand('18',$panjang, $last,"INV".date('Ymd')."DR");
 
		return $kode;
	}
	public function getKodeRand($lenght_max,$panjang, $laju_kode,$initial){
		$nol = $lenght_max - $panjang;
		$nol_lagi = str_repeat("0", $nol - strlen($initial));
		$kode = $initial . $nol_lagi . $laju_kode;
		return $kode;
	}	

	public function iscurl(){
		print_r(function_exists('curl_version'));
	}
}