<html>
	<header>
		<?php 
			echo \Fuel\Core\Asset::js('jquery.wookmark.js'); 		
			echo \Fuel\Core\Asset::js('jquery-1.7.1.min.js'); 		
		?>
	</header>
	<body>
		<div id="container">
		<header>
	
		</header>
		<div id="main" role="main">
	
			<ul id="tiles">
				
			<?php for($ctr=0;$ctr<=10;$ctr++); ?>
				<li><img src="images/image_1.jpg" width="200" height="283"><p>1</p></li>
				<li><img src="images/image_2.jpg" width="200" height="300"><p>2</p></li>
				<li><img src="images/image_3.jpg" width="200" height="252"><p>3</p></li>
				<li><img src="images/image_4.jpg" width="200" height="158"><p>4</p></li>
				<li><img src="images/image_5.jpg" width="200" height="300"><p>5</p></li>
				<li><img src="images/image_6.jpg" width="200" height="297"><p>6</p></li>
				<li><img src="images/image_7.jpg" width="200" height="200"><p>7</p></li>
				<li><img src="images/image_8.jpg" width="200" height="200"><p>8</p></li>
				<li><img src="images/image_9.jpg" width="200" height="398"><p>9</p></li>
				<li><img src="images/image_10.jpg" width="200" height="267"><p>10</p></li>
				<li><img src="images/image_1.jpg" width="200" height="283"><p>11</p></li>
				<li><img src="images/image_2.jpg" width="200" height="300"><p>12</p></li>
				<li><img src="images/image_3.jpg" width="200" height="252"><p>13</p></li>
				<li><img src="images/image_4.jpg" width="200" height="158"><p>14</p></li>
				<li><img src="images/image_5.jpg" width="200" height="300"><p>15</p></li>
				<li><img src="images/image_6.jpg" width="200" height="297"><p>16</p></li>
				<li><img src="images/image_7.jpg" width="200" height="200"><p>17</p></li>
				<li><img src="images/image_8.jpg" width="200" height="200"><p>18</p></li>
				<li><img src="images/image_9.jpg" width="200" height="398"><p>19</p></li>
				<li><img src="images/image_10.jpg" width="200" height="267"><p>20</p></li>
				<li><img src="images/image_1.jpg" width="200" height="283"><p>21</p></li>
				<li><img src="images/image_2.jpg" width="200" height="300"><p>22</p></li>
				<li><img src="images/image_3.jpg" width="200" height="252"><p>23</p></li>
				<li><img src="images/image_4.jpg" width="200" height="158"><p>24</p></li>
				<li><img src="images/image_5.jpg" width="200" height="300"><p>25</p></li>
				<li><img src="images/image_6.jpg" width="200" height="297"><p>26</p></li>
				<li><img src="images/image_7.jpg" width="200" height="200"><p>27</p></li>
				<li><img src="images/image_8.jpg" width="200" height="200"><p>28</p></li>
				<li><img src="images/image_9.jpg" width="200" height="398"><p>29</p></li>
				<li><img src="images/image_10.jpg" width="200" height="267"><p>30</p></li>
			<?php endfor; ?>

			</ul>
			
		</div>
		</div>
		
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
          loadData();
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
   /* function loadData() {
      isLoading = true;
      $('#loaderCircle').show();
      
      $.ajax({
        url: apiURL,
        dataType: 'jsonp',
        data: {page: page}, // Page parameter to make sure we load new data
        success: onLoadData
      });
    };*/
    
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
      loadData();
    });
  </script>

  
 
	</body>
	<footer>
	</footer>

	
</html>