(function() {
    var super_initialize, tinymce_defaults;

    tinymce_defaults = {
        selector: '.st-text-block',
        content_editable: true,
        inline: true,
        hidden_input: false,
        menubar: false
    };

    super_initialize = SirTrevor.Editor.prototype.initialize;

    SirTrevor.Editor.prototype.initialize = function() {
        var config, ed;
        super_initialize.apply(this, arguments);
        ed = this;
        config = $.extend({}, tinymce_defaults, {
            selector: '#' + this.ID + ' .st-text-block'
        }, _.result(SirTrevor, 'tinymce_config') || {}, _.result(this.options, 'tinymce_config') || {});
        tinymce.init(config);
        return $(this.$wrapper).on('focus click', '.st-text-block', function(e) {
            var $block, block, id;
            if (!$(this).is('.mce-content-body')) {
                $(this).attr('contenteditable', 'true');
                $block = $(this).closest('.st-block');
                block = ed.findBlockById($block.attr('id'));
                if (!this.id) {
                    this.id = _.uniqueId('st-text-block-mce-');
                }
                id = this.id;
                return setTimeout((function(_this) {
                    return function() {
                        tinymce.init($.extend({}, config, {
                            selector: '#' + id
                        }));
                        return $(_this).trigger('blur').trigger('focus');
                    };
                })(this), 100);
            }
        });
    };

    SirTrevor.Editor.prototype.scrollTo = function(element) {
        return $('html, body').animate({
            scrollTop: element.offset().top - 70
        }, 300, "linear");
    };

    SirTrevor.Block.prototype.validateField = function(field) {
        var content;
        field = $(field);
        content = field.attr('contenteditable') ? field.html() : field.val();
        if (content.length === 0) {
            return this.setError(field, i18n.t("errors:block_empty", {
                name: bestNameFromField(field)
            }));
        }
    };

    SirTrevor.Block.prototype.clearInsertedStyles = function() {};

    this.SirTrevor.Block.prototype._handleContentPaste = function() {};

    SirTrevor.toMarkdown = function(html) {
        return html;
    };

    SirTrevor.toHTML = function(html) {
        return html;
    };

}).call(this);