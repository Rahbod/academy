<template>
    <fieldset class="mb-3">
        <legend class="text-uppercase font-weight-bold  text-teal"
                v-text="$t(resource+':items.'+item.name+'.main_name')"></legend>
        <component
                v-for="(form_info,index) in item.info" :is="getComponent(form_info.type)"
                :info="form_info"
                :key="item.name+'-'+form_info.name+'-'+index"
                :value="model[item.name][form_info.name]" :options="getOptions(form_info,item.name)"
                :prefix="item.name"
                :index="null"
                :errors="errors"
                @input="updateModel($event,form_info.name,item.name)"
        ></component>
    </fieldset>
</template>
<script>
    import global_mixin from '../../../../mixins/GlobalMixin.vue';
    import form_fieldset_mixin from '../../../../mixins/form/FormFieldsetMixin.vue';

    export default {
        props: ['item'],
        mixins: [global_mixin, form_fieldset_mixin],
    }
</script>