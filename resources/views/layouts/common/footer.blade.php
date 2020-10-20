<footer class="page-footer"></footer>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script>
    //remote modal custom
    $(document).on("click", ".remote_modal", function (e) {
            e.preventDefault();
            $(this).data('#remote_modal', null);// clear modal if has some information from last used
            content = $('#remote_modal .modal-content');
            url = $(this).attr("ajax_target");
            $.get(url, function (html) {
                content.html(html);
                setTimeout(function () {
                    $('#remote_modal').modal({show: true});
                }, 500)
            });

            $('#remote_modal').on('hidden', function () {
                $(this).data('modal', null);
            });

            $.ajaxSetup({
				   headers: {
					   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				   }
				});
        });
</script>
@yield('custom_script')
</body>
</html>
