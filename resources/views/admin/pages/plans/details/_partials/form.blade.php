@csrf
{{-- Esse formulário será utilizado/incluido dentro de details/create.blade.php --}}
<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="name" placeholder="Nome" class="form-control" value="{{ $detail->name ?? old('name') }}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-info">Enviar</button>
</div>