<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Photo Caffeine</title>

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/caffeine.css" rel="stylesheet" type="text/css">
<link href="css/aminate.css" rel="stylesheet" type="text/css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.--><script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/ubuntu-mono:n4:default;acme:n4:default;electrolize:n4:default;iceberg:n4:default;inder:n4:default;megrim:n4:default;orbitron:n3:default.js" type="text/javascript"></script>
</head>
<body>
<div id="all_content">
	<!-- Navigation -->
	<?php
		include 'login.php';
		include 'functions.php';
	?>

          <div class="container">
          <div class="container-fluid">

			<div class="row">	<!-- row 1 -->
                    <div class="text-left col-sm-12">	<!-- Recent Photos -->
					<?php

						$mysqli = new mysqli($hostname, $username, $password, $database);


						if (mysqli_connect_errno()) {
							printf("MySQL Connection Failed: %s\n", mysqli_connect_error());
							exit();
						}

						/*
							Images in the carousel will be chosen randomly - controlled by a random number rand() in the SQL statement.
							They will be rotated by a random angle also defined in the SQL statement.
							Because images are cropped for large rotation angles, they will be scaled in order to completely fit in the container.
							Restrict images to those that are ~500x334 so that the size on the main page does not change.
						*/

						$scale_factor = 0.8;

						$sql2 = 	"select filename, caption, 15*(rand()-0.5) as random_rotation_angle from caffeine order by rand();";

						if ($result2 = $mysqli->query($sql2)) {
							$row_cnt2 = $result2->num_rows;
						}

						printf('<div id="carousel1" class="carousel slide" data-ride="carousel">');
							printf('<ol class="carousel-indicators">');
								printf('<li data-target="#carousel1" data-slide-to="0" class="active"></li>');
								for ($i = 1; $i < $row_cnt2; $i++) {
									printf('<li data-target="#carousel1" data-slide-to="%d"></li>', $i);
								}
							printf('</ol>');

							printf('<div class="carousel-inner" role="listbox">');


							$first_row = TRUE;
							while ($row = $result2->fetch_assoc()) {
								if ($first_row == TRUE)
								{
									printf('<div class="item active">');
									$first_row = FALSE;
								}
								else
								{
									printf('<div class="item">');
								}

								printf('<img src="');
								printf($row["filename"]);
								printf('" alt="Slide Image ');
								printf($row["row_no"]);
								printf('" class="center-block"');
								echo 'style="
								-ms-transform: rotate(' . $row["random_rotation_angle"] . 'deg) scale(' . $scale_factor . ');
								-webkit-transform: rotate(' . $row["random_rotation_angle"] . 'deg) scale(' . $scale_factor . ');
								transform: rotate(' . $row["random_rotation_angle"] . 'deg) scale(' . $scale_factor . ');
								"';
								printf('>');
								printf('<div class="carousel-caption">');

										printf('<p>');
										printf($row["caption"]);
										printf('</p>');

							printf('</div>');
						printf('</div>');





							}	/* end of while loop */
							printf('</div>');

						$result2->free();
						$mysqli->close();
				?>
					<a class="left carousel-control" href="#carousel1" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="right carousel-control" href="#carousel1" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span class="sr-only">Next</span></a></div>
				</div>	<!-- Recent Photos -->
	<!--			 <div class="col-sm-4 text-left">
                         <h4>About Me</h4>
                         <img class="main_page_photos" src="artwork/photographer.jpg" alt="Photographer Photo"/>
					<p>I specialize in photographing men. Most guys say they are ‘not photogenic’. Let me prove how wrong you are. </p>
                         <p>Good photos will get you noticed. Be honest - when you are searching a guy’s profile, do you carefully start with the profile text?
					Or do you flip through the profiles and only pay attention only to the ones whose photos catch your eye? </p>
                         <p>Together, we can do better than cheesy iPhone-in-a-Mirror selfies. &nbsp;I will make you look your best. &nbsp;
					Contact me for a complimentary consultation.</p>
                    </div>-->
               </div>		<!-- row 1 -->



          </div>	<!-- container-fluid -->
     </div>		<!-- container -->
</div>			<!-- all_content -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
