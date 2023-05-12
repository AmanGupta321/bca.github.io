<!DOCTYPE html>
<html>
<head>
    <title>ADMIN LOGIN</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap">
    <link rel="stylesheet" href="../css/login.css?<?php echo time(); ?>">
</head>
<body>
    <!-- PHPWORKS START -->
    <?php
     
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
        $uname = $_POST['username'];
        $pwd = $_POST['password'];

          $servername = "localhost";
          $username = "root";
          $password = "";
          $database = "dbaman";
          $conn = mysqli_connect($servername, $username, $password, $database);
    
          if (!$conn)
        {
              die("Sorry we failed to connect: ". mysqli_connect_error());
        }
          else
        { 
              $sql =  "SELECT * FROM `admin`";
              $result = mysqli_query($conn, $sql);
              $num_rows = mysqli_num_rows($result);
              $f = false;
              if($num_rows>0)
            {
                  while($row = mysqli_fetch_assoc($result))
                {
                    if ($row['username']==$uname && password_verify($pwd, $row['password']))
                    {   
                        echo '<div style="font-weight: bold; font-size: 18pt; color: green; background-color: lightgreen; text-align: center;">LOGIN SUCCESSFULL</div>';
                        echo '<script type="text/javascript">let redirect_Page = () => {
                            let tID = setTimeout(function () {
                                window.location.href = "./adminnavigation.html";
                                window.clearTimeout(tID);
                            },2200);
                        }
                        redirect_Page();</script>';

                        $f = true;
                        break;
                        }
                        else{
                            $f = false;
                        }
                }
            }
            if ($f == false){
                echo '<div style="font-weight: bold; text-align: center; color: rgba(248, 46, 11); background-color: rgb(250, 151, 151); font-size: 15pt;">OOPS!!! No Record Found...<br><a href="../Contact.html" style="text-align: center; font-weight: bold; color: #287bff; font-size: 15pt;">Kindly Contact Admin to update the Database...</a></div>';
                }
        }
        }
    ?>
    <!-- PHPWORKS END -->



        <nav>
            <!-- vh -80 -->
            <div class="logo">
                <h1> G O L D E N<br>B A K E R Y</h1>
            </div>
            <div class="menu">
                <a href="../index.php">H o m e</a>
                <a href="../login.php">C u s t o m e r</a>
                <a href="../catalogue.html">C a t a l o g u e</a>
                <a href="../about.html">A b o u t</a>
                <a href="../contact.html">C o n t a c t</a>
            </div>
        </nav>


        <div class="main_div">
            <div class="box">
                <h1>Admin Login</h1>
                <form method = "POST">
                    <div class="inputBox">
                        <input type="text" name="username" autocomplete="off" required>
                        <label for="">Username</label>
                    </div>

                    <div class="inputBox">
                        <input type="Password" name="password" autocomplete="off" required>
                        <label for="">Password</label>
                    </div>

                    <input type="submit" class = "button" name="" value="Login">
   <!-- <input type="button" name='signup' class = "button" value="Signup" onclick="window.location.href = './register.php';">
    -->
                </form>
            </div>
        </div>
       
</body>
</html>