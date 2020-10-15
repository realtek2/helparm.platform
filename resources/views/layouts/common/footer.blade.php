<footer class="page-footer" ></footer>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
@yield('custom_script')
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
        });

        $('#remote_modal').on('hidden', function () {
            $(this).data('modal', null);
        });
</script>
</body>
</html>
