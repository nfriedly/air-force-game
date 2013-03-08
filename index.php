<?php 

  error_reporting(E_ALL|E_STRICT);
  ini_set('display_errors', '1');

// get the appfog database settings
$env = json_decode(getenv("VCAP_SERVICES"), true);
$config = $env["mysql-5.1"][0]["credentials"];

$mysqli = new mysqli($config["hostname"], $config["username"], $config["password"], $config["name"]);


// save the score if there is one

if(isset( $_GET['score']) && isset($_COOKIE['name']) ){
	$score = $_GET['score'];
	$name = trim(strip_tags($_COOKIE['name']));
	if( is_numeric($score) && $name != "" ){ //&& $score > 5
		$query = sprintf("INSERT INTO afgame (`name`,`score`) VALUES ('%s','%f')",
			$mysqli->escape_string($name),
			$score
		);
		if(!$mysqli->query($query)){
			// if it failed, try creating the database table we need
			$first_error = $mysqli->error;
			if(!$mysqli->query("CREATE TABLE IF NOT EXISTS `afgame` (`name` varchar(22) NOT NULL, `score` double NOT NULL, `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, KEY `timestamp` (`timestamp`))")) {
				$mysqli->close();
				exit( "Error: $first_error \r\nQuery: $query\r\nCreate Table result: $mysqli->error ");
			} else {
				$mysqli->query($query);
			}
		}
	}
	
	$mysqli->close();
	header("Location: /");
	exit();
}

$scores_today = $scores_month = array();

if (mysqli_connect_errno()) {
	printf("<!-- Connect failed: %s\n -->", $db->connect_error());
}else{

	// high scores: today
	$date = date("Y-m-d");
	if ($result = $mysqli->query("SELECT name,score FROM afgame WHERE timestamp >= '$date' ORDER BY score DESC LIMIT 3")) {
      		while($obj = $result->fetch_object()){
           	$scores_today[] = array('name'=>$obj->name, 'score'=>$obj->score);
       	}
		$result->close();
	}

	// high scores: this month
	$date = date("Y-m-d",strtotime("-1 month"));
	if ($result = $mysqli->query("SELECT name,score FROM afgame WHERE timestamp >= '$date' ORDER BY score DESC LIMIT 5")) {
      		while($obj = $result->fetch_object()){
           	$scores_month[] = array('name'=>$obj->name, 'score'=>$obj->score);
       	}
		$result->close();
	} else {
		echo "<!-- $mysqli->error -->";
	}

}


$mysqli->close();
?>

<HTML>
<head>
<title>The Worlds Most Addicting Game</title>
<META http-equiv=Content-Type content="text/html; charset=windows-1251">

<meta name="description" http-equiv="description" content="Airforce Game, A.K.A. The Worlds Most Addicting Game" />
<meta name="keywords" http-equiv="description" content="Game, action, online, fun, exciting, brickballs" />

<link rel="stylesheet" href="styles.css" />

</HEAD>

<BODY>

<!-- Project Wonderful Ad Box Loader -->
<!-- Put this after the <body> tag at the top of your page -->
<script type="text/javascript">
   (function(){function pw_load(){
      if(arguments.callee.z)return;else arguments.callee.z=true;
      var d=document;var s=d.createElement('script');
      var x=d.getElementsByTagName('script')[0];
      s.type='text/javascript';s.async=true;
      s.src='//www.projectwonderful.com/pwa.js';
      x.parentNode.insertBefore(s,x);}
   if (window.attachEvent){
    window.attachEvent('DOMContentLoaded',pw_load);
    window.attachEvent('onload',pw_load);}
   else{
    window.addEventListener('DOMContentLoaded',pw_load,false);
    window.addEventListener('load',pw_load,false);}})();
</script>
<!-- End Project Wonderful Ad Box Loader -->

<table><tr><td valign="top" width="470">


	<DIV id="box" style="LEFT: 205px; WIDTH: 40px; POSITION: absolute; TOP: 205px; HEIGHT: 40px; BACKGROUND-COLOR: #990000; layer-background-color: #990000
">

	<TABLE height="40" width="40">
	  <TBODY>
	  <TR>
		<TD>&nbsp;</TD></TD></TR></TBODY></TABLE></DIV>
	
	<DIV id="enemy0" style="LEFT: 270px; TOP: 60px; WIDTH: 60px; POSITION: absolute; HEIGHT: 50px; BACKGROUND-COLOR: #000099; layer-background-color: #000099
