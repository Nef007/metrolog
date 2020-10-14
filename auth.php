<div id="auth">
<link type="text/css" rel="stylesheet" href="/css/main.css" />
	<h1>Авторизация</h1>


	<!-- Тут думать -->
	<?php if ($message_bad){?> <div class="massage_bad"> <a  href="#" id="main">
	<div id="okno"><?=$message_bad?></div>
	</a></div><?php } ?> 
	<?php if ($message_good){?> <div class="massage_good"> <a href="#" id="main">
	<div id="okno" class="message_good"><?=$message_good?></div>
	</a></div><?php } ?> 

	<form name="auth" action="index.php" method="post">
		<div>
			<label>Логин:</label> <input type="text" name="login" />
		</div>
		<div>
			<label>Пароль:</label> <input type="password" name="password" />
		</div>
		<div>
			<input type="submit" name="auth" value="Войти" />
		</div>
	</form>
</div>


	
