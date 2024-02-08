@extends('layouts.main')

@section('main.content')
    <section>
        <div class="container">
            <h4 class="mb-3">Мои заказы</h4>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title m-0">
                        Детали заказа
                    </h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-4">
                                <div class="text-muted">
                                    ID заказа
                                </div>
                            </div>

                            <div class="col-8">
                                {{$order->uuid}}
                            </div>
                        </div>
                    </li>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-4">
                                    <div class="text-muted">
                                        Сумма заказа
                                    </div>
                                </div>
    
                                <div class="col-8">
                                    {{ money(convert($order->amount), currency()) }} 
                                </div>
                            </div>
                        </li>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-muted">
                                            Статус заказа
                                        </div>
                                    </div>
        
                                    <div class="col-8">
                                       <div class="text-{{$order->status->color()}}">
                                            {{$order->status->name()}}
                                       </div>
                                    </div>
                                </div>
                            </li>
                            
                            @if ($order->status->isPending())
                            <div class="card-body">
                                <form action="{{ route('orders.payment', $order->uuid) }}" method="POST">
                                    @csrf
        
                                    <button type="submit" class="btn btn-primary">
                                        Перейти к оплате
                                    </button>
                                </form>
                            </div>
                        @endif

                </ul>
            </div>
        </div>
        </div>
    </section>
@endsection