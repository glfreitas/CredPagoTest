@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Monitor de URL´s') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <a class="btn btn-primary" href="{{ route('sites.index') }}" role="button"
                                data-toggle="tooltip" data-placement="top" title="Atualizar"><i class="fas fa-plus"></i>
                                Cadastrar</a>
                        </div>

                    </div>


                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">URL</th>
                                <th scope="col">Status</th>
                                <th scope="col">Atualização</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dados as $row)
                            <tr>
                                <th scope="row">{{ $row->id }}</th>
                                <td>{{ $row->descricao }}</td>
                                <td><a href="{{ $row->url }}" target="_blank">{{ $row->url }}</a></td>
                                <td><span
                                        class="badge badge-{{ ($row->status == 'Disponivel') ? 'success' : 'danger'; }}">{{ $row->status }}</span>
                                </td>
                                <td>{{ $row->atualizacao }}</td>
                                <td>
                                    <form method="POST" action="{{ route('sites.destroy', $row->id) }}">
                                        <a class="btn btn-primary" href="{{ route('testsite',$row->id) }}" role="button"
                                            data-toggle="tooltip" data-placement="top" title="Atualizar"><i
                                                class="fas fa-sync"></i></a>
                                        <a class="btn btn-success" href="{{ route('sites.show',$row->id) }}"
                                            role="button" data-toggle="tooltip" data-placement="top"
                                            title="Visualizar"><i class="fas fa-search"></i></a>
                                        <a class="btn btn-warning" href="{{ route('sites.edit',$row->id) }}"
                                            role="button" data-toggle="tooltip" data-placement="top" title="Editar"><i
                                                class="fas fa-edit"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit" role="button" data-toggle="tooltip"
                                            data-placement="top" title="Remover"><i
                                                class="fa fa-trash-alt"></i></button>
                                    </form>
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