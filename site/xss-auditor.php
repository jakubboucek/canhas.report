<?php
declare(strict_types = 1);

header("X-XSS-Protection: 1; report=/report.php");
echo $_GET['echo'] ?? $_POST['echo'] ?? '';
?>
<p><a href="?echo=<script>alert(1)</script>">Trigger the XSS Auditor (GET)</a></p>

<form action="xss-auditor.php" method="post">
	<input type="text" name="echo" value="<script>alert(1);</script>">
	<input type="submit" value="Trigger the XSS Auditor (POST)">
</form>
