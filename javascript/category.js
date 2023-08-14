$(document).ready(function(){

    $('#category_search').keyup(function(){

        var field_value  = $('#category_search').val();
        field_value = field_value.trim();
        // alert(field_value);

        if(field_value != '' ){

            $.ajax({
                url:"../search/category_search.php",
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
    document.getElementById('cato_name').value = name;
    document.getElementById('cato_id').value = id;
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


    $('#catname').keyup(function(){
        var cname = $('#catname').val();
        cname = $.trim(cname);
        
        if(cname == ''){
            $('#emessage').html("");
            $('#save').prop('disabled', false);
        }
        
        
            if( (cname != '') ){
                $.ajax({
                    url:'category_dat.php',
                    method:'POST',
                    dataType:'json',
                    data:{input:cname},

                    success:function(response){
                        // console.log('hello');
                        if( (!response.cname) ){
                            $('#save').prop('disabled', false);
                            $('#save').css("background-color", "rgb(141, 210, 37)");
                        }else{
                            $('#save').prop('disabled', true);
                            $('#save').css("background-color", "rgba(216, 214, 214, 0.593)");
                        }

                        if( (response.cname) && (cname != '')){
                            $('#emessage').html("Category already exists");
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

});