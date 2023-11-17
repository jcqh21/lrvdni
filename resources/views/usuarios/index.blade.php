@php
    $html_tag_data = [];
    $title = 'Usuarios del Sistema';
    $description= 'Contiene todos los Usuarios que son Añadidos al Sistema';
    $breadcrumbs = ["/"=>"Pagina Principal"]
@endphp
@extends('layout',[
'html_tag_data'=>$html_tag_data,
'title'=>$title,
'description'=>$description
])

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/vendor/datatables.min.css') }}"/>
@endsection

@section('js_vendor')
    <script src="{{ asset('/js/vendor/bootstrap-submenu.js') }}"></script>
    <script src="{{ asset('/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('/js/vendor/mousetrap.min.js') }}"></script>
@endsection

@section('js_page')
    <script src="{{ asset('/js/cs/datatable.extend.js') }}"></script>
    <script src="{{ asset('/js/plugins/datatable.editablerows.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <!-- Title and Top Buttons Start -->
                <div class="page-title-container">
                    <div class="row">
                        <!-- Title Start -->
                        <div class="col-12 col-md-7">
                            <h1 class="mb-0 pb-0 display-4" id="title">{{ $title }}</h1>
                            @include('_layout.breadcrumb',['breadcrumbs'=>$breadcrumbs])
                        </div>
                        <!-- Title End -->

                        <!-- Top Buttons Start -->
                        <div class="col-12 col-md-5 d-flex align-items-start justify-content-end">
                            <!-- Add New Button Start -->
                            <a class="btn btn-outline-primary btn-icon btn-icon-start w-100 w-md-auto add-datatable" href="{{ route('usuarios.create') }}">Nuevo</a>                            
                            <!-- Add New Button End -->
                        </div>
                        <!-- Top Buttons End -->
                    </div>
                </div>
                <!-- Title and Top Buttons End -->

                <!-- Content Start -->
                <div class="data-table-rows slim">
                    <!-- Table Start -->
                    <div class="data-table-responsive-wrapper">
                        <table id="datatableRows" class="data-table nowrap hover">
                            <thead>
                            <tr>
                                <th class="text-muted text-small text-uppercase">Id</th>
                                <th class="text-muted text-small text-uppercase">Nombre y Apellidos</th>
                                <th class="text-muted text-small text-uppercase">E-mail</th>
                                <th class="text-muted text-small text-uppercase">Rol</th>
                                <th class="text-muted text-small text-uppercase">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario)
                                <tr>
                                  <td style="display: none;">{{ $usuario->id }}</td>
                                  <td>{{ $usuario->name }}</td>
                                  <td>{{ $usuario->email }}</td>
                                  <td>
                                    @if(!empty($usuario->getRoleNames()))
                                      @foreach($usuario->getRoleNames() as $rolNombre)                                       
                                        <h5><span class="badge badge-dark">{{ $rolNombre }}</span></h5>
                                      @endforeach
                                    @endif
                                  </td>

                                  <td>                                  
                                    <a class="btn btn-info" href="{{ route('usuarios.edit',$usuario->id) }}">Editar</a>

                                    {!! Form::open(['method' => 'DELETE','route' => ['usuarios.destroy', $usuario->id],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                  </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Table End -->
                </div>
                <!-- Content End -->

                <!-- Add Edit Modal Start -->
                <div class="modal modal-right fade" id="addEditModal" tabindex="-1" role="dialog"
                     aria-labelledby="modalTitle" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitle">Add New</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input name="Name" type="text" class="form-control"/>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Sales</label>
                                        <input name="Sales" type="number" class="form-control"/>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Stock</label>
                                        <input name="Stock" type="number" class="form-control"/>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Category</label>
                                        <div class="form-check">
                                            <input type="radio" id="category1" name="Category" value="Whole Wheat"
                                                   class="form-check-input"/>
                                            <label class="form-check-label" for="category1">Whole Wheat</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="category2" name="Category" value="Sourdough"
                                                   class="form-check-input"/>
                                            <label class="form-check-label" for="category2">Sourdough</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="category3" name="Category" value="Multigrain"
                                                   class="form-check-input"/>
                                            <label class="form-check-label" for="category3">Multigrain</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tag</label>
                                        <div class="form-check">
                                            <input type="radio" id="tag1" name="Tag" value="New"
                                                   class="form-check-input"/>
                                            <label class="form-check-label" for="tag1">New</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="tag2" name="Tag" value="Sale"
                                                   class="form-check-input"/>
                                            <label class="form-check-label" for="tag2">Sale</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="tag3" name="Tag" value="Done"
                                                   class="form-check-input"/>
                                            <label class="form-check-label" for="tag3">Done</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel
                                </button>
                                <button type="button" class="btn btn-primary" id="addEditConfirmButton">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add Edit Modal End -->
            </div>
        </div>
    </div>
@endsection