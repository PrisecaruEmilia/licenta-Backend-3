@extends('admin.admin_master')
@section('admin')
    <div class="page-wrapper">
        <div class="page-content">



            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Toate Subcategoriile </h5>
                        </div>
                        <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>SL</th>
                                    <th>Nume Categorie </th>
                                    <th>Nume Subcategorie </th>
                                    <th>Acțiune</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach ($subcategory as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->category_name }}</td>
                                        <td>{{ $item->subcategory_name }}</td>

                                        <td>
                                            <a href="{{ route('subcategory.edit', $item->id) }}" class="btn btn-info"><i
                                                    class="lni lni-pencil-alt"></i>
                                            </a>
                                            <a href="{{ route('subcategory.delete', $item->id) }}" class="btn btn-danger"
                                                id="delete"><i class="lni lni-trash"></i> </a>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>




        </div>
    </div>
@endsection
