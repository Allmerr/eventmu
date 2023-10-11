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

<form action="" id="delete-form" method="post">
    @method('delete')
    @csrf
</form>
<script>
    function notificationBeforeDelete(event, el, dt) {
        event.preventDefault();
        Swal.fire({
            title: 'Apa Kamu Yakin?',
            text: "Untuk Menghapus Data Ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengonfirmasi penghapusan, lakukan penghapusan dengan mengirimkan form
                $("#delete-form").attr('action', $(el).attr('href'));
                $("#delete-form").submit();
            }
        });
    }
</script>
