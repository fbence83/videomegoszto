<DOCTYPE! html>
<html lang="hu">
<head>
    <link rel=stylesheet type="text/css" href="navbars.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel=stylesheet type="text/css" href="megoszt.css" />
    <link rel=stylesheet type="text/css" href="lists.css" />
    <link rel=stylesheet type="text/css" href="videos.css" />
    <link rel=stylesheet type="text/css" href="user.css" />
    <title>Videomegoszto</title>
</head>
<body>

<div class="homepage-header">
		
		<div class="logo">
		    <a href ="index.php" >
		    <img src="kamera.jpg" style="width:40px;height:40px;"></a>
		</div>
		<div class = "navbar-right">
            <?php
                if(isset($_SESSION["user"])){ ?>
                    <form action="index.php" method="post">
                        <button type="submit" name="logout_button" style="width:auto; display: block">Log Out</button>
                    </form>
                <?php }else{ ?>
                    <button onclick="document.getElementById('id01').style.display='block'"  style="width:auto;">Login</button>
                    <button onclick="document.getElementById('id02').style.display='block'"  style="width:auto;">Register</button>
                <?php } ?>
		</div>
	</div>
	<div id="id01" class="modal">
  
		<form class="modal-content animate" method="POST" action="index.php">

			<div class="felugro">
                <label for="uname"><b>Username</b></label>
				<input type="text" placeholder="Enter Username" name="uname" required>
				<label for="psw"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="psw" required>
				<button type="submit" id="login" name="login_button" class="loginbutton">Login</button>
			</div>

			<div class="felugro" style="background-color:#f1f1f1">
				<button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn1">Cancel</button>
				<span class="psw">Forgot <a href="#">password?</a></span>
			</div>
		</form>
	</div>
	
	<div id="id02" class="modal1">
		
		<form class="felugro-content animate" method = "POST" action="index.php">
			<div class="felugro2">
			<h2>Sign up!</h2>
                <label for ="username"><b>Username</b></label>
				<input type="text" placeholder="Enter Username" name="username" required>
				<label for ="pass"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="pass" required>
				<label for ="passa"><b>Password Again</b></label>
				<input type="password" placeholder="Enter Password Again" name="passa" required>
				<label for ="email"><b>Email</b></label>
				<input type="text" placeholder="Enter Your E-mail" name="email" required>
				<label for ="gender"><b>Gender</b></label>
				<input type="radio" name="gender" value="Férfi">Male
				<input type="radio" name ="gender" value="Nő">Female <br>
				<label for ="bday"><b>Birthday</b></label>
				<input type="date" name="bday">
			</div>
			
			<div class="felugro2" style = "background-color:#f1f1f1">
				<button type="submit" name="registration" class="signupbtn">Sign Up</button>
				<button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
			</div>
			
		</form>
	
	</div>

    <div>