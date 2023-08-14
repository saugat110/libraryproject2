// location.reload();
$(document).ready(function(){

    $('#book_search').keyup(function(){

        var field_value  = $('#book_search').val();
        field_value = field_value.trim();
        // alert(field_value);

        if(field_value != '' ){

            $.ajax({
                url:"../search/book_search.php",
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




function updateform(id, name, isbn, category, author, rack, copies, iname){ //from search
    document.querySelector('.update_form').style.display = 'block';
    document.getElementById('hido').value = id;
    document.getElementById('book_name').value = name;
    document.getElementById('isbn').value = isbn;
    document.getElementById('copies').value = copies;
    document.getElementById('iname').value = iname;

    var categoryElement = document.querySelector('select[name="category_name"]');
    var elements = categoryElement.options;
    for (var i = 0; i < elements.length; i++) {
        // Check if the option value matches "science"
        if (elements[i].value === category) {
            // Set the option as selected
            elements[i].selected = true;
            break; // Exit the loop since the desired option has been selected
        }
    }

    var categoryElement = document.querySelector('select[name="author_name"]');
    var elements = categoryElement.options;
    for (var i = 0; i < elements.length; i++) {
        // Check if the option value matches "science"
        if (elements[i].value === author) {
            // Set the option as selected
            elements[i].selected = true;
            break; // Exit the loop since the desired option has been selected
        }
    }

    var categoryElement = document.querySelector('select[name="rack_name"]');
    var elements = categoryElement.options;
    for (var i = 0; i < elements.length; i++) {
        // Check if the option value matches "science"
        if (elements[i].value === rack) {
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



function error_update_form(){
    document.querySelector('.update_form').style.display = 'block';
}

  
  $(document).ready(function(){  //image upload error auda add form afai kholna lai

    $.ajax({

        url:"dat.php",
        method:"GET",
        dataType:"json",

        success:function(response){
            console.log("hello namuna");
            if(response.error){
                show_add_form();
                console.log(response.error);
            }

        }

    });

    $.ajax({

        url:"dat2.php",
        method:"GET",
        dataType:"json",

        success:function(response){
            console.log("hello kaaaaamuna");
            if(response.error2){
                error_update_form();
                console.log(response.error2);
                // alert("hello");
            }

        }

    });

  });


  $('#inum').keyup(function(){
    var inum = $('#inum').val();
    inum = $.trim(inum);
    
    if(inum == ''){
        $('#emessage3').html("");
        $('#save').prop('disabled', false);
    }
    
    
        if( (inum != '') ){
            $.ajax({
                url:'bookadd_dat.php',
                method:'POST',
                dataType:'json',
                data:{input:inum},

                success:function(response){
                    // console.log('hello');
                    if( (!response.inum) ){
                        $('#save').prop('disabled', false);
                        $('#save').css("background-color", "rgb(141, 210, 37)");
                    }else{
                        $('#save').prop('disabled', true);
                        $('#save').css("background-color", "rgba(216, 214, 214, 0.593)");
                    }

                    if( (response.inum) && (inum != '')){
                        $('#emessage3').html("Book already exists");
                    }else{
                        $('#emessage3').html("");
                    }
                   console.log(response);
                }
            });
    }else{
        // $('#emessage1').html("");
    }
});