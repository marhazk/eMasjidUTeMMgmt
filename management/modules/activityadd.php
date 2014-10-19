<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<style>
div.hide { display:none; }
div.show { }
</style>
<script>
function showhide(obj, obj2)
{
	if (document.getElementById(obj).className == "hide")
	    document.getElementById(obj).className = "show";
    else
		document.getElementById(obj).className = "hide";
	if (document.getElementById(obj2).className == "hide")
	    document.getElementById(obj2).className = "show";
    else
		document.getElementById(obj2).className = "hide";
}
</script>
<form name="form1" method="post" enctype="multipart/form-data"  action="./?op=activityinfo">
  <table width="100%%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="40%"><strong>DAFTAR AKTIVITI </strong></td>
      <td width="2%">&nbsp;</td>
      <td width="58%">&nbsp;</td>
    </tr>
	<tr>
      <td width="40%">&nbsp;</td>
      <td width="2%">&nbsp;</td>
      <td width="58%">&nbsp;</td>
    </tr>
    <tr>
      <td width="40%">Nama Aktiviti</td>
      <td width="2%">:</td>
      <td width="58%"><span id="sprytextfield1">
        <input name="ename" type="text" id="ename" size="50" />
      <span class="textfieldRequiredMsg"><BR />Sila isi nama aktiviti.</span></span></td>
    </tr>
    <tr>
      <td width="40%">Lokasi</td>
      <td width="2%">:</td>
      <td width="58%"><select name="KodFakulti" style="width:150" onchange="changeFakulti();">
		<?php
		$query = mysql_query("SELECT * FROM Venue");
			while ($row = mysql_fetch_array($query))
			{
        ?>
        <option value="<?php echo $row[Name];?>"><?php echo $row[Name];?></option>
        <?php }?>
        </select></td>
    </tr>
    <tr>
      <td width="40%">Tarikh Mula </td>
      <td width="2%">:</td>
      <td width="58%">Date : 
        <select name="ed1" id="ed1">
        <option value="" selected="selected">-</option>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
        <option>11</option>
        <option>12</option>
        <option>13</option>
        <option>14</option>
        <option>15</option>
        <option>16</option>
        <option>17</option>
        <option>18</option>
        <option>19</option>
        <option>20</option>
        <option>21</option>
        <option>22</option>
        <option>23</option>
        <option>24</option>
        <option>25</option>
        <option>26</option>
        <option>27</option>
        <option>28</option>
        <option>29</option>
        <option>30</option>
        <option>31</option>
      </select>
/
<select name="em1" id="em1">
  <option value="" selected="selected">-</option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
  <option>6</option>
  <option>7</option>
  <option>8</option>
  <option>9</option>
  <option>10</option>
  <option>11</option>
  <option>12</option>
</select>
/
<select name="ey1" id="ey1">
  <option value="" selected="selected">-</option>
<!--  <option>2010</option>
  <option>2011</option> -->
  <option>2012</option>
  <option>2013</option>
<!--  <option>2014</option>
  <option>2015</option>
  <option>2016</option>
  <option>2017</option> -->
</select>
Time:
<select name="ehh1" id="ehh1">
  <option value="" selected="selected">-</option>
  <option>00</option>
  <option>01</option>
  <option>02</option>
  <option>03</option>
  <option>04</option>
  <option>05</option>
  <option>06</option>
  <option>07</option>
  <option>08</option>
  <option>09</option>
  <option>10</option>
  <option>11</option>
  <option>12</option>
  <option>13</option>
  <option>14</option>
  <option>15</option>
  <option>16</option>
  <option>17</option>
  <option>18</option>
  <option>19</option>
  <option>20</option>
  <option>21</option>
  <option>22</option>
  <option>23</option>
</select> 
: 
<select name="emm1" id="emm1">
  <option value="" selected="selected">-</option>
  <option>00</option>
  <option>01</option>
  <option>02</option>
  <option>03</option>
  <option>04</option>
  <option>05</option>
  <option>06</option>
  <option>07</option>
  <option>08</option>
  <option>09</option>
  <option>10</option>
  <option>11</option>
  <option>12</option>
  <option>13</option>
  <option>14</option>
  <option>15</option>
  <option>16</option>
  <option>17</option>
  <option>18</option>
  <option>19</option>
  <option>20</option>
  <option>21</option>
  <option>22</option>
  <option>23</option>
  <option>24</option>
  <option>25</option>
  <option>26</option>
  <option>27</option>
  <option>28</option>
  <option>29</option>
  <option>30</option>
  <option>31</option>
  <option>32</option>
  <option>33</option>
  <option>34</option>
  <option>35</option>
  <option>36</option>
  <option>37</option>
  <option>38</option>
  <option>39</option>
  <option>40</option>
  <option>41</option>
  <option>42</option>
  <option>43</option>
  <option>44</option>
  <option>45</option>
  <option>46</option>
  <option>47</option>
  <option>48</option>
  <option>49</option>
  <option>50</option>
  <option>51</option>
  <option>52</option>
  <option>53</option>
  <option>54</option>
  <option>55</option>
  <option>56</option>
  <option>57</option>
  <option>58</option>
  <option>59</option>
