<?php
// Disable HTTP caching
header("Expires: Thu, 19 Nov 1969 08:52:00 GMT"); // Past date
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false); // HTTP/1.1 (IE-specific)
header("Pragma: no-cache"); // HTTP/1.0
?>

let status = localStorage.getItem("redirectUrl");
const redirect = document.getElementById('redirectUrl');


redirect.href = status;


localStorage.removeItem("redirectUrl");