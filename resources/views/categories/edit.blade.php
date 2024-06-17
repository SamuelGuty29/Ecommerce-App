<x-app title="Editar categoria">
    <section class="container my-5">
        <div class="card">
            <div class="card-header">
                <h2 class="h4">Editar categoria</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.update', ['category' => $category->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <x-categories.form :category="$category" />
                </form>
            </div>
        </div>
    </section>
</x-app>
