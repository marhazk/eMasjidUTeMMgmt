<li><a href="/management/">Senarai Aktiviti</a></li>
<li><a href="?op=hadith/list">Senarai Hadith</a></li>
<li><a href="?op=FAQ/open_FAQ">Senarai FAQ</a></li>
<li><a href="?op=livestream">Tonton LIVE!</a></li>
<?php 
	if ($admin >= 1)
	{
?>
<li><a href="?op=activityform">Daftar Aktiviti</a></li>
<li><a href="?op=activityCPD">Kemaskini CPD</a></li>
<li><a href="?op=activityparticipants">Senarai Peserta</a></li>
<li><a href="?op=FAQ/manage_FAQ">Kemaskini FAQ</a></li>
<li><a href="?op=FAQ/AddFAQ">Tambah FAQ</a></li>
<li><a href="?op=logout">Daftar Keluar</a></li>
<?php }?>