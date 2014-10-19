<?php
$content = '
<table width="750" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="750" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="150"><img src="image001.jpg" width="100"></td>
        <td width="600"><p align="left"><strong>UNIVERSITI TEKNIKAL MALAYSIA MELAKA</strong><br>
          Karung Berkunci No. 1752, Pejabat Pos Durian Tunggal,<br>
          76109 Durian  Tunggal, Melaka<br>
 Tel : 06-331 6304/6268 Faks : 06-331 6262</p>
          <p align="left">E-mel : <em>pusatislam@utem.edu.my</em></p></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><hr/></td>
  </tr>
  <tr>
    <td><table width="750" border="0" cellspacing="0" cellpadding="0">
      <tr align="center">
        <td width="200"></td>
        <td width="350" valign="middle"><strong> PUSAT ISLAM</strong></td>
        <td width="200"><img src="sirim.jpg" width="69" height="47"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="750" border="0" cellspacing="0" cellpadding="0">
      <tr align="center">
        <td width="550" align="left" valign="middle"><p>Ruj. Kami (Our Ref)&nbsp;:&nbsp;UTeM.13.02/20.15/10/2 (&nbsp;&nbsp;)<br>Ruj. Tuan (Your Ref) :</p></td>
        <td width="200" align="left"><p>24 Rejab 1431H<br>6 Julai 2010</p></td>
      </tr>
    </table></td>
  </tr>
</table>
<p>
<BR>Nama1
<BR>Nama2
<BR>Nama3
<BR>Nama4
<BR>Nama5
<BR>Nama6
</p>
<p><img src="image003.png"/></p><p>Tuan/ Puan,</p>
      <p><b>MEMOHON PENYERTAAN STAF KE SAMBUTAN ISRA WAL MI RAJ UNIVERSITI  TEKNIKAL MALAYSIA  MELAKA</b></p>
      <p>Dengan segala hormatnya, saya merujuk perkara di atas.</p>
      <p>2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Adalah dimaklumkan bahawa Pusat Islam akan menganjurkan sambutan isra wal miraj. Di dalam program tersebut akan diadakan pengajian kitab bersama penceramah yang dilantik iaitu mengenai <b>&ldquo;Isra wal Miraj menurut Al-Quran dan Al-Hadis&rdquo;</b> peringkat universiti pada ketetapan berikut :-</p>
	  
	  
      <p><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tarikh&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;9 Julai 2010 bersamaan 27 Rejab 1431H</b><BR><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Masa&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;4.00 petang (Jumaat)</b><BR><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempat &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;Auditorium, Aras 2, Bangunan Canselori</b></p>
	   
	   
     <p>3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sehubungan itu, Pusat Islam, UTeM memohon kepada  tuan/ puan dapat menghantar staf bagi sama-sama mengimarahkan majlis ilmu ini. Semoga  kita sentiasa mendapat ilmu yang bermanfaat dari majlis ini.</p>
      <p>4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kerjasama tuan/ puan dalam hal ini amatlah dihargai dan  didahului dengan ucapan terima kasih.</p>
      <p><br>Sekian, Wassalam.</p>
      <p><b>&ldquo;DAKWAH PEMANGKIN KHAIRAH UMMAH&rdquo;</b><br>
        <b>&ldquo;KOMPETENSI TERAS KEGEMILANGAN&rdquo;</b></p>
      <p>Saya yang menjalankan amanah,</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <b>RADZUAN BIN NORDIN</b>
      <p>Pengarah<br>
    Pusat Islam</p>
';
?>
<?php
include "pdf/html2pdf.class.php";
$html2pdf = new HTML2PDF('P','A4','en');
$html2pdf->WriteHTML($content);

$html2pdf->Output('exemple.pdf');

?>