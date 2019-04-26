<script>
    import {mapMutations, mapGetters} from 'vuex';

    export default {
        data() {
            return {
                input_value: undefined,
                rendering: false
            }
        },
        props: ['info', 'options', 'value', 'prefix', 'index', 'errors','is_base','icon_type'],
        computed: {
            ... mapGetters(['direction', 'resource', 'main_url']),
            ... mapGetters('form',['model']),
            lable() {
                if(this.info.label !== undefined){
                    return this.info.label;
                }
                let prefix = '';
                if (this.prefix !== null) {
                    let p = this.prefix.replace(/\[/gi, "-");
                    p = p.replace(/\]/gi, "");
                    let array_prefix=p.split('-');

                    prefix += array_prefix[array_prefix.length-1] + '.';
                }
                let label =this.$t(this.resource + ':items.' + prefix + this.info.name);
                if(this.prefix!== null){
                    label=label.replace(this.$t(this.resource + ':items.' + prefix + "main_name"),"");
                }
                return label;
            },
            input_container_class() {
                let classes = '';
                if (this.index == null) {
                    classes = 'col-lg-6 col-md-5 col-sm-8';
                }

                return classes;
            },
            input_style() {
                let styles = {};
                if (this.info.input_style !== undefined) {
                    styles = JSON.parse(this.info.input_style);
                }
                if (this.info.direction !== undefined) {
                    styles.direction = this.info.direction;
                }
                return styles;
            }
        },
        watch: {
            input_value(new_value) {
                if (this.hasError()) {
                    this.deleteError(this.getErrorName(this.info.name));
                }
                this.input_value = new_value;
                if (this.value !== new_value) {
                    this.$emit('input', new_value);
                }


            },
            value(new_value) {
                this.value = new_value;
                if (this.input_value !== new_value) {
                    this.input_value = new_value;
                }

            }
        },
        methods: {
            ... mapMutations('form', ['setErrors', 'deleteError']),
            getName(name) {
                let input_name='';
                if (this.prefix == null || (this.is_base !== undefined && this.is_base == true)) {
                    input_name= name;
                } else {
                    if (this.index === null) {
                        input_name= this.prefix + '[' + name + ']';
                    }
                    else {
                        input_name= this.prefix + '[' + this.index + ']' + '[' + name + ']';
                    }

                }

                if(this.info.type === 'tags' || this.info.type ==='multiple'){
                    input_name +='[]';
                }
                return input_name;
            },
            getId(name) {
                if (this.prefix == null || (this.is_base !== undefined && this.is_base == true)) {
                    return name;
                } else {
                    let prefix = this.prefix.replace(/\[/gi, "-");
                    prefix = prefix.replace(/\]/gi, "");

                    if (this.index == null) {
                        return prefix + '-' + name;
                    }
                    return prefix + '-' + this.index + '-' + name;
                }
            },
            getErrorName(name) {
                if (this.prefix == null || (this.is_base !== undefined && this.is_base == true)) {
                    return name;
                } else {
                    let prefix = this.prefix.replace(/\[/gi, ".");
                    prefix = prefix.replace(/\]/gi, "");

                    if (this.index === null) {
                        return prefix + '.' + name;
                    }
                    return prefix + '.' + this.index + '.' + name;
                }
            },
            hasError() {
                let error_name = this.getErrorName(this.info.name);
                if (this.errors[error_name] == undefined) {
                    return false;
                }
                else {
                    return true;
                }
            },
            label_class() {
                let classes = '';
                if (this.index == null) {
                    classes = 'col-form-label col-lg-4 col-md-5 col-sm-4';
                    if (this.direction == 'rtl') {
                        classes += ' text-align-left';
                    }
                    else {
                        classes += ' text-align-right';
                    }
                }
                else {
                    classes += 'form-group-float-label is-visible cursor-pointer'
                }


                if (this.hasError()) {
                    classes += ' text-danger';
                }
                return classes;
            },
            componentFloatingLabels() {

                // Variables
                var showClass = 'is-visible',
                    animateClass = 'animate',
                    labelWrapperClass = 'form-group-float',
                    labelClass = 'form-group-float-label';

                // Setup
                $('input:not(.token-input):not(.bootstrap-tagsinput > input), textarea, select').on('checkval change', function () {

                    // Define label
                    var label = $(this).parents('.' + labelWrapperClass).children('.' + labelClass);

                    // Toggle label
                    if (this.value !== '') {
                        label.addClass(showClass);
                    }
                    else {
                        label.removeClass(showClass).addClass(animateClass);
                    }

                }).on('keyup', function () {
                    $(this).trigger('checkval');
                }).trigger('checkval').trigger('change');


                // Remove animation on page load
                $(window).on('load', function () {
                    $('.' + labelWrapperClass).find('.' + showClass).removeClass(animateClass);
                });
            }

        },
        created() {
//            console.log(this.info.name,this.value);
            this.input_value = this.value;
        },
        mounted() {
            $('.form-check-input-styled').uniform();
            $('.form-group-float').find('.is-visible').removeClass('animate');
            this.componentFloatingLabels();
        }
    }
</script>
