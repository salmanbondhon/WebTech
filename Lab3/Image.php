<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
      <?php

       if(isset($_POST['submit'])){

              $fileName = $_FILES['fileName']['name'];
              $tmp_loc = $_FILES['fileName']['tmp_name'];
              $uploadLoc = 'uploads/';

              if(!empty($fileName) ){
                     move_uploaded_file($tmp_loc, $uploadLoc.$fileName);
                     echo "file uploaded successfully";
              }
              else{
                     echo"select an image";
              }

       }
       ?>
       <h2>Profile Picture Upload</h2>
       <form method="post" action="" enctype="multipart/form-data">
              Select an Image
              <input type="file" name="fileName">  <br><br>
              <input type="submit" name="submit">
       </form>

</body>
</html>