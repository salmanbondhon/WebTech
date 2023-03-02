<?php
$nameErr = $emailErr = $degreeErr = $genderErr = $userErr = $passErr = $confrmPassErr = $dobErr = "";
$name = $email = $gender = $username = $password = $cnfrmPass = $dob = "";
$errCnt = 0;  
 $message = '';  
 $error = '';  
 if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["name"])) {
    $nameErr = "Name is required";
    $errCnt = $errCnt + 1;     
     } else {
         $name = check_input($_POST["name"]);
         $wcount = str_word_count($name);
         if ($wcount < 2 ) {
          $nameErr = "Minimum 2 words required";
          $errCnt = $errCnt + 1; 
          }

         if (!preg_match("/^[a-zA-Z]/", $name)) {
          $nameErr = "Name must start with a letter!";
          $errCnt = $errCnt + 1;    
         }

         if (!preg_match("/^[a-zA-Z_\-. ]*$/",$name)) {
           $nameErr = "Only letters, period and white space allowed";
           $errCnt = $errCnt + 1;   
         }   
    }

    if (empty($_POST["email"])) {
    $emailErr = "Email is required";
    $errCnt = $errCnt + 1;     
     } else {
         $email = check_input($_POST["email"]);
         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           $emailErr = "Invalid email format";
           $errCnt = $errCnt + 1;   
         }
     }


     if (empty($_POST["username"])) {
         $userErr = "Username is required";
         $errCnt = $errCnt + 1;     
       } else {
         $username = $_POST["username"];

         if (strlen($username) <2 ) {
          $userErr = "Minimum 2 characters required";
          $errCnt = $errCnt + 1;    
         }

         if (!preg_match("/^[a-zA-Z_\-.]*$/", $username)) {
          $userErr = "Username can contain alpha numeric characters, period, dash or underscore only!";
          $errCnt = $errCnt + 1;    
         }

       }


     if (empty($_POST["password"])) {
         $passErr = "Password is required";
         $errCnt = $errCnt + 1;     
       } else {

          $password = check_input($_POST["password"]);
          $cnfrmPass = check_input($_POST["cnfrmPass"]);

          if (empty($cnfrmPass)) {
             
               $confrmPassErr = "Confirm password is required";
              $errCnt = $errCnt + 1;  
          } else {
               if ($password != $cnfrmPass) {
                    
                    $confrmPassErr = "Confirm password is didn't match with password!";
                    $errCnt = $errCnt + 1;
               }
          }

     
          if (strlen($password) < 8 ) {
               $passErr = "Minimum 8 characters required";
              $errCnt = $errCnt + 1;    
              }

         if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[%$#@]).+$/", $password)) {
               $passErr .= " Password must contain atleast a digit, a lower case and an upper case letter, atleast one of the [%$#@] and no space.";
              $errCnt = $errCnt + 1;    
              }

          }

     if (empty($_POST["gender"])) {
         $genderErr = "Gender is required";
     $errCnt = $errCnt + 1;
     } else {
         $gender = check_input($_POST["gender"]);
     }

     if (empty($_POST["dob"])) {
         $dobErr = "Date of Birth is required";
         $errCnt = $errCnt + 1;
     } else {
         $dob = $_POST["dob"];
     }


      if($errCnt > 0) {
      echo "<span class='error'>Please enter valid Input...!</span>";
      } 
      else {
           if(file_exists('data.json'))  
           {  
                $current_data = file_get_contents('data.json');  
                $array_data = json_decode($current_data, true);  
                $new_data = array(  
                     'name'               =>     $_POST['name'],  
                     'e-mail'          =>     $_POST["email"],  
                     'username'     =>     $_POST["username"],
                     'password'     =>     $_POST["password"],
                     'gender'     =>     $_POST["gender"],
                     'dob'     =>     $_POST["dob"]  
                );  
                $array_data[] = $new_data;  
                $final_data = json_encode($array_data);  
                if(file_put_contents('data.json', $final_data))  
                {  
                     $message = "<p>Registration Success!</p>";
                    // <a href=""></a>
                }  
           }  
           else  
           {  
                $error = 'JSON File not exits';  
           }  
      }  
 }  
 function check_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>User Registration</title>
       <style>
        .error{
          color: red;
        }
       </style>
      </head>  
      <body>  
           <?php include 'Header.php';?>
           <br />  
           <div class="container" style="width:500px;">  
                <h3 >Registration </h3><br />
                <form method="post">  
                   
                     <br />  
                     <label>Name</label> 
                     <input type="text" name="name" class="form-control"  />
                      <span class="error">* <?php echo $nameErr;?></span> <br/><br>

                     <label>E-mail</label> 
                     <input type="text" name = "email" class="form-control"  />
                     <span class="error">* <?php echo $emailErr;?></span>
                     <br /><br>
                     <label>User Name</label>  
                     <input type="text" name = "username" class="form-control" />
                     <span class="error">* <?php echo $userErr;?></span>
                     <br /><br>
                     <label>Password</label>  
                     <input type="password" name = "password" class="form-control" />
                     <span class="error">* <?php echo $passErr;?></span>
                     <br /><br>
                     <label>Confirm Password</label>  
                     <input type="password" name = "cnfrmPass" class="form-control" />
                     <span class="error">* <?php echo $confrmPassErr;?></span>
                     <br /><br>

                    <label>Gender</label> 
                    <input type="radio" id="male" name="gender" value="male">
                     <label for="male">Male</label>                     
                     <input type="radio" id="female" name="gender" value="female">
                     <label for="female">Female</label>
                     <input type="radio" id="other" name="gender" value="other">
                     <label for="other">Other</label>
                     <span class="error">* <?php echo $genderErr;?></span>
                     <br><br>

                     <label>Date of Birth:</label> 
                     <input type="date" name="dob"> 
                     <span class="error">* <?php echo $dobErr;?></span>
                     <br><br>
                   
                     
                     <input type="submit" name="submit" value="Register" class="btn btn-info" /><br /> 
                      <?php  
                      if(isset($error))  
                     {  
                          echo $error;  
                     }  
                     ?>
                     <?php if(isset($message)){
                         echo $message;
                     } ?>
                   
                       
                      
                </form>  
           </div>  
           <br />  
           <?php include 'Footer.php';?>
      </body>  
 </html>  