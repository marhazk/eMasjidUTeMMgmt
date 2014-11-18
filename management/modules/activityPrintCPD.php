<?php

require_once 'modules/PHPWord.php';
// New Word Document
$PHPWord = new PHPWord();
// New portrait section
$section = $PHPWord->createSection();
// Add header




//header("Content-Type: application/vnd.ms-word; charset=utf-8'");
	header("Content-Type: application/vnd.ms-word; charset=utf-8'");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=CPDList.doc");
	if ($_REQUEST["aid"] >= 1)
	{
		$aid =$_REQUEST["aid"];
		$sqlx = mysql_query("SELECT * FROM activities WHERE ActivityID='".$aid."'");
		$rowx = mysql_fetch_array($sqlx);
			
		$start = date("z", strtotime($rowx["DateOfEvent"]));
		$end = date("z", strtotime($rowx["DateOfEnd"]));
		$totalDays = (int)$end-(int)$start;
		$sql = mysql_query("SELECT * FROM participants, staff, office, officecode where participants.aid=$aid AND staff.StaffID=participants.uid AND office.StaffID=staff.StaffID AND officecode.OfficeID=office.OfficeID GROUP BY participants.uid, staff.StaffID, office.StaffID ORDER BY officecode.OfficeID DESC");
	}
	$staffLen = 8;
	$nameLen = 35;
	$officeLen = 18;
	$dayLen = 3;
	$aChar = "☑ ";
	$bChar = "☐ ";
    
	$Char0 = "0/3 ";
	$Char1 = "1/3 ";
	$Char2 = "1/3 ";
	$Char3 = "2/3 ";
	$Char4 = "1/3 ";
	$Char5 = "2/3 ";
	$Char6 = "2/3 ";
	$Char7 = "3/3 ";
	/*$Char0 = "☐☐☐ ";
	$Char1 = "☑☐☐ "; //2611 //2610
	$Char2 = "☐☑☐ ";
	$Char3 = "☑☑☐ ";
	$Char4 = "☐☐☑ ";
	$Char5 = "☑☐☑ ";
	$Char6 = "☐☑☑ ";
	$Char7 = "☑☑☑ ";
	$cChar = "✓ ";
	$dChar = "✔ ";*/
	
	$text = "SENARAI PESERTA UNTUK BORANG CPD ".$rowx["Name"]."\r\n";
	//echo $text;
    
    $header = $section->createHeader();
    $header->addText($text);
    
	//echo strline($text);
	//echo "\r\n";
    
    $section->addTextBreak();

    $table = $section->addTable();
    $table->addRow();
    $table->addCell(4500)->addText("NO STAFF");
    $table->addCell(4500)->addText("NAMA PENUH");
    $table->addCell(4500)->addText("PTJ");
//echo space("NO STAF",$staffLen).space("NAMA PENUH",$nameLen).space("PTJ",$officeLen);
    
    //$section->addText('Some text...');
	for ($num = 0; $num <= $totalDays; $num++)
	{
        $table->addCell(4500)->addText("D".($num+1));
		//echo space("D".($num+1),$dayLen);
        
	}
	//echo "\r\n";
    //$test = "☑☑☑";
    //iconv(mb_detect_encoding($test, mb_detect_order(), true), "UTF-8", $test);
    $th = "TH";
    $h = "H";
	while ($row = mysql_fetch_array($sql))
	{
        $table->addRow();
		//echo space($row["StaffID"],$staffLen).space($row["Name"],$nameLen).space($row["OfficeName"],$officeLen);
		$table->addCell(4500)->addText($row["StaffID"]);
		$table->addCell(4500)->addText($row["Name"]);
		$table->addCell(4500)->addText($row["OfficeName"]);
		$tokenNum = 0;
		$StaffID = $row["StaffID"];
		$toklist = $row["state"];
		$tokens = ":";
		$arr = explode(':', $row["state"]);
		foreach ($arr as $rx) {
			if ($rx == 1) { $table->addCell(4500)->addText($Char1); }
			elseif ($rx == 2) { $table->addCell(4500)->addText($Char2); }
			elseif ($rx == 3) { $table->addCell(4500)->addText($Char3); }
			elseif ($rx == 4) { $table->addCell(4500)->addText($Char4); }
			elseif ($rx == 5) { $table->addCell(4500)->addText($Char5); }
			elseif ($rx == 6) { $table->addCell(4500)->addText($Char6); }
			elseif ($rx == 7) { $table->addCell(4500)->addText($Char7); }
			else
			{
				$table->addCell(4500)->addText($Char8);
			}
			/*if ($rx == 1) { echo space($Char1,$dayLen); }
			elseif ($rx == 2) { echo space($Char2,$dayLen); }
			elseif ($rx == 3) { echo space($Char3,$dayLen); }
			elseif ($rx == 4) { echo space($Char4,$dayLen); }
			elseif ($rx == 5) { echo space($Char5,$dayLen); }
			elseif ($rx == 6) { echo space($Char6,$dayLen); }
			elseif ($rx == 7) { echo space($Char7,$dayLen); }
			else
			{
				echo space($Char0,$dayLen);
			}*/
		}
		//echo "\r\n";
	}
    $section->addTextBreak();
    $section->addTextBreak();
	//echo "Disahkan oleh,\r\n";
	//echo "\r\n";
	//echo "\r\n";
	//echo "___________________\r\n";
    
    
$section->addText('Disahkan oleh,');
    $section->addTextBreak();
    $section->addTextBreak();
    $section->addTextBreak();
$section->addText('_____________________');

$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
//$objWriter->save('HeaderFooter2.docx');
$objWriter->save('file.doc', 'Word2007', true);

$a = file_get_contents("file.doc");
die ($a);
?>