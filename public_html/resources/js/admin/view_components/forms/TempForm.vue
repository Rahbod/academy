<template>
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Basic form inputs</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <p class="mb-4">Examples of standard form controls supported in an example form layout. Individual form controls automatically receive some global styling. All textual <code>&lt;input></code>, <code>&lt;textarea></code>, and <code>&lt;select></code> elements with <code>.form-control</code> are set to <code>width: 100%;</code> by default. Wrap labels and controls in <code>.form-group</code> for optimum spacing. Labels in horizontal form require <code>.col-form-label</code> class.</p>

            <form action="#">
                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">Basic inputs</legend>

                    <div class="form-group row">
                        <label :class="label_class">Default text input</label>
                        <div :class="input_container_class">
                            <input type="text" class="form-control" placeholder="Default text input...">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label :class="label_class">Password</label>
                        <div :class="input_container_class">
                            <input type="password" class="form-control" placeholder="Password...">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label :class="label_class">Email</label>
                        <div :class="input_container_class">
                            <input type="email" class="form-control" placeholder="Email...">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label :class="label_class">Number</label>
                        <div :class="input_container_class">
                            <input type="number" class="form-control" placeholder="Number...">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label :class="label_class">Read only field</label>
                        <div :class="input_container_class">
                            <input type="text" class="form-control" readonly value="read only">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label :class="label_class">Disabled field</label>
                        <div :class="input_container_class">
                            <input type="text" class="form-control" disabled value="disabled">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label :class="label_class">Disabled autocomplete</label>
                        <div :class="input_container_class">
                            <input type="text" class="form-control" placeholder="Autocomplete is off" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label :class="label_class">Maximum value</label>
                        <div :class="input_container_class">
                            <input type="text" class="form-control" maxlength="4" placeholder="Maximum 4 characters">
                        </div>
                    </div>

                    <div class="form-group row form-group-feedback form-group-feedback-right">
                        <label :class="label_class">Input with icons</label>
                        <div :class="input_container_class">
                            <input type="text" class="form-control" placeholder="Input with icons ...">
                            <div class="form-control-feedback"><i class="icon-droplets"></i></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="cursor-pointer" :class="label_class" for="clickable-label">Focus on label click</label>
                        <div :class="input_container_class">
                            <input type="text" class="form-control" id="clickable-label" placeholder="Field focus on label click">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="cursor-pointer" :class="label_class">Left inline styled radio</label>
                        <div :class="input_container_class">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input-styled" name="radio-inline-left" checked data-fouc>
                                    Selected styled
                                </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input-styled" name="radio-inline-left" data-fouc>
                                    Unselected styled
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label :class="label_class">Static text</label>
                        <div :class="input_container_class">
                            <div class="form-control-plaintext">This is a static text</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label :class="label_class">Textarea</label>
                        <div :class="input_container_class">
                            <textarea rows="4" cols="3" class="form-control" placeholder="Default textarea"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label :class="label_class">DatePicker</label>
                        <div :class="input_container_class">
                            <DatePicker placeholder="DatePicker ..."></DatePicker>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label :class="label_class">Select2</label>
                        <div :class="input_container_class">
                            <select2 placeholder="Select2 ..."></select2>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label :class="label_class" class="text-danger">Invalid state with icon</label>
                        <div :class="input_container_class">
                            <div class="form-group-feedback form-group-feedback-right">
                                <input type="text" class="form-control border-danger" placeholder="Invalid state">
                                <div class="form-control-feedback text-danger">
                                    <i class="icon-cancel-circle2"></i>
                                </div>
                            </div>
                            <span class="form-text text-danger">Invalid state helper</span>
                        </div>
                    </div>
                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit <i class="icon-paperplane ml-2"></i></button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import VuePersianDatetimePicker from 'vue-persian-datetime-picker';
    import select2 from '../../components/Select2.vue'
    import {mapGetters} from 'vuex'
    export default {
        components:{DatePicker:VuePersianDatetimePicker,select2},
        computed:{
            ...mapGetters(['direction']),
            label_class(){
                let classes='col-form-label col-lg-4 col-md-5 col-sm-4';
                if(this.direction == 'rtl'){
                    classes += ' text-align-left';
                }
                else {
                    classes += ' text-align-right';
                }
                if(this.hasError()){
                    classes += ' text-align-right';
                }
                return classes;
            },
            input_container_class(){
                let classes='col-lg-6 col-md-5 col-sm-8';
                return classes;
            },
        },
        mounted(){
            $('.form-check-input-styled').uniform();
        }

    }
</script>

<style>
    @media only screen and (min-width: 576px) {
        .text-align-right{
            text-align: right !important;
        }
        .text-align-left{
            text-align: left !important;
        }
    }

    .form-group-feedback-right .form-control-feedback {
        left: .875rem;
    }

</style>