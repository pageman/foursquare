<?php
	$ctr = 1;
	if(isset($post))
	{
	
	}
	else
	{
		$post 	  = null;
	}
?>


<html>
	<h2> 4square Search </h2>
	<section>
		<div> Search User </div>
	</section>	
	<section>	
		<div> <?php echo \Fuel\Core\form::open('4square/search_user') ?></div>
		<div> <?php echo \Fuel\Core\form::input('name',$post) ?> </div>
		
		<div> <?php echo \Fuel\Core\form::submit('search','Search') ?> </div>
		</div>
		<div> <?php echo \Fuel\Core\form::close() ?> </div>
	</section>
	<section>
		<?php
	
		if(isset($user))
		{
			foreach($user->response->results as $results)
			{
				echo '<h2>'.$results->firstName.'</h2>';
				echo $results->homeCity.'<br>';
				echo $results->gender;
			}
		}	
				

		?>
	</section>
</html>