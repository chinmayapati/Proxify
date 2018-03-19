<script>
    function updateURL(baseurl) {
        var a = document.getElementsByTagName("a");
        var baseLength = window.location.href.length;
        for (var i = 4; i < a.length; i++) {
            a[i].href = baseurl + a[i].href.substr(baseLength);
            console.log(a[i].href);
        }
    }
</script>

<?php

include "Proxify.class.php";

$site = new Proxify("http://localhost/test/");
$sitedata = $site->fetchURL();

print_r($sitedata["content"]);

echo "<script>updateURL('$site->url');</script>";

?>