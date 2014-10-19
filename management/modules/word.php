<?php
	header("Content-Type: application/vnd.ms-word; charset=utf-8'");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=test.doc");
	$content= file_get_contents('surat1test.rtf'); 

     $content = str_replace('__NAME__',"TEST SAHAJA",$content);

     $content = str_replace( '**USER_NAME**' , $my_username, $content); 
	 //file_put_contents('testsurat1.docx', $content);
	 echo $contents;
     ?>