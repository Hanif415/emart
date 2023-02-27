@if(session('success'))
    <div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismis="alert" aria-label="Close"></button>
    </div>
@elseif(session('error'))
    <div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close align-items-end" data-bs-dismis="alert" aria-label="Close"></button>
    </div>
@endif
