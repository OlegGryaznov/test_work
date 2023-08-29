@extends('layout.app')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Список пользователей</h3>
                <a href="{{ route('users.create') }}" class="btn btn-primary">Создать пользователя</a>
            </div>

            <div id="list-container">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>city</th>
                        <th>count images</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                <button class="btn btn-primary" id="btn-load-more">Загрузить еще</button>
            </div>
        </div>
    </div>

@push('scripts')
    <script>
        let btnLoadMore, listContainer;
        let offsetValue = 15;
        let limitValue = 15;

        function fetchUsers() {
            instanceAxios.get(`users?offset=${offsetValue}&limit=${limitValue}`).then(response => {
                let collection = [];

                response.data.data.forEach(obj => {
                    let tr = document.createElement('tr');
                    for (prop in obj) {
                        let td = document.createElement('td');
                        td.innerHTML = obj[prop]
                        tr.appendChild(td)
                    }

                    collection.push(tr);
                })

                render(collection);
                offsetValue += 15;
            })
        }

        function render(items) {
            items.forEach(item => listContainer.querySelector('tbody').appendChild(item))
        }

        window.onload = function () {
            btnLoadMore = document.querySelector('#btn-load-more');
            btnLoadMore.addEventListener('click', fetchUsers)
            listContainer = document.querySelector('#list-container');
            fetchUsers();
        }
    </script>
@endpush
@endsection

