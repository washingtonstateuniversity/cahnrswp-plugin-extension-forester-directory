<fieldset id="consultant-service-optional-consulting">
	<div class="consultant-field radio" >

		<label>Member of Association of Consulting Foresters</label>

		<div><input id="macf-yes" type="radio" name="_macf" value="1" <?php checked( 1, $macf ); ?>/><label for="macf-yes">Yes</label></div>

		<div><input id="macf-no" type="radio" name="_macf" value="0" <?php checked( 0, $macf ); ?>/><label for="macf-no">No</label></div>
	</div>

	<div class="consultant-field radio" >

		<label>SAF Certified Foresters on Staff</label>

		<div><input id="saf-yes" type="radio" name="_saf" value="1" <?php checked( 1, $saf ); ?>/><label for="saf-yes">Yes</label></div>

		<div><input id="saf-no" type="radio" name="_saf" value="0" <?php checked( 0, $saf ); ?>/><label for="saf-no">No</label></div>

	</div>

	<div class="consultant-field radio" >

		<label>Certified Wildfire Mitigation Specialist(s) (CWMS) on staff</label>

		<div><input id="cwms-yes" type="radio" name="_cwms" value="1" <?php checked( 1, $cwms ); ?>/><label for="cwms-yes">Yes</label></div>

		<div><input id="cwms-no" type="radio" name="_cwms" value="0" <?php checked( 0, $cwms ); ?>/><label for="cwms-no">No</label></div>

	</div>

	<div class="consultant-field radio" >

		<label>Are you an NRCS Technical Service Provider (TSP)</label>

		<div><input id="tsp-yes" type="radio" name="_tsp" value="1" <?php checked( 1, $tsp ); ?>/><label for="tsp-yes">Yes</label></div>

		<div><input id="tsp-no" type="radio" name="_tsp" value="0" <?php checked( 0, $tsp ); ?>/><label for="tsp-no">No</label></div>

	</div>

	<div class="consultant-field"><label>TSP ID Number</label>

		<input type="text" name="_tsp_number" value="<?php echo esc_attr( $tsp_number ); ?>" placeholder="TSP number"/>

	</div>

</fieldset>

<fieldset id="consultant-service-optional-contractors">

	<div class="consultant-field radio" >

		<label>Registered Washington State Farm Labor Contractor</label>

		<div><input id="sfl-yes" type="radio" name="_sfl" value="1" <?php checked( 1, $sfl ); ?>/><label for="sfl-yes">Yes</label></div>

		<div><input id="sfl-no" type="radio" name="_sfl" value="0" <?php checked( 0, $sfl ); ?>/><label for="sfl-no">No</label></div>

	</div>

	<div class="consultant-field"><label>FLC license number</label>

	<input type="text" name="_flc" value="<?php echo esc_attr( $flc ); ?>" placeholder="FLC license number"/></div>
</fieldset>