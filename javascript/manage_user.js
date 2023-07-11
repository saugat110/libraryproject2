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