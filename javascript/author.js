$(document).ready(function(){

    $('#author_search').keyup(function(){

        var field_value  = $('#author_search').val();
        field_value = field_value.trim();
        // alert(field_value);

        if(field_value != '' ){

            $.ajax({
                url:"../search/author_search.php",
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




function updateform(id, name){ //from search
    document.querySelector('.update_form').style.display = 'block';
    document.getElementById('auth_name').value = name;
    document.getElementById('auth_id').value = id;
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


$('#aname').keyup(function(){
    var aname = $('#aname').val();
    aname = $.trim(aname);
    
    if(aname == ''){
        $('#emessage').html("");
        $('#save').prop('disabled', false);
    }
    
    
        if( (aname != '') ){
            $.ajax({
                url:'auth_dat.php',
                method:'POST',
                dataType:'json',
                data:{input:aname},

                success:function(response){
                    // console.log('hello');
                    if( (!response.aname) ){
                        $('#save').prop('disabled', false);
                        $('#save').css("background-color", "rgb(141, 210, 37)");
                    }else{
                        $('#save').prop('disabled', true);
                        $('#save').css("background-color", "rgba(216, 214, 214, 0.593)");
                    }

                    if( (response.aname) && (aname != '')){
                        $('#emessage').html("Author already exists");
                    }else{
                        $('#emessage').html("");
                    }
                   console.log(response);
                }
            });
    }else{
        // $('#emessage1').html("");
    }
});