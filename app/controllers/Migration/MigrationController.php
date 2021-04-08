<?php

namespace App\Controllers;

use App\Core\Request;

class MigrationController
{
	protected $pageTitle;

	public function index()
	{
		$pageTitle = "Migration";

		return view('migrations/index', compact('pageTitle'));
	}

	public function run()
	{
		$request = Request::validate('login');
		return view('migrations/run', compact('request'));
	}
}
