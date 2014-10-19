
<title>Himpunan Koleksi Soalan (faq) </title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">

$(function(){

// The height of the content block when it's not expanded
var adjustheight = 60;
// The "more" link text
var moreText = "+  More";
// The "less" link text
var lessText = "- Less";

// Sets the .more-block div to the specified height and hides any content that overflows
$(".more-less .more-block").css('height', adjustheight).css('overflow', 'hidden');

// The section added to the bottom of the "more-less" div
$(".more-less").append('<p class="continued">[&hellip;]</p><a href="#" class="adjust"></a>');

$("a.adjust").text(moreText);

$(".adjust").toggle(function() {
		$(this).parents("div:first").find(".more-block").css('height', 'auto').css('overflow', 'visible');
		// Hide the [...] when expanded
		$(this).parents("div:first").find("p.continued").css('display', 'none');
		$(this).text(lessText);
	}, function() {
		$(this).parents("div:first").find(".more-block").css('height', adjustheight).css('overflow', 'hidden');
		$(this).parents("div:first").find("p.continued").css('display', 'block');
		$(this).text(moreText);
});
});

</script>

<style>
	body{
		background:#fefefe;
		font-family:Tahoma, Geneva, sans-serif; 
	}
	p{
		font-family:Tahoma, Geneva, sans-serif; 
		font-size:14px; 
		line-height:22px;
		margin-bottom:20px;
	}
	#container{
		text-align:center
		width:700px;
		margin:auto;
	}
	a.adjust{
		padding:10px;
		display:block;
		font-weight:bold;
		background:#eee;
		color:#333;
		border-radius:12px;
		-webkit-border-radius:12px;
		-moz-border-radius:12px;
		width:80px;
		text-align:center;
		text-decoration:none;
	}
		a.adjust:hover{
			background:#333;
			color:#FFF;
			-webkit-transition: all 400ms; /*safari and chrome */
			-moz-transition: all 400ms ease; /* firefox */
			-o-transition: all 400ms ease; /* opera */
			transition: all 400ms ease;
		}
	p.continued{
		margin-top:0;
	}
	img{
		padding:10px;
		background:#FFF;
		border-radius: 12px;
		-webkit-box-shadow: 0 1px 13px rgba(0,0,0,.25);
		-moz-box-shadow: 0 1px 13px rgba(0,0,0,.25);
		box-shadow: 0 1px 13px rgba(0,0,0,.25);
		width:400px;
		margin-left:20px;
	}
</style>

<div id="container">
	<h1>Himpunan Koleksi Soalan (faq)</h1>
    
    
    <?php
	
	
	$get_data = "SELECT FaqID, Question, Answer, Date, Author FROM faq ORDER BY FaqID DESC";
	$result = mysql_query($get_data);
	
	while ($row=mysql_fetch_array($result))
	{
		?>
    <div class="more-less">
    	<div class="more-block">
          <p> <?php echo $row[Question] ?> </p>
          <p> <?php echo $row[Answer] ?> </p>
    	</div>
 	</div>
    <hr />
    
    <?php
	
	}
	
	?>
</div>
