@extends('layouts.front')

@section('content')

    <div class="container">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h2>Dados para Pagamento</h2>
                    <hr>
                </div>
            </div>
            <form action="" method="post">                
                <div class="row">
                    <div class="col-md-12  form-group">
                        <label>Número do cartão </label>
                        <input type="text" class="form-control" name="card_number"><span class="brand"></span>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>Mês de expiração</label>                        
                        <input type="text" class="form-control" name="car_month">
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Ano de expiração</label>
                        <input type="text" class="form-control" name="car_year">
                    </div>
                </div>  
                <div class="row">
                    <div class="col-md-5 form-group">
                        <label>Código de segurança</label>
                        <input type="text" class="form-control" name="car_cvv">
                    </div>
                </div> 
                <button class="btn btn-success btn-lg">Confirmar Pagamento</button>          
            </form>            
        </div>
    </div>    
@endsection

@section('scripts')
    <script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js">
        const sessionId = '{{session()->get('pagseguro_session_code')}}';
        PagSeguroDirectPayment.setSessionId(sessionId);
    </script>

    <script type="text/javascript" >
        let cardNumber = document.querySelector('input[name=card_number]');
        let spanBrand = document.querySelector('span.brand');
        cardNumber.addEventListener('keyup',function(){ 
            if(cardNumber.value.length >= 6) {
                PagSeguroDirectPayment.getBrand({
                    cardBin:cardNumber,
                    success: function(res) {
                        let imgFlag= `<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${res.brand.name}.png">`;
                        spanBrand.innerHTML = imgFlag;
                    },
                    error: function(err) {
                        console.log(err);
                    },
                    complete: function(res) {
                        console.log('Complete:',res);
                    }
                });
            }
        });
    </script>
@endsection