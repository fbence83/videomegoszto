<DOCTYPE! html>
<html lang="hu">
<head>
    <link rel=stylesheet type="text/css" href="css/navbars.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel=stylesheet type="text/css" href="css/megoszt.css" />
    <link rel=stylesheet type="text/css" href="css/lists.css" />
    <link rel=stylesheet type="text/css" href="css/videos.css" />
    <link rel=stylesheet type="text/css" href="css/user.css" />
    <title>Videomegoszto</title>
</head>
<body>
<script>
    function showHint(str) {
        if (str.length == 0) {
            document.getElementById("txtHint").innerHTML = "";
            document.getElementById("what").style.display = 'none';
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("what").style.display = 'block';
                    var x = this.responseText;
                    var szavak = x.split(",");
                    var mennyi = szavak.length;

                    text = "<ul>";
                    for (i = 0; i < mennyi; i++) {
                        text += "<li>" + "<a href =\"videos.php?id=" + szavak[i] + "\"" +   ">" + szavak[i] + "</a>" + "</li>";
                    }
                    text += "</ul>";
                    document.getElementById("txtHint").innerHTML = text;

                }
            };
            xmlhttp.open("GET", "talalatok.php?q=" + str, true);
            xmlhttp.send();
        }
    }
</script>
<div class="homepage-header">
		
		<div class="logo">
		    <a href ="index.php" >
		    <img src="img/kamera.jpg" style="width:40px;height:40px;"></a>
		</div>
        <div class="searchbar">
            <form class="search-bar" action="/action_page.php" style="margin:auto;max-width:800px">
                <input type="text" onkeyup="showHint(this.value)" placeholder="Search.." name="search2">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>

        <div class="forsearch" id="what" >
            <p id="txtHint"></p>
        </div>

		<div class = "navbar-right">
            <?php
                $fioknev = $_SESSION["user"][0];
                if(isset($_SESSION["user"])){ ?>
                    <a href="user.php?id=<?php echo $fioknev; ?>">Fiókom</a>
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