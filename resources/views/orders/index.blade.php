@extends('layouts.main')

@section('main.content')
    <section>
        <div class="container">
            <h4 class="mb-3">Мои заказы</h4>
            @if ($orders->isEmpty())
                Нет ни одной записи
            @else
            <div class="table-responsive">
                <table class="table">
                    <th>ID</th>
                    <th>Сумма</th>
                    <th>Статус</th>
                    @foreach ($orders as $order)
                    <tr>

                        <td>
                            {{ $order->uuid }}
                        </td>

                        <td>
                            {{ money(convert($order->amount), currency()) }} 
                        </td>
                        
                        <td class="text-{{$order->status->color()}}">
                            {{ $order->status->name() }}
                        </td>

                        <td>
                            <a href="{{ route('orders.show', $order->uuid) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                  </svg>
                            </a>
                        </td>

                    </tr>
                        @endforeach
                </table>
            </div>
            @endif
        </div>
    </section>
@endsection