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

// window.onunload = function() {
//     if (location.search.includes('?e=1')) {
//       var newUrl = location.href.replace('?e=1', '');
//       history.replaceState(null, '', newUrl);
//     }
//   };

  
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

  });