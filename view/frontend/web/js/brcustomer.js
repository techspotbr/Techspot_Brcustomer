require(['jquery','pessoaFisica','pessoaJuridica'], function($, pessoaFisica, pessoaJuridica){
    'use strict';
    
    $(document).ready(
        function(){
            pessoaFisica();

            var customerType = {
                pFisica : '1',
                pJuridica : '2',
            };

            $('#legal_type').on('change',function(){
                var ltSelected = $(this).val();

                if(ltSelected == customerType.pFisica){
                    pessoaFisica();
                } else if (ltSelected == customerType.pJuridica){
                    pessoaJuridica();
                }
            }).trigger('change');
        }
    );
});