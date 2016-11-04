    </div>
    
    <script type="text/javascript">
        $(document).ready(function($){
            $("#amount").mask("##0.00", {reverse: true});
            $("#telephone").mask("(99)9999-9999");
            $("#cellphone").mask("(99)99999-9999");
        });
    </script>
        

    <!-- Loading Scripts -->
    <script src="{{URL::asset('js/bootstrap-select.min.js')}}"></script>
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    
    <script src="{{URL::asset('js/Chart.min.js')}}"></script>
    <script src="{{URL::asset('js/fileinput.js')}}"></script>
    <script src="{{URL::asset('js/chartData.js')}}"></script>
    <script src="{{URL::asset('js/main.js')}}"></script>

</body>

</html>