@extends('layouts.front')

@section('content')

    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <h2>Dados para Pagamento</h2>
                    <hr>
                </div>
            </div>
            <form action="" method="post">     
                
                <div class="row">
                    <div class="col-md-6  form-group">
                        <label>Nome no cartão </label>
                        <input type="text" class="form-control" name="card_name">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6  form-group">
                        <label>Número do cartão </label>
                        <input type="text" class="form-control" name="card_number">
                        <input type="hidden" name="card_brand">
                    </div>
                    <div class="col-md-3 form-group pt-md-4 mt-2">
                        <span class="brand"></span>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label>Mês de expiração</label>                        
                        <input type="text" class="form-control" name="card_month">
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Ano de expiração</label>
                        <input type="text" class="form-control" name="card_year">
                    </div>
                </div>  
                <div class="row">
                    <div class="col-md-5 form-group">
                        <label>Código de segurança</label>
                        <input type="text" class="form-control" name="card_cvv">
                    </div>
                    <div class="col-md-8 installments form-group"></div>
                </div> 
                <button class="proccessCheckout btn btn-success btn-lg">Confirmar Pagamento</button>          
            </form>            
        </div>
    </div>    
@endsection

@section('scripts')
    <script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <script src="{{ asset('assets/js/jquery.ajax.js')}}"></script>    
    <script>
        const sessionId = '{{session()->get('pagseguro_session_code')}}';        
        PagSeguroDirectPayment.setSessionId(sessionId);
    </script>

    <script>
        
        let amountTransaction = '{{$cartItems}}';
        let cardNumber = document.querySelector('input[name=card_number]');
        let spanBrand = document.querySelector('span.brand');

        cardNumber.addEventListener('keyup',function(){ 
            if(cardNumber.value.length >= 6) {
                PagSeguroDirectPayment.getBrand({
                    cardBin:cardNumber.value.substr(0,6),
                    success: function(res) {
                        let imgFlag= `<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${res.brand.name}.png">`;
                        spanBrand.innerHTML = imgFlag;
                        document.querySelector('input[name=card_brand]').value = res.brand.name;
                        getInstallments(amountTransaction, res.brand.name);
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

        function getInstallments(amount, brand){
            PagSeguroDirectPayment.getInstallments({
                amount: amount,
                maxInstallmentNoInterest: 0,
                brand: brand,
                    success: function(res){
                        let selectInstallments = drawSelectInstallments(res.installments[brand]);
                        document.querySelector('div.installments').innerHTML = selectInstallments;
                },
                    error: function(err) {
                        // callback para chamadas que falharam.
                },
                    complete: function(res){
                        // Callback para todas chamadas.
                }
            });
        }

        let submitButton = document.querySelector('button.proccessCheckout');

        submitButton.addEventListener('click',function(event){
                event.preventDefault();
                PagSeguroDirectPayment.createCardToken({
                cardNumber: document.querySelector('input[name=card_number').value, // Número do cartão de crédito
                brand:      document.querySelector('input[name=card_brand]').value, // Bandeira do cartão
                cvv:        document.querySelector('input[name=card_cvv]').value, // CVV do cartão
                expirationMonth: document.querySelector('input[name=card_month').value, // Mês da expiração do cartão
                expirationYear:  document.querySelector('input[name=card_year').value, // Ano da expiração do cartão, é necessário os 4 dígitos.
                success: function(res) {
                        console.log(res);
                        proccessPayment(res.card.token);
                }
            });
        });

        function proccessPayment(token){
            let data = { 
                card_token: token,
                hash: PagSeguroDirectPayment.getSenderHash(),
                installment: document.querySelector('select.select_installments').value,
                card_name: document.querySelector('input[name=card_name]').value,
                _token: '{{csrf_token()}}'
            }
           
            $.ajax({
                type:'POST',
                url:'{{route("checkout.proccess")}}',
                data: data,
                dataType:'json',
                success: function(res) {
                    console.log(res);
                }
            });
        }

        function drawSelectInstallments(installments) {
            let select = '<label>Opções de Parcelamento:</label>';

            select += '<select class="form-control select_installments">';

            for(let l of installments) {
                select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - Total fica ${l.totalAmount}</option>`;
            }

            select += '</select>';

            return select;
	    }

    </script>
@endsection