<?php 

	echo $this->session->flashdata('message');

	echo form_open('admin/saisir_ventes');

		echo form_submit('submit', 'Enregistrer', 'class="btn btn-success"');

		echo '<div style="margin: 5px;">&nbsp;</div>';

		echo $t_body;

	echo form_close();
	


