<?php
declare(strict_types = 1);

require __DIR__ . '/functions.php';

header('Public-Key-Pins: pin-sha256="ljbKIGOBhWbHsgr5ieSGoUd5dbvm3/lQE3wKBs5p6ys="; pin-sha256="WilSR+KkE5qbh2xuw/lwFUDs67VGvP8LX1Tt5zAfp7I="; max-age=600; includeSubDomains; report-uri="' . \Can\Has\reportUrl() . '"');
?>
HPKP response header is deprecated and ingored in Chrome now.
