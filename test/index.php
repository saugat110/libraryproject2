<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="jquery-3.6.4.min.js"></script>
</head>
<body>
    <h1>PHP live search</h1>
    <input type="text" id="live_search" placeholder="Search...">

    <div class="result"></div>

    <script>
        $(document).ready(function(){
            $('#live_search').keyup(function(){

                var input = $(this).val();
                // alert(input);

                if(input!= ''){
                    $.ajax({
                        url:'search.php',
                        method:"POST",
                        data:{search:input},
                            success:function(data){ //handle response data returned from server
                                $('.result').css("display", "block");
                                $('.result').html(data);
                            }
                    });
                }else{
                    $('.result').css("display", "none");

                }
            });
        });
    </script>
</body>
</html>