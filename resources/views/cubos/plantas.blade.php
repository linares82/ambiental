<html>
    <head>
        <link rel="stylesheet" type="text/css" href="{{ asset('dist/pivot.css') }} ">
        <link rel="stylesheet" type="text/css" href="{{ asset('dist/c3.min.css') }} ">
        <script src="{{ asset('ace-master/assets/js/jquery-2.1.4.min.js') }}"></script>
        <script src="{{ asset('ace-master/assets/js/jquery-ui.custom.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/d3.v3.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/c3.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/pivot.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/pivot.es.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/c3_renderers.js') }}"></script>

        <style type="text/css">
        @media print {
          body  {
            visibility: hidden;
          }
          #output  {
            visibility: visible;
          }
          #output  {
            position: absolute;
            left: 0;
            top: 0;
          }
        }
        </style>

    </head>
    <body>
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">

            <a href="{{route('home')}}">
                Inicio
            </a>

	</div>
        <script type="text/javascript">
            
            $(function(){
                var derivers = $.pivotUtilities.derivers;
                var renderers = $.extend($.pivotUtilities.renderers, 
                              $.pivotUtilities.c3_renderers);

                $("#output").pivotUI(<?php echo $consulta;?>, {
                    renderers: renderers,
                    cols: ["Año", "Mes"], 
                    rows: ["Entidad", "Planta"],
                    rendererName: "Grafica Barras C3"
                }, false, "es");
                
             });
        </script>

        <div id="output" style="padding:30px;width:80%"></div>

        @push('scripts')
        <link rel="stylesheet" type="text/css" href="{{ asset('dist/pivot.css') }} ">
        <script src="{{ asset('ace-master/assets/js/jquery-2.1.4.min.js') }}"></script>
            <script src="{{ asset('ace-master/assets/js/jquery-ui.custom.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/d3.v3.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/c3.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/pivot.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/pivot.es.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dist/c3_renderers.js') }}"></script>
        @endpush

    </body>    
</html>


