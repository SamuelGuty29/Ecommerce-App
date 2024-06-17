<x-app title="Inicio">
    <section class="my-3 d-flex justify-content-center">
        <h1>Listado de productos</h1>
    </section>
    <section class="d-flex flex-wrap justify-content-center">
        @foreach ($products as $product)
        <div class="card" style="width: 18rem;">
            <img src="{{$product->file->route}}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{$product->name}}</h5>
              <p class="card-text">{{$product->description}}</p>
              <a href="#" class="btn btn-primary">ver</a>
            </div>
          </div>
        @endforeach
    </section>
</x-app>
