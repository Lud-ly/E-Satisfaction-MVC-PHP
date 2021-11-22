/** ------------------------------------------------------------------------
* \date : 12/11/2020
* \author : Maxime CHAMBAUD
* \brief:   Cette fonction permet de faire une requete ajax
* \details:
* \param: json data les data de la requete
* \param: string url l'url
* \param: string type le verbe http de la requete 
* \version 1.00
* \note V1.00 creation 12/11/2020
*-------------------------------------------------------------------------
*-------------------------------------------------------------------------
*-------------------------------------------------------------------------*/
function MakeRequeteAjax(type,url,data,succesFunction,errorFunction,parametresOptionnels)
{
  GetRequeteAjax({type,url,data})
  .then(reponse => SuccessAjax(reponse,succesFunction,parametresOptionnels))
  .catch(reponse => ErrorAjax(reponse,errorFunction,parametresOptionnels))
}
/** ------------------------------------------------------------------------
* \date : 12/11/2020
* \author : Maxime CHAMBAUD
* \brief:   Cette fonction permet de retourner une requete ajax
* \details:
* \param: json parametresAjaxJSON les parametres de la requete
* \return Promise la promise pour la requete ajax 
* \version 1.00
* \note V1.00 creation 12/11/2020
*-------------------------------------------------------------------------
*-------------------------------------------------------------------------
*-------------------------------------------------------------------------*/
function GetRequeteAjax(parametresAjaxJSON)
{
  return $.ajax(parametresAjaxJSON)
}
/** ------------------------------------------------------------------------
* \date : 12/11/2020
* \author : Maxime CHAMBAUD
* \brief:   Cette fonction permet de traiter success requete ajax
* \details:
* \param: json reponse traite le succes de l'ajax
* \param: fucntion errorFunction traite les success de l'ajax specifiquement
* \param: json parametresOptionnels parametre a passer
* \version 1.00
* \note V1.00 creation 12/11/2020
*-------------------------------------------------------------------------
*-------------------------------------------------------------------------
*-------------------------------------------------------------------------*/
function SuccessAjax(reponse,succesFunction,parametresOptionnels)
{
  if(succesFunction !== undefined)
  {
    succesFunction(reponse,parametresOptionnels)
  }
}
/** ------------------------------------------------------------------------
* \date : 12/11/2020
* \author : Maxime CHAMBAUD
* \brief:   Cette fonction permet de traiter erreur requete ajax
* \details:
* \param: json reponse traite les erreur de l'ajax
* \param: fucntion errorFunction traite les erreur de l'ajax specifiquement
* \param: json parametresOptionnels parametre a passer
* \version 1.00
* \note V1.00 creation 12/11/2020
*-------------------------------------------------------------------------
*-------------------------------------------------------------------------
*-------------------------------------------------------------------------*/
function ErrorAjax(reponse,errorFunction,parametresOptionnels)
{
  if(errorFunction !== undefined)
  {
    errorFunction(reponse,parametresOptionnels)
  }
}