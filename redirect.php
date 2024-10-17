<?php
if(isset($_POST['facebook'])) {
    header("Location: https://www.facebook.com");
    exit();
} elseif(isset($_POST['whatsapp'])) {
    header("Location: https://web.whatsapp.com");
    exit();
} elseif(isset($_POST['twitter'])) {
    header("Location: https://twitter.com");
    exit();
}
?>
