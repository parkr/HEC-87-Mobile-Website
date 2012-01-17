<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php echo $this->Html->meta('icon'); ?>
	<title><?php echo $title_for_layout; ?> &mdash; Hotel Ezra Cornell 87</title>
	<link rel="stylesheet" href="css/application.css" type="text/css" media="screen" charset="utf-8">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile.structure-1.0.min.css" /> 
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
	<div id="banner"></div>
	<div id="content">
		<?php echo $this->Session->flash(); ?>
		<?php echo $content_for_layout; ?>
	</div>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>