<?php
declare(strict_types = 1);

$reportTo = [
	'group' => 'default',
	'max_age' => 60,
	'endpoints' => [
		[
			'url' => 'https://' . $_SERVER['HTTP_HOST'] . '/report.php',
		]
	],
	'include_subdomains' => true,
];
header('Report-To: ' . json_encode($reportTo, JSON_UNESCAPED_SLASHES));
?>

<button id="wheel">Add <code>onwheel</code> handler</button> and then use your mousewheel to scroll
<script>
document.getElementById('wheel').onclick = function() {
	window.addEventListener('wheel', function(event) {
		event.preventDefault();
		console.log('weee');
	});
}	
</script>
