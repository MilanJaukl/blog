<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/chart.min.js"></script>
<script src="assets/js/bs-init.js"></script>
<script src="assets/js/theme.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });

    $(document).ready(function () 
    {
        $("#checkAll").click(function (event) 
        {
            if (this.checked)
            {
                $(".check").each(function () 
                {
                    this.checked = true;
                });
            }
            else
            {
                $(".check").each(function () 
                {
                    this.checked = false;
                });
            }
        });
    });

    function loadUsersOnline () 
    {
        $.get("includes/functions.php?usersonline=result", function (data){
            $(".usersonline").text("Users online: "+data);
        });
    }
    loadUsersOnline();
    setInterval(function () 
    {
        loadUsersOnline();
    }, 1000);
</script>
</body>

</html>