<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	function getbrowser(){
		$u_agent = $_SERVER['HTTP_USER_AGENT'];
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";
		// First get the platform?
		if (preg_match('/linux/i', $u_agent)) {
		$platform = 'linux';
		} elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
		$platform = 'mac';
		} elseif (preg_match('/windows|win32/i', $u_agent)) {
		$platform = 'windows';
		}
		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) {
		$bname = 'Internet Explorer';
		$ub = "MSIE";
		} elseif(preg_match('/Firefox/i',$u_agent)) {
		$bname = 'Mozilla Firefox';
		$ub = "Firefox";
		} elseif(preg_match('/Chrome/i',$u_agent)) {
		$bname = 'Google Chrome';
		$ub = "Chrome";
		} elseif(preg_match('/Safari/i',$u_agent)) {
		$bname = 'Apple Safari';
		$ub = "Safari";
		} elseif(preg_match('/Opera/i',$u_agent)) {
		$bname = 'Opera';
		$ub = "Opera";
		} elseif(preg_match('/Netscape/i',$u_agent)) {
		$bname = 'Netscape';
		$ub = "Netscape";
		}
		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
		// we have no matching number just continue
		}
		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
		//we will have two since we are not using 'other' argument yet
		//see if version is before or after the name
		if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
		  $version= $matches['version'][0];
		} else {
		  $version= $matches['version'][1];
		}
		} else {
		$version= $matches['version'][0];
		}
		// check if we have a number
		if ($version==null || $version=="") {$version="?";}
		$jadi =  array(
		'userAgent' => $u_agent,
		'name'      => $bname,
		'version'   => $version,
		'platform'  => $platform,
		'pattern'    => $pattern
		);
		return $jadi["platform"].":".$jadi["name"]."-".$jadi["version"];
	}
	function getip(){
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
    function namadate($tgl){
		$bulanarr = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$pisah = explode("-",$tgl);
		return $pisah[2]." ".$bulanarr[$pisah[1]*1]." ".$pisah[0];
	}
    function namadatetime($datetime,$time=TRUE){
		if($datetime==""){
			return "";
		}else{
			$bulanarr = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
			$tgl = explode(" ",$datetime);
			$pisah = explode("-",$tgl[0]);
			if($time==TRUE){
				return $pisah[2]." ".$bulanarr[$pisah[1]*1]." ".$pisah[0]." ".$tgl[1];
			}else{
				return $pisah[2]." ".$bulanarr[$pisah[1]*1]." ".$pisah[0];
			}
		}
	}
	function verifyEmail($toemail, $fromemail, $getdetails = false)
	{
		$result = "";
		// Get the domain of the email recipient
		$email_arr = explode('@', $toemail);
		$domain = array_slice($email_arr, -1);
		$domain = $domain[0];

		// Trim [ and ] from beginning and end of domain string, respectively
		$domain = ltrim($domain, '[');
		$domain = rtrim($domain, ']');

		if ('IPv6:' == substr($domain, 0, strlen('IPv6:'))) {
			$domain = substr($domain, strlen('IPv6') + 1);
		}

		$mxhosts = array();
			// Check if the domain has an IP address assigned to it
		if (filter_var($domain, FILTER_VALIDATE_IP)) {
			$mx_ip = $domain;
		} else {
			// If no IP assigned, get the MX records for the host name
			getmxrr($domain, $mxhosts, $mxweight);
		}
		$details="";
		if (!empty($mxhosts)) {
			$mx_ip = $mxhosts[array_search(min($mxweight), $mxhosts)];
		} else {
			// If MX records not found, get the A DNS records for the host
			if (filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
				$record_a = dns_get_record($domain, DNS_A);
				 // else get the AAAA IPv6 address record
			} elseif (filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
				$record_a = dns_get_record($domain, DNS_AAAA);
			}

			if (!empty($record_a)) {
				$mx_ip = $record_a[0]['ip'];
			} else {
				// Exit the program if no MX records are found for the domain host
				$result = 'invalid';
				$details .= 'No suitable MX records found.';

				return ((true == $getdetails) ? array($result, $details) : $result);
			}
		}

		// Open a socket connection with the hostname, smtp port 25
		$connect = @fsockopen($mx_ip, 25);

		if ($connect) {

				  // Initiate the Mail Sending SMTP transaction
			if (preg_match('/^220/i', $out = fgets($connect, 1024))) {

						  // Send the HELO command to the SMTP server
				fputs($connect, "HELO $mx_ip\r\n");
				$out = fgets($connect, 1024);
				$details .= $out."\n";

				// Send an SMTP Mail command from the sender's email address
				fputs($connect, "MAIL FROM: <$fromemail>\r\n");
				$from = fgets($connect, 1024);
				$details .= $from."\n";

							// Send the SCPT command with the recepient's email address
				fputs($connect, "RCPT TO: <$toemail>\r\n");
				$to = fgets($connect, 1024);
				$details .= $to."\n";

				// Close the socket connection with QUIT command to the SMTP server
				fputs($connect, 'QUIT');
				fclose($connect);

				// The expected response is 250 if the email is valid
				if (!preg_match('/^250/i', $from) || !preg_match('/^250/i', $to)) {
					$result = 'invalid';
				} else {
					$result = 'valid';
				}
			}
		} else {
			$result = 'invalid';
			$details .= 'Could not connect to server';
		}
		if ($getdetails) {
			return array($result, $details);
		} else {
			return $result;
		}
	}	