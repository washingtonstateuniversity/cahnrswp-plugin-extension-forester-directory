<fieldset id="consultant-service-type">
	<?php foreach ( $services as $service_key => $service ) :?>
	<div class="consultant-field checkbox">
		<label>
			<input type="checkbox" name="_taxonomy[service][]" value="<?php echo esc_attr( $service_key ); ?>" />
			<?php echo esc_html( $service ); ?>
		</label>
	</div>
	<?php endforeach; ?>
	<div class="consultant-field textarea">
		<label>Other Services Provided</label>
		<textarea name="_other_services"><?php echo esc_html( $other_services ); ?></textarea>
	</div>
</fieldset>