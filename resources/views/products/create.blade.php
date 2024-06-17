<x-app title="Crear Producto">
    <section class="container my-5">
        <div class="card">
            <div class="card-header">
                <h2 class="h4">Crear producto</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <x-products.form />
                </form>
            </div>
        </div>
    </section>
</x-app>
