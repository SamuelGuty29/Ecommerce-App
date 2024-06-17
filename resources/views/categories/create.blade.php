<x-app title="Crear categoria">
    <section class="container my-5">
        <div class="card">
            <div class="card-header">
                <h2 class="h4">Crear categoria</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <x-categories.form />
                </form>
            </div>
        </div>
    </section>
</x-app>