</select></td>
    </tr>
    <tr>
      <td width="40%">Tarikh Tamat </td>
      <td width="2%">:</td>
      <td width="58%">Date : 
        <select name="ed2" id="ed2">
        <option value="" selected="selected">-</option>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
        <option>11</option>
        <option>12</option>
        <option>13</option>
        <option>14</option>
        <option>15</option>
        <option>16</option>
        <option>17</option>
        <option>18</option>
        <option>19</option>
        <option>20</option>
        <option>21</option>
        <option>22</option>
        <option>23</option>
        <option>24</option>
        <option>25</option>
        <option>26</option>
        <option>27</option>
        <option>28</option>
        <option>29</option>
        <option>30</option>
        <option>31</option>
      </select>
/
<select name="em2" id="em2">
  <option value="" selected="selected">-</option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
  <option>6</option>
  <option>7</option>
  <option>8</option>
  <option>9</option>
  <option>10</option>
  <option>11</option>
  <option>12</option>
</select>
/
<select name="ey2" id="ey2">
  <option value="" selected="selected">-</option>
<!--  <option>2010</option>
  <option>2011</option> -->
  <option>2012</option>
  <option>2013</option>
<!--  <option>2014</option>
  <option>2015</option>
  <option>2016</option>
  <option>2017</option> -->
</select> 
Time: 
<select name="ehh2" id="ehh2">
  <option value="" selected="selected">-</option>
  <option>00</option>
  <option>01</option>
  <option>02</option>
  <option>03</option>
  <option>04</option>
  <option>05</option>
  <option>06</option>
  <option>07</option>
  <option>08</option>
  <option>09</option>
  <option>10</option>
  <option>11</option>
  <option>12</option>
  <option>13</option>
  <option>14</option>
  <option>15</option>
  <option>16</option>
  <option>17</option>
  <option>18</option>
  <option>19</option>
  <option>20</option>
  <option>21</option>
  <option>22</option>
  <option>23</option>
 </select>
: 
<select name="emm2" id="emm2">
  <option value="" selected="selected">-</option>
  <option>00</option>
  <option>01</option>
  <option>02</option>
  <option>03</option>
  <option>04</option>
  <option>05</option>
  <option>06</option>
  <option>07</option>
  <option>08</option>
  <option>09</option>
  <option>10</option>
  <option>11</option>
  <option>12</option>
  <option>13</option>
  <option>14</option>
  <option>15</option>
  <option>16</option>
  <option>17</option>
  <option>18</option>
  <option>19</option>
  <option>20</option>
  <option>21</option>
  <option>22</option>
  <option>23</option>
  <option>24</option>
  <option>25</option>
  <option>26</option>
  <option>27</option>
  <option>28</option>
  <option>29</option>
  <option>30</option>
  <option>31</option>
  <option>32</option>
  <option>33</option>
  <option>34</option>
  <option>35</option>
  <option>36</option>
  <option>37</option>
  <option>38</option>
  <option>39</option>
  <option>40</option>
  <option>41</option>
  <option>42</option>
  <option>43</option>
  <option>44</option>
  <option>45</option>
  <option>46</option>
  <option>47</option>
  <option>48</option>
  <option>49</option>
  <option>50</option>
  <option>51</option>
  <option>52</option>
  <option>53</option>
  <option>54</option>
  <option>55</option>
  <option>56</option>
  <option>57</option>
  <option>58</option>
  <option>59</option>
 </select></td>
    </tr>
    <tr>
      <td>Tarikh Akhir Pendaftaran </td>
      <td>:</td>
      <td>Date :
        <select name="ed3" id="ed3">
          <option value="" selected="selected">-</option>
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
          <option>6</option>
          <option>7</option>
          <option>8</option>
          <option>9</option>
          <option>10</option>
          <option>11</option>
          <option>12</option>
          <option>13</option>
          <option>14</option>
          <option>15</option>
          <option>16</option>
          <option>17</option>
          <option>18</option>
          <option>19</option>
          <option>20</option>
          <option>21</option>
          <option>22</option>
          <option>23</option>
          <option>24</option>
          <option>25</option>
          <option>26</option>
          <option>27</option>
          <option>28</option>
          <option>29</option>
          <option>30</option>
          <option>31</option>
        </select>
        /
        <select name="em3" id="em3">
          <option value="" selected="selected">-</option>
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
          <option>6</option>
          <option>7</option>
          <option>8</option>
          <option>9</option>
          <option>10</option>
          <option>11</option>
          <option>12</option>
        </select>
        /
        <select name="ey3" id="ey3">
          <option value="" selected="selected">-</option>