">
	<TABLE height=50 width=60>
	  <TBODY>
	  <TR>
		<TD>&nbsp;</TD></TR></TBODY></TABLE></DIV>

	<DIV id="enemy1"
	style="LEFT: 300px; WIDTH: 100px; POSITION: absolute; TOP: 330px; HEIGHT: 20px; BACKGROUND-COLOR: #000099; layer-background-color: #000099">
	<TABLE height=20 width=100>
	  <TBODY>
	  <TR>
		<TD>&nbsp;</TD></TR></TBODY></TABLE></DIV>
	<DIV id="enemy2"
	style="LEFT: 70px; WIDTH: 30px; POSITION: absolute; TOP: 320px; HEIGHT: 60px; BACKGROUND-COLOR: #000099; layer-background-color: #000099">
	
	<TABLE height=60 width=30>
	  <TBODY>
	  <TR>

		<TD>&nbsp;</TD></TR></TBODY></TABLE></DIV>
	<DIV id="enemy3"
	style="LEFT: 70px; WIDTH: 60px; POSITION: absolute; TOP: 70px; HEIGHT: 60px; BACKGROUND-COLOR: #000099; layer-background-color: #000099">
	<TABLE height=60 width=60>
	  <TBODY>
	  <TR>
		<TD>&nbsp;</TD></TR></TBODY></TABLE></DIV>
	<TABLE cellSpacing=0 cellPadding=0 border=0><!-- row 1 -->
	  <TBODY>
	
	  <TR>

		<TD width="50" bgColor=#000000 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width="50" bgColor=#000000 height="50">
		  <TABLE>
			<TBODY>
	
			<TR>

			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 bgColor=#000000 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 bgColor=#000000 height=50>
		  <TABLE>
	
			<TBODY>

			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 bgColor=#000000 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 bgColor=#000000 height=50>
	
		  <TABLE>

			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 bgColor=#000000 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
	
		<TD width=50 bgColor=#000000 height=50>

		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 bgColor=#000000 height=50>
		  <TABLE>
			<TBODY>
			<TR>
	
			  <TD></TD></TR></TBODY></TABLE></TD></TR><!-- row 2 -->

	  <TR>
		<TD width=50 bgColor=#000000 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
	
			<TBODY>

			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
	
		  <TABLE>

			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
	
		<TD width=50 height=50>

		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
	
			  <TD></TD></TR></TBODY></TABLE></TD>

		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width="50" bgColor="#000000" height="50">
		  <TABLE>
			<TBODY>
	
			<TR>

			  <TD></TD></TR></TBODY></TABLE></TD></TR><!-- row 3 -->
	  <TR>
		<TD bgcolor="#000000" width="50" height="50">
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
	
		  <TABLE>

			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
	
		<TD width=50 height=50>

		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
	
			  <TD></TD></TR></TBODY></TABLE></TD>

		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
	
			<TR>

			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width="50" bgColor="#000000" height="50">
		  <TABLE>
	
			<TBODY>

			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD></TR><!-- row 4 -->
	  <TR>
		<TD bgcolor="#000000" width="50" height="50">
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
	
		<TD width=50 height=50>

		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
	
			  <TD></TD></TR></TBODY></TABLE></TD>

		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
	
			<TR>

			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
	
			<TBODY>

			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width="50" bgColor="#000000" height="50">
	
		  <TABLE>

			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD></TR><!-- row 5 -->
	  <TR>
		<TD width="50" bgColor="#000000" height="50">
		  <TABLE>
			<TBODY>
			<TR>
	
			  <TD></TD></TR></TBODY></TABLE></TD>

		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
	
			<TR>

			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
	
			<TBODY>

			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
	
		  <TABLE>

			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
	
		<TD width="50" bgColor="#000000" height="50">

		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD></TR><!-- row 6 -->
	  <TR>
		<TD width="50" bgColor="#000000" height="50">
		  <TABLE>
			<TBODY>
	
			<TR>

			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
	
			<TBODY>

			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
	
		  <TABLE>

			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
	
		<TD width=50 height=50>

		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
	
			  <TD></TD></TR></TBODY></TABLE></TD>

		<TD width="50" bgColor="#000000" height="50">
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD></TR><!-- row 7 -->
	  <TR>
		<TD width="50" bgColor="#000000" height="50">
		  <TABLE>
	
			<TBODY>

			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
	
		  <TABLE>

			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
	
		<TD width=50 height=50>

		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
	
			  <TD></TD></TR></TBODY></TABLE></TD>

		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
	
			<TR>

			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width="50" bgColor="#000000" height="50">
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD></TR><!-- row 8 -->
	  <TR>
		<TD width="50" bgColor="#000000" height="50">
	
		  <TABLE>

			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
	
		<TD width=50 height=50>

		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
	
			  <TD></TD></TR></TBODY></TABLE></TD>

		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
	
			<TR>

			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width=50 height=50>
		  <TABLE>
	
			<TBODY>

			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width="50" bgColor="#000000" height="50">
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD></TR><!-- row 9 -->
	  <TR>
	
		<TD width="50" bgColor="#000000" height="50">

		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width="50" bgColor="#000000" height="50">
		  <TABLE>
			<TBODY>
			<TR>
	
			  <TD></TD></TR></TBODY></TABLE></TD>

		<TD width="50" bgColor="#000000" height="50">
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width="50" bgColor="#000000" height="50">
		  <TABLE>
			<TBODY>
	
			<TR>

			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width="50" bgColor="#000000" height="50">
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width="50" bgColor="#000000" height="50">
		  <TABLE>
	
			<TBODY>

			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width="50" bgColor="#000000" height="50">
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width="50" bgColor="#000000" height="50">
	
		  <TABLE>

			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD>
		<TD width="50" bgColor="#000000" height="50">
		  <TABLE>
			<TBODY>
			<TR>
			  <TD></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>

<br /><br />

<!-- script type="text/javascript"><!--
google_ad_client = "pub-9477050254721722";
/* afgame 468x60, created 5/6/08 */
google_ad_slot = "6630440666";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script -->

	
	<!-- Project Wonderful Ad Box Code -->
<div id="pw_adbox_68141_1_0"></div>
<script type="text/javascript"></script>
<noscript><map name="admap68141" id="admap68141"><area href="http://www.projectwonderful.com/out_nojs.php?r=0&c=0&id=68141&type=1" shape="rect" coords="0,0,468,60" title="" alt="" target="_blank" /></map>
<table cellpadding="0" cellspacing="0" style="width:468px;border-style:none;background-color:#ffffff;"><tr><td><img src="http://www.projectwonderful.com/nojs.php?id=68141&type=1" style="width:468px;height:60px;border-style:none;" usemap="#admap68141" alt="" /></td></tr><tr><td style="background-color:#ffffff;" colspan="1"><center><a style="font-size:10px;color:#0000ff;text-decoration:none;line-height:1.2;font-weight:bold;font-family:Tahoma, verdana,arial,helvetica,sans-serif;text-transform: none;letter-spacing:normal;text-shadow:none;white-space:normal;word-spacing:normal;" href="http://www.projectwonderful.com/advertisehere.php?id=68141&type=1" target="_blank">Ads by Project Wonderful!  Your ad here, right now: $0</a></center></td></tr></table>
</noscript>
<!-- End Project Wonderful Ad Box Code -->


</td>
<td valign="top" width="380" id="rightsideDesc">
	
	<h1>Air Force Game</h1>
	<i>A.K.A The Worlds Most Addicting Game</i>
	
	<p><strong>Objective:</strong> Click and hold on the red square. 
Keep it away from the blue shapes or the black wall.</p>


	<p><strong>Goal:</strong> > 30 Seconds is considered to be incredible.</p>
	
	<p><strong>Trivia:</strong> U.S. Air Force pilots have been known to 
<strong>average</strong> more than 60 seconds. </p>

	<hr />

	<p><strong>High Scores</strong></p>
	Today:
	<table>
<?php
	foreach($scores_today as $score){ ?>
		<tr><td><?=$score['name']?></td><td class="number"><?=sprintf("%01.3f",$score['score'])?></td></tr>
<?php	}
?>
	</table>

	<br />Within 1 month:
	<table>
<?php
	foreach($scores_month  as $score){ ?>
		<tr><td><?=$score['name']?></td><td class="number"><?=sprintf("%01.3f",$score['score'])?></td></tr>
<?php	}
?>
	</table>	
	

	<hr />
	<p><a href="http://air-force-game.nfriedly.com/">Air Force Game</a> is updated and maintained by <a href="http://nfriedly.com/">Nathan Friedly of nFriedly Web Development</a>, an <a href="http://nfriedly.com/webdev/javascript">Expert node.js, JavaAcript and AJAX develer</a></p>
	<p>The source is <a href="https://github.com/nfriedly/air-force-game">available on Github</a>.</p>

	
</td>
<!--td valign="top" width="160">
	<script type="text/javascript"><!- -
	google_ad_client = "pub-9477050254721722";
	/* afgame skyscraper */
	google_ad_slot = "0826385857";
	google_ad_width = 160;
	google_ad_height = 600;
	//- - >
	</script>
	<script type="text/javascript"
	src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
	</script>

</td -->
</tr>
</table>

<script src="scripts.js" type="text/javascript"></script>



<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1735765-26']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</body></html>