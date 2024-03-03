
<a href="{{ $edit_url }}" class="btn btn-warning btn-sm text-white"> <i class="fa fa-pencil-square-o"></i></a>

<form action="{{ $destroy }}" method="post" class="inline">
  <button type="submit" class="btn btn-danger btn-sm hapus" data-id="{{$pakaian->id_pakaian}}"><i class="fa fa-trash-o"></i></button>
    @method('delete')
    @csrf
</form>
<!--  -->
<script>
    $(document).on('click', '.hapus', function(e) {
      var pakaianid = $(this).attr('data-id');
       var form =  $(this).closest("form");
        event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "Anda Ingin Menghapus Data "+pakaianid+"  ",
                icon: 'warning',

                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                  form.submit();
                Swal.fire({
                title: 'Deleted!',
                text: 'Your file has been deleted.',
                icon: 'success',
                timer: 4000,
                showConfirmButton: false,
              
                })
                }
            })
        });
</script>
<!-- {{ $destroy }}  -->