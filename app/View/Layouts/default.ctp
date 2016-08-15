<?php
$carnetizeTitle = __d('carnetize_dev', 'Carnetize - ');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $carnetizeTitle ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');
		$css = array();

		// Normalize css
		// array_push($css,'/resources/library-vendor/normalize/normalize.css');

		//  Bootstrap, Bootstrap Vertical tabs, style BS Vertical
		//  array_push($scripts,'//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css');
		array_push($css,'http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz');
		array_push($css,'/resources/library-vendor/bootstrap/css/bootstrap.min.css');
		array_push($css,'/resources/library-vendor/bootstrap/css/bootstrap.vertical-tabs.min.css');
		array_push($css,'/resources/library-vendor/bootstrap/css/tabs.sideways.css');

		//  font-awesome
		//  array_push($scripts,'//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css');
		array_push($css,'/resources/library-vendor/font-awesome/css/font-awesome.min.css');

		// Color Picker
		array_push($css,'/resources/library-vendor/color_picker/jquery-ui.css');
		array_push($css,'/resources/library-vendor/color_picker/evol.colorpicker.css');

		// Font Selector
		array_push($css,'/resources/library-vendor/font_selectors/fontselector.css');

		// Jquery Custom ScrollBar
		array_push($css,'/resources/library-vendor/jquery.mCustomScrollbar/jquery.mCustomScrollbar.css');

		// Pnotify CSS
		array_push($css,'/resources/library-vendor/pnotify/pnotify.custom.min.css');

		// My Custom CSS
       	array_push($css,'/resources/app/css/carnetize.css');

		echo $this->Html->css($css);

		echo $this->fetch('css');

		$scripts = array();

		//  jQuery - https://github.com/jquery/jquery, jquery-ui
		//  array_push($scripts,'https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js');
		array_push($scripts,'/resources/library-vendor/jquery/jquery.min.js');
		array_push($scripts,'/resources/library-vendor/jquery.ui/jquery-ui.js');

		//  Bootstrap - https://github.com/twbs/bootstrap
		//  array_push($scripts,'//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js');
		array_push($scripts,'/resources/library-vendor/bootstrap/js/bootstrap.min.js');

		// Jquery DataTables, BootStrap DataTables
		array_push($scripts,'/resources/library-vendor/datatables/jquery.dataTables-cust.js');
		array_push($scripts,'/resources/library-vendor/datatables/DT_bootstrap.js');

		// Jquery Custom ScrollBar
		array_push($scripts,'/resources/library-vendor/jquery.mCustomScrollbar/jquery.mCustomScrollbar.js');

		// Evol Color Picker
		array_push($scripts,'/resources/library-vendor/color_picker/evol.colorpicker.js');

		// Font Selector
		array_push($scripts,'/resources/library-vendor/font_selectors/jquery.fontselector.js');

		// Jquery Validate JS
		array_push($scripts,'/resources/library-vendor/jquery-validate/jquery.validate.min.js');
		array_push($scripts,'/resources/library-vendor/jquery-validate/additional-methods.js');

		// Pnotify JS
		array_push($scripts,'/resources/library-vendor/pnotify/pnotify.custom.min.js');
		array_push($scripts,'/resources/library-vendor/pnotify/pnotify.confirm.js');

		// Kinetic HTML5 Canvas
		array_push($scripts,'/resources/library-vendor/kinetic/kinetic.min.js');

		// App
		// array_push($scripts,'/resources/app/js/base.js');
		array_push($scripts,'/resources/app/js/carnetize.js');
		array_push($scripts,'/resources/app/js/carnetize.load.js');
		array_push($scripts,'/resources/app/js/carnetize.connections.js');
		array_push($scripts,'/resources/app/js/carnetize.users.js');

		echo $this->Html->script($scripts);

		echo $this->fetch('script');

	?>
</head>
<body>
	<div id="container">
		<div id="content">

			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Session->flash('auth'); ?>
			<!--nocache-->
			<?php echo $this->fetch('content'); ?>
			<!--/nocache-->
		</div>
	</div>
</body>
</html>
<script charset="utf-8">
<?php $this->Js->writeBuffer(); ?>
<?php $this->Js->get('#authMessage'); ?>
<?php echo $this->Js->effect('fadeIn', array('speed' => 'slow')); ?>
setTimeout(function(){
	<?php echo $this->Js->effect('fadeOut'); ?>
}, 2000)
</script>
