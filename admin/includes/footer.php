<!-- jQuery -->
<script src="js/jquery.js"></script>
<script src="js/scripts.js"></script>
<script>
    $(document).ready(function () {

        $('#selectAllBoxes').click(function (event) {

            if (this.checked) {
                $('.checkBoxes').each(function () {
                    this.checked = true;

                });
            } else {
                $('.checkBoxes').each(function () {
                    this.checked = false;

                });
            }
        });

        var div_box = "<div id='load-screen'><div id='loading'></div></div>";
        $("body").prepend(div_box);

        $('#load-screen').delay(700).fadeOut(600, function () {
            $(this).remove();
        });


    });
</script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>