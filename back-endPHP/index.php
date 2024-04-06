<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/style.css" />
    <title>Header Example</title>
  </head>
  <body>
    <div class="wrapper">
      <div class="container">
        <div class="header">
          <div class="logo">
            <img src="./assets/img/logo.png" alt="logo" />
          </div>
          <div class="user-info">
            <div class="info">
              <p class="name-by">Handicrafted by</p>
              <p class="name">Jim HLS</p>
            </div>
            <img src="./assets/img/avatar.png" alt="Avatar" />
          </div>
        </div>
      </div>
      <div class="slider-bar">
        <div class="info-slider">
          <h1 class="title">A joke a day keeps the doctor away</h1>
          <small class="context"
            >If you joke wrong way, your teeth have to pay. (Serious)</small
          >
        </div>
      </div>
      <div class="container">
        <div class="content">
            <?php include 'show_and_review.php'; ?>
        </div>
      </div>

      <div class="footer">
        <div class="description">
          <p>
            This website is created as part of Hlsolutions program. The
            materials contained on this website are provided for general
          </p>
          <p>
            information only and do not constitute any form of advice. HLS
            assumes no responsibility for the accuracy of any particular
            statement and
          </p>
          <p>
            accepts no liability for any loss or damage which may arise from
            reliance on the information contained on this site.
          </p>
          <div class="author">
            <p>Copyright 2021 HLS</p>
          </div>
        </div>
      </div>
    </div>

<script>
function recordVote(jokeId, vote) {
    // Gửi yêu cầu ghi vote đến server bằng AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "record_vote.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText); // Log response from server
            // Reload the page to show updated content (you can use other methods to update content without reloading)
            location.reload();
        }
    };
    xhr.send("jokeId=" + jokeId + "&vote=" + vote);
}
</script>
  </body>
</html>
