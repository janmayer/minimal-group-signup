<?php
ini_set("display_errors", 0);
header("Content-type: application/json");

include("config.inc.php");

/* Setup */
$response = array();
$data = array();
$group = array();

/* Timestamp */
$data["time"] = time();

/* Remote IP */
if (!isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
	$data["ip"] = $_SERVER["REMOTE_ADDR"];
} else {
	$data["ip"] = $_SERVER["HTTP_X_FORWARDED_FOR"];
}

/* Backend validation of form fields */
foreach ($fields as $field) {
	if(validate($_REQUEST, $data, $field, $response, $message) === false){
		die(json_encode($response));
	}
}

/* Check for group size */
if(!is_writable($file_groups) && !is_writable($file_groups)){
	$response["status"] = "failed";
	$response["message"] = "A file is not writable";
	die(json_encode($response));
}
if(find_group($file_groups, $_REQUEST["group"], $group) === false){
	$response["status"] = "failed";
	$response["message"] = $message["group_invalid"];
	die(json_encode($response));
}
if($group[4] >= $group[3]){
	$response["status"] = "failed";
	$response["message"] = $message["group_full"];
	die(json_encode($response));
}

/* Add user to list */
$data["group"] = $group[0];
add_student($file_students, $data);
update_group($file_groups, $data["group"]);

/* Send mail */
if($send_mail == true){
	$m_subject = $message["mail_subject"];
	$m_message = sprintf($message["mail_message"], $data["firstname"], $data["lastname"], $group[1], $group[2]); // customize mail message here
	$m_header = "MIME-Version: 1.0\n";
	$m_header .= "Content-type: text/plain; charset=utf-8\n";
	$m_header .= "Content-Transfer-Encoding: 8bit\n";
	$m_header .= "From: " . $message["mail_from"] . "\n";
	mail($data["email"], $m_subject, $m_message, $m_header);
}

/* success */
$response["status"] = "success";
$response["message"] = sprintf($message["success"], $data["firstname"], $data["lastname"], $data["group"]);  // customize sucess message here
exit(json_encode($response));



/*************************************/

function validStrLen($str, $min, $max){
	$len = strlen($str);
	return !($len < $min || $len > $max);
}

function validate($in, &$out, $field, &$response, $message){
	// optional fields
	if( $field["min"] == 0 && !array_key_exists( $field["name"], $in)){
		$out[$field["name"]] = "";
		return true;
	}
	// required fields
    elseif( array_key_exists( $field["name"], $in) && validStrLen( $in[$field["name"]], $field["min"], $field["max"])){
		$out[$field["name"]] = $in[$field["name"]];
		return true;
	// invalid fields
	} else {
		$response["status"] = "failed";
		$response["message"] = $message["field_invalid"] . $field["name"];
		return false;
	}
}

function find_group($file, $id, &$out){
	if (($handle = fopen($file, "r")) !== false) {
		while (($group = fgetcsv($handle, 0, ";")) !== false) {
			if($group[0] == $id){
				$out = $group;
				return true;
			}
		}
		fclose($handle);
		return false;
	} else {
		return false;
	}
}

function update_group($file, $id){
	if (($handle = fopen($file, "r+")) !== false) {
		$data = array();
		while (!feof($handle)) {
			$data[] = fgetcsv($handle, 0, ";");
		}
		rewind($handle);
		foreach($data as $group){
			if($group[0] == $id){
				$group[4] = $group[4] + 1;
			}
			if(count($group) > 1){ // Prevent php from applying new lines every time
				fputcsv($handle, $group, ";");
			}
		}
		fclose($handle);
		return false;
	} else {
		return false;
	}
}

function add_student($file, $data){
	if (($handle = fopen($file, "a+")) !== false) {
		fputcsv($handle, $data, ";");
	} else {
		return false;
	}
	return true;
}

?>