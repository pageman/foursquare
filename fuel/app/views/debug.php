<?php 
    $venue = sq4hack\sq4hack::puke_recommends('14.558294,121.0185087');
    $venue_photos = sq4hack\sq4hack::puke_group_photos('43695300f964a5208c291fe3');
?>
<pre>
    <?php 
        print_r($venue_photos);
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