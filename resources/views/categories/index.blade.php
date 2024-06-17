<x-app title="Categorias">
    <section class="container">
        <div class="d-flex justify-content-center my-4">
            <h1>Listado de categorias</h1>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-end">
                <a href="{{ route('categories.create') }}" class="btn btn-primary">Crear categoria</a>
            </div>
            <div class="card-body">
                <div class="table-responsive my-4 mx-2">
                    <table class="table table-bordered" id="category_table">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <th scope="row">{{ $category->name }}</th>
                                    <th scope="row">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('categories.edit', ['category' => $category->id]) }}"
                                                class="btn btn-warning btn-sm"><i
                                                    class="fas fa-pencil-alt">Editar</i></a>

                                            <button class="ms-2 btn btn-danger btn-sm"
                                                onclick="deleteForm({{ $category->id }})">
                                                <i class="fas fa-trash">Eliminar</i>
                                            </button>

                                            <form id="delete_form_{{ $category->id }}"
                                                action="{{ route('categories.destroy', ['category' => $category->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                </div>
                </th>
                </tr>
                @endforeach
                </tbody>
                </table>
            </div>
        </div>
        </div>
    </section>
    <x-slot:scripts>
        <script>
            document.addEventListener("DOMContentLoaded", loadDatatable);

            function loadDatatable() {
                $('#category_table').DataTable()
            }


            async function deleteForm(category_id) {
                const response = await Swal.fire({
                    icon: 'warning',
                    title: 'Esta seguro de eliminar?',
                    showCancelButton: true
                })
                if (!response.isConfirmed) return
                document.getElementById(`delete_form_${category_id}`).submit();
            };
        </script>
    </x-slot:scripts>
</x-app>
