<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $this->Html->meta('icon'); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	<link rel="icon" href="<?php echo full_url(); ?>/img/hec-logo-icon.png">
	<title><?php echo $title_for_layout; ?> &mdash; Hotel Ezra Cornell 87</title>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile.structure-1.0.min.css" type="text/css" media="screen" charset="utf-8" /> 
	<?php echo $this->Html->css("application"); ?>
	<link rel="apple-touch-icon" href="img/hec-logo-icon.png" />
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script> 
	<?php echo $this->Html->script("application"); ?>
	<?php echo $scripts_for_layout; ?>
	<script src="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-22375846-2']);
		_gaq.push(['_trackPageview']);

		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
</head>
<body>
	<div data-role="page" data-theme="a">
		<div id="branding">
		    <!--<h1>The Hotel Ezra Cornell</h1>
		    <p>Showcasing Hospitality Education Through Student Leadership</p>-->
			<?php 
				echo $this->Html->link(
					$this->Html->image(
						'the_hec_logo.png',
						array(
							'alt' => "The Hotel Ezra Cornell",
							'id' => 'logo'
						)
					),
					"/",
					array('escape' => false)
				); 
			?>
		</div>
		<div data-role="header">
			<?php 
			if(isset($prevpage_for_layout)):
				echo $this->Html->link(
						human($prevpage_for_layout['title']), 
						$prevpage_for_layout['routing'], 
						array(
							"data-icon" => "arrow-l",
							"data-direction" => "reverse"
						)
				);
			endif;
			?>
			<a href="<?php echo $this->Html->url('/'); ?>" data-icon="home" data-direction="reverse" data-iconpos="notext" class="ui-btn-right">Home</a>
		    <h1><?php echo $title_for_layout; ?></h1>
		</div>
		<div data-role="content" id="<?php echo $this->params['controller'] ?>">
			<?php $flash = $this->Session->flash(); ?>
			<?php if($flash != ""): ?><div data-role="header">
				<?php echo $flash; ?>
			</div><?php endif; ?>
			<?php echo $content_for_layout; ?>
			<div id="user_status">
				<?php 
					if(AuthComponent::user('id') > 0){ 
						echo "Logged in as ". AuthComponent::user('name') . ". " . 
							$this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); 
					}else{ 
						echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login')); 
					} 
				?>
			</div>
			<?php $this->element('sql_dump'); ?>
		</div>
		<div data-role="footer">
			<h4>&copy; 2012 Hotel Ezra Cornell. <?php echo $this->Html->link('Contact', array('controller' => 'pages', 'action' => 'contact')); ?>.</h4>
		</div><!-- /footer -->
		<?php $this->element('sql_dump'); ?>
	</div>
</body>
</html>
