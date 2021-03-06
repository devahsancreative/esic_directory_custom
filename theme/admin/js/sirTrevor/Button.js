(function() {
    var button_template,
        __hasProp = {}.hasOwnProperty;

    button_template = '<span class="btn btn-default st-required" contenteditable="true">Button</span>';

    SirTrevor.Blocks.Button = SirTrevor.Block.extend({
        button_sizes: {
            'btn-xs': 'X-Small',
            'btn-sm': 'Small',
            '': 'Default',
            'btn-lg': 'Large'
        },
        button_alignment: {
            'left': 'Left',
            'center': 'Center',
            'right': 'Right'
        },
        button_styles: {
            'btn-default': 'Default',
            'btn-primary': 'Primary',
            'btn-success': 'Success',
            'btn-info': 'Info',
            'btn-warning': 'Warning',
            'btn-danger': 'Danger',
            'btn-dark': 'Dark',
            'btn-blue': 'Blue'

        },
        type: "button",
        title: 'Button',
        editorHTML: '<div class="st-button-form-wrapper form-inline well" style="margin: 10px; display: none;"> <div class="form-group"> Size: <select name="size"></select> </div> <div class="form-group"> Alignment: <select name="alignment"></select> </div> <div class="form-group"> Style: <select name="style"></select> </div> <div class="form-group"> Full width: <input type="checkbox" name="is_block"/> </div> <div class="form-group"> URL: <input type="text" name="url" value=""/> </div><div class="form-group"> Value: <input type="text" name="html" value=""/> </div> <button type="button">OK</button> </div> <div class="st-button-wrapper" style="text-align: center; min-height: 0">' + button_template + '</div>',
        icon_name: 'button',
        loadData: function(data) {
            return this.$find('.btn').html(SirTrevor.toHTML(data.text, this.type));

        },

        _setBlockInner: function() {
            var $alignment_select, alignment, alignment_class, $sizes_select, $styles_select, size, size_class, style, style_class, _ref, _ref1;
            SirTrevor.Block.prototype._setBlockInner.apply(this, arguments);
            $styles_select = this.$('[name=style]');
            _ref = this.button_styles;
            for (style_class in _ref) {
                if (!__hasProp.call(_ref, style_class)) continue;
                style = _ref[style_class];
                $styles_select.append($('<option/>').attr('value', style_class).text(style));
            }
            $styles_select.val('btn-default');

            $alignment_select = this.$('[name=alignment]');
            _ref = this.button_alignment;
            for (alignment_class in _ref) {
                if (!__hasProp.call(_ref, alignment_class)) continue;
                alignment = _ref[alignment_class];
                $alignment_select.append($('<option/>').attr('value', alignment_class).text(alignment));
            }
            $alignment_select.val('center');
            $sizes_select = this.$('[name=size]');
            _ref1 = this.button_sizes;
            for (size_class in _ref1) {
                if (!__hasProp.call(_ref1, size_class)) continue;
                size = _ref1[size_class];
                $sizes_select.append($('<option/>').attr('value', size_class).text(size));
            }
            $sizes_select.val('');
            return $sizes_select.on('change click', (function(_this) {
                return function() {
                    var btn, selected_size_class, _ref2, _results;
                    selected_size_class = $sizes_select.val();
                    btn = _this.getButton();
                    _ref2 = _this.button_sizes;
                    _results = [];
                    for (size_class in _ref2) {
                        if (!__hasProp.call(_ref2, size_class)) continue;
                        _results.push(btn.toggleClass(size_class, size_class === selected_size_class));
                    }
                    return _results;
                };
            })(this));
        },
        onBlockRender: function() {
            var $block_checkbox, $sizes_select, $styles_select,$html_value;
            this.getWrapper().on('click keyup', (function(_this) {
                return function() {
                    return _this.checkForButton();
                };
            })(this));
            this.getButton().on('click', (function(_this) {
                return function() {
                    return _this.$('.st-button-form-wrapper').show('fast');
                };
            })(this));
            this.$('.st-button-form-wrapper button').on('click', (function(_this) {
                return function() {
                    return _this.$('.st-button-form-wrapper').hide('fast');
                };
            })(this));
            $styles_select = this.$('[name=style]');
            $styles_select.on('change click', (function(_this) {
                return function() {
                    var btn, selected_style_class, style_class, _ref, _results;
                    selected_style_class = $styles_select.val();
                    btn = _this.getButton();
                    _ref = _this.button_styles;
                    _results = [];
                    for (style_class in _ref) {
                        if (!__hasProp.call(_ref, style_class)) continue;
                        _results.push(btn.toggleClass(style_class, style_class === selected_style_class));
                    }
                    return _results;
                };
            })(this));
            $styles_select.trigger('change');

            $alignment_select = this.$('[name=alignment]');
            $alignment_select.on('change click', (function(_this) {
                return function() {
                    var btn, selected_alignment_class, alignment_class, _ref, _results;
                    selected_alignment_class = $alignment_select.val();
                    btn = _this.getButton();
                    _ref = _this.button_alignment;
                    _results = [];
                    for (alignment_class in _ref) {
                        if (!__hasProp.call(_ref, alignment_class)) continue;
                        _results.push(btn.toggleClass(alignment_class, alignment_class === selected_alignment_class));
                    }
                    return _results;
                };
            })(this));
            $alignment_select.trigger('change');

            $sizes_select = this.$('[name=size]');
            $sizes_select.on('change click', (function(_this) {
                return function() {
                    var btn, selected_size_class, size_class, _ref, _results;
                    selected_size_class = $sizes_select.val();
                    btn = _this.getButton();
                    _ref = _this.button_sizes;
                    _results = [];
                    for (size_class in _ref) {
                        if (!__hasProp.call(_ref, size_class)) continue;
                        _results.push(btn.toggleClass(size_class, size_class === selected_size_class));
                    }
                    return _results;
                };
            })(this));
            $sizes_select.trigger('change');
            $block_checkbox = this.$('[name=is_block]').on('change click', (function(_this) {
                return function() {
                    return _this.getButton().toggleClass('btn-block', $block_checkbox.is(':checked'));
                };
            })(this));

            //Change from Haider
            $html_value = this.$('[name=html]');
            $html_value.on('change keyup', (function(_this) {
                return function() {
                    //get current value first. then assign it to the textbox
                    console.log('just pressed a key');
                    var value = $(this).val();
                    return _this.getButton().html(value);
                };
            })(this));
            //End of Haider Change
            return $block_checkbox.trigger('change');
        },
        checkForButton: function() {
            if (this.$('.btn').length === 0) {

                return setTimeout((function(_this) {
                    return function() {
                        if (_this.$('.btn').length === 0) {

                            return _this.getWrapper().html(button_template);
                        }
                    };
                })(this), 500);
            }
        },
        getWrapper: function() {
            return this.$('.st-button-wrapper');
        },
        getButton: function() {

            return this.$('.st-button-wrapper .btn');
        },
        toData: function() {
            console.log('toData');
            var data;
            data = {};
            this.$('select, input').each(function() {
                var value;
                if (this.getAttribute('type') === 'checkbox') {

                    value = $(this).is(':checked');
                } else {

                    value = $(this).val();
                }
                data[this.getAttribute('name')] = value;
                return true;
            });
            data.html = this.getButton().html();
            return this.setData(data);
        },
        loadData: function(data) {
            var $el, i, v;
            for (i in data) {
                if (!__hasProp.call(data, i)) continue;
                v = data[i];
                $el = this.$('select, input').filter('[name=' + i + ']');
                if ($el.attr('type') === 'checkbox') {
                    if (v) {
                       // alert('i am here');
                        $el.attr('checked', 'yes');
                    }
                } else {
                    //alert('i am there');
                    $el.val(v);
                }
            }
            return this.getButton().html(data.html);
        }
    });

}).call(this);