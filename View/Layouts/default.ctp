<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html ng-app="myApp">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('app.generic');

        echo $this->Html->script('lib/jquery-2.1.1.min');
        echo $this->Html->script('lib/bootstrap.min');

        echo $this->Html->script('lib/angular');
        echo $this->Html->script('lib/angular-route.min');
        echo $this->Html->script('app');
        echo $this->Html->script('controllers');
	?>
</head>
<body ng-controller="AppCtrl">
	<div id="container">
		<div id="content">
            <div class='wrapper'>
                <?php echo $this->fetch('content'); ?>
            </div>
		</div>
	</div>
</body>
</html>
