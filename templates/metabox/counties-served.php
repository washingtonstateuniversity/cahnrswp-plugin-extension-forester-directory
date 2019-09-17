<fieldset id="consultant-service-location">
	<?php foreach ( $counties as $county_key => $county ) :?>
	<div class="consultant-field checkbox">
		<label>
			<input type="checkbox" name="_taxonomy[county][]" value="<?php echo esc_attr( $county_key ); ?>" />
			<?php echo esc_html( $county ); ?>
		</label>
	</div>
	<?php endforeach; ?>
</fieldset>