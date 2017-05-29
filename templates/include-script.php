<script src="../js/sidebar_menu.js"></script>
<script>
        $(document).ready(function() {
            $('#tabel').DataTable( {
                stateSave: true,
                "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]]
            });
        });
</script>