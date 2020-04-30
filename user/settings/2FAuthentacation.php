<?php 
include($_SERVER['DOCUMENT_ROOT']."/auth/auth.php");
include(_DIR_CLASS."/googlelib/GoogleAuthenticator.php");
include(ROOT."/auth/auth.php");
$current_user = current_user();
$QRcode       = new GoogleAuthenticator();
$username     = ($current_user['username']);
$password     = hashes($current_user['password'],'decrypt');
$email        = ($current_user['email']);
$CSRF_TOKEN   = $_SESSION['CSRF_TOKEN'];

function getSecretKey(){
  $QRcode       = new GoogleAuthenticator();
  if (!isset($_SESSION['SecretKey'])) {
    //echo $QRcode->createSecret();
    $_SESSION['SecretKey'] = $QRcode->createSecret();
  }
  return $_SESSION['SecretKey'];
}

$createSecret = getSecretKey();
$url          = $QRcode->getQRCodeGoogleUrl('CyberSec CTF', $createSecret, $username);
$getCode      = $QRcode->getCode($createSecret);
$svg          = $QRcode->SVG($url);

echo $createSecret;
if (isset($_POST['submit'])) {
$code         = $_POST['code'];
$c_password   = $_POST['confirm_password'];
$secretKey    = $_POST['secretKey'];
$secret       = $_POST['secret'];
echo $secretKey;
echo "<br>";
echo $secret;
echo "<br>";
echo $createSecret;
//exit;
  if ($CSRF_TOKEN == $_POST['CSRF_TOKEN']) {
    if ($password != $c_password) {
      echo "<script>alert('Your password is not match, Please try to enter again')</script>";
      //echo permission_denined('Error!','Your password is not match, Please try to enter again.',400);
    }
    elseif ($secretKey != $secret) {
      echo "<script>alert('Your secret key is $secretKey\n$secret, Please try to enter again.')</script>";
      //echo permission_denined('Error!','Your secret key is not match, Please try to enter again.',400);
    }
    elseif ($getCode != $code) {
      //echo "Your code incorrect or expired, Please try to enter again.";
      echo "<script>alert('Your code incorrect or expired, Please try to enter again.')</script>";
      //echo permission_denined('Error!','Your code incorrect or expired, Please try to enter again.',400);
    }else{
      //update status to on
      query("INSERT INTO google_auth(email,username,secretKey,status) VALUES ('$email','$username','$createSecret','ON')");
    }
  }else{
    echo permission_denined('Error!','sorry you\'re unauthorized to perform an action.',400);
  }
}

?>
<!DOCTYPE html>
<html>
<head>
  <title> PH Capture the Flag Website for Pentesters | Basic Challenges | All Web CTF Problems  </title>
  <?php 
    include(ROOT.'includes/navigation.php'); 
  ?>
      <style type="text/css">
#profile{
  height: 100%;
}
.img-profile{

}
.response-img{
  height: 100px;
  width: 100px;
  border-radius: 50%;
}
.edit-profile{
  padding-left: 0px;
  padding-top: 30px;
}
.info{
  float: right;
  width: 80%;
}
.update{
  float: right;
}
a{
  color:#fff;
}
a:hover{
  color:#fff;
}
#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
      </style>
