<?php
if (!function_exists("droit_ecriture_module")) {
	function droit_ecriture_module() {
		$groupes_utilisateur = groupes_users($_SESSION["espace"]["id_espace"], $_SESSION['user']['id_utilisateur']);

		// Récupération de l'id_module
		$module_infos = db_tableau("SELECT * FROM gt_module WHERE nom='".MODULE_NOM."'");
		if (!is_array($module_infos)) { return false; }

		$module_infos = $module_infos[0];

		$groupes_2	= objet_affectations(array('type_objet' => 'module'), $module_infos['id_module'], "groupes", 2);
		if (is_null($groupes_2)) { return false; }

		// Parcours de $groupes_2 pour vérifier si un des groupes de l'utilisateur à le droit d'écrire
		$ecriture_ok = false;
		for ($i=0; $i < count($groupes_2) && !$ecriture_ok; $i++) {
			$ecriture_ok = $ecriture_ok || in_array($groupes_2[$i]['id_groupe'], array_keys($groupes_utilisateur));
		}
		return $ecriture_ok;
	}
}
?>