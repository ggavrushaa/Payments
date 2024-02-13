<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Оплата</title>
</head>
<body>
  <section>
    <div class="container">
        <div class="pt-5">
            <div class="row">
                <div class="col-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>Оплата Bitcoin</h5>

                            <p>
                                Переведите {{ money($payment->driver_amount, $payment->driver_currency_id, 8) }} на адрес:
                            </p>

                            <div class="alert alert-secondary small">
                                {{ $payment->driver_wallet }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
    <script>
        setTimeout(function(){
            window.location.reload();
        }, 5000);
    </script>
</body>
</html>