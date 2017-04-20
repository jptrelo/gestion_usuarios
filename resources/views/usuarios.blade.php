@extends('master')
@section('content')

        <section id="importacion">
            <div class="container">
                <div class="row">

                    {!! Form::open(['url' => 'usuarios/importarUsuarios', 'method' => 'POST',
                                     'enctype' => 'multipart/form-data', 'class' => 'form-horizontal center-block col-xs-12 col-sm-8 col-md-6']) !!}

                        <div class="form-group">
                            <!-- File Button --> 
                            <div class="col-xs-9">
                                
                                {{ Form::file('fileExcel',
                                             ['class' => 'form-control input-file', 'required' => 'true', 'accept' => '.csv'])
                                }}
                            </div>

                            <!-- Button -->
                            <div class="col-xs-3">
                                {{ Form::button(
                                    '<span class="glyphicon glyphicon-upload"></span> Subir',
                                     ['class' => 'btn btn-success btn-block', 'type'=>'submit'])
                                }}
                            </div>
                        </div>           

                        @include('flash::message')

                    {!! Form::close() !!}                    

                </div>
            </div>
        </section>

        <section id="opcionesLista">
            <div class="container">
                <div class="row">
                    {!! Form::open(['url' => 'usuarios/', 'method' => 'GET', 'class' => 'form-horizontal center-block col-xs-12 col-sm-8 col-md-6']) !!}
                    <div class="form-group">
                        
                        <div class="col-xs-7">                    
                            {{ Form::text('txtNumRegistros', null, ['class' => 'form-control', 'placeholder' => 'Número de registros']) }}
                        </div>
                        <div class="col-xs-5">
                            <div class="dropdown btn-group">
                                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Orden</button>
                                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                  </button>

                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="#">Ascendente</a></li>
                                    <li><a href="#">Descendente</a></li>
                                  </ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::button(
                                    '<span class="glyphicon glyphicon-play-circle"></span> Procesar',
                                     ['class' => 'btn btn-info center-block', 'type'=>'submit'])
                                }}
                    </div>   
                    {!! Form::close() !!}

                </div>
            </div>
        </section>

        <section id="listaUsuarios">    
            <div class="container">
                <div class="row">
                    <div class="col-xs-6">
                            {{ $usuarios->links() }}
                    </div>
                    <div class="col-xs-6">
                        <div class="btn-group pull-right gestion-usuarios" role="group" aria-label="...">
                          <button type="button" class="btn btn-danger" id="elim-usuarios">Eliminar</button>
                          <button type="button" class="btn btn-warning" id="edit-usuarios">Editar</button>
                        </div>
                        <div class="btn-group pull-right gestion-edita" style="display:none;" role="group" aria-label="...">
                            <button type="button" class="btn btn-default cancela">Cancelar</button>
                            <button type="button" class="btn btn-success guarda">Guardar</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive">                     
                        
                        <table class="table table-hover table-striped tblUsuarios">
                            <thead>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @forelse ($usuarios as $usuario) 
                                    <tr id="trUsuario{{ $usuario->id }}">
                                        <td>{{ $usuario->id }}</td>
                                        <td>{{ $usuario->first_name }}</td>
                                        <td>{{ $usuario->last_name }}</td>
                                        <td>  
                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-default btn-xs">
                                                    <input type="checkbox" value="{{ $usuario->id }}" autocomplete="off">
                                                    <span class="glyphicon glyphicon-ok"></span>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No hay usuarios para mostrar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>                        
                    </div>    
                    {{ $usuarios->links() }}
                </div>
            </div>            
        </section>


        <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('librerias_js')
    <script type="text/javascript" src="{{ secure_asset('js/usuarios.js') }}"></script>
@stop