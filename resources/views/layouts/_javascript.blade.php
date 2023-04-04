<!-- jQuery -->
<script src="/asset/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
{{-- <script src="/asset/plugins/jquery-ui/jquery-ui.min.js"></script> --}}
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    //   $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- daterangepicker -->
<script src="/asset/plugins/moment/moment.min.js"></script>
<script src="/asset/plugins/daterangepicker/daterangepicker.js"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="/asset/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Summernote -->
<script src="/asset/plugins/summernote/summernote-bs4.min.js"></script>
<script src="/asset/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- overlayScrollbars -->
<script src="/asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- AdminLTE App -->
<script src="/asset/dist/js/adminlte.js"></script>
{{-- <script type="text/javascript"
    src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.js">
</script> --}}
<!-- AdminLTE for demo purposes -->
{{-- <script src="/asset/dist/js/demo.js"></script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="/asset/dist/js/pages/dashboard.js"></script> --}}
<script src="{{ asset('asset/plugins/toastr/toastr.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<script>
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : '{{ csrf_token() }}'}
    });

     $(document).on('click', '.delete-btn', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $('#deleted_form').attr('action', url);
            console.log(url);
            $.confirm ({
                'title': 'Confirmation',
                'message': 'Are you sure?',
                'buttons': {
                    'Yes': {
                        'class': 'yes btn-danger',
                        'action': function() {
                            console.log("goint to " + url);
                            $.ajax({
                                url: url,
                                type: 'DELETE',
                                processData: false,
                                dataType: false,
                                cache: false,
                                success: function (data){
                                    toastr.error(data);
                                    $('.dataTable').DataTable().ajax.reload();
                                }
                            });
                        }
                    }
                }
            });
        });

     $(document).on('click', '.delete-and-refresh-btn', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $('#deleted_form').attr('action', url);
            console.log(url);
            $.confirm ({
                'title': 'Confirmation',
                'message': 'Are you sure?',
                'buttons': {
                    'Yes': {
                        'class': 'yes btn-danger',
                        'action': function() {
                            console.log("goint to " + url);
                            $.ajax({
                                url: url,
                                type: 'DELETE',
                                processData: false,
                                dataType: false,
                                cache: false,
                                success: function (data) {
                                    window.location.reload();
                                }
                            });
                        }
                    }
                }
            });
        });
</script>

<script>
    @if(session('errors'))
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif

    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(isset($success))
        toastr.success("{{ $success }}");
    @endif

    @if(session('info'))
        toastr.info("{{ session('info') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>

<script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>
<script>
    window.editors = {};
    document.querySelectorAll('.editor').forEach( ( node, index ) => {
        ClassicEditor
            .create( node, {
                ckfinder: {
                }
            })
            .then( newEditor => {
                newEditor.editing.view.change( writer => {
                    var height = node.getAttribute('data-height');
                    writer.setStyle('min-height', height + 'px', newEditor.editing.view.document.getRoot());
                } );
                window.editors[index] = newEditor
        } );
    } );
</script>
