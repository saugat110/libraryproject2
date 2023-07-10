$(document).ready(function(){

    $('#admin_search').keyup(function(){

        var field_value  = $('#admin_search').val();
        field_value = field_value.trim();
        // alert(field_value);

        if(field_value != '' ){

            $.ajax({
                url:"../search/admin_search.php",
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




function updateform(a_id, fname, lname, email, password, phone, address, role ){ //from search
    document.querySelector('.update_form').style.display = 'block';
    document.getElementById('update_fname').value = fname;
    document.getElementById('update_lname').value = lname;
    document.getElementById('update_email').value = email;
    document.getElementById('update_password').value = password;
    document.getElementById('update_phone').value = phone;
    document.getElementById('update_address').value = address;
    document.getElementById('update_admin_id').value = a_id;


    var select = document.querySelector('select[name="update_role"]');  //for select 
    var elements = select.options;
    for (var i = 0; i < elements.length; i++) {
        // Check if the option value matches "science"
        if (elements[i].value === role) {
            // Set the option as selected
            elements[i].selected = true;
            break; // Exit the loop since the desired option has been selected
        }
    }

    document.querySelector('.hideall').style.display = 'block';
}

function close_update(){
    document.querySelector('.update_form').style.display = 'none';
    document.querySelector('.hideall').style.display = 'none';
}


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

        url:'admin_dat.php',
        method:"GET",
        dataType:"json",

        success:function(response){
            if(response.error){
                show_add_form();
                console.log("add_admin_error sill set");

                var select = document.querySelector('select[name="role"]');  //for select 
                var elements = select.options;
                for (var i = 0; i < elements.length; i++) {
                    // Check if the option value matches "science"
                    if (elements[i].value === response.role) {
                        // Set the option as selected
                        elements[i].selected = true;
                        break; // Exit the loop since the desired option has been selected
                    }
                }
            }
        }
    });
});