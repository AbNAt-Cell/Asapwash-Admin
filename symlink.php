<?php
$target = '/home/u890683004/domains/asapwash.cloud/public_html/public/upload';
$link = '/home/u890683004/domains/asapwash.cloud/public_html/upload';

if (symlink($target, $link)) {
    echo "Symlink created successfully!";
} else {
    echo "Failed to create symlink.";
}
?>