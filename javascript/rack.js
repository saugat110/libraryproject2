$(document).ready(function(){

    $('#rack_search').keyup(function(){

        var field_value  = $('#rack_search').val();
        field_value = field_value.trim();
        // alert(field_value);

        if(field_value != '' ){

            $.ajax({
                url:"../search/rack_search.php",
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
    document.getElementById('rack_name').value = name;
    document.getElementById('rack_id').value = id;
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


$('#rname').keyup(function(){
    var rname = $('#rname').val();
    rname = $.trim(rname);
    
    if(rname == ''){
        $('#emessage').html("");
        $('#save').prop('disabled', false);
    }
    
    
        if( (rname != '') ){
            $.ajax({
                url:'rack_dat.php',
                method:'POST',
                dataType:'json',
                data:{input:rname},

                success:function(response){
                    // console.log('hello');
                    if( (!response.rname) ){
                        $('#save').prop('disabled', false);
                        $('#save').css("background-color", "rgb(141, 210, 37)");
                    }else{
                        $('#save').prop('disabled', true);
                        $('#save').css("background-color", "rgba(216, 214, 214, 0.593)");
                    }

                    if( (response.rname) && (rname != '')){
                        $('#emessage').html("Rack already exists");
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