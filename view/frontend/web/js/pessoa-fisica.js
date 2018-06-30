define(['jquery', 'inputMask'], function($, inputmask) {
    'use strict';
    return function(){
        // Field company
        $('.field.company ').hide();
        $('#company').prop('disabled', true);

        // Field document
        $('#document').prop('disabled', false);
        
        $('.field.document').show();

        // Field document_emitter
        $('#document_emitter').prop('disabled', false);
        $('.field.document_emitter').show();
        
        // Field state_inscription
        $('.field.state-inscription').hide();
        $('#state_inscription').prop('disabled', true);

        // Field county inscription
        $('.field.county-inscription').hide();
        $('#county_inscription').prop('disabled', true);

        // Change Taxvat label
        $('#taxvat').inputmask("999.999.999-99");
        $('label[for="taxvat"] span').html('CPF');   
    };
});