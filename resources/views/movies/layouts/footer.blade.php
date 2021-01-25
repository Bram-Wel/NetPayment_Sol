@stack('modals')

@livewireScripts
@stack("scripts")
<script src="{{ asset('js/assets/sweetalert.min.js') }}"></script>
<script type="module" src="{{ asset('js/assets/ionicons.esm.js') }}"></script>
<script nomodule="" src="{{ asset('js/assets/ionicons.min.js') }}"></script>

<script>
    window.addEventListener('alert', event => {
        Swal.fire({
            position: 'center',
            icon: event.detail.type,
            title: event.detail.title,
            message: event.detail.message,
            showConfirmButton: true,
        });
    })
</script>

<script>
    @if(session()->has('message'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.success("{{ session('message') }}");
    @endif

        @if(session()->has('error'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.error("{{ session('error') }}");
    @endif

        @if(session()->has('info'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.info("{{ session('info') }}");
    @endif

        @if(session()->has('warning'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.warning("{{ session('warning') }}");
    @endif
</script>
</body>
</html>
