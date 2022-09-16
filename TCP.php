<?php

class TCP {

	// Tableau des résultats déjà envoyés
	public $TResultSaved = array();
	// Tableau des variables mises de côté
	public $TTemp = array();

	/**
	 * Fonction retournant la suite d'entier qui n'a pas déjà été envoyé
	 * @param int $i
	 * @return array
	 */
	public function process($i) {
		$TResult = array();
		// On stock la valeur d'entrée dans notre tableau temporaire
		$this->TTemp[] = $i;
		sort($this->TTemp);
		// Si $i est la valeur suivante de la dernière valeur du tableau des résultats déjà envoyés
		if(intval(end($this->TResultSaved)) + 1 == $i) {
			// On stock la variable dans le tableau à retourner
			$TResult[] = $i;
			// On met la valeur dans une variable temporaire
			$tmpVal = $i;
			// On passe sur toutes les variables mise de coté et on vérifie si c'est la suivante de $i
			foreach($this->TTemp as $k => $val) {
				if($tmpVal + 1 == $val) {
					// Si c'est la suivante, on l'a retourne, on met à jour la valeur temporaire, on met à jour le tableau de résultat qui va être envoyé, et on vide la tableau temporaire des variables qui vont être envoyées
					$tmpVal = $val;
					$TResult[] = $val;
					$this->TResultSaved[] = $val;
					unset($this->TTemp[$k]);
				}
			}
		}

		return $TResult;
	}
}

$tcp = new TCP();
print_r($tcp->process(2));
print_r($tcp->process(4));
print_r($tcp->process(1));
print_r($tcp->process(3));
print_r($tcp->process(5));
