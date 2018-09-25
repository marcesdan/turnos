<script type="text/javascript">
  $(function() {
     $.notify({
       icon: "fa fa-check",
       message: "{{ session('status') }}",
       icon: 'fa fa-check' 
     },{
       type: "info",
       placement: {
        align: "center",
      }
     });
  });
</script>