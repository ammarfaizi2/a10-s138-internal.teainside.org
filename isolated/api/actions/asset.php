<?php

if (isset($_GET["data"]) && is_string($_GET["data"])) {
	$file = json_decode(aes_decrypt($_GET["data"], APP_KEY), true);

	if (isset($file["type"], $file["path"], $file["expired"])) {


		if (time() >= $file["expired"]) {
			goto error_404;
		}

		if ($file["type"] === "captcha") {
			$ext = explode(".", $file["path"]);
			$ext = strtolower(end($ext));
			$contentType = [
				"png" => "image/png",
				"jpg" => "image/jpg",
				"jpeg" => "image/jpeg"
			];

			$file["path"] = BASEPATH."/isolated/captcha/".$file["path"];
			if (file_exists($file["path"])) {
				if (isset($contentType[$ext])) {
					header("Content-Type: ".$contentType[$ext]);
				}
				readfile($file["path"]);
				exit;
			}
			$data["erri"] = "credential_ok";
			goto error_404;
		}
	}

	exit;
}

error_404:
$code = 404;
$data["error"] = "404_not_found";