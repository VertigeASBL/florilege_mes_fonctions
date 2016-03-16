<?php

/**
 * Assigner une valeur à la clé donnée du tableau donné
 *
 * @param array $tableau : le tableau en question
 * @param mixed $cle : la clé
 * @param mixed $valeur : la valeur
 *
 * @return array : le tableau avec la bonne valeur associée à la bonne clé
 */
function filtre_table_cle_valeur_dist($tableau, $cle, $valeur) {

	$tableau[$cle] = $valeur;

	return $tableau;
}

/**
 * Mettre un string sur une seule ligne
 *
 * C'est utile pour passer une requête SQL à une boucle DATA,
 * comme ça ne fonctionne pas si la requête contient des retours
 * de ligne
 *
 * @param String $str : Le string à traiter
 *
 * @return String : Le string traité
 */
function filtre_monoligne_dist($str) {

	$tab = explode("\n", $str);

    return trim(
        array_reduce(
	        $tab,
	        function ($carry, $item) {
		        return $carry . trim($item) . ' ';
	        },
	        ''
        )
    );
}

/**
 * Fusionner deux tableaux d'un façon sensée
 *
 * Fonctionne de la même façon que jQuery.extend avec l'option "deep"
 *
 * @param String $str : Le string à traiter
 *
 * @return String : Le string traité
 */
function fusionner_tableaux($t1, $t2) {

	foreach ($t2 as $cle => $val) {
		if (! is_array($val)) {
			$t1[$cle] = $val;
		} else {
			$t1[$cle] = gse_fusionner_tableaux(
				(isset($t1[$cle]) and is_array($t1)) ? $t1 : array(),
				$val
			);
		}
	}

	return $t1;
}
