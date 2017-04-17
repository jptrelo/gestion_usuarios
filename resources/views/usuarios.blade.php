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
                                             ['class' => 'form-control input-file', 'required' => 'true'])
                                }}
                            </div>

                            <!-- Button -->
                            <div class="col-xs-3">
                                {{ Form::button(
                                    '<span class="glyphicon glyphicon-upload"></span> Subir',
                                     ['class' => 'btn btn-info', 'type'=>'submit'])
                                }}
                            </div>
                        </div>                
                    {!! Form::close() !!}
                </div>
            </div>
        </section>

        <section id="opcionesLista">
            <div class="container">
                <div class="row">
                    {!! Form::open(['url' => 'usuarios/', 'method' => 'POST', 'class' => 'form-horizontal center-block col-xs-12 col-sm-8 col-md-6']) !!}
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
                    <div class="table-responsive">
                        {{ $usuarios->links() }}
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario) 
                                    <tr>
                                        <td>{{ $usuario->id }}</td>
                                        <td>{{ $usuario->first_name }}</td>
                                        <td>{{ $usuario->last_name }}</td>
                                        <td>
                                            <div class="btn-group" data-toggle="buttons">
                                              <label class="btn btn-info">
                                                <input type="checkbox" autocomplete="off">
                                              </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $usuarios->links() }}
                    </div>    
                </div>
            </div>
        </section>

@stop

@section('librerias_js')
    <script src="{{ asset('js/usuarios.js') }}" />
@stop