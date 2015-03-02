/*
$(document).ready(function() {
    Order.init();
});

var Order = (function() {
    var Order = {};
    
    Order.init = function() {
        Order.registerEventhandlers();
        Order.disableTabs();     
    };
    
    Order.registerEventhandlers = function() {
        $(document)
            .on('change', '#order-customer_id', Order.updateCustomerData)
            .on('change', '.address-select', Order.updateAddressData)
            .on('change', '.product-select', Order.updateProductOptions)
            .on('click', '#add-product', Order.addProduct)
            .on('click', '.btn-delete-product', Order.deleteProduct);    
    };
    
    Order.updateCustomerData = function(event) {
        var id = $(this).val(),
            request = $.get('get-customer-data', {id: id});
            
        request.done(function(response) {
            if (response.status) {
                
                // Set the customer data
                $('#order-name').val(response.customer.name);
                $('#order-firstname').val(response.customer.firstname);
                $('#order-email').val(response.customer.email);
                $('#order-phone').val(response.customer.phone);
                $('#order-mobile').val(response.customer.mobile);
                $('#order-fax').val(response.customer.fax);
            }
        });    
    };
    
    Order.updateAddressData = function(event) {
        var id = $(this).val(),
            type = $(this).data('type'),
            request = $.get('get-address-data', {id: id});
            
        request.done(function(response) {
            if (response.status) {

                // Set the address data
                $('#order-'+type+'_company').val(response.address.company);
                $('#order-'+type+'_name').val(response.address.name);
                $('#order-'+type+'_firstname').val(response.address.firstname);
                $('#order-'+type+'_address').val(response.address.address);
                $('#order-'+type+'_zipcode').val(response.address.zipcode);
                $('#order-'+type+'_city').val(response.address.city);
                $('#order-'+type+'_country_id').val(response.address.countryId).trigger('change');
            }
        });    
    };
    
    /**
     * Disables the tab-functionality of the tabs that are marked as disabled
     *
     * @param   Event
     * @return  void

    Order.disableTabs = function() {
        $('.disabled a[data-toggle]').removeAttr('data-toggle');    
    };
    
    Order.updateProductOptions = function(event) {
        var getProductOptionsHtml = Order.getProductOptionsHtml($(this).val());
        
        getProductOptionsHtml.done(function(response) {
            $('#product-options-container').html(response);
            
            // Enable the submit button
            $('#add-product').prop('disabled', false);
        });    
    };
    
    Order.getProductOptionsHtml = function(productId) {
        return $.get('get-product-options-html', {id: productId});    
    };
    
    Order.addProduct = function(event) {
        var orderId = $(this).data('order'),
            productId = $('#product-id').val(),
            productQuantity = $('#product-quantity').val(),
            productOptions = {},
            valid = true;
            
        // Validation    
        // If there are options of type 'checkbox', at least one of it's values
        // has to be selected
        $.each($(':checkbox:not(:checked).product-option'), function() {
            // Check if there is at least one checked option in the options 
            // with the same name
            if (!$('.product-option[name="'+$(this).attr('name')+'"]:checked').length) {
                // @todo: Communicate error
                valid = false;
            }
        });  
        
        if (valid) {
            // Compose the productoptions
            $.each($('select.product-option, :radio:checked.product-option, :checkbox:checked.product-option'), function() {                       
                var optionKey = $(this).data('option');
                
                // Init the option key if is does not exist yet 
                if (!_.has(productOptions, optionKey))
                    productOptions[optionKey] = [];
                
                // Add the selected values
                productOptions[optionKey].push($(this).val());
            });
            
            // Validation
            
            // Disable the submit button
            $('#add-product').prop('disabled', true);
            
            // Save the product
            var data = {
                    orderId: orderId,
                    productId: productId,
                    productQuantity: productQuantity,
                    productOptions: productOptions    
                },
                request = $.post('add-product', data);
                
            request.done(function(response) {
                if (response.status == 1) {
                    // Reset all the product fields               
                    $('#product-id').select2('val', '');
                    $('#product-quantity').val(1);
                    $('#product-options-container').empty();
                    
                    // Disable the product in the dropdown list
                    $('#product-id option[value='+productId+']').prop('disabled', true);
                    
                    // Update the products and totals table
                    Order.updateProductsTable().done(Order.updateTotalsTable);
                    
                } else {
                    // Re-enable the submit button
                    $('#add-product').prop('disabled', false);
                }
            });    
        }        
    };
    
    Order.updateProductsTable = function() {
        var getProductsTableHtml = Order.getProductsTableHtml($('#add-product').data('order')),
            dfd = $.Deferred();
        
        getProductsTableHtml.done(function(response) {
            $('#products-table-container').html(response);
            dfd.resolve();
        });
        
        return dfd.promise();            
    };
    
    Order.updateTotalsTable = function() {
        var getProductsTableHtml = Order.getProductsTableHtml($('#add-product').data('order'), 1),
            dfd = $.Deferred();
        
        getProductsTableHtml.done(function(response) {
            $('#totals-table-container').html(response);
            dfd.resolve();
        });
        
        return dfd.promise();            
    };
    
    Order.getProductsTableHtml = function(orderId, showTotals) {
        var showTotals = showTotals || 0;
        return $.get('get-products-table-html', {id: orderId, showTotals: showTotals});    
    };
    
    Order.deleteProduct = function(event) {
        event.preventDefault();
        
        var orderProductId = $(this).data('id'),
            orderId = $('#add-product').data('order'),
            data = {
                orderId: orderId,
                orderProductId: orderProductId
            },
            request = $.post('delete-product', data);
            
        request.done(function(response) {
            if (response.status == 1) {
                // Re-enable the product
                $('#product-id option[value='+response.productId+']').prop('disabled', false);
                
                // Update the products and totals table
                Order.updateProductsTable().done(Order.updateTotalsTable);
            } else {
                // @todo: communicate
            }    
        }); 
    };
    
    return Order;
})();
*/