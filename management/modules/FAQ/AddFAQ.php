

<form id="form1" name="form1" method="post" action="?op=FAQ/processFAQ">
<table width="490" border="0">
  <tr>
    <td height="36" colspan="2" align="left"><strong>ADD NEW F.A.Q</strong></td>
    </tr>
  <tr>
    <td width="83" align="left" valign="top">Question :</td>
    <td width="372">	
	  <label>
        <textarea name="Question" cols="45" rows="3" id="Question"></textarea>
      </label>
   </td>
  </tr>
  <tr>
    <td align="left" valign="top">Answer :</td>
    <td><label>
      <textarea name="Answer" id="Answer" cols="45" rows="5"></textarea>
    </label></td>
  </tr>
  <tr>
    <td align="left">Date : </td>
    <td><label>
    <?php
		require_once('modules/FAQ/classes/tc_calendar.php');

		$myCalendar = new tc_calendar("Date1", true);
		$myCalendar->setIcon("modules/FAQ/images/iconCalendar.gif");
		$myCalendar->setDate(1, 1, 2000);

		$myCalendar->writeScript();	  
	?>
    </label></td>
  </tr>
  <tr>
    <td align="left">Author :</td>
    <td><label>
      <input name="Author" type="text" id="Author" size="45" />
    </label></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
    <td><label>
      <input type="submit" name="Submit" id="Submit" value="Insert New F.A.Q" />
      </label></td>
  </tr>
</table>


 </form>
