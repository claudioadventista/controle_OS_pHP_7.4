<?php 
@session_start();
// condição para que o cronometro funcione
if(($_SESSION['cronometro']="sim")AND($_SESSION['logado'] != "Admin")){
?>
  <!DOCTYPE HTML>
  <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <title>Controle OS</title>
      <link rel="shortcut icon" href="favicon.ico" >
      <meta name="viewport" content="widhth=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=10,  minimum-scale=1.0" />
      <meta name="referrer" content="default" id="meta_referrer" />
      <meta http-equiv="cache-control" content="max-age=0" />
      <meta http-equiv="cache-control" content="no-cache" />
      <meta http-equiv="expires" content="0" />
      <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
      <meta http-equiv="pragma" content="no-cache" />
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <link rel="stylesheet" type="text/css" href="../estilo/index.css" />
      <?php 
      if($_SESSION['tema']=="claro"){
        echo '<link rel="stylesheet" type="text/css" href="../estilo/tema_escuro.css" />';
      }
      ?>
      <link href="../fonts/fontawesome-free-5.11.2-web/css/fontawesome.css" rel="stylesheet">
      <link href="../fonts/fontawesome-free-5.11.2-web/css/brands.css" rel="stylesheet">
      <link href="../fonts/fontawesome-free-5.11.2-web/css/solid.css" rel="stylesheet">	
    </head>
    <body>
      
  
      <div id="cronometro">
        <style>
          #minutes, #seconds, .digito{
            color:#777;
          }

          
          #hours, #minutes, #seconds, .digito {
            position:relative;
            font-size: 30px;
            top:3px;
          }
          @font-face{
            font-family:digital;  /*Definindo a família*/
            src: url(../fonte_digital/digital-7.TTF); 
          }
        </style>
        <!--<span id='hours'></span><span class="digito">&nbsp:&nbsp</span>-->
        <span id='minutes'></span><span class="digito">&nbsp:</span>
        <span id='seconds'></span>&nbsp<button class="botao" id='reset' title="Clique para resetar o cronômetro"><i class="fas fa-sync"></i><span class="espaco">Reset</span></button>
        <script type="text/javascript">
            (function() {
            "use strict";
            var secondsLabel = document.getElementById('seconds'),
            minutesLabel = document.getElementById('minutes'), 
            hoursLabel = document.getElementById('hours'), totalSeconds = 0, 
            resetButton = document.getElementById('reset'), timer = null;
                  timer = setInterval(setTime, 1000);
            resetButton.onclick = function() {
              if (timer) {
                totalSeconds = 0;
                stop();
              }
            };
            
          /*******************************************************************************
            
                Expira a session depois de uma hora com a página ociosa 
            
          ********************************************************************************/

            function setTime() {
                if (totalSeconds > 3600) { // 3600
                totalSeconds = 0;
                //window.location.replace('../php/expira_session.php');
                window.location.replace('../html/login.php');
              }
                
                totalSeconds++;
                secondsLabel.innerHTML = pad(totalSeconds % 60);
                minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
                hoursLabel.innerHTML = pad(parseInt(totalSeconds / 3600))
          }
            
            function pad(val) {
              var valString = val + "";
              if (valString.length < 2) {
                return "0" + valString;
                
              } else {	
                return valString;
              }
            }
          })();
        </script>
      </div>
    </body>
  </html>
<?php } ?>
   