<!--          <option>2010</option>
          <option>2011</option> -->
          <option>2012</option>
          <option>2013</option>
      <!--    <option>2014</option>
          <option>2015</option>
          <option>2016</option>
          <option>2017</option> -->
        </select>
        Time:
        <select name="ehh3" id="ehh3">
          <option value="" selected="selected">-</option>
          <option>00</option>
          <option>01</option>
          <option>02</option>
          <option>03</option>
          <option>04</option>
          <option>05</option>
          <option>06</option>
          <option>07</option>
          <option>08</option>
          <option>09</option>
          <option>10</option>
          <option>11</option>
          <option>12</option>
          <option>13</option>
          <option>14</option>
          <option>15</option>
          <option>16</option>
          <option>17</option>
          <option>18</option>
          <option>19</option>
          <option>20</option>
          <option>21</option>
          <option>22</option>
          <option>23</option>
        </select>
        :
        <select name="emm3" id="emm3">
          <option value="" selected="selected">-</option>
          <option>00</option>
          <option>01</option>
          <option>02</option>
          <option>03</option>
          <option>04</option>
          <option>05</option>
          <option>06</option>
          <option>07</option>
          <option>08</option>
          <option>09</option>
          <option>10</option>
          <option>11</option>
          <option>12</option>
          <option>13</option>
          <option>14</option>
          <option>15</option>
          <option>16</option>
          <option>17</option>
          <option>18</option>
          <option>19</option>
          <option>20</option>
          <option>21</option>
          <option>22</option>
          <option>23</option>
          <option>24</option>
          <option>25</option>
          <option>26</option>
          <option>27</option>
          <option>28</option>
          <option>29</option>
          <option>30</option>
          <option>31</option>
          <option>32</option>
          <option>33</option>
          <option>34</option>
          <option>35</option>
          <option>36</option>
          <option>37</option>
          <option>38</option>
          <option>39</option>
          <option>40</option>
          <option>41</option>
          <option>42</option>
          <option>43</option>
          <option>44</option>
          <option>45</option>
          <option>46</option>
          <option>47</option>
          <option>48</option>
          <option>49</option>
          <option>50</option>
          <option>51</option>
          <option>52</option>
          <option>53</option>
          <option>54</option>
          <option>55</option>
          <option>56</option>
          <option>57</option>
          <option>58</option>
          <option>59</option>
      </select></td>
    </tr>
    <tr>
      <td>Nombor Telefon</td>
      <td>:</td>
      <td><span id="sprytextfield2">
      <input name="econtact" type="text" id="econtact" size="50" />
      <span class="textfieldRequiredMsg"><BR />Sila isi nombor telefon.</span><span class="textfieldMaxCharsMsg"><BR />Nombor telefon melebihi had aksara.</span><span class="textfieldMinCharsMsg"><BR />Nombor telefon tidak sah..</span></span></td>
    </tr>
    <tr>
      <td width="40%">Penganjur</td>
      <td width="2%">:</td>
      <td width="58%"><input name="eorg" type="text" id="eorg" size="50" /></td>
    </tr>
    <tr>
      <td>Banner</td>
      <td>:</td>
      <td><input type="file" name="ebanner" id="fileField" /></td>
    </tr>
    <tr>
      <td width="40%">Butiran Terperinci </td>
      <td width="2%">&nbsp;</td>
      <td width="58%">&nbsp;</td>
    </tr>
    <tr>
      <td height="500" colspan="3" valign="top">
      <label for="textarea"></label>
