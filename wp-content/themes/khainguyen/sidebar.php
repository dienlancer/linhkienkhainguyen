<div class="col-lg-3 hidden-xs hidden-sm hidden-md">
<form method="POST" id="Form_loc" action="http://linhkienkhainguyen.com/chuyen-muc/san-pham-moi/">
	<div class="groups-sp-sidebar">
		<div class="title-sidebar">
			LỌC SẢN PHẨM
		</div>
		<div class="filter-sidebar">			
			<?php
				$re = array();
				if (isset($_POST['Filter'])) {
					$re = $_POST['loc-sp'];
				}
				function CheckedBox($val, $re) {
					if ($re) {
						if (in_array($val, $re)) {
							echo "checked";
						} else {
							echo "";
						}
					} else {
						echo "";
					}															
				}

				function CheckedRadio($val, $re) {
					if (isset($_POST[$re])) {
						if ($_POST[$re] == $val) {
							echo "checked";
						} else {
							echo "";
						}
					} else {
						echo "";
					}															
				}

				function CheckedRadioGia($val) {
					if (isset($_POST['loc-gia'])) {
						if ($_POST['loc-gia'] == $val) {
							echo "checked";
						} else {
							echo "";
						}
					} else {
						echo "";
					}															
				}

				// $parent = get_term_by('name', 'Sản phẩm', 'chuyen-muc');
				$categories = get_terms( 'chuyen-muc', array(
				    'hide_empty' => 0,
				    // 'child_of' => $parent->term_id,
				    'hierarchical'=> 0
				) );
				foreach ($categories as $term) {
			?>
					<div class="checkbox">
						<label class="common-p">
							<input type="checkbox" name="loc-sp[]" <?php CheckedBox($term->term_id, $re) ?> value="<?php echo $term->term_id; ?>"><?php echo $term->name ?>
						</label>
					</div>
				<?php 
					$parent_sub = get_term_by('name', $term->name, 'chuyen-muc');
					$categories_sub = get_terms( 'chuyen-muc', array(
					    'hide_empty' => 0,
					    'child_of' => $parent_sub->term_id
					) );

					foreach ($categories_sub as $term_sub) {
				?>
						<div class="radio">
							<label class="common-p">
								<input type="checkbox" <?php CheckedBox($term->term_id, $re) ?> name="loc-sp[]" value="<?php echo $term_sub->term_id; ?>">
								<?php echo $term_sub->name ?>
							</label>
						</div>

				<?php } ?>
			<?php } ?>
			
		</div>
	</div>

	<div class="groups-sp-sidebar">
		<div class="title-sidebar">
			LỌC THEO GIÁ
		</div>
		<div class="filter-sidebar">
			<div class="radio-gia">
				<label class="common-p">
					<input type="radio" value="100" <?php CheckedRadioGia('100') ?> name="loc-gia"> < 100.000 Đ
				</label>
			</div>

			<div class="radio-gia">
				<label class="common-p">
					<input type="radio" value="200" <?php CheckedRadioGia('200') ?> name="loc-gia"> 101.000 Đ - 200.000 Đ
				</label>
			</div>

			<div class="radio-gia">
				<label class="common-p">
					<input type="radio" value="500" <?php CheckedRadioGia('500') ?> name="loc-gia"> 201.000 Đ - 500.000 Đ
				</label>
			</div>

			<div class="radio-gia">
				<label class="common-p">
					<input type="radio" value="1000" <?php CheckedRadioGia('1000') ?> name="loc-gia"> 501.000 Đ - 1.000.000 Đ
				</label>
			</div>

			<div class="radio-gia">
				<label class="common-p">
					<input type="radio" value="1001" <?php CheckedRadioGia('1001') ?> name="loc-gia"> > 1.000.000 Đ
				</label>
			</div>
		</div>
	</div>
	<input type="hidden" name="Filter" value="Filter">
</form>
</div>
<script type="text/javascript">
	jQuery(".filter-sidebar input").click(function() {
		// alert(jQuery(this).val());
		jQuery("#Form_loc").submit();
	});
</script>