@extends('layout.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Создать пользователя</h3>
        <a href="{{ route('users.index') }}" class="btn btn-success">Список пользователей</a>
    </div>
    <div class="row">
        <h3 class="result"></h3>
        <div class="col-12">
            <form class="form" id="form">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name">
                    <span id="error-name" class="error d-none"></span>
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city">
                    <span id="error-city" class="error d-none"></span>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    <span id="error-image" class="error d-none"></span>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" id="create-btn">Создать</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function createUser() {
            const resultDiv = document.querySelector('.result');
            resultDiv.innerHTML = '';

            let data = new FormData();
            data.append('name', document.querySelector('#name').value);
            data.append('city', document.querySelector('#city').value);
            data.append('image', document.querySelector('#image').files[0])

            instanceAxios.post('users', data).then(response => {
                clearErrors();
                resultDiv.innerHTML = 'Пользователь создан успешно!'
                document.querySelector('#form').reset();
            }).catch(e => {
                clearErrors()

                let errors = e.response.data.errors;

                for(let prop in errors) {
                    let element = document.querySelector(`#error-${prop}`);
                    element.classList.remove('d-none');

                    errors[prop].forEach(error => {
                        let span = document.createElement('span');
                        span.innerHTML = error;
                        element.appendChild(span)
                    })
                }
            });
        }

        function clearErrors() {
            document.querySelectorAll('.error').forEach(element => {
                element.innerHTML = '';
                element.classList.add('d-none')
            })
        }

        window.onload = function () {
            let button = document.querySelector('#create-btn');
            button.addEventListener('click', function (e) {
                e.preventDefault();
                createUser();
            })
        }
    </script>
@endsection
