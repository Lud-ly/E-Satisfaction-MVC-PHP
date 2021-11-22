<?php

class GestionVariableCss
{
    function __construct($company)
    {

        $this->primaryColor = $company['primary_color'];
        $this->secondaryColor = $company['secondary_color'];
        $this->logo = $company['logo'];
    }

    public function setCompanyCssColor()
    {
        echo '<style> html{  --primary-color: ' . $this->primaryColor . ';  --secondary-color: ' . $this->secondaryColor . '; } </style>';
    }

    public function setCompagnyLogo()
    {
        echo '<img src="' . $this->logo . '" alt="logo compagny">';
    }
    public function getCompagnyLogo()
    {
        echo $this->logo;
    }
    public function test()
    {
        return "coucou";
    }
}
