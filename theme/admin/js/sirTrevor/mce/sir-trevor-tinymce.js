(function() {

    var super_initialize, tinymce_defaults;

    tinymce_defaults = {
        selector: '.st-text-block',
        content_editable: true,
        inline: true,
        hidden_input: false,
        menubar: false,
        browser_spellcheck : true,
        contextmenu: false,
        spellchecker_rpc_url: base_url+'assets/tinymce/js/tinymce/plugins/spellchecker/spellchecker.php',
        plugins: "spellchecker textcolor colorpicker table image media code",  //added by hamid raza
/*        plugins: ['advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],*/

        toolbar: "undo redo | styleselect | fontsizeselect | forecolor | backcolor | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | table | link image | media | code",
        fontsize_formats: "8px 10px 12px 14px 18px 20px 24px 24px 28px 30px 36px 40px",
        relative_urls: false

    };
    //console.log(base_url+'assets/tinymce/js/tinymce/plugins/spellchecker/spellchecker.php');

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