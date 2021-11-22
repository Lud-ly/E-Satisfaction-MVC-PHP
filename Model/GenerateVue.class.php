<?php

/**
 * Class Vue
 * Génère la vue
 */
class GenerateVue
{
    private $fileName;

    public function __construct($action, $data)
    {
        $nameView = "Vue" . $action;
        $this->instanceVue = new $nameView;
        $this->instanceNavbar = new VueNavbar;
        $data['instanceVue'] = $this->instanceVue;
        $this->fileName = "Vue/" . $nameView . ".php";
        $this->data = $data;
    }

    // Génère et affiche la vue
    public function generate()
    {
        $gestionVariableCss =  new GestionVariableCss($_SESSION['dataUserLoginApps']['company']);
        $contenu = $this->getVue($this->fileName, $this->data);
        $navbar = $this->getVue('Vue/VueNavbar.php', ['navbar' => $this->instanceNavbar, 'variableCssCompagny' => $gestionVariableCss]);
        $vue = $this->getVue('Vue/gabarit.php', array('contenu' => $contenu, 'navbar' => $navbar, 'variableCssCompagny' => $gestionVariableCss));
        echo $vue;
    }

    public function generatePublicView()
    {
        $gestionVariableCss =  new GestionVariableCss($_SESSION['dataUserLoginApps']['company']);
        $contenu = $this->getVue($this->fileName, $this->data);
        $vue = $this->getVue('Vue/gabarit.php', array('contenu' => $contenu, 'variableCssCompagny' => $gestionVariableCss));
        echo $vue;
    }

    private function getVue($fileName, $data)
    {
        return $this->generateFile($fileName, $data);
    }

    // Génère un fichier vue et renvoie le résultat produit
    private function generateFile($file, $data)
    {
        if (file_exists($file)) {
            extract($data);
            ob_start();
            require $file;
            return ob_get_clean();
        } else {
            throw new Exception("File '$file' not found");
        }
    }
}
