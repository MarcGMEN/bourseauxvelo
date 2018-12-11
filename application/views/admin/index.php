<?php echo $this->session->flashdata('message');


	$links = array(
		anchor('admin/viewquestions', 'Gérer questions FAQ'),
		anchor('admin/saisir_ventes', 'Gérer ventes')
		);

	echo heading('Utilisez les liens ci -dessous pour accéder aux fonctions d\'administration', 3);
	echo ul($links);