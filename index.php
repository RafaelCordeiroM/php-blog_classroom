<?php include "include/header.php"; ?>
<?php

// $query = "SELECT * from users_online WHERE id = :id";

// $statement = $connection-> prepare($query);

// $statement->execute(
// 	array(
// 		'id' => '9'
// 	)
// );

// echo mysqli_num_rows($statement);


?>

<?php
if (isset($_GET['month']) && isset($_GET['day'])) {
	$mon = escape($_GET['month']);
	$day = escape($_GET['day']);
	header("location: schedule_page.php?mon=$mon&day=$day");
}
?>
<?php
if (isset($_POST['add_schedule'])) {

	$date = escape($_POST['schedule_date']);
	$title = escape($_POST['schedule_title']);
	$content = escape($_POST['schedule_content']);
	$author = $user['username'];
	$discipline = escape($_POST['schedule_discipline']);
	$topic = escape($_POST['schedule_topic']);

	$query = "INSERT INTO schedule (schedule_date,schedule_title,schedule_content,schedule_author,schedule_discipline,schedule_topic)";
	$query .= " VALUES('$date','$title','$content','$author','$discipline','$topic')";

	$query = mysqli_query($connection, $query);

	if ($query) echo "<div class='alert alert-success col-sm-12 text-center'>Schedule Added</div>";
	else echo mysqli_error($connection);
}

?>
<?php include "include/header_html.php"; ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light">
	<div class="container d-flex align-items-center px-4" id="navbar_main">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="oi oi-menu"></span> Menu
		</button>
		<div class="collapse navbar-collapse" id="ftco-nav">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active"><a href="./" class="nav-link pl-0">Home</a></li>
				<li class="nav-item"><a href="blog" class="nav-link">Blog</a></li>
				<li class="nav-item"><a href="library" class="nav-link">Library</a></li>
			</ul>
		</div>
	</div>
</nav>

<!-- END nav -->

<section class="home-slider owl-carousel mb-2">
	<div class="slider-item" style="background-image:url(images/bg_6.jpg);">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-end" data-scrollax-parent="true">
				<div class="col-md-6 ftco-animate float-right">
					<h1 class="mb-4">Técnicos em Informática</h1>
				</div>
			</div>
		</div>
	</div>

	<div class="slider-item" style="background-image:url(./images/bg_7.jpg);">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
				<div class="col-md-6 ftco-animate">
					<h1 class="mb-4">Técnicos em Informática</h1>

				</div>
			</div>
		</div>
	</div>
</section>
<section class="bg-primary p-4">
	<style>
		.date_div {

			background: #5d50c6;
			font-size: 25px;
			color: white;

		}

		.date_div span {
			color: white;
		}

		.el_css:hover {
			text-decoration: none;
			border-bottom: none;
		}

		.date_div.day {
			font-weight: 700;
			font-size: 25px;
		}

		.date_div .mos,
		.date_div .yr {
			font-size: 18px;
		}

		.div-date-scheduled {
			display: inline-flex;
			border: 1px solid transparent;
			border-bottom-color: white;
			transition-duration: 0.1s;

		}

		.div-date-scheduled:hover {
			border: 1px solid white;

		}

		.circle {
			display: block;
			font-size: 20px;
			color: #fff;
			text-align: center;
			background: #6b6b6b;
		}
	</style>
	<hr>
	<div class="col-sm-12 text-center">
		<h1>Schedule</h1>

	</div>
	<div class="col-sm-12 text-center mb-4">
		<button class="btn btn-outline-light " data-toggle="modal" data-target="#modal_schedule">Create Schedule</button>
	</div>


	<?php

	$query_schedule = "SELECT * from schedule ORDER BY STR_TO_DATE(schedule_date,'%d-%m-%Y') ASC";
	$query_schedule = mysqli_query($connection, $query_schedule);


	if (!$query_schedule) echo mysqli_error($connection);
	else {
		while ($row = mysqli_fetch_assoc($query_schedule)) {
			$date = $row['schedule_date'];
			$title = $row['schedule_title'];
		}
	}
	?>

	<div class="container d-block" align="center">

		<?php

		$query_cal = "SELECT * from schedule";
		$query_cal = mysqli_query($connection, $query_cal);

		while ($data_cal = mysqli_fetch_assoc($query_cal)) {
			$date = date_create($data_cal['schedule_date']);
		?>
			<a href="schedule_page/<?php echo $data_cal['schedule_id'];  ?>" class="el_css ">
				<div class="div-date-scheduled border_schedule_div m-1 mb-4">
					<div class="mr-2 p-1">
						<h2 class="el_css" style="color:white;"> <?php echo $data_cal['schedule_title'] ?></h2>
					</div>
					<div class="date_div p-3">
						<span class="day"><?php echo date_format($date, "d"); ?></span>
						<span class="mos"> / <?php echo date_format($date, "m"); ?> /</span>
						<span class="yr"><?php echo date_format($date, "Y"); ?></span>
					</div>
				</div>
			</a>

		<?php } ?>


	</div>
	<hr>

