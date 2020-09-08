@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 offset-2">

        <h2>Minhas reservas atuais</h2>
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
