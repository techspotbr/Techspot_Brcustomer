define(['jquery'], function($) {
    'use strict';
    return function(){

        // Field document
        $('.field.document').hide();
        $('#document').prop('disabled', true);

        // Field document
        $('.field.document_emitter').hide();
        $('#document_emitter').prop('disabled', true);

        // Field company
        $('#company').prop('disabled', false);
        $('.field.company ').show();

        // Field state_inscription
        $('#state_inscription').prop('disabled', false);
        $('.field.state-inscription').show();

        // Field county inscription
        $('#county_inscription').prop('disabled', false);
        $('.field.county-inscription').show();

        // Change Taxvat label
        $('label[for="taxvat"] span').html('CNPJ');
    };
});