</section>
<?php

function week_day($day)
{
	global $connection;
	$query = "SELECT * from week WHERE week_day='$day' ORDER BY week_time";
	$query = mysqli_query($connection, $query);
	echo "<table class='table table-hover'>";
	echo "<thead class='thead-light'><th>" . strtoupper($day) . "</th></thead>";
	echo "<tbody>";
	while ($row = mysqli_fetch_assoc($query)) {
		$week_class = $row['week_class'];
		$week_time = date_create($row['week_time']);

		echo "
		<tr>
			<td align='center'>{$week_class} <div class='circle'>" . date_format($week_time, "G") . ":" . date_format($week_time, "i") . "</div> </td>
		</tr>
		";
	}
	echo "</tbody>";
	echo "</table>";
}

?>
<session class="p-4">
	<div class="col-sm-12 text-center">
		<h1>weekly classes</h1>
	</div>
	<hr>
	<div class="d-flex m-4">

		<?php
		week_day('monday');
		week_day('tuesday');
		week_day('wednesday');
		week_day('thursday');
		week_day('friday');
		?>

	</div>
</session>

<?php
// include "calendario.php"; 
?>

<section class="ftco-services ftco-no-pb">
	<div class="container-wrap">
		<div class="row no-gutters">
			<div class="col-md-3 d-flex services align-self-stretch py-5 px-4 ftco-animate bg-primary">
				<div class="media block-6 d-block text-center">
					<div class="icon d-flex justify-content-center align-items-center">
						<span class="flaticon-teacher"></span>
					</div>
					<div class="media-body p-2 mt-3">
						<h3 class="heading">União</h3>
					</div>
				</div>
			</div>
			<div class="col-md-3 d-flex services align-self-stretch py-5 px-4 ftco-animate bg-darken">
				<div class="media block-6 d-block text-center">
					<div class="icon d-flex justify-content-center align-items-center">
						<span class="flaticon-reading"></span>
					</div>
					<div class="media-body p-2 mt-3">
						<h3 class="heading">Amizade</h3>
					</div>
				</div>
			</div>
			<div class="col-md-3 d-flex services align-self-stretch py-5 px-4 ftco-animate bg-primary">
				<div class="media block-6 d-block text-center">
					<div class="icon d-flex justify-content-center align-items-center">
						<span class="flaticon-books"></span>
					</div>
					<div class="media-body p-2 mt-3">
						<h3 class="heading">Engajamento</h3>
					</div>
				</div>
			</div>
			<div class="col-md-3 d-flex services align-self-stretch py-5 px-4 ftco-animate bg-darken">
				<div class="media block-6 d-block text-center">
					<div class="icon d-flex justify-content-center align-items-center">
						<span class="flaticon-diploma"></span>
					</div>
					<div class="media-body p-2 mt-3">
						<h3 class="heading">Cooperatividade</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(images/bg_8.jpg);" data-stellar-background-ratio="0.5">
	<div class="container">
		<div class="row justify-content-center mb-5 pb-2 d-flex">
			<div class="col-md-6 align-items-stretch d-flex">
				<div class="img img-video d-flex align-items-center" style="background-image: url(images/about-2.jpg);">
					<div class="video justify-content-center">
						<a href="https://vimeo.com/45830194" class="icon-video popup-vimeo d-flex justify-content-center align-items-center">
							<span class="ion-ios-play"></span>
						</a>
					</div>
				</div>
			</div>
			<div class="col-md-6 heading-section heading-section-white ftco-animate pl-lg-5 pt-md-0 pt-5">
				<h2 class="mb-4">3º B - Informática</h2>
			</div>
		</div>
		<?php
		$q = mysqli_query($connection, "SELECT * from users where user_role = 'student'");
		$num_student = mysqli_num_rows($q);

		$q = mysqli_query($connection, "SELECT * from users where user_role = 'teacher'");
		$num_teacher = mysqli_num_rows($q);
		?>
		<div class="row d-md-flex align-items-center justify-content-center">
			<div class="col-lg-12">
				<div class="row d-md-flex align-items-center">
					<div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
						<div class="block-18">
							<div class="icon"><span class="flaticon-doctor"></span></div>
							<div class="text">
								<strong class="number" data-number="<?= $num_teacher ?>">0</strong>
								<span>Professores</span>
							</div>
						</div>
					</div>
					<div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
						<div class="block-18">
							<div class="icon"><span class="flaticon-doctor"></span></div>
							<div class="text">
								<strong class="number" data-number="<?= $num_student ?>">0</strong>
								<span>Estudantes</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="p-4 bg-dark">
	<div class="col-sm-12 text-center">
		<h1 style="color:white;">Our location</h1>
	</div>
	<hr>
	<script type="text/javascript">
		google.charts.load("current", {
			"packages": ["map"],
			// Note: you will need to get a mapsApiKey for your project.
			// See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
			"mapsApiKey": "AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY"
		});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Lat', 'Long', 'Name'],
				[-16.358699, -46.899241, 'Escola Estadual Virgílio de Melo Franco'],
			]);

			var map = new google.visualization.Map(document.getElementById('map_div'));
			map.draw(data, {
				showTooltip: true,
				showInfoWindow: true
			});
		}
	</script>
	<div class="col-sm-12">
		<div id="map_div" style="width: auto; height: 300px"></div>
	</div>

