<?php

class CreateCode
{
	private $length;
	private $prefix;

	public  function __construct($length, $prefix)
	{
		$this->length = $length;
		$this->prefix = $prefix;
	}

	private function generateCode() {

		$uniqid = uniqid(mt_rand(), true);
		$hash = md5($uniqid);

		return $this->prefix . strtoupper(substr($hash, 0, $this->length));
	}

	private function createText($total_code) {
		$code_list = '';

		for ($i = 1; $i <= $total_code; $i++) {
			$code = self::generateCode();
		    $code_list .= $code . "\r\n";
		}

		return $code_list;
	}

	public function createFile($file_name, $total_code) {
		$data = self::createText($total_code);
		$file_open = fopen($file_name, 'w');
		fwrite($file_open, $data);

		if($file_open) {
			echo "File created";
		} else {
			echo "File can not created";
		}

		fclose($file_open);

	}
}

$obj_create = new CreateCode(8,'MQ');
$obj_create->createFile('section2.txt', 250);