<!--/.Navbar -->

      <main>
        <div class="container"> 
          <section>
            <div class="row mt-5">
              <?php include("settings.php"); ?>
              <div class="col-lg-8 col-md-12">
                <div class="row">
                  <div class="col-md-12">
                    <div id="profile" class="card special-color-dark white-text text-left note note-danger">
                      <div class="card-header">
                        <p>Two Factor Authentacation</p>
                      </div>
                      <div class="card-body">
                        <form action="" method="POST">
                          <div class="row">
                            <div class="tab col-md-12">
                              <div class="row container">
                                <h6 class="cart-title"><b>Enable Two-Factor Authentacation</b></h6>
                                <p class="card-text white-text">
                                  Make sure you have TOTP/RFC-6238 compatible with application, 
                                  such as <a href="" class="text-primary">Google Authentacator</a> or <a href="" class="text-primary">Duo mobile</a>.
                                </p>
                                <p class="card-text white-text">For Browsers you need to install the <a href="" class="text-primary">Authentacator Extention</a> in your chrome browsers, if you don't have Phone or make accessable for Pc's and laptop</p> 
                              </div>
                              <hr class="my-3 success-color">
                              <div class="row container">
                                <p class="card-text white-text">
                                  Open you application and select "add account" or "+" and scan the QR-Code below.
                                </p>
                                <div class="form-group" style="display: block;margin-left: auto;margin-right: auto;width: 35%;">
                                  <?php echo $svg; ?>
                                  <!--svg xmlns="http://www.w3.org/2000/svg"  
                                    xmlns:xlink="http://www.w3.org/1999/xlink"  
                                    width="200"  
                                    height="200"  
                                    id="QRCode"  
                                    version="1.1">  
                                    <image width="200" height="200"  
                                    xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAADICAIAAAAiOjnJAAAABmJLR0QA/wD/AP+gvaeTAAAFKUlEQVR4nO3d0W4bNxCG0bro+79yelHAKARlsRTno+TgnMtY1q7gH8SIGc5+/fr16y+Y9ve7b4A/k2CRECwSgkVCsEgIFol/nv7r19fXmcs/bHYMXvf6na83WZZuY+kjLF1358Xv+gt+s2KRECwSgkVCsEg8L94fDP5/4rHy/PpC15Xv0ufdqdavXzx4k+f/glYsEoJFQrBICBaJW8X7g52N6R1dT+LSLvbObQx+d9m5qwN/QSsWCcEiIVgkBIvEK8V7Z2czfbCm3tm1vzbYY/PhrFgkBIuEYJEQLBKfVbwPNoxf6yruB0ufaOlLw4ezYpEQLBKCRUKwSLxSvHc7wh9yfvV6I36wqeZYu86DA3v6ViwSgkVCsEgIFolbxfuxPd/BYnanWn/Xd4gl3fycEVYsEoJFQrBICBaJrx/dWP1/x47RHju/+qMb5K1YJASLhGCRECwSt+a8f9qu7n+Wdt4fdK3o3VDGz5wRb847RwkWCcEiIVgkbu28D9byx56ddO1DCuHB3p4l3d/omxWLhGCRECwSgkViftrMzuHPwQsde+Lo4IWO7fh3j476ZsUiIVgkBIuEYJF45Qmr3aDzY9XrsUEugx/h2DOqRlixSAgWCcEiIVgkXpk20zVsDO6eD3a1L73z4IWODb0pbsOKRUKwSAgWCcEiMbDzvuRDHrS0o2vM7z5+17z0O1YsEoJFQrBICBaJ5wdWj01QeTDYVNN9Szh2V8fa9nfoeecowSIhWCQEi8St4v3BsSmMXRv7sfOrS9f9EcNnbrJikRAsEoJFQrBIvNI2s2Sw5Lz+3e4851I93n3AbmDn0l3dfCsrFgnBIiFYJASLxMCoyMGBKjvl+VKN2e1xd/vj145NjrzJikVCsEgIFgnBIvG8eO96P7rmlqXrXv/uoMFnNi1d6NqBKZtWLBKCRUKwSAgWiYFRkd34w+5Cx4bPLL24Oy4wOKHTE1Z5J8EiIVgkBIvE6QOr1281eJ5z6a4GT3sONuS8q5a/pnjnnQSLhGCRECwSt9pmjvVv7DjWGPOuan3JgccwXbNikRAsEoJFQrBIPC/euy6LbvxhN9dl6UKf+UjVJSOnFqxYJASLhGCRECwS8wdWr33I6PbBjekfsXt+fuq9FYuEYJEQLBKCRWLgwOqDnV3sY1vPS+88+GVl8LrvOnN78yNYsUgIFgnBIiFYJG61zZw/7vjCi3d+d2ef+ljb/tKLu4/vwCrvJFgkBIuEYJF4ZdrMg/MtGXeue30bXSfM4OCapQu9q7lezztHCRYJwSIhWCRutc28a+f9wc6W9+BDU6/vasngjv/OYPeCFYuEYJEQLBKCReJW8X5tcDj79U+70TTvmgK/8+Lr390x8mXFikVCsEgIFgnBIvG8beZdus30wSesHqv0l3xapW/FIiFYJASLhGCReGXO+6CuX6Wb5H794p3vH4MF+OCAoNc+oBWLhGCRECwSgkXilZ73HYMd4juWnkM0+M4PfsRp3tdYsUgIFgnBIiFYJF7peT82fWXnnbub3KnHu0H2XcvNa6W9FYuEYJEQLBKCRWLgwGqnK5O7YZCDhfDg94BjYzW/WbFICBYJwSIhWCQ+q3jvNqYH37krk6/tVOvHHtb6zYpFQrBICBYJwSLxSvH+rgE1g5vp3Yt37OzaL02Bv37npZ/+jhWLhGCRECwSgkXiVvF+bPjMZz7L9Pq63dNouzH3B543a8UiIVgkBIuEYJH4rDnv/DGsWCQEi4RgkRAsEoJFQrBICBaJfwGByanQaB9e6wAAAABJRU5ErkJggg=="/>
                                  </svg-->                          
                                </div>
                              </div>
                              <hr class="my-3 success-color">
                              <div class="row container">
                                <p class="card-text white-text">
                                  Enter your Secret key if you are unable to scan the QR code
                                </p>
                                <div class="form-group col-sm-12">
                                  <input type="text" name="secret" value="<?php echo $createSecret; ?>" class="form-control" readonly="true" style="background: transparent;color:#fff;border:1px solid rgba(0,0,0,.125);">
                                  </div>
                              </div>
                            </div>
                            <div class="tab col-md-12">
                              <p class="card-text white-text">
                                To Enable the Two-Factor Authentacation you most be enter the following
                              </p>
                              <?php //echo get_msg(); ?>
                              <hr class="my-3 success-color">
                              <div class="row">
                                <div class="form-group col-sm-12">
                                  <input type="password" class="form-control" value="<?php echo $password ?>" placeholder="Your password" name="confirm_password">
                                </div>
                              </div>
                              <hr class="my-3 success-color">
                              <div class="row">
                                <div class="form-group col-sm-12">
                                  <input type="text" class="form-control col-sm-12" value="<?php echo $createSecret ?>" placeholder="Your Secret Key" name="secretKey">
                                </div>
                              </div>
                              <hr class="my-3 success-color">
                              <div class="row">
                                <div class="form-group col-sm-12">
                                  <input type="text" class="form-control" value="<?php echo $getCode ?>" placeholder="Your 6 Digit Code" name="code">
                                </div>
                              </div>
                              <hr class="my-3 success-color">
                            </div>
                          </div>
                          <input type="hidden" name="CSRF_TOKEN" value="<?php echo $CSRF_TOKEN; ?>">
                          <div class="float-right" style="margin-top: 10px;">
                            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                            <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                            <button type="submit" id="submit" name="submit">Save</button>
                          </div>
                        </form>
                      </div>
                    </div>
                    <br/>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </main>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab

function showTab(n) {
  document.getElementById("submit").style.display = "none";
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  if (n == (x.length - 1)) {
    document.getElementById("submit").style.display = "inline";
    document.getElementById("nextBtn").style.display = "none";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  //if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>
  <?php 
    include(ROOT.'includes/footer.php'); 
  ?>

  </body>
</html>