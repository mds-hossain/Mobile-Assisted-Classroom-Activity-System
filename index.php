<?php
//    echo "hello";
	session_start();

?>
<html>
<head>

  <!-- Styles -->
  

  <script src="js/modernizr-2.7.1.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="/css/bootstrap/bootstrap.min.css" rel="stylesheet" />
	<link href="/css/index.css" rel="stylesheet" />
	<script src="/js/jquery.min.js"></script>

  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/animate.css">
  <link href='http://fonts.googleapis.com/css?family=Dr+Sugiyama|Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>


    <link href="css/style.css" rel='stylesheet' type='text/css' /><!-- custom css -->
    <link href="css/font-awesome.min.css" rel="stylesheet"><!-- fontawesome css -->


  

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
	<script>
		function loginTeacher(){
			$.ajax({
				url: 'teacher/login.php',
				datatype: 'text',
				type: 'post',
				data: {
					'userName': $("#inputUser").val(),
					'password': $("#inputPassword").val()
				},
				success: function(data){
					if (data == 1){
						window.location.href= "teacher/teacher.php";
					}else if (data == 0){
						$('#alert').html('Wrong Username or Password').removeProp('hidden');
					}
					else
						$('#alert').html('Internal Error Occured').removeProp('hidden');
				}
			});
		}
		$(document).ready(function(){
			$('.form-signin').submit(function(e){
				e.preventDefault();
			})
		});
	</script>
</head>
<body>

                    <a class="navbar-brand" href="index.php"><img src="img/macas-logo-header-tr.png" alt="Logo" width="250" height="50" style="padding-left: 50px;"></a>

        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
      
            <li><a href="index.php">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="index.php/register">Create Account</a></li>
          </ul>
        </div><!--/.navbar-collapse -->
      </div>
    </div>

    <!--Header-->
    <section id="header" style = "background: #0B2955">
<img class="macas" src="img/macas-mac-white.png" alt="Header Image">
      <div class="container" style="margin-right:90px">
        <div class="row header-text">
          <div class="col-sm-8 pull-right text-right">
           <div class="margin-100">
            <h1>Meet MACAS</h1>
            <h3> Mobile Assisted Classroom Activity System <strong></h3>
            <h3> It is <strong><em>absolutely free</em></strong> too!</h3>
           </div>
     
            <a href="/index.php/teacher" class="btn btn-primary btn-lg">Teacher Log In <i class=""></i></a> &nbsp;&nbsp;
            <a href="/index.php/stud" class="btn btn-primary btn-lg">Student Log In <i class=""></i></a>
          </div>
     

          
            
     
        </div>
        
      </div>

</section>


  <section id="main2">
      <div class="container">
        <div class="row">
          
          <div class="col-sm-6 wow fadeInUpBig">
            <img class="main2-img pull-left" src="img/main2.png" alt="Main2 Image">
          </div>
        
          <div class="col-sm-6 margin-30">
            <h2>Available across all devices</h2><br />
            <p> To facilitate teaching and active learning, Mobile Assisted Classroom Activity System (MACAS) is introduced to support popular class activities in classroom lectures at University of Macau. </p><br />

<p>The system provides a single convenient platform for both teachers and students – for the teacher to prepare class activities, to conduct them, and to archive the feedbacks; and for the student to learn from and interact with teacher and peers with the help of a mobile device. </p><br/>
            
            <br/>
            <a href="#" class="btn btn-secondary btn-lg"> Click to know more <i class=""></i></a>
          </div>

        </div>
      </div>
    </section>
    
<div class="banner" id="home">
	<div class="container">
		<div class="row banner-text">
			<div class="slider-info col-lg-6">
				<div class="banner-info-grid mt-lg-5">
					<h2> A unique way of classroom teaching </h2>
					<p> MACAS is here to make the classroom teaching more effective and result oriented where</p>
                                        <h3> Learning is <strong><em> Fun !</em></strong></h3><br/>
				</div>
		
                                  <a class="btn text-capitalize" href="#popup1"onclick="window.location.href = 'https://www.youtube.com';" target="_blank"> watch video </a>
                       
			</div>
		
			<div class="col-lg-6 col-md-8 mt-lg-0 mt-sm-5 mt-3 banner-image text-lg-center">
				<img src="images/bannerpng.png" alt="" class="img-fluid"/>
			</div>
		</div>
	</div>
</div>

    <footer>
      <div class="container">
        <div class="row">
          <div class="col-sm-12 text-center">
            <p><small>Copyright &copy; MACAS, 2019. All rights reserved.</small></p>
          </div>
        </div>
      </div>
    </footer>

 <!-- Javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-2.1.0.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/main.js"></script>
    
    <script>
      new WOW().init();
    </script>

<style>
.navigation-bar ul {
  padding: 0px;
  margin: 0px;
  text-align: center;
  display:inline-block;
  vertical-align:top;
}

.macas{
height: 500;
width: 800;
margin-right: 900px;
margin-top: 60px;
position:absolute;
}
</style>
        
</body>
</html>



