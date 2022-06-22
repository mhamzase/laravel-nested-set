<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Nested Set</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Nunito', sans-serif;
        }

     

        @media print {
            .form-area, .print-btn, .heading-category{
                display:none;
            }
            .printTable {
                border:1px solid black;
                background-color: white;
                /* height: 100%; */
                width: 98%;
                position: fixed;
                top: 0;
                left: 0;
                margin: 10px;
                /* padding: 15px; */
                font-size: 14px;
                /* line-height: 18px; */
            }
        }
    </style>
</head>

<body>
    <div class="bg"></div>
    <div class="container my-5 col-6">
        <form method="post" action="{{ route('categories.store') }}">
            @csrf
            <div class="form-area row mb-4">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                    @endforeach
                @endif

                <div class="col-5">
                    <label for="name" class="form-label">Category name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="col-5">
                    <label for="name" class="form-label">Select parent category</label>
                    <select name="parent_id" id="parent_id" class="form-control">
                        <option value="0">No parent</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2 position-relative">
                    <button type="submit" class="btn btn-dark position-absolute bottom-0">Submit</button>
                </div>
            </div>
        </form>

        <h5 class="display-4 my-4 heading-category">Categories</h5>
        <table class="printTable table table-striped mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Parent</th>
                    <th>Child</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->ancestors->count() ? implode(' > ', $category->ancestors->pluck('name')->toArray()) : 'No parent' }}
                        </td>
                        <td>{{ $category->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- {!! '<span class="badge text-bg-dark">Top Level</span>' !!} --}}
        <div class="text-end">
            <button class="btn btn-dark print-btn">Print Table</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

    <script>
        document.querySelector('.print-btn').addEventListener('click', function () {
            window.print();
        });
    </script>
</body>

</html>
