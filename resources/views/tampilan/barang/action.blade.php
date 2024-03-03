<a href="{{ $detail }}" class="tool btn btn-blue btn-sm text-white"><span class="toolText-left">Detail</span>
  <i class="fa fa-eye"></i></a>
<a href="{{ $edit_url }}" class="tool btn btn-warning btn-sm text-white"><span class="toolText-top">Edit</span> <i class="fa fa-pencil-square-o"></i></a>

<form action="{{ $destroy }}" method="post" class="inline">
  <button type="submit" class="tool btn btn-danger btn-sm hapus" data-id="{{$barang->id}}"><span class="toolText-right">Delete</span><i class="fa fa-trash-o"></i></button>
    @method('delete')
    @csrf
</form>
<!--  -->
<script>
    $(document).on('click', '.hapus', function(e) {
      var barangid = $(this).attr('data-id');
       var form =  $(this).closest("form");
        event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "Anda Ingin Menghapus Data "+barangid+"  ",
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