<?php
// Use in the "Post-Receive URLs" section of your GitHub repo.

	shell_exec( 'git reset --hard HEAD && git pull && find . -type f -exec chmod 0644 {} && find . -type d -exec chmod 0755 {}' );
	// && find . -type f -exec chmod 0644 {} && find . -type d -exec chmod 0755 {}
?>