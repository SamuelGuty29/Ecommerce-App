<x-app title="Editar producto">
    <section class="container my-5">
        <div class="card">
            <div class="card-header">
                <h2 class="h4">Editar producto</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <x-products.form :product="$product" />
                </form>
            </div>
        </div>
    </section>
</x-app>
