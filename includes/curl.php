<?php
class  curl {

	public static $HEADERS = array("Content-Type:multipart/form-data");


	public static function get($url) {
		$status = false;
		try {
			$curl_init = curl_init();
			$options = array(
				CURLOPT_URL => $url,
				CURLOPT_HEADER => true,
				CURLOPT_HTTPHEADER => curl::$HEADERS,
				CURLOPT_RETURNTRANSFER => true
			); // cURL options
			curl_setopt_array($curl_init, $options);
			$exec = curl_exec($curl_init);
			if(!curl_errno($curl_init)) {
				$info = curl_getinfo($curl_init);
				$header_size = curl_getinfo($curl_init, CURLINFO_HEADER_SIZE);
				$header = substr($exec, 0, $header_size);
				$body = substr($exec, $header_size);
				$RETURN = $body;
				$status = true;
			}
			else {
				$RETURN['error'] = 'curl';
				$RETURN['errorcode'] = curl_error($curl_init);
			}
			curl_close($curl_init);
		}
		catch(Exception $e) {
			$RETURN['error'] = 'exception';
			$RETURN['errorcode'] = $e;
		}
		return ($status)?$RETURN:json_encode($RETURN, true);
    }




		public static function post($url) {
			$status = false;
			try {
				$curl_init = curl_init();
				$options = array(
					CURLOPT_URL => $url,
					CURLOPT_HEADER => true,
					CURLOPT_POST => 1,
					CURLOPT_HTTPHEADER => curl::$HEADERS,
					CURLOPT_RETURNTRANSFER => true
				); // cURL options
				curl_setopt_array($curl_init, $options);
				if(!empty($_FILES)){
					$keys = array_keys($_FILES);
					for($i=0; $i<count($keys); $i++) {
						$tmpfile = $_FILES[$keys[$i]]['tmp_name'];
						$filename = basename($_FILES[$keys[$i]]['name']);
						//$_POST[$keys[$i]] =  curl_file_create($tmpfile, $_FILES[$keys[$i]]['type'], $filename); // for >= php 5.5
						$_POST[$keys[$i]] =  '@'.$tmpfile.';filename='.$filename; // for < php 5.5
					}
				}
				curl_setopt($curl_init, CURLOPT_POSTFIELDS, $_POST);
				$exec = curl_exec($curl_init);
				if(!curl_errno($curl_init)) {
					$info = curl_getinfo($curl_init);
					$header_size = curl_getinfo($curl_init, CURLINFO_HEADER_SIZE);
					$header = substr($exec, 0, $header_size);
					$body = substr($exec, $header_size);
					$RETURN = $body;
					$status = true;
				}
				else {
					$RETURN['error'] = 'curl';
					$RETURN['errorcode'] = curl_error($curl_init);
				}
				curl_close($curl_init);
			}
			catch(Exception $e) {
				$RETURN['error'] = 'exception';
				$RETURN['errorcode'] = $e;
			}
			return ($status)?$RETURN:json_encode($RETURN, true);
			}
}

?>