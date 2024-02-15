<?php
    $conn = mysqli_connect('localhost', 'test', '1234', 'test');
    $sql = "SELECT path FROM record where rid = ".$_GET["rid"];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    
    $path = $row['path'];
?>

<!DOCTYPE html>
<html>
  <head>
    <style>
      body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        padding: 0;
      }

      video {
        width: 100%;
        max-width: 800px;
        height: auto;
      }
    </style>
  </head>
  <body>
    <video class="video/mp4" autoplay controls>
      <source type="video/mp4" src="<?php echo $path ?>">
    </video>
  </body>
</html>