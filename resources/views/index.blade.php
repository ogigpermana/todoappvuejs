<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Todo List App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
  </head>
  <body>
  <div class="container" id="app">
    <tasks></tasks>
  </div>
  <script type="text/javascript" src="{{ asset('js/app.js') }}">

  </script>
  </body>
</html>
