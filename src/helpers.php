<?php

/**
 * @param string	$type
 * @param ?int		$no
 * @return string
 */
function load_captcha(string $type, ?int $num = null): ?string
{
	if (is_null($num)) {
		require BASEPATH."/config/captcha/{$type}.php";
		$num = rand(1, $captchaProblemsAmount);
	}

	// $num = 5;

	$captchaKey = json_encode(
		[
			"type" => $type,
			"num" => $num
		]
	);

	ob_start();
	require BASEPATH."/isolated/captcha/{$type}/{$type}_".sprintf("%04d", $num).".php";
	return ob_get_clean();
}

/**
 * @param string	$type
 * @param int		$num
 * @return bool
 */
function check_captcha_answer(string $type, int $num): bool
{
	$checkAnswer = 1;
	$answer = &$_POST["answer"];
	return require BASEPATH."/isolated/captcha/{$type}/{$type}_".sprintf("%04d", $num).".php";
}

/**
 * @param string  $str
 * @param string  $key
 * @param ?string $iv
 * @return string
 */
function aes_encrypt(string $str, string $key, ?string $iv = null): string
{
	$key = hash("sha256", $key, true);

	if (is_null($iv)) {
		$iv = openssl_random_pseudo_bytes(16);
		$ret = openssl_encrypt($str, "AES-256-CBC", $key, 1, $iv).$iv;
	} else {
		$ret = openssl_encrypt($str, "AES-256-CBC", $key, 1, $iv);
	}

	return base64_encode($ret);
}

/**
 * @param string	$type
 * @param string	$path
 * @param int		$expired
 * @return string
 */
function asset_lock(string $type, string $path, int $expired = 300): string
{
	return aes_encrypt(
		json_encode(
			[
				"type" => $type,
				"path" => $path,
				"expired" => (time() + $expired)
			],
			JSON_UNESCAPED_SLASHES
		),
		APP_KEY
	);
}

/**
 * @param string $path
 * @param int	 $expired
 * @return string
 */
function captcha_asset(string $path, int $expired = 500)
{
	return "/api.php?action=asset&amp;data=".rawurlencode(asset_lock("captcha", $path, $expired));
}

/**
 * @param string  $str
 * @param string  $key
 * @param ?string $iv
 * @return ?string
 */
function aes_decrypt(string $str, string $key, ?string $iv = null): ?string
{
	$key = hash("sha256", $key, true);
	$str = base64_decode($str);

	if (is_null($iv)) {
		$iv = substr($str, -16);
		$str = substr($str, 0, -16);
	}

	$ret = openssl_decrypt($str, "AES-256-CBC", $key, 1, $iv);
	return is_string($ret) ? $ret : null;
}
