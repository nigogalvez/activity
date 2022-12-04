<!DOCTYPE html>
<html>
    <head>
        <style>
            .btn{
                width: 25px;
                height: 25px;
                font-weight: bold;
                text-align: center;
            }
            .cls{
                width: 25px;
                height: 25px;
                font-weight: bold;
                text-align: center;
            }
            .eql{
                width: 100%;
                height: 25px;
                font-weight: bold;
                text-align: center;
            }
            .display{
                border:1px #666 solid; 
                height: 50px; width: 130px; 
                text-align: right; 
                font-size: 20px;
            }
        </style>
    </head>
    <body>
        <table width="120">
            <tr>
                <td colspan="5"><textarea id="display" class="display" readonly></textarea></td>
            </tr>
            <tr>
                <td><input value="7" type="button" class="btn"></td>
                <td><input value="8" type="button" class="btn"></td>
                <td><input value="9" type="button" class="btn"></td>
                <td><input id="cls" value="C" type="button" class="cls"></td>
            </tr>
            <tr>
                <td><input value="4" type="button" class="btn"></td>
                <td><input value="5" type="button" class="btn"></td>
                <td><input value="6" type="button" class="btn"></td>
                <td><input id="plus" value="+" type="button" class="btn"></td>
            </tr>
            <tr>
                <td><input value="1" type="button" class="btn"></td>
                <td><input value="2" type="button" class="btn"></td>
                <td><input value="3" type="button" class="btn"></td>
                <td><input id="sub" value="-" type="button" class="btn"></td>
            </tr>
            <tr>
                <td><input value="0" type="button" class="btn"></td>
                <td><input id="dot" value="." type="button" class="btn"></td>
                <td><input id="div" value="/" type="button" class="btn"></td>
                <td><input id="mul" value="*" type="button" class="btn"></td>
            </tr>
            <tr>
                <td colspan="5"><input id="eql" value="=" type="button" class="eql"></td>
            </tr>
        </table>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function(){

                $('input[type=button]').hover(function() {
                    $(this).css('background-color', 'grey');
                }, function() {
                    $(this).css('background-color', 'white');
                });
                
                $('input[type=button]').click(function() {
                    var num = $(this).val();
                    var old = $('#display').html();
                    //this will clear the input of the user
                    if( num === 'C' ) {
                        $('#display').html('');
                        return;
                    }
                    if( num === '=' ) {
                        $('#display').html(old);
                        return;
                    }

                    $.ajax({
                            url:'ajax.php',
                            type: "POST",
                            data:{'action':'operation','num':num,'old':old},
                            success: function(msg){
                                $('#display').html(msg);
                            }
                        }).error(function(){
                            $('#display').html('Oops! An error occured');}
                           );
                });
                //when equal button is clicked
                $('#eql').click(function() {
                    var num = $('#display').html();
                    var old = $('#display').html();
                    $.ajax({
                            url:'ajax.php',
                            type: "POST",
                            data: {'action':'equal', 'num':num, 'old':old},
                            success: function(msg) {
                                $('#display').html(msg);
                            }
                        }).error(function(){
                            $('#display').html('Oops! An error occured');}
                           );
                });
            });
        </script>
    </body>
</html>