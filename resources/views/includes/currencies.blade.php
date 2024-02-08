@php
    $currencies = \App\Services\Currencies\Models\Currency::getCached();
@endphp

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{currency()}}
    </a>
    <ul class="dropdown-menu">
      @foreach ($currencies as $currency)
        <li>
           <a href="{{route('currency', $currency)}}" class="dropdown-item">
               {{$currency->id}}
           </a>
        </li>
      @endforeach
    </ul>
</li>