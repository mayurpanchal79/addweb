<?php

namespace WPMailSMTP\Vendor;

// Don't redefine the functions if included multiple times.
if (!\function_exists('WPMailSMTP\\Vendor\\GuzzleHttp\\Psr7\\str')) {
    include __DIR__ . '/functions.php';
}
