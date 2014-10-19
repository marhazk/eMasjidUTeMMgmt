<?php
//Call to PHPDocX
require_once("classes/CreateDocx.inc");

$docx = new CreateDocx();
$text = array();
$text[] =
	array(
	'text' => 'I am going to write',
	);
$text[] =
	array(
	'text' => ' Hello World!',
	'b' => 'single',
	);
$text[] =
	array(
	'text' => ' using bold characters.',
	);
//We insert the the text into the Word document
$docx->addText($text);


$docx->createDocx('testsurat1');

?>