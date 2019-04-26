<script>
    import {mapActions,mapGetters} from 'vuex';
    import form_fieldset from './FormFieldsetMixin.vue'

    export default {
        props:['item','item_index'],
        mixins:[form_fieldset],
        computed:{
            ... mapGetters('form', ['errors']),
        },
        methods: {
            ...mapActions(['collapseCard', 'fullScreen']),
            ...mapActions('form',['addRecord','deleteRecord']),
        },

    }
</script>