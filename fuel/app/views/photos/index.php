<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>jQuery Wookmark Plug-in API Example</title>
  <meta name="description" content="An very basic example of how to use the Wookmark jQuery plug-in.">
  <meta name="author" content="Christoph Ono">

  <meta name="viewport" content="width=device-width,initial-scale=1">

 <?php 

 echo \Fuel\Core\Asset::js('jquery-1.7.1.min.js');
 echo \Fuel\Core\Asset::js('jquery.wookmark.js');
// echo \Fuel\Core\Asset::css('ratchet.css'); 
 //echo \Fuel\Core\Asset::css('reset.css');
 echo \Fuel\Core\Asset::css('style.css');
 echo \Fuel\Core\Asset::css('bootstrap.min.css');

  ?>
  
</head>

<body>

		<div id="container">
		<div class="content" role="main">
		<div>
		
		<?php
		
		?>
		<div class="btn-toolbar" style="margin:0;">
              <div class="btn-group">
                <button class="btn dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
					<ul class="dropdown-menu" id="venueList">

					<!-- li><a href="#">Action</a></li-->
					<!-- li><a href="javascript:void()" onClick="photo('bbb')">aaaa</a></li -->
					</ul>
				<!--<a class="btn btn-primary" value='Search' style='height:20px;'>Search</a>-->
              </div><!-- /btn-group -->
			  
			
		</div>
			<!--<input type="text" placeholder="location" style='width:80%;' id='tags'>-->
			
		
	</div>
      <ul id="tiles">
        <!-- These is where we place content loaded from the Wookmark API -->
      </ul>

      <div id="loader">
        <div id="loaderCircle"></div>
      </div>
	  
	  <div id="photo">
		<div id="photolist"></div>
	  </div>
    
    </div>
      
    <footer>

    </footer>
  </div>

  <!-- include jQuery -->
 
  <script type='text/javascript'>
	  $('body')
		  .on('touchstart.dropdown', '.dropdown-menu', function (e) { e.stopPropagation(); })
		  .on('touchstart.dropdown', '.dropdown-submenu', function (e) { e.preventDefault(); });
  var lat;
  var lng;
  
	function photo(venue_id){
		$('#tiles').children("li").remove();
		console.log(venue_id);
		
		$.ajax({
			type: "POST",
			data: "id="+venue_id,
			url: "/ajax/venues/photos",
			success: function(data){
				console.log(data);
				
				// encode to JS object
				var photos =	JSON.parse(data)
				
				// show the photos
				
				var html = "";
				for(var i in photos){
				
					console.log(photos[i].url);
					html += '<li><img src='+photos[i].url+' width="200" height="269"></img></li>';
					//html += "<li>"+photos[i].name+"</li>";
console.log(photos[i].name)					
				}
				
				// Add image HTML to the page.
				$('#tiles').append(html);
				
				// Apply layout.
				applyLayout();
			}
		});	
	}
	
  
  
  // get lat,lng using HTML5 GeoLocation API
  $(document).ready(function(){
	
	if (navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(showPosition);
	}
	else
	{
		x.innerHTML="Geolocation is not supported by this browser.";
	}
	
	function showPosition(position)
	{
		lat = position.coords.latitude
		lng = position.coords.longitude
		
		$.ajax({
			type: "POST",
			data: "lat="+lat+"&lng="+lng,
			url: "/ajax/venues/recomends",
			success: function(data){
				console.log(data);
				
				// encode to JS object
				venue =	JSON.parse(data)
				//console.log(venue)
				
				// put JS object to Dropdown list
				for(var i in venue){
					$('#venueList').append('<li><a href="javascript:void()" id="'+venue[i].id+'">'+venue[i].name+'</a></li>');

					$('#'+venue[i].id).click(function(){
						photo(venue[i].id);
					});
				}
				
			}
		});	
	}
	
	
  });
  
		
  </script>
  
  <!-- Once the page is loaded, initalize the plug-in. -->
  <script type="text/javascript">
    var handler = null;
    var page = 1;
    var isLoading = false;
    var apiURL = 'http://www.wookmark.com/api/json/popular'
    
    // Prepare layout options.
    var options = {
      autoResize: true, // This will auto-update the layout when the browser window is resized.
      container: $('#tiles'), // Optional, used for some extra CSS styling
      offset: 2, // Optional, the distance between grid items
      itemWidth: 210 // Optional, the width of a grid item
    };
    
    /**
     * When scrolled all the way to the bottom, add more tiles.
     */
    function onScroll(event) {
      // Only check when we're not still waiting for data.
      if(!isLoading) {
        // Check if we're within 100 pixels of the bottom edge of the broser window.
        var closeToBottom = ($(window).scrollTop() + $(window).height() > $(document).height() - 100);
        if(closeToBottom) {
          //loadData();
        }
      }
    };
    
    /**
     * Refreshes the layout.
     */
    function applyLayout() {
      // Clear our previous layout handler.
      if(handler) handler.wookmarkClear();
      
      // Create a new layout handler.
      handler = $('#tiles li');
      handler.wookmark(options);
    };
    
    /**
     * Loads data from the API.
     */
    function loadData() {
      isLoading = true;
      $('#loaderCircle').show();
      
      $.ajax({
        url: apiURL,
        dataType: 'jsonp',
        data: {page: page}, // Page parameter to make sure we load new data
        success: onLoadData
      });
    };
    
    /**
     * Receives data from the API, creates HTML for images and updates the layout
     */
    function onLoadData(data) {
      isLoading = false;
      $('#loaderCircle').hide();
      
      // Increment page index for future calls.
      page++;
      
      // Create HTML for the images.
      var html = '';
      var i=0, length=data.length, image;
      for(; i<length; i++) {
        image = data[i];
        html += '<li>';
        
        // Image tag (preview in Wookmark are 200px wide, so we calculate the height based on that).
        html += '<img src="'+image.preview+'" width="200" height="'+Math.round(image.height/image.width*200)+'">';
        
        // Image title.
        html += '<p>'+image.title+'</p>';
        
        html += '</li>';
      }
      
      // Add image HTML to the page.
      $('#tiles').append(html);
      
      // Apply layout.
      applyLayout();
    };
  
    $(document).ready(new function() {
      // Capture scroll event.
      $(document).bind('scroll', onScroll);
      
      // Load first data from the API.
     // loadData();
    });
  </script>

	
   <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>

    <script src="http://twitter.github.com/bootstrap/assets/js/google-code-prettify/prettify.js"></script>
    <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-dropdown.js"></script>
	
</body>
</html>
