<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $plan->name ?? '' }}">
</div>
<div class="form-group">
    <label>Preço:</label>
    <input type="text" name="price" class="form-control" placeholder="Preço:" value="{{ $plan->price ?? '' }}">
</div>
<div class="form-group">
    <label>Descrição:</label>
    <input type="text" name="description" class="form-control" placeholder="Descrição:"
        value="{{ $plan->description ?? '' }}"> {{-- no Value traz o valor preenchido --}}
</div>

<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>