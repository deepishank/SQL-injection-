<?php
$otp=rand(00000,99999);
?>
<form action="otp.php" method="POST"> 
<input type="email" name="email" placeholder="Enter New Email" required>
<input type="hidden" name="otp" value="< ? php echo $otp;?>">
<button type="submit"> class="btn btn-primary btn-block"onclick="send_otp()">Send OTP</button>


</form>