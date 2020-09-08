<form
        id="room-form"
        action="{{ $room->id ? route('rooms.update', ['room' => $room->id]) : route('rooms.store') }}"
        method="{{ $room->id ? 'put' : 'post' }}"
>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Dados do Quarto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <label class="col-12">
                    Detalhe
                    <input class="form-control" value="{{ $room->detail }}" name="detail" required type="text">
                </label>
                <label class="col-12">
                    Hotel
                    <select name="hotel_id" required class="form-control">
                        <option value="">Selecione</option>
                    @foreach(\App\Model\Hotel::all() as $hotel)
                            <option value="{{ $hotel->id }}" {{ $hotel->id == $room->hotel_id ? 'selected' : '' }}>
                                {{ $hotel->name }}
                            </option>
                        @endforeach
                    </select>
                </label>
                <label class="col-12">
                    Hóspede
                    <select name="user_id" class="form-control">
                        <option value="">Livre</option>
                        @foreach(\App\Model\User::all() as $user)
                            <option value="{{ $user->id }}" {{ $user->id == $room->user_id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </label>
                <div class="col-12">
                    Categoria
                    <br>
                    @for ($i = 1; $i < 6; $i++)
                        <label class="fa fa-star label-star category-star{{ $i }}">
                            <input
                                    onchange="defineCategory($(this).val())"
                                    name="category"
                                    style="display: none"
                                    {{ $room->category == $i ? 'checked' : '' }}
                                    type="radio"
                                    value="{{ $i }}"
                            >
                        </label>
                    @endfor
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </div>
</form>

<script>
    defineCategory = function (category) {
        $('.label-star').css('color', 'inherit');

        for (var i = 1; i < 6; i++) {
            if (i <= category) {
                $(`.category-star${i}`).css('color', '#ff9d06');
            }
        }
    };

    defineCategory({{ $room->category ?: 1 }});

    $('#room-form').on('submit', function (e) {
        e.preventDefault();

        const form = $(this);

        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            success: function () {
                swal("Operação realizada com sucesso!", {icon: "success"}).then(() => {
                    $('#form-modal').modal('hide');
                    window.location.reload();
                });
            },
            error: function () {
                swal("Falha ao salvar!", {icon: "error"});
            }
        });
    })
</script>
