@extends('layouts.app')
@section('content')
    <div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        </div>
    </div>
{{--<div class="table-responsive">--}}
    <div>
        <div class="card-header row">
            <div class="col-6">
                <h1 class="">Hotéis</h1>
            </div>
            <div class="col-6 text-right">
                @if(Auth::user()->role == 'master')
                    <button onclick="loadForm('{{ route('hotels.create') }}')" type="button"
                            class="btn btn-primary" data-toggle="modal" data-target="#form-modal">
                        Novo
                    </button>
                @endif
            </div>
        </div>
        <table class="table align-items-center">
            <thead class="thead-light">
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Endereço</th>
                <th scope="col">Quartos</th>
                <th scope="col">Categoria</th>
                @if(Auth::user()->role == 'master')<th scope="col">Ação</th>@endif
            </tr>
            </thead>
            <tbody class="list">
            @forelse($hotels as $hotel)
                <tr>
                    <th>
                        {{ $hotel->name }}
                    </th>
                    <td>
                        {{ $hotel->address }}
                    </td>
                    <td>
                        {{ count($hotel->rooms) }}
                    </td>
                    <td>
                        @for ($i = 0; $i < ($hotel->category ?: 1); $i++)
                            <i class="fa fa-star" style="color: #ff9d06"></i>
                        @endfor
                    </td>
                    @if(Auth::user()->role == 'master')
                    <td class="text-right">
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <button
                                        onclick="remove('{{ route('hotels.destroy', ['hotel' => $hotel->id]) }}')"
                                        class="dropdown-item"
                                >
                                    Excluir
                                </button>
                                <button onclick="loadForm('{{ route('hotels.edit', ['hotel' => $hotel->id]) }}')" type="button" class="dropdown-item" data-toggle="modal" data-target="#form-modal">
                                    Editar
                                </button>
                            </div>
                        </div>
                    </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <th colspan="5">
                        <div class="alert alert-info">
                            Não há hotéis
                        </div>
                    </th>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
{{--</div>--}}
@endsection

@section('scripts')
    @parent
    <script>
        function remove(url) {
            swal({
                title: "Deseja excluir este hotel?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url,
                            method: 'delete',
                            success: function () {
                                swal("Operação realizada com sucesso!", {icon: "success"}).then(() => {
                                    window.location.reload();
                                });
                            },
                            error: function () {
                                swal("Falha na operação!", {icon: "error"});
                            }
                        });
                    }
                });
        }

        function loadForm(url) {
            $.ajax({
                url,
                method: 'get',
                success: function (response) {
                    $('#form-modal .modal-dialog').html(response);
                },
                error: function () {
                    $('#form-modal .modal-dialog').html('<br><div class="alert alert-warning">Falha ao carregar dados</div>');
                }
            });
        }
    </script>
@endsection
