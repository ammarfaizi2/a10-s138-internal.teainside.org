<?php

require __DIR__."/../bootstrap/web.php";

$data = [];

if (!
	(
		isset($_GET["action"]) && is_string($_GET["action"])
	)
) {
	$code = 400;
	$data = ["error" => "bad_request"];
	goto res;	
}

switch ($_GET["action"]) {
	case "asset":
		require BASEPATH."/isolated/api/actions/asset.php";
		break;
	case "get_captcha":
		echo load_captcha("calculus");
		exit;
		break;
	case "login":
		if (
			isset(
				$_POST["username"],
				$_POST["password"],
				$_POST["captcha_key"]
			) &&
			is_string($_POST["username"]) &&
			is_string($_POST["password"]) &&
			is_string($_POST["captcha_key"])
		) {
			$ckey = json_decode(aes_decrypt($_POST["captcha_key"], APP_KEY), true);
			if (!isset($ckey["type"], $ckey["num"])) {
				$code = 400;
				$data = ["error" => "Invalid captcha key"];
				goto res;
			}
			$code = 200;
			if (check_captcha_answer($ckey["type"], $ckey["num"])) {
				$data = [
					"status" => "failed",
					"msg" => "Wrong username or password!"
				];
			} else {
				$data = [
					"status" => "failed",
					"msg" => "Wrong captcha answer!"
				];
			}
		}
		break;
	default:
		break;
}


res:
header("Content-Type: application/json");
http_response_code($code);
echo json_encode(
	[
		"status" => $code,
		"data" => $data
	]
);
