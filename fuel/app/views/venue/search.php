

<?php
	$ctr = 1;
	if(isset($post))
	{
		$location = $post;
		$section = $post_section;
	}
	else
	{
		$location = null;
		$section  = null;
		$post 	  = null;
	}
?>


<html>
	<header class="bar-title"> 
	<h2 class="title">4square Search </h2>
	</header>
	<body>
	
	<h2>Search Venue</h2>
		
	<section>	
		<div class='input-group'> <?php echo \Fuel\Core\form::open('4square/search_venue') ?>
		 <?php echo \Fuel\Core\form::input('location',$post) ?>
		 <?php echo \Fuel\Core\form::select('section',$section,array(
												'food'=>'food',
												'coffee'=>'coffee',
												'drinks'=>'drinks',
												'shops'=>'shops',
												'arts'=>'arts',
												'outdoors'=>'outdoors',
												'sights'=>'sights',
												'trending '=>'trending',
												'specials '=>'specials',
												));
		echo \Fuel\Core\form::submit('search','Search',array('class'=>'button-main'));
		?> 										
		</div>
		<div> <?php  ?> </div>
		</div>
		<div> <?php echo \Fuel\Core\form::close() ?> </div>
	</section>
	<section>
		

		<?php if(isset($venue->response->groups)): ?>
		<ul class="list">
		<?php	
			foreach($venue->response->groups as $groups):
			
				foreach($groups->items as $items):
				
					echo '<h2>'.$items->venue->name.'</h2>';
					
					if(isset($items->venue->location->address)):
						echo "<li>".$items->venue->location->address."</li>";
					endif;
					
					if(isset($items->venue->location->city)):
						echo "<li>".$items->venue->location->city."</li>";
					endif;
					
					if(isset($items->venue->contact->phone)):
						echo '<li>Contact: '.$items->venue->contact->phone."</li>";
					endif;
					
					if(isset($items->venue->stats->checkinsCount)):
						echo '<li> Checkin count: '.$items->venue->stats->checkinsCount."</li>";
					endif;
					
				endforeach;
			endforeach;
		?>	
		</ul>
		<?php endif; ?> 
	</section>
	</body>
</html>