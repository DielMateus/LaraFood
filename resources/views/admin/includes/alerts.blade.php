@if ($errors->any())
    <div class="alert alert-warning">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>

@endif

{{-- Mensagem de sucesso exibido em DetailPlanController no método destroy --}}
{{-- Se existir a sessão message então exibirá a mensagem de sucesso --}}
@if (session('message')) 
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif