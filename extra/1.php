<!DOCTYPE html>
<html>
<head>
  <style>

  p { margin:0; color:blue; }
  div,p { margin-left:10px; }
  span { color:red; }
  </style>
  <script src="../js/jquery-1.7.1.min.js"></script>
</head>
<body>
  <p>Type 'correct' to validate.</p>
  <form action="javascript:alert('success!');">
    <div>
      <input type="text" />

      <input type="submit" />
    </div>
  </form>
  <span></span>
<script>

    $("form").submit(function() {
      if ($("input:first").val() == "correct") {
        $("span").text("Validated...").show();
        return true;
      }
      $("span").text("Not valid!").show().fadeOut(1000);
      return false;
    });
</script>

</body>
</html>