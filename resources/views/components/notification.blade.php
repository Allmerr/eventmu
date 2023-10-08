@if(count($errors))
    <script>
    Swal.fire({
        icon: 'error'
        title: 'Oops...',
        text: 'Please check your input',
    });
    </script>
@endif


@if(session()->has('error'))
    <script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ session()->get('error') }}',
    })
    </script>
@endif

@if (session()->has('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session()->get('success') }}',
    })
</script>
@endif
