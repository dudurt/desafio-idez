<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cidades</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style> 
            body {
                margin-top: 30px; 
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="container-sm">
            <form action="{{ route('pagintedcities') }}">
                <div class="form-group row">
                    <label class="col-sm-12 col-form-label text-center">
                        <h2>Busca de cidades por estado</h2>
                    </label>
                </div>
                <br>
                <div class="form-group row">
                    <label for="stateAcronym" class="col-sm-2 offset-sm-1 col-form-label text-end">
                        Estado:
                    </label>
                    <div class="col-sm-5">
                        <select class="form-select" id="stateAcronym" name="stateAcronym">
                            @foreach ($stateArr as $optStateAcronym => $optStateName)
                                <option value="{{$optStateAcronym}}" {{ $stateAcronym === $optStateAcronym ? "selected" : "" }}>{{$optStateName}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-primary" type="submit">Pesquisar</button>
                    </div>
                </div>
            </form>
            <br>
            <div class="col-sm-8 offset-sm-2">
                <table class="table table-dark table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nome Cidade</th>
                            <th scope="col">Codigo Ibge</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($citiesArr)
                            @foreach ($citiesArr as $city)
                                <tr>
                                    <td>{{ $city['name'] }} </td>
                                    <td>{{ $city['ibge_code'] }}</td>
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>

                @isset($citiesArr)
                    {{ $citiesArr->links() }}
                @endisset
            </div>
        </div>
    </body>
</html>