@extends('layouts.navbar')

@section('headExtension')
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Persona | News </title>
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('container')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
          <h1>News</h1>
        </div>
    </div>
    <div class="d-flex justify-content-end mb-1">
        <a href="createNews"><button type="button" class="btn btn-primary">create news</button></a>
    </div>
  </div>
</section>

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Date Created</th>
                    <th>Active on Mobile</th>
                    <th>Carousel Active</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php $i=1; @endphp
                    @if ($reference != null)
                    @forelse ($reference as $key => $item)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $item['title']}}</td>
                      <td>{{ date('d-m-Y', strtotime($item['date_created']))}}</td>
                      <td>{{ $item['is_active']}}</td>
                      <td>{{ $item['is_carousel']}}</td>
                      <td> 
                        <a href="showNews/{{ $key }}"><i class="far fa-eye mr-2"></i></a>
                        <a href="showNews/{{ $key }}/edit"><i class="far fa-edit mr-2"></i></a>
                        <a href="showNews/{{ $key }}/delete"><i class="fas fa-folder-minus"></i></a>
                      </td>
                    </tr>
                    @empty
                      <tr>
                        <td>No Record Found</td>
                      </tr>
                    @endforelse
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@section('footExtension')
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection