<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>

    <header class="p-3 text-bg-dark">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
              <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              {{-- <li><a href="#" class="nav-link px-2 text-secondary">Home</a></li>
              <li><a href="#" class="nav-link px-2 text-white">Features</a></li>
              <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
              <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
              <li><a href="#" class="nav-link px-2 text-white">About</a></li> --}}
              <li class="nav-link px-2 text-white"><h1>{{ $evaluation->name }}</h1></li>
            </ul>

          </div>
        </div>
      </header>


      <main>
        <div class="container p-4">
            @foreach ($evaluation->quizzes as $quiz)

            <h4>{{ $quiz->question }}</h4>



                <form action="{{ route('prueba-completada', $evaluation) }}" method="post">
                    @csrf

                @if ($quiz->is_long)

                <div class="my-3">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Deja tu respuesta" name="long_answer" id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">Respuesta</label>
                    </div>
                </div>

                @else

                <div class="my-3">
                    <div class="form-check">
                        <input id="credit" name="answer_{{ $quiz->id }}" type="radio" class="form-check-input" >
                        <label class="form-check-label" for="answer_{{ $quiz->id }}">{{ $quiz->answer_1 }}</label>
                    </div>
                    <div class="form-check">
                        <input id="debit" name="answer_{{ $quiz->id }}" type="radio" class="form-check-input" >
                        <label class="form-check-label" for="answer_{{ $quiz->id }}">{{ $quiz->answer_2 }}</label>
                    </div>
                    <div class="form-check">
                        <input id="paypal" name="answer_{{ $quiz->id }}" type="radio" class="form-check-input" >
                        <label class="form-check-label" for="answer_{{ $quiz->id }}">{{ $quiz->answer_3 }}</label>
                    </div>
                    <div class="form-check">
                        <input id="paypal" name="answer_{{ $quiz->id }}" type="radio" class="form-check-input" >
                        <label class="form-check-label" for="answer_{{ $quiz->id }}">{{ $quiz->answer_4 }}</label>
                    </div>
                </div>

                @endif



                <hr class="my-4">


            @endforeach

                <button class="btn btn-primary btn-lg">Enviar resultado</button>


            </form>


        </div>
      </main>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
