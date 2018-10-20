<script type="text/javascript">
    $(function() {
        $.notify({
            icon: "fa fa-exclamation-triangle",
            message: "{{ session('error') }}",
        },{
            type: "danger",
            placement: {
                align: "center",
            }
        });
    });
</script>
