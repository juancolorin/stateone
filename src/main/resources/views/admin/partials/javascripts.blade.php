<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
<script src="{{ url('quickadmin/js') }}/timepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
<script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
<script src="{{ url('quickadmin/js') }}/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.0/js/bootstrap-select.min.js"></script>

<script src="{{ url('quickadmin/file-upload') }}/js/vendor/jquery.ui.widget.js"></script>
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<script src="{{ url('quickadmin/file-upload') }}/js/jquery.iframe-transport.js"></script>
<script src="{{ url('quickadmin/file-upload') }}/js/jquery.fileupload.js"></script>
<script src="{{ url('quickadmin/file-upload') }}/js/jquery.fileupload-process.js"></script>
<script src="{{ url('quickadmin/file-upload') }}/js/jquery.fileupload-image.js"></script>
<script src="{{ url('quickadmin/file-upload') }}/js/jquery.fileupload-audio.js"></script>
<script src="{{ url('quickadmin/file-upload') }}/js/jquery.fileupload-video.js"></script>
<script src="{{ url('quickadmin/file-upload') }}/js/jquery.fileupload-validate.js"></script>

<script src="{{ url('quickadmin/js') }}/gestion-promociones.js"></script>
<script src="{{ url('quickadmin/js') }}/gestion-inmuebles.js"></script>

<script src="{{ url('quickadmin/js') }}/main.js"></script>

<script>

    $('.datepicker').datepicker({
        autoclose: true,
        dateFormat: "{{ config('quickadmin.date_format_jquery') }}"
    });

    $('.datetimepicker').datetimepicker({
        autoclose: true,
        dateFormat: "{{ config('quickadmin.date_format_jquery') }}",
        timeFormat: "{{ config('quickadmin.time_format_jquery') }}"
    });

    $('#datatable').dataTable( {
        "language": {
            "url": "{{ trans('quickadmin::strings.datatable_url_language') }}"
        }
    });

</script>
