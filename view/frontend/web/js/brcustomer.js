require(['jquery', 'inputMask', 'pessoaFisica','pessoaJuridica'], function($, inputmask, pessoaFisica, pessoaJuridica){
    'use strict';
    
    $(document).ready(
        function(){
            pessoaFisica();

            var customerType = {
                pFisica : '1',
                pJuridica : '2',
            };

            $('#custom_telephone').inputmask("(99) 9999-9999");
            $('#custom_cellphone').inputmask("(99) 99999-9999");

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