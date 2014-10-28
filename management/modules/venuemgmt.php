    <?php
    if ($admin >= 1)
    {
        if ($_POST[vd] == "Tambah")
        {
            $sql = "INSERT into venue (Name) values ('".$_POST['vname']."');";
            //die($sql);
            $q = mysql_query($sql);
            if ($q)
                echo "<BR>Berjaya ditambahkan!<BR>";
            else
                echo "<BR>Tidak berjaya ditambahkan! Sila cuba lagi<BR>";
        }
        elseif ($_POST[vd] == "Hapus")
        {
            $q = mysql_query("DELETE FROM venue WHERE Venue_Id=".$_POST[vid]);
            if ($q)
                echo "<BR>Berjaya dipadamkan!<BR>";
            else
                echo "<BR>Tidak berjaya dipadamkan! Sila cuba lagi<BR>";

        }
    ?>
        <form method=post>
            <input type=text name="vname" value=""><input type=submit name="vd" value="Tambah">
        </form>

        <form method=post>
            <select name="vid">
                <?php
                $q = mysql_query("SELECT * FROM venue");
                while ($row = mysql_fetch_array($q))
                {
                    ?><option value="<?=$row[Venue_Id]?>"><?=$row[Name]?></option>
                <?php
                }
                ?>
            </select><input type=submit name="vd" value="Hapus">
        </form>
    <?php
    }
    ?>

