<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exercise_two extends CI_Controller {


	function __construct()
	{
		parent::__construct();
	}

	public function index(){}

	public function disk_usage()
	{
		$res = disk_free_space(".");
		$res = round($res / (1024 * 1024), 2) . "Mb";

		$total = disk_total_space(".");
		$total = round($total / (1024 * 1024), 2) . "Mb";


		echo "Total usage: ", $total, PHP_EOL;
		echo "Free usage: ", $res, PHP_EOL;
	}


	public function file_list()
	{
		$res = shell_exec("ls");
		echo "<pre>";
		print_r($res);
	}

	public function upload_via_ftp()
	{
		$ftp_conn = ftp_connect("ftp.localhost") or die("Could not connect to ftp");

		$file = "content.json";
		$fp = fopen($file,"r");

		// upload file
		if (ftp_fput($ftp_conn, "result.json", $fp, FTP_ASCII))
		{
			echo "Successfully uploaded $file.";
		}
		else
		{
			echo "Error uploading $file.";
		}
	}

	public function upload_via_scp()
	{
		//ref: https://www.php.net/manual/en/function.ssh2-scp-send.php
		$connection = ssh2_connect('shell.example.com', 22);
		ssh2_auth_password($connection, 'username', 'password');

		$result = ssh2_scp_send($connection, '/local/filename', '/remote/filename', 0644);

		if ($result == True) {
			echo "Uploaded via SFTP - successfully";
		}else{
			echo "Uploaded via SFTP - failed.";
		}
	}

	public function upload_via_sftp()
	{
		$connection = ssh2_connect('shell.example.com', 22);
		ssh2_auth_password($connection, 'username', 'password');

		$result = ssh2_scp_send($connection, '/local/filename', '/remote/filename', 0644);
		if ($result == True) {
			echo "Uploaded via SFTP - successfully";
		}else{
			echo "Uploaded via SFTP - failed.";
		}
	}

	public function start_apache()
	{
		$result = shell_exec("service apache2 start");
		if ($result == True) {
			echo "Apache Server started - successfully";
		}else{
			echo "Apache to failed start.";
		}
	}

	public function server_monitor()
	{
		echo "Login to server via SSH.", PHP_EOL;
		echo "Check Process tree: ";
		echo "ps aux | grep apache2", PHP_EOL;
		echo "Kill any zombi process to reduce server memory using kill command", PHP_EOL;
		echo "Check corresponding logs for any issues in the process. Log path: /var/log/syslog", PHP_EOL;
	}
}
