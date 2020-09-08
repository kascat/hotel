@extends('layouts.app')

@section('content')
    <div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form
                    id="reservation-form"
                    action="{{ route('new_reservation') }}"
                    method="post"
            >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reserva</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <label class="col-12">
                                Hotel/Quartos disponíveis
                                <select name="room" required class="form-control">
                                    <option value="">Selecione</option>
                                    @foreach($reservations as $reservation)
                                        <option value="{{ $reservation->id }}">
                                            {{ $reservation->hotel->name }} /
                                            {{ $reservation->detail }}
                                            ({{ $reservation->category ?: 1 }}) estrelas
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Reservar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 offset-2">

            <div class="card-header row">
                <div class="col-6">
                    <h1 class="">Minhas reservas</h1>
                </div>
                <div class="col-6 text-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form-modal">
                        Nova
                    </button>
                </div>
            </div>
            <br>
            <table class="table align-items-center">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Detalhe</th>
                    <th scope="col">Hotel</th>
                    <th scope="col">Categoria</th>
                </tr>
                </thead>
                <tbody class="list">
                @forelse(Auth::user()->rooms as $room)
                    <tr>
                        <th>
                            {{ $room->detail }}
                        </th>
                        <td>
                            {{ $room->hotel->name ?? 'Sem informação' }}
                        </td>
                        <td>
                            @for ($i = 0; $i < ($room->category ?: 1); $i++)
                                <i class="fa fa-star" style="color: #ff9d06"></i>
                            @endfor
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th colspan="5">
                            <div class="alert alert-info">
                                Não há reservas
                            </div>
                        </th>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        defineCategory = function (category) {
            $('.label-star').css('color', 'inherit');

            for (var i = 1; i < 6; i++) {
                if (i <= category) {
                    $(`.category-star${i}`).css('color', '#ff9d06');
                }
            }
        };


        $('#reservation-form').on('submit', function (e) {
            e.preventDefault();

            const form = $(this);

            swal({
                title: "Confirma a reserva deste quarto?",
                icon: "info",
                buttons: true,
                dangerMode: true,
            })
                .then((confirmed) => {
                    if (confirmed) {
                        $.ajax({
                            url: form.attr('action'),
                            method: form.attr('method'),
                            data: form.serialize(),
                            success: function () {
                                swal("Reserva realizada com sucesso!", {icon: "success"}).then(() => {
                                    $('#form-modal').modal('hide');
                                    window.location.reload();
                                });
                            },
                            error: function () {
                                swal("Falha ao reservar!", {icon: "error"});
                            }
                        });
                    }
                });
        })
    </script>
@endsection

