<?php
/*session_start();*/

require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

/*mysqli_select_db($conn,'publications');*/


if (isset($_POST['username']))
    $username = sanitizeString($_POST['username']);
if (isset($_POST['password']))
    $password = sanitizeString($_POST['password']);
if (isset($_POST['name']))
    $name = sanitizeString($_POST['name']);
if (isset($_POST['gender']))
    $gender = sanitizeString($_POST['gender']);
if (isset($_POST['phone_number']))
    $phone_number = sanitizeString($_POST['phone_number']);
if (isset($_POST['email']))
    $email = sanitizeString($_POST['email']);


error_reporting(0);




$query = ("SELECT * FROM stu_marks WHERE ('$password' = password) AND ('$username' = username)");
$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);

$rows = mysqli_num_rows($result);

if ($rows == 1){
    echo "username already already exists";
}
    
else{
   $register = "INSERT INTO `stu_marks` (`name`, `phone_number`, `email`, `username`, `password`, `id`) VALUES ('$name', '$phone_number', '$email', '$username', '$password', NULL)";
    mysqli_query($conn, $register);
    echo "registration successful";
}
    


 echo <<<_END
 <html>
    <head>
        <title>Register credentialsa</title>
        <style>
            *{
                box-sizing: border-box;
                background: #42455a;
            }
            .Main-Form {
                    background: white;
                    max-width: 45%;
                    padding: 15px;
                    margin: auto;
                    height:auto;
                    margin-top: 100px;
                    
              }
            .title{
                font-size: 18px;
                transform:uppercase;
                text-align: center;
                padding: 4px;
                background: #42455a;
                color: #ccc;
                /*height: 80px;*/
            }
            input[type=text]{
                 width: 70%;
                 max-height: auto;
                 padding: 5px;
                 border-radius: none;
                font-size: 20px;
                background:#fff;
                margin-left: 70px;
                
            }
            .Main-Form label {
                 font-size: 20px;
                margin-left: 70px;
    
                color: black; 
                 background:#fff;
            }
            .submit {
                background:#171a14;
                font-size: 25px;
                font-weight: bold;
                color: ccc;
                text-align: center;
                width: 53%;
                margin-top: 10px;
                margin-left: 125px;
                margin-bottom: 20px;
                
            }
            .submit:hover {
                background-color: #142507;
                cursor: pointer;
            }
            .Main-Form select{
                margin-left: 70px;
                background: #fff;
                font-size: 15px;
                color: black;
            }
                
            
        </style>
    </head>
    <body>
    <form class="Main-Form" method = "post" action = "RegisterForm.php">
          <div class="title">
           <h2>Registration Form</h2>
          </div><br>
        <label>Name & Surname</label><br><input type="text" name="name"  placeholder="name & surname"><br><br>
        <select name="gender" size = "1">
            <option value="male">male</option>
            <option value="female">female</option>
        </select><br><br>
        <label>Phone Number</label><br><input type="text" name="phone_number" placeholder="phone number"><br><br>
        <label>Email </label><br><input type="text" name="email" placeholder="email address"><br><br>
        <label>username </label><br><input type="text" name="username" placeholder="username"><br><br>
        <label>Password</label><br><input type="text" name="password" placeholder="password"><br><br>
        <input type="submit" class="submit" name="submit" value="submit">
    </form>
    </body>
</html>
_END;

if (empty($username))
    echo "fill up username";

function sanitizeString($var)
{
$var = stripslashes($var);
$var = strip_tags($var);
$var = htmlentities($var);
return $var;
}

function sanitizeMySQL($connection, $var)
{
$var = $connection->real_escape_string($var);
$var = sanitizeString($var);
return $var;
}
?>