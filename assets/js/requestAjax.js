/**
* @date : 28/07/2021
* @author : Nathan OLIVE
* @brief : méthode get
* @param: string url l'url
* @param: json data les data de la requete
* @param: function succesFunction
* @param: function errorFunction 
*/
function getAjax(url, data, succesFunction, errorFunction)
{
  let type = 'GET';
  MakeRequeteAjax(type, url, data, succesFunction, errorFunction);
}
/**
* @brief : méthode add
* @param: string url l'url
* @param: json data les data de la requete
* @param: function succesFunction
* @param: function errorFunction 
*/
function addAjax(url, data, succesFunction, errorFunction, parametresOptionnels)
{
  let type = 'POST';
  MakeRequeteAjax(type, url, data, succesFunction, errorFunction, parametresOptionnels);
}
/**
* @date : 28/07/2021
* @author : Nathan OLIVE
* @brief : méthode update
* @param: string url l'url
* @param: json data les data de la requete
* @param: function succesFunction
* @param: function errorFunction 
*/
function updateAjax(url, data, succesFunction, errorFunction)
{
  let type = 'POST';
  MakeRequeteAjax(type, url, data, succesFunction, errorFunction);
}
/**
* @date : 28/07/2021
* @author : Nathan OLIVE
* @brief : méthode remove
* @param: string url l'url
* @param: json data les data de la requete
* @param: function succesFunction
* @param: function errorFunction 
*/
function removeAjax(url, data, succesFunction, errorFunction)
{
  let type = 'POST';
  MakeRequeteAjax(type, url, data, succesFunction, errorFunction);
}



