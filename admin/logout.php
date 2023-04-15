<?php
setcookie("type", "", time() - 60, "/", "", 0);
setcookie("login", "", time() - 60, "/", "", 0);
?>
<script>
    window.location.href = '../admin/index.php';
</script>