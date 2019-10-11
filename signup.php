<?php include_once("./chunks/head.php") ?>

<section id="logo-main">
	<div class="row text-center">
		<div class="col-12 m-auto" style="padding: 20px; border-bottom: 2px solid #e5e8e9;"><a href="./">
			<img width="200" height="60" src="./images/logo.png" alt="" style="background: black;"></a>
		</div>
	</div>


		<div class="row">
			<div class="col-4 m-auto text-center">
				<p style="color: black; padding: 20px;"><strong>Sign up with your email address</strong></p>
                
                <?php
                if (isset($_SESSION['msg'])) {
                    echo '<div class="alert alert-danger" role="alert" style="border-radius: 0;">
                      '.$_SESSION['msg'].'
                    </div>';
                    unset($_SESSION['msg']);
                }
                
                ?>

				<form action="./backend/signup-db.php" method="post" id="signup-form">

						<div class="form-group">
                            <div class="form-input-bg">
                                <input type="name" name="name" class="form-control" id="inputName" placeholder="Name">
                            </div>
                        </div>
					
                        <div class="form-group">
                            <div class="form-input-bg">
                                <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Email address">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-input-bg">
                                <input type="password" name="password" class="form-control" id="inputPassword44" placeholder="Password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-input-bg">
                                <input type="number" name="number" class="form-control" id="inputNumber44" placeholder="Number">
                            </div>
                        </div>

                        <div class="form-group text-left">
                            <label for="gender" style="color: black;">Gender</label>
                            <div class="form-input-bg">
                                <select id="gender" class="form-control" name="gender">
                                    <option>-- Select --</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Not Listed">Not Listed</option>
                                </select>
                            </div>
                        </div>

			            <div style="padding-top: 20px;">
			            	<small style="color: black; font-size: 12px;">By clicking on Sign up, you agree to Spotify's Terms and Conditions of Use.<br><br>To learn more about how Spotify collects, uses, shares and protects your personal data please read Spotify's Privacy Policy.</small>
			            </div>
			            <div class="guest-content" style="padding: 30px 0px;">
			                <a href="#" onclick="document.getElementById('signup-form').submit();" style="width: 70%">Sign Up</a>
			            </div>

			            <div>
			            	<p style="color: black;">Already have an account ? <a href="./login.php"><span style="color: green;">Log In</span></a></p>
			            </div>

                </form>
			</div>
	</div>
</section>



<?php include_once("./chunks/bottom.php") ?>