<?php 
require_once "config.php";
require_once "session.php";

$error = '';
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if(empty($email)){
        $error .= '<p class="error">Please enter email. </p>';
    }
    if(empty($password)){
        $error .= '<p class="error">Please enter password. </p>';
    }

    if(empty($error)){
        if($query = $db->prepare("SELECT * FROM student_board WHERE email = student_email")){
          $statement = $login->prepare($query);
          $statement -> execute(
            array(
              'email' => $_POST["email"],
              'password' => $_POST["password"]
            )
            );
            $count = $statement -> rowCount();
            if($count > 0){
              $_SESSION['student_email'] = $_POST["email"];
              header("location:welcome.php");
            }else{
              $message = '<label>Username or password is wrong</label>';
            }
            /*$query->bind_param('s', $email);
            $query->execute();
            $row = $query->fetch();
            if($row){
                if(password_verify($password, $row['password'])){
                    $_SESSION["student_id"] = $row['id'];
                    $_SESSION["user"] = $row;
                    header("location: welcome.php");
                    exit;
                }else{
                    $error .= '<p class="error">The password is not valid.</p>';
                }
            }else{
                $error .= '<p class="error">No user exists with that email address.</p>';
            }*/
        }
        //$query->close();
    }
    //mysqli_close($db);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <link href="login.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form>
    <img class="mb-4" src="khaslogo.jpg"alt="" width="100" height="100">
    <h1 class="h3 mb-3 fw-normal">Please login</h1>

    <div class="form-floating">
      <input type="email" class="form-control" id="email" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="password" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
  </form>
</main>


    
  </body>
</html>
