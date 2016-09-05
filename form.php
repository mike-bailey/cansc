<?php
session_start();

if ($_SESSION["user"] == true) {
	echo "";
} else {
	die("Login first please.<script>document.location = 'index.php';</script>");
}
?>
<html>
	<head>
	<style>
	h1, h2, h3, .centered {
		text-align: center;
	}
	#notifications {
	    cursor: pointer;
	    position: fixed;
	    right: 0px;
	    z-index: 9999;
	    bottom: 0px;
	    margin-bottom: 22px;
	    margin-right: 15px;
	    max-width: 300px;   
	}
	.col-md-6 {
	    padding-left: 10px; 
	    padding-right: 10px;
	}
	</style>
		<script src="https://code.jquery.com/jquery-3.1.0.js" integrity="sha256-slogkvB1K3VOkzAI8QITxV3VzpOnkeNVsKvtkYLMjfk=" crossorigin="anonymous"></script>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
                <!-- Notify js -->
                <script src="js/notify.js"></script>
		<!-- submit fun -->
		<script src="js/submit.js"></script>
		<!-- Custom functions -->
		<script>
			function refreshChart() {
				$.get( "chart.php?interactive", function( data ) {
				  $( "#chart" ).html( data );
				});
			}
			function getAll() {
				$( "#dllink" ).html( "<br>Loading your PDF..." );
                                $.get( "getall.php", function( data ) {
                                  $( "#dllink" ).html( "<br>"+data );
                                });
                        }
                        function getAllNoNotes() {
                                $( "#dllink" ).html( "<br>Loading your PDF..." );
                                $.get( "getall.php?nonotes", function( data ) {
                                  $( "#dllink" ).html( "<br>"+data );
                                });
                        }
			function expand(div) {
				if ( div == 1 ) {
					$("form").css("display","");
				}
				if ( div == 2 ) {
                                	$("#chartfield").css("display","");
					$.get( "chart.php?interactive", function( data ) {
                                  		$( "#chart" ).html( data );
                                	});
                                }
				$("#expand"+div).html("<a href='javascript:unexpand("+div+")'>Unexpand</a>");
			}
                        function unexpand(div) {
                                if ( div == 1 ) {
                                $("form").css("display","none");
                                }
				if ( div == 2 ) {
                                $("#chartfield").css("display","none");
                                }
                                $("#expand"+div).html("<a href='javascript:expand("+div+")'>Expand</a>");
                        }
		</script>
	</head>

<body onload="refreshChart();">
<div id="notifications"></div>
<h1>Main Page</h1>
<h3>Submission Form</h3>
<div class="centered" id="expand1"><a href="javascript:expand(1)">Expand</a></div>
<div class="container-fluid" style="padding-top: 5%">
<div class="row">
<form action="submitchef.php" id="chefForm" style="display: none;">
<input type="text" value="" id="updateid" style="display: none;" hidden>
	<div class="col-md-6">
	  <div class="form-group">
	    <label for="name">Full Name</label>
	    <input type="text" class="form-control" id="name" placeholder="John Doe">
	  </div>
	  <div class="form-group">
	    <label for="business">Business</label>
	    <input type="text" class="form-control" id="business" placeholder="Crypsis Group">
	  </div>
	  <div class="form-group">
	    <label for="phone">Phone Number</label>
	    <input type="text" class="form-control" id="phone" placeholder="571341095" >
	  </div>
          <div class="form-group">
            <label for="website">Website</label>
            <input type="text" class="form-control" id="website" placeholder="http://michaelbailey.co" >
          </div>
          <div class="form-group">
            <label for="image">Image (URL, please)</label>
            <input type="text" class="form-control" id="image" placeholder="http://michaelbailey.co/img/dublife.jpg" >
          </div>
          <div class="form-group">
            <label for="fb">Facebook Username</label>
            <input type="text" class="form-control" id="fb" placeholder="" >
          </div>
          <div class="form-group">
            <label for="notes">Notes</label>
            <textarea class="form-control" id="notes" rows="2" placeholder="" ></textarea>
          </div>
     </div>
     <div class="col-md-6">
          <div class="form-group">
            <label for="snapchat">Snapchat Username</label>
            <input type="text" class="form-control" id="snapchat" placeholder="" >
          </div>
	  <div class="form-group">
            <label for="twitter">Twitter</label>
            <input type="text" class="form-control" id="twitter" placeholder="" >
          </div>
          <div class="form-group">
            <label for="insta">Instagram</label>
            <input type="text" class="form-control" id="insta" placeholder="" >
          </div>
          <div class="form-group">
            <label for="linkedin">LinkedIn</label>
            <input type="text" class="form-control" id="linkedin" placeholder="" >
          </div>
          <div class="form-group">
            <label for="story">Story</label>
            <textarea class="form-control" id="story" rows="4" placeholder="" ></textarea>
          </div>
		  <button onclick="refreshChart();" type="submit" class="btn btn-default">Submit</button>
                  <button type="button" onclick="reset();$('#cancelupdate').css('display','none');" class="btn btn-warning" id="cancelupdate" style="display: none;">Cancel Update</button>
		</form>
		</center>
	</div> 
</div>
<hr>
<h3>Current Data</h3>
<div class="centered" id="expand2"><a href="javascript:expand(2)">Expand</a></div>
<div id="chartfield" style="display: none;">
<div class="row">
	<div class="col-md-12">
		<br>
                <center><button class="btn btn-danger" onclick="getAll()">Download all as PDF</button>
                <button class="btn btn-danger" onclick="getAllNoNotes()">Download all w/o Notes as PDF</button>
		</center>

	</div>
</div>
<div class="row">
        <div class="col-md-12">
                <br>
                <center><button class="btn btn-default" onclick="refreshChart()">Refresh</button></center>
        </div>
</div>
<div class="row">
	<div class="col-md-12" style="text-align: center;">
		<div id="dllink">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div id="chart">
		</div>
	</div>
</div>
</div>
<script src="/js/jquery.simple.js"></script>
<script src="js/notify.js"></script>
<br><br>
</body>
</html>

