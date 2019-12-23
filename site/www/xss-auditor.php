<?php
declare(strict_types = 1);

require __DIR__ . '/../shared/functions.php';

header("X-XSS-Protection: 1; report=" . \Can\Has\reportUrl());
echo $_GET['echo'] ?? $_POST['echo'] ?? '';
?>
<p><a href="?echo=<script>alert(1)</script>">Trigger the XSS Auditor (GET)</a></p>

<form action="xss-auditor.php" method="post">
	<input type="text" name="echo" value="<script>alert(1);</script>">
	<input type="submit" value="Trigger the XSS Auditor (POST)">
</form>
