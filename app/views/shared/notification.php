<!-- Notifications -->
<div class="alert alert-<?php echo $type; ?>">
	<?php
	
	if (is_object($message)) {
		// MessageBag
		$messages = $message->all();
		foreach ($messages as $key=>$msg) {
			echo $msg.'<br />';
		}
	} else {
		echo $message;
	}
	?>
	<span onclick="javascript:$(this).parent().hide()"></span>
</div>