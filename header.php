<div id="header">
			<div id="logo" onClick="window.location='./';">Политех.Контест</div>
			<div id="menu">
				<?php
				// не показывать меню без авторизации
				 if (isset($_SESSION['userid'])) {
			 	?>
			 		<div id="menuButton"><a href="./">Задачи</a></div>
				 	<div id="menuButton"><a href="./attempts.php">Посылки</a></div>
					<div id="menuButton"><a href="./monitor.php">Монитор</a></div>
					<div id="menuButton"><a href="./help.php">Справка</a></div>
					<div id="menuButton"><a href="./logout.php">Выход</a></div>
				<?php } ?>
				
				<!-- <div id="menuButton">Задать вопрос</div> -->
			</div>
</div>