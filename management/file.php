<?php
switch ($includefile)
{
	case 'activityPrintCPD':
	case 'activityPrintLetter1':
	case 'activityPrintLetter2':
	case 'activityPrintLetter2List':
	case 'config':
	case 'activityedit':
	case 'activityCPD':
	case 'activityform':
	case 'accDB':
	case 'FAQ/manage_FAQ':
	case 'FAQ/AddFAQ':
	case 'FAQ/calendar_form':
	case 'FAQ/process_delete_post':
	case 'FAQ/process_update_post':
	case 'FAQ/processFAQ':
	case 'FAQ/update_post':
	case 'FAQ/view_post':
	case 'greet':
	case 'file':
	case 'template':
		$includefile = "error";
		break;
	default:
		break;
	}
?>