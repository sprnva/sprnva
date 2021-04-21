<?php

namespace App\Core;

use App\Core\App;

class Request
{
	/**
	 * Fetch the request URI.
	 *
	 * @return string
	 */
	public static function uri()
	{
		$base_uri = (App::get('base_url') != "")
			? str_replace(App::get('base_url'), "", $_SERVER['REQUEST_URI'])
			: $_SERVER['REQUEST_URI'];

		return parse_url($base_uri, PHP_URL_PATH);
	}

	/**
	 * Fetch the request method.
	 *
	 * @return string
	 */
	public static function method()
	{
		return $_SERVER['REQUEST_METHOD'];
	}

	/**
	 * Validates the POST method inputs
	 * 
	 */
	public static function validate($uri = '', $datas = [])
	{

		foreach ($datas as $key => $data) {
			if ($data == "required") {
				if (empty($_POST[$key])) {
					$errorList[] = "&bull; {$key} is {$data} but has no value.";
				}
			}
		}

		foreach ($_POST as $key => $value) {
			$post_data[$key] = sanitizeString($value);
		}

		static::storeValidatedToSession($post_data);

		if (!empty($errorList)) {
			redirect($uri, [implode('<br>', $errorList), "danger"]);
		}

		if (isset($_POST['_token'])) {
			static::verifyCsrfToken($_POST['_token']);
		}

		return $post_data;
	}

	/**
	 * store validated request to session
	 * 
	 */
	private static function storeValidatedToSession($validatedRequest)
	{
		static::invalidateOld();
		$_SESSION['OLD'] = $validatedRequest;
	}

	/**
	 * get the old input values
	 * 
	 */
	public static function old($inputName)
	{
		return (!empty($inputName) && isset($_SESSION['OLD']) && array_key_exists($inputName, $_SESSION['OLD']))
			? $_SESSION['OLD'][$inputName]
			: '';
	}

	/**
	 * generate a token
	 * 
	 */
	public static function token($length)
	{
		return md5(randChar($length));
	}

	/**
	 * will send an email containing the password reset link
	 * 
	 */
	public static function passwordResetLink($request)
	{
		$isEmailExist = App::get('database')->select("*", "users", "email = '" . $request['email'] . "'");

		if (!$isEmailExist) {
			redirect('/forgot/password', ['E-mail not found in the server.', 'danger']);
		} else {

			$token = Request::token(10);

			$subject = "Sprnva password reset link";
			$emailTemplate = file_get_contents('system/Email/stubs/email.stubs');

			$app_name = ["{{app_name}}", "{{username}}", "{{link_token}}", "{{year}}"];
			$values = [
				App::get('config')['app']['name'],
				$isEmailExist['fullname'],
				$_SERVER['SERVER_NAME'] . "/" . App::get('config')['app']['base_url'] . "reset/password/" . $token,
				date('Y')
			];
			$body_content = str_replace($app_name, $values, $emailTemplate);

			$body = $body_content;

			$isSent = sendMail($subject, $body, $request['email']);

			if ($isSent[1] == "success") {

				$insertData = [
					'email' => $request['email'],
					'token' => $token,
					'created_at' => date("Y-m-d H:i:s")
				];

				$hasResetPending = App::get('database')->select("email", "password_resets", "email = '" . $request['email'] . "'");

				if (!empty($hasResetPending['email'])) {
					App::get('database')->update('password_resets', $insertData, "email = '" . $request['email'] . "'");
				} else {
					App::get('database')->insert('password_resets', $insertData);
				}
			}

			redirect('/forgot/password', $isSent);
		}
	}

	/**
	 * generates a csrf token
	 * 
	 */
	public static function csrf_token()
	{
		if (!isset($_SESSION["csrf_token"])) {
			$_SESSION["csrf_token"] = md5(bin2hex(randChar(20)));
		} else {
			$token = $_SESSION["csrf_token"];
		}

		return $token;
	}

	/**
	 * verifies csrf token
	 * 
	 */
	public static function verifyCsrfToken($request)
	{
		if (!static::tokensMatch($request)) {
			throwException('419 | Page expired.');
		}
	}

	/**
	 * match secret token vs users token
	 * 
	 */
	public static function tokensMatch($request)
	{
		if (strlen($_SESSION["csrf_token"]) != strlen($request)) {
			return false;
		} else {
			$res = $_SESSION["csrf_token"] ^ $request;
			$ret = 0;
			for ($i = strlen($res) - 1; $i >= 0; $i--) {
				$ret |= ord($res[$i]);
			}

			return !$ret;
		}
	}

	/**
	 * renew the csrf token
	 * 
	 */
	public static function renewCsrfToken()
	{
		$_SESSION["csrf_token"] = md5(bin2hex(randChar(20)));
	}

	public static function invalidateOld()
	{
		if (isset($_SESSION['OLD'])) {
			unset($_SESSION['OLD']);
		}
	}
}
