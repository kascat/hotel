<form
        id="hotel-form"
        action="{{ $hotel->id ? route('hotels.update', ['hotel' => $hotel->id]) : route('hotels.store') }}"
        method="{{ $hotel->id ? 'put' : 'post' }}"
>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Dados do Hotel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <label class="col-12">
                    Nome
                    <input class="form-control" value="{{ $hotel->name }}" name="name" required type="text">
                </label>
                <label class="col-12">
                    Endereço
                    <input class="form-control" value="{{ $hotel->address }}" name="address" required type="text">
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
                                    {{ $hotel->category == $i ? 'checked' : '' }}
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

    defineCategory({{ $hotel->category ?: 1 }});

    $('#hotel-form').on('submit', function (e) {
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
