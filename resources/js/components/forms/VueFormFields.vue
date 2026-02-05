<template>
    <div :class="template.class">
        <template v-for="(item, key) in fields" :key="key">
            <slot v-if="item.custom" v-bind="$props"
                :field="item"
                :id="key"
                :name="key"
                :ref="key" />
            <checkbox-field v-else-if="item.type === 'checkbox'" v-bind="$props"
                :field="item"
                :id="key"
                :ref="key" />
            <datepicker-field v-else-if="item.type === 'datepicker'" v-bind="$props"
                :field="item"
                :id="key"
                :ref="key" />
            <dropdown-field v-else-if="item.type === 'select'" v-bind="$props"
                :field="item"
                :id="key"
                :ref="key"
                @field:updated="updated(key)" />
            <editor-field v-else-if="item.type === 'editor'" v-bind="$props"
                :field="item"
                :id="key"
                :ref="key" />
            <hidden-field v-else-if="item.type === 'hidden'" v-bind="$props"
                :field="item"
                :form="form"
                :id="key"
                :ref="key" />
            <listbox-field v-else-if="item.type === 'listbox'" v-bind="$props"
                :field="item"
                :id="key"
                :ref="key" />
            <number-field v-else-if="item.type === 'number'" v-bind="$props"
                :field="item"
                :id="key"
                :ref="key" />
            <password-field v-else-if="item.type === 'password'" v-bind="$props"
                :field="item"
                :id="key"
                :ref="key" />
            <security-field v-else-if="item.type === 'security'" v-bind="$props"
                :field="item"
                :id="key"
                :ref="key" />
            <switch-field v-else-if="item.type === 'switch'" v-bind="$props"
                :field="item"
                :id="key"
                :ref="key" />
            <textarea-field v-else-if="item.type === 'textarea'" v-bind="$props"
                :field="item"
                :id="key"
                :ref="key" />
            <upload-field v-else-if="item.type === 'upload'" v-bind="$props"
                :field="item"
                :form="form"
                :id="key"
                :ref="key" />
            <text-field v-else v-bind="$props"
                :field="item"
                :id="key"
                :ref="key" />
        </template>
    </div>
</template>

<script>
import CheckboxField from './fields/CheckboxField.vue';
import DatepickerField from './fields/DatepickerField.vue';
import DropdownField from './fields/DropdownField.vue';
import EditorField from './fields/EditorField.vue';
import HiddenField from './fields/HiddenField.vue';
import ListboxField from './fields/ListboxField.vue';
import NumberField from './fields/NumberField.vue';
import PasswordField from './fields/PasswordField.vue';
import SecurityField from './fields/SecurityField.vue';
import SwitchField from './fields/SwitchField.vue';
import TextField from './fields/TextField.vue';
import TextareaField from './fields/TextareaField.vue';
import UploadField from './fields/UploadField.vue';

export default {
    components: {
        CheckboxField,
        DatepickerField,
        DropdownField,
        EditorField,
        HiddenField,
        ListboxField,
        NumberField,
        PasswordField,
        SecurityField,
        SwitchField,
        TextField,
        TextareaField,
        UploadField,
    },

    emits: ['field:updated'],

    props: {
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

    methods: {
        updated(fieldid) {
            this.$emit('field:updated', fieldid);
        },
    },
};    
</script>
