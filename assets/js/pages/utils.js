class Utils {

   
  static questionFormIsValid() {

    let questionInputIsValid = Utils.questionInputIsValid();
    let answersInputsAreValid = Utils.answersInputsAreValid();

    return questionInputIsValid && answersInputsAreValid;
  }

  static questionInputIsValid() {
    return $("#questionContent").val() !== "";
    
  }

  static answersInputsAreValid() {
    let emptyInputs = $(".containerForm").find("input").filter(function () {
      return $(this).val() === "" ;
    });
    return emptyInputs.length === 0;
  }

  static replaceKeysfromArrayIntoTheOtherArray(array,arrayToChange){
    array = array.map(function (iterator){
      for(let key in arrayToChange){
        if(iterator[key]){
          iterator[arrayToChange[key]] = iterator[key];
          delete iterator[key];
        }
      }
      return iterator;
    });
  }

}
