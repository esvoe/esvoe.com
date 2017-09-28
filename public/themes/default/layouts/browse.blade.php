<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">   
    <meta name="csrf_token" content="{!! csrf_token() !!}"/>
    <script src="https://sand.esvoe.com/build/UnityLoader.js"></script>
    <script src="https://sand.esvoe.com/js/api_client.js?t=1502788411"></script>
    <script>
        ESAPI.init(function(status, payload) {
            console.log("esapi init "+status+" >> "+payload.error_message);
        });
        var gameInstance = UnityLoader.instantiate("gameContainer", "/build/WebGL.json");
    </script>
 <style>
 body {
 background: black;
 }
 </style>
  </head>
  <body>
    <div id="gameContainer" style="width: 600px; height: 800px; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); margin:0px;"></div>
  </body>
</html>
