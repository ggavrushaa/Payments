@extends('layouts.main')

@section('main.content')
    <section>
        <div class="container">
            <h1>Redirect for payment</h1>
        </div>
        <script>
            window.location.href = "{{ $entity->url }}";
        </script>
    </section>
@endsection