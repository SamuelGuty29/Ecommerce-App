<x-app title="Productos">
    <section class="container">
        <div class="d-flex justify-content-center my-4">
            <h1>Listado de productos</h1>
        </div>
        <Product-List :products="{{ $products }}" :category_data = "{{ $categories }}" />
        
        </div>
    </section>
</x-app>
