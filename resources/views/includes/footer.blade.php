<script>
 $(document).ready(function(){
    $(document).on('click','.user_logout',function(e){
        e.preventDefault();
        $('#logout').submit();
    });
 })
</script>