<?PHP

/**
 * Calls a restapi using the curl php module. You will have
 * to change the $APIcall method to match your own path. You
 * will also have to change it when you upload it to csunix.
 * 
 * @param $path The path within the web service
 * @param $method "PUT", "DELETE", "GET", or "POST"
 * @param $body The body of the request (should be json encoded)
 * 
 * @return ["data"=>associative array of contents, "response"=>http response code]
 */

function callAPI($path, $method, $body = "")
{

	// change this to match your setup
	$APIcall = "http://localhost/a3" . $path;




	$ch = curl_init();	                       		 // initialize the curl handler
	curl_setopt($ch, CURLOPT_URL, $APIcall);	     // set the url
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	 // make it return the body instead of echoing it


	if ($method == "GET") {                        // set the method
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $body);    // set the body
	} elseif ($method == "POST") {                        // set the method
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $body);    // set the body
	} elseif ($method == "PUT") {
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $body);    // set the body
	} elseif ($method == "DELETE") {
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $body);    // set the body
	}

	$output = curl_exec($ch);                       // send the request
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);


	// instead of to an associative array
	return array('data' => $output, 'response' => $httpCode);
}
