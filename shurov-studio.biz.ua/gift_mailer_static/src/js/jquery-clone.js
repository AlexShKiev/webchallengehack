'use strict';

(function ($) {
    var defaults = {
        "trigger": ".js-trigger-clone-tpl",
        "insertInСontainer": ".js-tpl-container",
        "remove": ".js-remove-tpl"
    };

    var CloneTpl = function (options) {
        this.options = $.extend({}, defaults, options || {});

        this.$trigger = $(this.options.trigger);

        this.cloneTplId = this.$trigger.data('copy-tpl');

        this.clonedCallback = function (options) {
        };
        this.removeCallback = function (options) {
        };

        if (this.cloneTplId) {
            this.init();
        }
    };

    CloneTpl.prototype = {
        init: function () {
            this.initEvents();
        },
        initEvents: function () {
            var self = this;

            this.$trigger.on('click', function (e) {
                e.preventDefault();

                self.clone();

                self.clonedCallback(self.options);


            });

            $('body').on('click', this.options.remove, function (e) {
                e.preventDefault();

                $(this)
                    .parent()
                    .remove();

                self.removeCallback(self.options);
            })
        },
        clone: function () {
            $(this.options.insertInСontainer).append($(this.cloneTplId).html());

        }
    };
    $(document).ready(function () {
        new CloneTpl();
    });


})(jQuery);