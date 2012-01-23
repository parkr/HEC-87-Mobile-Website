<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $this->Html->meta('icon'); ?>
	<link rel="icon" href="<?php echo full_url(); ?>/img/hec-logo-icon.png">
	<title><?php echo $title_for_layout; ?> &mdash; Hotel Ezra Cornell 87</title>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile.structure-1.0.min.css" type="text/css" media="screen" charset="utf-8" /> 
	<?php echo $this->Html->css("application"); ?>
	<link rel="apple-touch-icon" href="img/hec-logo-icon.png" />
<?php echo $scripts_for_layout; ?>
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script> 
	<script src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>
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
		    <h1>The Hotel Ezra Cornell</h1>
		    <p>Showcasing Hospitality Education Through Student Leadership</p>
		</div>
		<div data-role="header">
			<a href="<?php echo full_url(); ?>" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-left jqm-home">Home</a>
		    <h1><?php echo $title_for_layout; ?></h1>
		</div>
		<div data-role="content">
			<?php $flash = $this->Session->flash(); ?>
			<?php if($flash != ""): ?><div data-role="header">
				<?php echo $flash; ?>
			</div><?php endif; ?>
			<?php echo $content_for_layout; ?>
		</div>
		<div data-role="footer">
			<h4>&copy; 2012 Hotel Ezra Cornell. <?php echo $this->Html->link('Contact HEC', array('controller' => 'pages', 'action' => 'contact')); ?></h4>
		</div><!-- /footer -->
		<?php $this->element('sql_dump'); ?>
	</div>
</body>
</html>
