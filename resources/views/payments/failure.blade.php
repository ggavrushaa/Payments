@extends('layouts.main')

@section('main.content')
    <section>
        <div class="container">
            <div class="text-center">
                <div class="mb-4 text-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" fill="currentColor"
                        class="bi bi-x-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                </div>

                <h5>
                    Оплата не прошла
                </h5>

                <p>
                    Не свезло, с кем не бывает.
                    <br>
                    Не парься и попробуй еще пару раз.
                </p>

                <a href="{{ $payment->payable->getPayableUrl() }}" class="btn btn-primary">
                    Продолжить
                </a>
            </div>
        </div>
    </section>
@endsection