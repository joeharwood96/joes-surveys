$(document).ready(function(){
    //get the question type from the select input
    $( "#optionQuestion" ).change(function () {
        var str = "";
    $( "#optionQuestion option:selected" ).each(function() {
        //everytime the user changes the type, get the value
        str += $( this ).text();
        for(var i = 0; i < 10; i++){
            //remove the previous options
            $("#optionRemove").remove();
        }
    });
        console.log(str);
        for(var i = 1; i < 4; i++){
            //if the question type is drop-down or multiple choice append the option inputs
            if(str === 'Drop-down' || str === 'Multiple choice'){
                $("<input type='text' name='option["+i+"]' id='optionRemove' placeholder='option' class='form-control' required>").insertAfter($("#optionQuestion"));
                $("<br id='optionRemove'><p id='optionRemove'>Option: </p>").insertAfter($("#optionQuestion")); 
            }
        }
  })
  .change();

  

});