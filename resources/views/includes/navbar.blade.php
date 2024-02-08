<nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
    <div class="container">
      <a class="navbar-brand" href="{{route('home')}}">
        Магазин
      </a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('orders')}}">
                Мои заказы
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('subscriptions')}}">
                Мои подписки
            </a>
          </li>

        </ul>

        <ul class="navbar-nav mb-2 mb-lg-0">
            @include('includes.currencies')
        </ul>
    </li>
      </div>
    </div>
  </nav>