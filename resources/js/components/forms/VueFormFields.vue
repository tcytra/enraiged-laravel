<template>
    <div class="formgrid grid mb-3"
        :class="class">
        <template v-for="(item, key) in fields" :key="key">
            <slot v-if="item.custom" v-bind="$props"
                :field="item"
                :id="key"
                :name="key"/>
            <calendar-field v-else-if="item.type === 'calendar'" v-bind="$props"
                :field="item"
                :id="key"/>
            <checkbox-field v-else-if="item.type === 'checkbox'" v-bind="$props"
                :field="item"
                :id="key"/>
            <password-field v-else-if="item.type === 'password'" v-bind="$props"
                :field="item"
                :id="key"/>
            <dropdown-field v-else-if="item.type === 'select'" v-bind="$props"
                :field="item"
                :id="key"/>
            <switch-field v-else-if="item.type === 'switch'" v-bind="$props"
                :field="item"
                :id="key"/>
            <textarea-field v-else-if="item.type === 'textarea'" v-bind="$props"
                :field="item"
                :id="key"/>
            <upload-field v-else-if="item.type === 'upload'" v-bind="$props"
                :field="item"
                :id="key"/>
            <hidden-field v-else-if="item.type === 'hidden'" v-bind="$props"
                :field="item"
                :id="key"/>
            <text-field v-else v-bind="$props"
                :field="item"
                :id="key"/>
        </template>
    </div>
</template>

<script>
import CalendarField from './fields/CalendarField.vue';
import CheckboxField from './fields/CheckboxField.vue';
import DropdownField from './fields/DropdownField.vue';
import HiddenField from './fields/HiddenField.vue';
import PasswordField from './fields/PasswordField.vue';
import SwitchField from './fields/SwitchField.vue';
import TextField from './fields/TextField.vue';
import TextareaField from './fields/TextareaField.vue';
import UploadField from './fields/UploadField.vue';

export default {
    components: {
        CalendarField,
        CheckboxField,
        DropdownField,
        HiddenField,
        PasswordField,
        SwitchField,
        TextField,
        TextareaField,
        UploadField,
    },

    props: {
        class: {
            type: String,
            default: null,
        },
        creating: {
            type: Boolean,
            default: false,
        },
        fields: {
            type: Object,
            required: true,
        },
        form: {
            type: Object,
            required: true,
        },
        invalid: {
            type: Boolean,
            default: false,
        },
        template: {
            type: Object,
            required: true,
        },
        updating: {
            type: Boolean,
            default: false,
        },
    },
};    
</script>
