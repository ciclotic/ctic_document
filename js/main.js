/**
 * Collection Form plugin
 *
 * @param element
 * @constructor
 */
var CollectionForm = function (element) {
    this.$element = $(element);
    this.$list = this.$element.find('[data-form-collection="list"]:first');
    this.$name = this.$element.data('formName');
    this.count = this.$list.children().length;

    this.$element.on(
        'click',
        '[data-form-collection="add"]:last',
        $.proxy(this.addItem, this)
    );

    this.$element.on(
        'click',
        '[data-form-collection="delete"]',
        $.proxy(this.deleteItem, this)
    );

    this.$element.on(
        'change',
        '[data-form-collection="update"]',
        $.proxy(this.updateItem, this)
    );

    $(document).on(
        'change',
        '[data-form-prototype="update"]',
        $.proxy(this.updatePrototype, this)
    );
}

CollectionForm.prototype = {
    constructor : CollectionForm,

    /**
     * Add a item to the collection.
     * @param event
     */
    addItem: function (event) {
        event.preventDefault();

        var prototype = this.$element.attr('data-prototype');

        var prototype = prototype.replace(
            new RegExp('__name-' + this.$name + '__',"g"),
            this.count
        );

        this.$list.append(prototype);
        this.count = this.count + 1;

        $(document).trigger('collection-form-add', [this.$list.children().last()]);
    },

    /**
     * Update item from the collection
     */
    updateItem: function (event) {
        event.preventDefault();

        var $element = $(event.currentTarget),
            url = $element.data('form-url'),
            value = $element.val(),
            $container = $element.closest('[data-form-collection="item"]'),
            index = $container.data('form-collection-index'),
            position = $container.data('form-collection-index');


        if (url) {
            $container.load(url, {'id' : value, 'position' : position});
        } else {
            var prototype = this.$element.find('[data-form-prototype="'+ value +'"]').val();

            prototype = prototype.replace(
                new RegExp('__name-' + this.$name + '__',"g"),
                index
            );

            $container.replaceWith(prototype);
        }

        $(document).trigger('collection-form-update', [this.$list.children().first()]);
    },

    /**
     * Delete item from the collection
     * @param event
     */
    deleteItem: function (event) {
        event.preventDefault();

        $(event.currentTarget)
            .closest('[data-form-collection="item"]')
            .remove();

        $(document).trigger('collection-form-delete', [$(event.currentTarget)]);
    },

    /**
     * Update the prototype
     * @param event
     */
    updatePrototype: function (event) {
        var $target = $(event.currentTarget);
        var prototypeName = $target.val();

        if (undefined !== $target.data('form-prototype-prefix')) {
            prototypeName = $target.data('form-prototype-prefix') + prototypeName;
        }

        this.$list.html('');

        this.$element.data(
            'prototype',
            this.$element.find('[data-form-prototype="'+ prototypeName +'"]').val()
        );
    }
}

/*
 * Plugin definition
 */

$.fn.CollectionForm = function (option) {
    return this.each(function () {
        var $this = $(this);
        var data = $this.data('collectionForm');
        var options = typeof option == 'object' && option;

        if (!data) {
            $this.data(
                'collectionForm',
                (data = new CollectionForm(this, options))
            )
        }
    })
}

$.fn.CollectionForm.Constructor = CollectionForm;

/*
 * Apply to standard CollectionForm elements
 */

$(function() {
    $(document).on('collection-form-add', function (e, addedElement) {
        var newCollection = $(addedElement).find('[data-form-type="collection"]');
        newCollection.CollectionForm();

        $(document).trigger('dom-node-inserted', [$(addedElement)]);
    });

    var newCollections = $('[data-form-type="collection"]');
    newCollections.CollectionForm();
});

$.expr[":"].contains = $.expr.createPseudo(function(arg) {
    return function( elem ) {
        return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
    };
});

if (annyang) {
    // Let's define a command.
    annyang.addCommands({
        'ir a *address': function(address) {
            var rediretTo = '';
            switch (address.toUpperCase())
            {
                case 'INICIO':
                    rediretTo = '/';
                    break;
                case 'PRODUCTOS':
                    rediretTo = '/productos/listado';
                    break;
                case 'PRODUCTO':
                    rediretTo = '/productos/listado';
                    break;
                default:
                    break;
            }

            if (rediretTo) {
                window.location.href = rediretTo;
            }
        },
        'cerrar sesion': function() {
            window.location.href = '/logout';
        },
        'desactivar': function() {
            SpeechKITT.abortRecognition();
        }
    });
}

$(function() {
    $('#switchCompanySelect').on('change', function() {
        window.location = $('#switchCompany ').attr('action') + '/' + $(this).val();
    });
});