<script type="text/javascript" src="./images/nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<span id="sprytextarea1">
<textarea name="edesc" cols="80" rows="30" id="pMsg"></textarea>
</td>
    </tr>
    <tr>
      <td width="40%">&nbsp;</td>
      <td width="2%">&nbsp;</td>
      <td width="58%">&nbsp;</td>
    </tr>
    <tr>
      <td width="40%">Penyertaan Peserta</td>
      <td width="2%">&nbsp;</td>
      <td width="58%">&nbsp;</td>
    </tr>
    <!--<tr>
      <td>Pelajar UTeM </td>
      <td>&nbsp;</td>
      <td><select name="epartyes2" id="epartyes2">
        <option value=1>Aktif</option>
        <option value=0 selected="selected">Tidak Aktif</option>
      </select></td>
    </tr> -->
   <!-- <tr>
      <td width="40%">Staf UTeM </td>
      <td width="2%">&nbsp;</td>
      <td width="58%"><select name="epartyes" id="epartyes">
        <option value=1 selected="selected" >Aktif</option>
        <option value=0>Tidak Aktif</option>
      </select></td>
    </tr> -->
    <tr>
      
      <td colspan=3><!--<p>* pilihan </p> -->
        <table width="100%%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="50%">Pusat Tanggungjawab </td>
            <td width="10%">Bilangan Peserta </td>
            <td width="5%">Aktif</td>
            <td width="15%">Bilangan Peserta Yang Dikehendaki </td>
            <td width="20%">Salin</td>
          </tr>
          <?php
		  	$num = 0;
		  	$query = mysql_query("SELECT * FROM OfficeCode");
			while ($row = mysql_fetch_array($query))
			{
				$num++;
		  ?>
          <tr>
            <td width="50%"><?php echo $row["OfficeName"]; ?></td>
            <?php
			$totalStaff = 0;
		  	$query2 = mysql_query("SELECT * FROM Office WHERE OfficeID=".$row["OfficeID"]);
			while ($row2 = mysql_fetch_array($query2))
			{
				$totalStaff++;
			}
			
				if ($row["OfficeID"] == 16)			//PJKA
					$maxDefVal = 1;
				else if ($row["OfficeID"] == 17)	//PPP
					$maxDefVal = 1;
				else if ($row["OfficeID"] == 18)	//PPS
					$maxDefVal = 3;
				else if ($row["OfficeID"] == 19)	//PENERBIT
					$maxDefVal = 3;
				else if ($row["OfficeID"] == 20)	//PPB
					$maxDefVal = 1;
				else
					$maxDefVal = 10;
				
			?>
            <td width="10%"><?php echo $totalStaff;?></td>
            <td width="5%">
                  <input name="eaktif<?php echo $num;?>" type="checkbox" id="eaktif<?php echo $num;?>" value="1" checked="checked" onclick="showhide('text-<?php echo $num;?>','textx-<?php echo $num;?>')"/></td>
                  
            <td width="15%"><div id="text-<?php echo $num;?>" class="show"><span id="sprytextfield3-<?php echo $num;?>">
              <input name="enamex<?php echo $num;?>" type="text" id="ename2" value="<?php echo $maxDefVal; ?>" size="5" /><span class="textfieldRequiredMsg"><BR />Sila isi sekurang-kurangnya nilai 0 minimum</span><span class="textfieldMaxCharsMsg"><BR />Melebihi had jumlah peserta.</span><span class="textfieldMinCharsMsg"><BR />Sila isi sekurang-kurangnya nilai 0 minimum</span>
            </span></div></td>
            <td width="20%"><div id="textx-<?php echo $num;?>" class="show"><select name="epartx<?php echo $num;?>" id="epartno3">
            <?php
		  	$query2 = mysql_query("SELECT Staff.Name, Staff.StaffID, Position.StaffID, Position.PosID, Office.OfficeID FROM Staff, Office, Position WHERE Office.OfficeID=".$row["OfficeID"]." AND Office.StaffID = Staff.StaffID AND (Position.PosID=4 OR Position.PosID=20) AND (Position.status=1 OR Office.status=1) AND Staff.StaffID = Position.StaffID GROUP BY Staff.Name, Position.StaffID, Office.StaffID");
			while ($row2 = mysql_fetch_array($query2))
			{
						$query3 = mysql_query("SELECT * FROM Staff WHERE StaffID=".$row2["StaffID"]." LIMIT 0,1");
						$rowName = mysql_fetch_array($query3);
						?>
                        <option value="<?php echo $rowName["StaffID"]; ?>"><?php echo $rowName["Name"]; ?></option>
                      <?php 
				//	}
				//}
			} ?>
              
            </select></div></td>
          </tr>
          <?php } ?>
        </table>
      <p>Untuk kegunaan pejabat, ditandatangani oleh: 
        <select name="epartno2" id="epartno2">
          <option>[Staff 1]</option>
          <option>[Staff 2]</option>
        </select>
      </p></td>
    </tr>
<!--    <tr>
      <td width="40%">Peserta Luar </td>
      <td width="2%">&nbsp;</td>
      <td width="58%"><select name="epartno" id="epartno">
        <option value=1 >Aktif</option>
        <option value=0 selected="selected">Tidak Aktif</option>
      </select></td>
    </tr> -->
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="40%">&nbsp;</td>
      <td width="2%">&nbsp;</td>
      <td width="58%">
      <input type=hidden name=epartyes2 value=0 />
      <input type=hidden name=epartyes value=0 />
      <input type=hidden name=epartno value=0 />
      <input type="submit" name="chk" id="chk" value="Daftar" />
      <input type="submit" name="xxx" id="xxx" value="Hapus" /></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {hint:"Hanya nombor sahaja", maxChars:12, minChars:9});
<?php
for ($num = 1; $num <= 20; $num++)
{
	?>
	var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3-<?php echo $num;?>", "integer", {hint:"Hanya nombor sahaja", maxChars:3, minChars:1});
<?php } ?>
</script>
