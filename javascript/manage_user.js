$(document).ready(function(){

    $('#student_search').keyup(function(){

        var field_value  = $('#student_search').val();
        field_value = field_value.trim();
        // alert(field_value);

        if(field_value != '' ){

            $.ajax({
                url:"../search/user_search.php",
                method:"POST",
                data:{input:field_value},

                    success:function(data){ //handle response data if request success
                        $('#default_table').css("display", "none");

                        $('.search_result').css("display", "block");

                        $('.search_result').html(data);

                    }
            });
        }else{ //search empty huda
            $('#default_table').css({"display": "block" }); //border none garena vne search clear grda border double auxa

            $('.search_result').css("display", "none");
        }
    });
});


function show_add_form(){
    document.querySelector('.addform').style.display = 'block';
    document.querySelector('.hideall').style.display = 'block';
}

function close_add(){
    document.querySelector('.addform').style.display = 'none';
    document.querySelector('.hideall').style.display = 'none';
}


$(document).ready(function(){


    $.ajax({
        url:'user_dat.php',
        method:'GET',
        dataType:'json',
        
        success:function(response){
            show_add_form();

            var select = document.querySelector('select[name="facult"]');
            var elements = select.options;
            for (var i = 0; i < elements.length; i++) {
                if (elements[i].value === response.facult) {
                    elements[i].selected = true;
                    break;
                }
            }
        }
    });
});


$(document).ready(function(){


    $('#roll_enter').keyup(function(){
        var roll = $('#roll_enter').val();
        roll = $.trim(roll);
        
        if(roll == ''){
            $('#emessage2').html("");
        }
        
        
            if( (roll != '') ){
                $.ajax({
                    url:'roll_dat.php',
                    method:'POST',
                    dataType:'json',
                    data:{input:roll},

                    success:function(response){
                        // console.log('hello');
                        if( (!response.roll) ){
                            $('#save').prop('disabled', false);
                            $('#save').css("background-color", "rgb(141, 210, 37)");
                        }else{
                            $('#save').prop('disabled', true);
                            $('#save').css("background-color", "rgba(216, 214, 214, 0.593)");
                        }

                        if( (response.roll) && (roll != '')){
                            $('#emessage2').html("Student already exists");
                        }else{
                            $('#emessage2').html("");
                        }
                       console.log(response);
                    }
                });
        }else{
            // $('#emessage1').html("");
        }
    });

});