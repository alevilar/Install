<style>
.columns-3 {
	-webkit-column-count: 3; /* Chrome, Safari, Opera */
    -moz-column-count: 3; /* Firefox */
    column-count: 3;
}
</style>


<div class="columns-3">
<?php

function loopAndEcho ( $confgs) {
	foreach ($confgs as $k=>$val) {
		if ( is_array($val) ) {
			echo "<h3>$k</h3>";
			loopAndEcho($val);
		} else {
			?>
			<b><?php echo $k?>:</b> <?php echo $val?><br>
			<?php
		}
	}
}

loopAndEcho($configurations);

?>
</div>