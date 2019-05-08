<script>
    import basic_input from '../../view_components/forms/basic_form/inputs/BasicInput.vue'
    import file_selector_input from '../../view_components/forms/basic_form/inputs/FileSelectorInput.vue'
    import file_picker_input from '../../view_components/forms/basic_form/inputs/FilePickerInput.vue'
    import radio_input from '../../view_components/forms/basic_form/inputs/RadioInput.vue'
    import hidden_input from '../../view_components/forms/basic_form/inputs/HiddenInput.vue'
    import textarea_input from '../../view_components/forms/basic_form/inputs/TextareaInput.vue'
    import disable_input from '../../view_components/forms/basic_form/inputs/DisableInput.vue'
    import select2_input from '../../view_components/forms/basic_form/inputs/Select2Input.vue'



    const icon_picker_input = resolve => {
        require.ensure(['../../view_components/forms/basic_form/inputs/IconPickerInput.vue'], () => {
            resolve(require('../../view_components/forms/basic_form/inputs/IconPickerInput.vue'))
        })
    };
    const editor_input = resolve => {
        require.ensure(['../../view_components/forms/basic_form/inputs/EditorInput.vue'], () => {
            resolve(require('../../view_components/forms/basic_form/inputs/EditorInput.vue'))
        })
    };
    const simple_editor_input = resolve => {
        require.ensure(['../../view_components/forms/basic_form/inputs/SimpleEditorInput.vue'], () => {
            resolve(require('../../view_components/forms/basic_form/inputs/SimpleEditorInput.vue'))
        })
    };
    const date_input = resolve => {
        require.ensure(['../../view_components/forms/basic_form/inputs/DateInput.vue'], () => {
            resolve(require('../../view_components/forms/basic_form/inputs/DateInput.vue'))
        })
    };
    const image_input = resolve => {
        require.ensure(['../../view_components/forms/basic_form/inputs/ImageInput.vue'], () => {
            resolve(require('../../view_components/forms/basic_form/inputs/ImageInput.vue'))
        })
    };
    export default {
        components: {
            basic_input,
            textarea_input,
            disable_input,
            radio_input,
            hidden_input,
            date_input,
            select2_input,
            image_input,
            editor_input,
            simple_editor_input,
            icon_picker_input,
            file_selector_input,
            file_picker_input,
        },
        methods:{
            getComponent(name) {
                let component_name = name;
                switch (name) {
                    case 'text':
                    case 'email':
                    case 'password':
                    case 'number':
                    case 'time':
                        component_name = 'basic_input';
                        break;
                    case 'select':
                    case 'tags':
                    case 'multiple':
                        component_name = 'select2_input';
                        break;
                    case 'textarea':
                        component_name = 'textarea_input';
                        break;
                    case 'disable':
                        component_name = 'disable_input';
                        break;
                    case 'icon_picker':
                        component_name = 'icon_picker_input';
                        break;
                    case 'editor':
                        component_name = 'editor_input';
                        break;
                    case 'simple_editor':
                        component_name = 'simple_editor_input';
                        break;
                    case 'hidden':
                        component_name = 'hidden_input';
                        break;
                    case 'radio':
                        component_name = 'radio_input';
                        break;
                    case 'date':
                        component_name = 'date_input';
                        break;
                    case 'image':
                        component_name = 'image_input';
                        break;
                    case 'file_selector':
                        component_name = 'file_selector_input';
                        break;
                    case 'file':
                        component_name = 'file_picker_input';
                        break;
                }
                return component_name;
            },
        }
    }
</script>