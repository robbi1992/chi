<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploader extends CI_Controller {
	public function index() {
		error_reporting(E_ALL | E_STRICT);
		@include(APPPATH.'library/UploadHandler.php');
		$upload_handler = new UploadHandler();
	}
}