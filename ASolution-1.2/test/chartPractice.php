<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="../js/jquery.min.js"></script>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <div class="ch_main">
            <div class="ch_day">
                
                <div class="ch_value_1">
                  value-1
                </div>
               <div class="ch_value_2">
                 value-2
                </div>
                <div class="ch_value_3">
                  value-3
                </div>
                
            </div>
          
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
               $('.ch_main').css({'background':'#ccc'});
                $('.ch_day').css({'background':'green','width':'10px'});
                
                $('.ch_value_1').css({'background':'red','float':'left','width':'100px'});
                $('.ch_value_2').css({'background':'green','float':'left','width':'200px'});
                $('.ch_value_3').css({'background':'blue','float':'left','width':'300px'});
            });
        </script>
    </body>
</html>
