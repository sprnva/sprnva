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
		$base_uri = (App::get('base_url') != "/")
			? str_replace(App::get('base_url'), "", $_SERVER['REQUEST_URI'])
			: $_SERVER['REQUEST_URI'];

		return trim(parse_url($base_uri, PHP_URL_PATH),  '/');
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
	public static function validate($uri, $datas = [])
	{
		foreach ($datas as $key => $data) {
			if ($data == "required") {
				if (empty($_POST[$key])) {
					$errorList[] = "&bull; {$key} is {$data} but has no value.";
				}
			}
		}

		if (!empty($errorList)) {
			redirect($uri, [implode('<br>', $errorList), "danger"]);
		}

		foreach ($_POST as $key => $value) {
			$post_data[$key] = sanitizeString($value);
		}

		return $post_data;
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
			redirect('forgot/password', ['E-mail not found in the server.', 'danger']);
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

			redirect('forgot/password', $isSent);
		}
	}
}
