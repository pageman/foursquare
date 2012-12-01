<?php 
    $photos = sq4hack\sq4hack::puke_group_photos('43695300f964a5208c291fe3',1,0);
?>
<pre>
    <?php 
        print_r($photos);
        print Fuel\Core\Asset::img($photos[0]['avatar']);
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