</section>

<section class="ftco-gallery">
	<div class="container-wrap">
		<div class="row no-gutters">
			<div class="col-md-3 ftco-animate">
				<a href="images/.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(images/.jpg);">
					<div class="icon mb-4 d-flex align-items-center justify-content-center">
						<span class="icon-instagram"></span>
					</div>
				</a>
			</div>
			<div class="col-md-3 ftco-animate">
				<a href="images/.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(images/.jpg);">
					<div class="icon mb-4 d-flex align-items-center justify-content-center">
						<span class="icon-instagram"></span>
					</div>
				</a>
			</div>
			<div class="col-md-3 ftco-animate">
				<a href="images/.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(images/.jpg);">
					<div class="icon mb-4 d-flex align-items-center justify-content-center">
						<span class="icon-instagram"></span>
					</div>
				</a>
			</div>
			<div class="col-md-3 ftco-animate">
				<a href="images/.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(images/.jpg);">
					<div class="icon mb-4 d-flex align-items-center justify-content-center">
						<span class="icon-instagram"></span>
					</div>
				</a>
			</div>
		</div>
	</div>
</section>
<!-- Modal -->


<div class="modal fade" id="modal_schedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">create schedule</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?PHP echo $_SERVER['PHP_SELF'] ?>" method="post">

					<div class="button-group"><label for="schedule_date">Date</label>
						<input class="form-control" type="date" name="schedule_date">
					</div>
					<div class="button-group"><label for="schedule_title">Title</label>
						<input class="form-control" type="text" name="schedule_title">
					</div>
					<div class="button-group"><label for="schedule_content">Content</label>
						<textarea name="schedule_content" value="" cols="30" rows="10" id="editor-content"></textarea>
						<script>
							ClassicEditor
								.create(document.querySelector('#editor-content'))
								.catch(error => {
									console.error(error);
								});
						</script>
					</div>
					<div class="button-group"><label for="role_user">Discipline</label>
						<select name="schedule_discipline">
							<?php
							$query = "SELECT * from categoria";
							$query = mysqli_query($connection, $query);

							while ($row = mysqli_fetch_assoc($query)) {
								$cat_id = $row['cat_id'];
								$cat_title = $row['cat_title'];

							?>
								<option value="<?php echo $cat_id ?>"><?php echo $cat_title ?></option>

							<?php } ?>

						</select>
						<div class="button-group"><label for="schedule_topic">Topic</label>
							<textarea class="form-control" name="schedule_topic" id="editor-topic"></textarea>
							<script>
								ClassicEditor
									.create(document.querySelector('#editor-topic'))
									.catch(error => {
										console.error(error);
									});
							</script>
						</div>
					</div>
					<button name="add_schedule" type="submit" class="btn btn-primary">Add Schedule</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php include "include/footer.php"; ?>