<?php 
$con=mysqli_connect('localhost','root','test');
echo $email=$_POST['email'];
$res=mysqli_query($con,"select * from users where email='$email'");
$connect=mysqli_num_rows($res);
if($count>0){
    echo "yes"
} else {
    echo"No";
}
?>