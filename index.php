<?php
//登入頁�
// Start the session
session_name('homework');
session_start();
?>
<form name="form1" method="post" action="check.php" >
請輸入學號: <br> <input name="MyHead">

<br>

<form name="form2" method="post" action="check.php" >
請輸入密碼: <br> <input name="password">

<br>
<br>
<input type="submit" value="登入">
</form>
