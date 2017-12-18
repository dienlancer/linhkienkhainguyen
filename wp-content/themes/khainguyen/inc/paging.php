<?php function paging($wp_query, $page_, $posts_per_page_, $request_key='page', $mysql=false) {
		$query_string = $_SERVER['QUERY_STRING'];
		$query_string = preg_replace("/&$request_key=\\d*|^$request_key=\\d*/", "", $query_string);
		// $query_string = preg_replace("/?q=\/chuyen-muc\/[^&]*&/", "", $query_string);

		global $wpdb;
		if ($mysql) {
			if ($rs = $wpdb->get_results($wp_query)) {
				$num_posts = count($rs);
			} else {
				$num_posts = 0;
			}
		} else {
		 	$posts = new wp_query($wp_query);
			$num_posts = $posts->post_count;
		}

		$num_pages = ceil($num_posts / $posts_per_page_);
		if ($num_pages == 0) $num_pages = 1;

		$start_page = $page_ - 2;
		$end_page = $page_ + 2;
		if ($start_page < 1) $end_page += 1 - $start_page;
		if ($end_page > $num_pages) {
			$start_page -= $end_page - $num_pages;
			$end_page = $num_pages;
		}

		if ($start_page < 1) $start_page = 1;
		if ($page_ == 1) { 
?>

	<li class="disabled"><a class="page">&laquo;&laquo;</a></li>
	<li class="disabled"><a class="page page-separator-left">&laquo;</a></li>

<?php 	} else { ?>

	<li><a href="?<?php echo $query_string; ?>&<?php echo $request_key ?>=1" class="page">&laquo;&laquo;</a></li>
	<li><a href="?<?php echo $query_string; ?>&<?php echo $request_key ?>=<?php echo $page_-1; ?>" class="page page-separator-left">&laquo;</a></li>

<?php	}
		
		for ($i=$start_page; $i<=$end_page; $i++) { ?>
		
			<li class="<?php if ($i==$page_) echo "active"; ?>"><a <?php if ($i!=$page_) echo 'href="?'.$query_string.'&'.$request_key.'='.$i.'"'; ?> class="page <?php if ($i==$page_) echo "active"; ?>"><?php echo $i; ?><?php if ($i==$page_) echo '<span class="sr-only">(current)</span>'; ?></a></li>

<?php	} 

		if ($page_ == $num_pages) { ?>

	<li class="disabled"><a class="page page-separator-right">&raquo;</a></li>
	<li class="disabled"><a class="page">&raquo;&raquo;</a></li>

<?php 	} else { ?>

	<li><a href="?<?php echo $query_string; ?>&<?php echo $request_key ?>=<?php echo $page_+1; ?>" class="page page-separator-right">&raquo;</a></li>
	<li><a href="?<?php echo $query_string; ?>&<?php echo $request_key ?>=<?php echo $end_page; ?>" class="page">&raquo;&raquo;</a></li>

<?php 	}
} 

function admin_pagination($wp_query, $page_, $posts_per_page_, $request_key='page', $mysql=false) {
		$query_string = $_SERVER['QUERY_STRING'];
		$query_string = preg_replace("/&$request_key=\\d*|^$request_key=\\d*/", "", $query_string);
		global $wpdb;
		if ($mysql) {
			if ($rs = $wpdb->get_results($wp_query)) {
				$num_posts = count($rs);
			} else {
				$num_posts = 0;
			}
		} else {
		 	$posts = new wp_query($wp_query);
			$num_posts = $posts->post_count;
		}

		$num_pages = ceil($num_posts / $posts_per_page_);
		if ($num_pages == 0) $num_pages = 1;
?>
	<div class="tablenav bottom">
		<div class="tablenav-pages">
			<span class="displaying-num"><?php echo $num_posts ?> items</span>
			<span class="pagination-links">
				<a class="first-page disabled" title="Go to the first page" href="?<?php echo $query_string; ?>&<?php echo $request_key ?>=1">&laquo;</a>
				<a class="prev-page disabled" title="Go to the previous page" href="?<?php echo $query_string; ?>&<?php echo $request_key ?>=<?php echo max(1, $page_-1); ?>">&lsaquo;</a>
				<span class="paging-input"><?php echo $page_ ?> of <span class="total-pages"><?php echo $num_pages ?></span></span>
				<a class="next-page" title="Go to the next page" href="?<?php echo $query_string; ?>&<?php echo $request_key ?>=<?php echo min($num_pages, $page_+1); ?>">&rsaquo;</a>
				<a class="last-page" title="Go to the last page" href="?<?php echo $query_string; ?>&<?php echo $request_key ?>=<?php echo $num_pages; ?>">&raquo;</a>
			</span>
		</div>
	</div>
<?php
}
?>