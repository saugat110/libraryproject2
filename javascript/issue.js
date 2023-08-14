$(document).ready(function(){

    $('#issue_search').keyup(function(){

        var field_value  = $('#issue_search').val();
        field_value = field_value.trim();
        // alert(field_value);

        if(field_value != '' ){

            $.ajax({
                url:"../search/issue_search.php",
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

    // const myarray= {roll_ok:false, isbn_ok:false };


    // $('#sroll').keyup(function(){
    //     var roll = $('#sroll').val();

        
    //         if(roll != ''){
    //             $.ajax({
    //                 url:'issue_dat.php',
    //                 method:'POST',
    //                 dataType:'json',
    //                 data:{input1:roll},

    //                 success:function(response){
    //                     // console.log('hello');
    //                     if(response.roll){
    //                         myarray.roll_ok  = true;
    //                         $('#emessage1').html("");
    //                     }else{
    //                         $('#emessage1').html("Student not found");
    //                         myarray.roll_ok  = false;
    //                     }
    //                 }
    //             });
    //     }else{
    //         $('#emessage1').html("");
    //     }
    // });

    // $('#isbn').keyup(function(){
    //     var isbn = $('#isbn').val();

    //     if(isbn != ''){
    //         $.ajax({
    //             url:'issue_dat.php',
    //             method:'POST',
    //             dataType:'json',
    //             data:{input2:isbn},

    //             success:function(response){
    //                 console.log(response.isbn);
    //                 if(response.isbn){
    //                     myarray.isbn_ok = true;
    //                     $('#emessage2').html("");
    //                     // console.log(myarray);
    //                 }else{
    //                     $('#emessage2').html("Book not found");
    //                     myarray.isbn_ok = false;
    //                 }
    //             }
    //         });
    // }else{
    //     $('#emessage2').html("");
    // }
    // });




    $('#save').css("background-color", "rgba(216, 214, 214, 0.593)");

    $('#sroll, #isbn').keyup(function(){
        var roll = $('#sroll').val();
        roll = $.trim(roll);
        var isbn = $('#isbn').val();
        isbn = $.trim(isbn);

        if(roll == ''){
            $('#emessage1').html("");
        }
        if(isbn == ''){
            $('#emessage2').html("");
        }
        
            if( (roll != '') || (isbn!='') ){
                $.ajax({
                    url:'issue_dat.php',
                    method:'POST',
                    dataType:'json',
                    data:{input1:roll, input2:isbn},

                    success:function(response){
                        // console.log('hello');
                        if( (response.roll) && (response.isbn) ){
                            $('#save').prop('disabled', false);
                            $('#save').css("background-color", "rgb(141, 210, 37)");
                        }else{
                            $('#save').prop('disabled', true);
                            $('#save').css("background-color", "rgba(216, 214, 214, 0.593)");
                        }

                        if( (!response.roll) && (roll != '')){
                            $('#emessage1').html("Student not found");
                        }else{
                            $('#emessage1').html("");
                        }
                        if( (!response.isbn) && (isbn != '') ){
                            $('#emessage2').html("Book not found");
                        }else{
                            $('#emessage2').html("");
                        }
                    }
                });
        }else{
            // $('#emessage1').html("");
        }
    });

    


    // if( ((myarray.roll_ok) == true) && ((myarray.isbn_ok) == true) ){
    //     $('#save').prop('disabled', false);
    //     // $('#emessage1').html('Student not found');
    //     $('#save').css("background-color", "rgba(216, 214, 214, 0.593)");
    // }else{
    //     // console.log(myarray);
    //     $('#save').prop('disabled', true);
    //     $('#save').css("background-color", "gray");
    // }
});

























function updateform(id, isbn){ //from search
    document.querySelector('.update_form').style.display = 'block';
    document.getElementById('bissue_id').value = id;
    document.getElementById('b_isbn').value = isbn;
    // console.log(id);
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

// $('#save').prop('disabled', true);
// $('#emessage1').html('Student not found');
// $('#save').css("background-color", "rgba(216, 214, 214, 0.593)");