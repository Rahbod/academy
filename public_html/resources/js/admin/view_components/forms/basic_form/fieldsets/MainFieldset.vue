<template>
    <fieldset class="mb-3">
        <component v-if="form_info.name!= undefined" v-for="(form_info,index) in info"
                   :is="getComponent(form_info.type)" :info="form_info"
                   :key="form_info.name+'-'+index"
                   :value="model[form_info.name]" :options="getOptions(form_info)"
                   :prefix="null"
                   :index="null"
                   :errors="errors"
                   @input="updateModel($event,form_info.name)"
        ></component>
    </fieldset>
</template>
<script>
    import global_mixin from '../../../../mixins/GlobalMixin.vue';
    import form_fieldset_mixin from '../../../../mixins/form/FormFieldsetMixin.vue';

    export default {
        mixins: [global_mixin,form_fieldset_mixin],
    }
</script>