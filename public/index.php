<?php

require __DIR__."/../bootstrap/web.php";

?><!DOCTYPE html>
<html>
<head>
	<title>Tea Science Internal</title>
	<style type="text/css">
		body {
			background-color: #000;
			font-family: Arial, Tahoma;
		}
		button {
			cursor: pointer;
		}
		.lc {
			background-color: #fff;
			width: 300px;
			margin: 50px 0px 120px 0px;
			padding: 1px 30px 40px 30px;
		}
		.llc {
			margin: 10px 0px 5px 0px;
		}
		.blc {
			margin-top: 20px;
		}
		#captcha {
			margin-bottom: 10px;
		}
		#rgc {
			margin-top: 10px;
		}
	</style>
</head>
<body>
	<center>
		<div class="lc">
			<h1>Login</h1>
			<form id="login_form" method="post" action="javascript:void(0);">
				<div class="llc"><label>Username: </label></div>
				<div class="bbc"><input type="text" name="username" required/></div>
				<div class="llc"><label>Password: </label></div>
				<div class="bbc"><input type="password" name="password" required/></div>
				<div id="loading_captcha"><h3>Loading captcha...</h3></div>
				<div id="answer_echo" style="display:none;"><h4>Please answer this problem to make sure you are a human!</h4></div>
				<div id="captcha"></div>
				<div id="rcg"><button type="button" onclick="resolve_captcha();">Refresh captcha</button></div>
				<div class="blc"><button id="login_btn" disabled>Login</button></div>
			</form>
		</div>
	</center>
	<script type="text/javascript">
		function gid(id) {
			return document.getElementById(id);
		}
		let captcha = gid("captcha"),
			login_btn = gid("login_btn"),
			login = gid("login_form"),
			loading_captcha = gid("loading_captcha"),
			answer_echo = gid("answer_echo"),
			rcg = gid("rcg");

		function resolve_captcha()
		{
			rcg.style.display = answer_echo.style.display = "none";
			captcha.innerHTML = loading_captcha.style.display = "";
			let xhr = new XMLHttpRequest;
			xhr.onreadystatechange = function () {
				if (this.readyState === 4) {
					login_btn.disabled = 0;
					captcha.innerHTML = this.responseText;
					loading_captcha.style.display = "none";
					rcg.style.display = answer_echo.style.display = "";
				}
			};
			xhr.open("GET", "/api.php?action=get_captcha");
			xhr.send();
		}
		resolve_captcha();

		login_form.addEventListener("submit", function () {
			let xhr = new XMLHttpRequest;
			xhr.onreadystatechange = function () {
				if (this.readyState === 4) {
					let d = JSON.parse(this.responseText).data;
					alert(d.msg);
					if (d.status == "ok") {
						window.location = d.redirect;
					}
				}
			};
			xhr.open("POST", "/api.php?action=login");
			xhr.send(new FormData(login_form));
		});
	</script>
</body>
</html>