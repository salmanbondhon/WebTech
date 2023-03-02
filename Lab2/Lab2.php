<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php

$nameErr= $nameErr2 = $emailErr = $genderErr = $dobErr = $degreeErr = "";
$name = $email = $gender = $dob = $degree = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
      $nameErr = "Name is required";
    } else {
      $name = ($_POST["name"]);
      $wcount = str_word_count($name);
      if($wcount<2){
          $nameErr="Minimum 2 words required";
      }
     if (!preg_match("/[a-zA-Z]/",$name))
      {
        $nameErr = "Must start with a letter";
      }
    
      if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
        $nameErr = "Only letters and white space allowed";
      }
    }
  
    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
    } else {
      $email = ($_POST["email"]);
  
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
      }
    }

    if (empty($_POST["gender"])) {
      $genderErr = "Gender is required";
    } else {
      $gender = ($_POST["gender"]);
    }

    if (empty($_POST["degree"])) {
      $degreeErr = "Degree is required";
    } else {
      $degree = ($_POST["degree"]);
    }

}
?>
<h2>PHP Form Validation Example</h2>
<p><span class="error">* Required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Date of Birth:
  <input type="date" name="date" value="<?php echo $d;?>"> 
  <!-- <span class="error">* <?php echo $dobErr;?></span>  -->
  <br /><br>
  Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <input type="radio" name="gender" value="other">Other
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  Degree:
  <input type="checkbox" name="ssc" value="ssc">SSC  
  <input type="checkbox" name="hsc" value="hsc">HSC  
  <input type="checkbox" name="bsc" value="bsc">BSC  
  <input type="checkbox" name="msc" value="msc">MSC 
  <span class="error">* <?php echo $degreeErr;?></span>
 <br><br>
  Blood Group:
  <select name="bg" id="bg">
    <option value="O+">O+</option>
    <option value="B+">B+</option>
    <option value="A+">A+</option>
    <option value="AB+">AB+</option>
  </select>
 
<br><br>

  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $dob ;
echo "<br>";
echo $gender;
?>

</body>
</html>