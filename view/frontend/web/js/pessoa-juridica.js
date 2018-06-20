define(['jquery'], function($) {
    'use strict';
    return function(){
         // Field company
         $('#company').prop('disabled', false);
         $('.field.company ').show();

         // Field state_inscription
         $('#state-inscription').prop('disabled', false);
         $('.field.state-inscription').show();
 
         // Field county inscription
         $('#county-inscription').prop('disabled', false);
         $('.field.county-inscription').show();
 
         // Change Taxvat label
         $('label[for="taxvat"] span').html('CNPJ');
    };
});