<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('default.css');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body style="padding-top: 70px">
	<div id="container">
		<div id="header" class="m-0 p-0">
			<nav class="navbar navbar-expand-sm navbar-dark bg-primary fixed-top">
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item nav-link active">
							<?php echo $this->Html->link(
								'ユーザー管理',
								[
									'controller' => 'members',
									'action' => 'index'
								]
							); ?>
						</li>
						<li class="nav-item nav-link">
							<?php echo $this->Html->link(
								'席決めアプリ',
								[
									'controller' => 'members',
									'action' => 'select'
								]
							); ?>
						</li>
					</ul>
					<?php if ($auth): ?>
						<ul class="navbar-nav">
							<li class="nav-item">
								<?php echo $this->Html->link(
									'ログアウト',
									[
										'controller' => 'users',
										'action' => 'logout'
									]
								); ?>
							</li>
						</ul>
					<?php else: ?>
						<ul class="navbar-nav">
							<li class="nav-item">
								<?php echo $this->Html->link(
									'ログイン',
									[
										'controller' => 'users',
										'action' => 'login'
									]
								); ?>
							</li>
						</ul>
					<?php endif; ?>
				</div>
			</nav>
		</div>

		<div id="content">

			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php //echo $this->Html->link(
					//$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					//'https://cakephp.org/',
					//array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
				//);
			?>
			<p>
				<?php //echo $cakeVersion; ?>
			</p>
		</div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
