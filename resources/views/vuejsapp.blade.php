<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="rtl">
    <head>
       
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@lang('COMS')</title>
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="app">
            <router-view></router-view>
        </div>
     
        
        <script src="{{asset('js/app.js')}}"></script>
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
                     ]); ?>
                   
           </script>
    </body>
</html>
