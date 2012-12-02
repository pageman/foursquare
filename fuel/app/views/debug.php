<?php 
    $venue = sq4hack\sq4hack::puke_recommends('11.8494,121.8862');
?>
<pre>
    <?php 
        print_r($venue);
    ?>
</pre>
<script>
    if(navigator.geolocation)
    {
  navigator.geolocation.getCurrentPosition(function(position)
    {
      var lat = position.coords.latitude;
      var lng = position.coords.longitude;
      alert(lat);
      alert(lng);
    });
    }
</script>