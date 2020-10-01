<?php
/**
 * Class for Using Whatsapp in application
 *
 *
 * @author Rohit Arya, <arya.rohit13@gmail.com>
 * @version 1.0
 */
class Whatsapp {
	
	/**
	 * Function to Register Account
	 *
	 *
	 * @param data array of user information (name, company name, email, phone)
	 */
	public function createAccount($data){
		$data['type']='create_acc';
		$URL='https://villaments.win/wapanel/create-acc';
		if($data['email']=='')
			$data['email']=$data['phone'];
		$curl = curl_init();
		curl_setopt_array($curl, array(
						  CURLOPT_URL => $URL,
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => "",
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 0,
						  CURLOPT_FOLLOWLOCATION => true,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => "POST",
						  CURLOPT_POSTFIELDS => $data,
		));
		$res = (array) json_decode(curl_exec($curl));
		return $res;
	}
	
	/**
	 * Function to set webhook
	 *
	 *
	 * @param api_key received at the time of account creation
	 * @param url web address at which new received message will be received 
	 */
	public function setWhatsappHook($api_key, $url) {
		$data['api_key']=$api_key;
		$data['url']=$url;
		$URL='https://villaments.win/wapanel/api/webhook.php';
		$curl = curl_init();
		curl_setopt_array($curl, array(
						  CURLOPT_URL => $URL,
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => "",
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 0,
						  CURLOPT_FOLLOWLOCATION => true,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => "POST",
						  CURLOPT_POSTFIELDS => $data,
		));
		$res = (array) json_decode(curl_exec($curl));
		return $res;
	}
	
	/**
	 * Function to get balance in account
	 *
	 *
	 * @param api_key received at the time of account creation
	 */
	public function getWhatsappBalance($api_key) {
			$data['api_key']=$api_key;
			$URL='https://villaments.win/wapanel/api/sms_balance.php';
			$curl = curl_init();
			curl_setopt_array($curl, array(
							  CURLOPT_URL => $URL,
							  CURLOPT_RETURNTRANSFER => true,
							  CURLOPT_ENCODING => "",
							  CURLOPT_MAXREDIRS => 10,
							  CURLOPT_TIMEOUT => 0,
							  CURLOPT_FOLLOWLOCATION => true,
							  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							  CURLOPT_CUSTOMREQUEST => "POST",
							  CURLOPT_POSTFIELDS => $data,
			));
			$res = (array) json_decode(curl_exec($curl));
			$balance=$res['data'][0]->sms_quota;
			return $balance;
	}
	
	/**
	 * Function to send Whatsapp
	 *
	 *
	 * @param api_key received at the time of account creation
	 */
	public function sendwhatsapp($data) {
		$URL='https://villaments.win/wapanel/api/send_sms.php';
		$dt['api_key']=$data['api_key'];
		$dt['phone']=$data['receiverMobileNo'];
		$dt['body']=$data['message'];
		if(isset($data['filePathUrl']))
			$dt['file_link']=$data['filePathUrl'];
		else
			$dt['file_link']='';
		$curl = curl_init();
		curl_setopt_array($curl, array(
						  CURLOPT_URL => $URL,
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => "",
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 0,
						  CURLOPT_FOLLOWLOCATION => true,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => "POST",
						  CURLOPT_POSTFIELDS => $dt,
		));
		$res = (array) json_decode(curl_exec($curl));
		return $res;
	}
}