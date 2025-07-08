<template>
    <div class="card container p-6">
        <html-head title="Preview Theme" />
        <div class="flex flex-row">
            <div class="flex flex-col align-center mx-3 w-48">
                <primevue-button class="mb-3" label="Primary" />
                <primevue-button class="mb-3" label="Secondary" severity="secondary" />
                <primevue-button class="mb-3" label="Success" severity="success" />
                <primevue-button class="mb-3" label="Info" severity="info" />
                <primevue-button class="mb-3" label="Warning" severity="warning" />
                <primevue-button class="mb-3" label="Help" severity="help" />
                <primevue-button class="mb-3" label="Danger" severity="danger" />
                <primevue-button class="mb-3" label="Contrast" severity="contrast" />
            </div>
            <div class="flex flex-col align-center mx-3 w-128">
                <form class="form horizontal" @submit.prevent="submit">
                    <checkbox-field id="checkbox"
                        :field="{
                            label: 'Checkbox',
                            type: 'checkbox',
                        }"
                        :form="form" />
                    <datepicker-field id="datepicker" show-button-bar show-icon disable-weekends
                        :field="{
                            label: 'Datepicker',
                            placeholder: 'Datepicker Field',
                            type: 'datepicker',
                        }"
                        :form="form" />
                    <dropdown-field id="dropdown"
                        :field="{
                            autoselectable: true,
                            clearable: true,
                            label: 'Dropdown',
                            options: {
                                source: 'api',
                                route: 'test.available',
                            },
                            placeholder: 'Dropdown Field',
                            searchable: true,
                            type: 'select',
                        }"
                        :form="form" />
                    <editor-field id="editor"
                        :field="{
                            height: '160px',
                            placeholder: 'Editor Field',
                            type: 'editor',
                        }"
                        :form="form" />
                    <listbox-field id="listbox" checkmark disable-highlight filter multiple
                        :field="{
                            label: 'Listbox',
                            options: {
                                label: 'city',
                                values: [
                                    {id: 1, city: 'Calgary'},
                                    {id: 2, city: 'Edmonton'},
                                    {id: 3, city: 'Montréal'},
                                    {id: 4, city: 'Toronto'},
                                    {id: 5, city: 'Vancouver'},
                                ],
                            },
                            type: 'listbox',
                        }"
                        :form="form" />
                    <number-field id="number" show-buttons
                        :field="{
                            buttonLayout: 'horizontal',
                            currency: 'CAD',
                            label: 'Number',
                            max: 100,
                            min: 0,
                            minFractionDigits: 2,
                            mode: 'currency',
                            placeholder: 'Number Field',
                            step: 0.25,
                            type: 'number',
                        }"
                        :form="form" />
                    <password-field id="password"
                        :field="{
                            label: 'Password',
                            placeholder: 'Password Field',
                            type: 'password',
                        }"
                        :form="form" />
                    <security-field id="security" mask
                        :field="{
                            label: 'Security',
                            length: 6,
                            placeholder: 'Security Field',
                            type: 'security',
                        }"
                        :form="form" />
                    <switch-field id="switch"
                        :field="{
                            label: 'Switch',
                            size: 'large',
                            type: 'switch',
                        }"
                        :form="form" />
                    <text-field id="text"
                        :field="{
                            label: 'Text',
                            placeholder: 'Text Field',
                            type: 'text',
                        }"
                        :form="form" />
                    <textarea-field id="textarea" autoresize
                        :field="{
                            label: 'Textarea',
                            placeholder: 'Textarea Field',
                            type: 'text',
                        }"
                        :form="form"  />
                </form>
            </div>
            <div class="flex flex-col align-center mx-3 w-64">
                <pre>{{ form.data() }}</pre>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head as HtmlHead, useForm } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import CheckboxField from '@/components/forms/fields/CheckboxField.vue';
import DatepickerField from '@/components/forms/fields/DatepickerField.vue';
import DefaultLayout from '@/layouts/DefaultLayout.vue';
import DropdownField from '@/components/forms/fields/DropdownField.vue';
import EditorField from '@/components/forms/fields/EditorField.vue';
import HiddenField from '@/components/forms/fields/HiddenField.vue';
import ListboxField from '@/components/forms/fields/ListboxField.vue';
import NumberField from '@/components/forms/fields/NumberField.vue';
import PasswordField from '@/components/forms/fields/PasswordField.vue';
import PrimevueButton from 'primevue/button';
import SecurityField from '@/components/forms/fields/SecurityField.vue';
import SwitchField from '@/components/forms/fields/SwitchField.vue';
import TextField from '@/components/forms/fields/TextField.vue';
import TextareaField from '@/components/forms/fields/TextareaField.vue';

defineOptions({
    layout: DefaultLayout,
});

const form = useForm({
    checkbox: false,
    datepicker: null,
    dropdown: null,
    editor: null,
    listbox: null,
    number: null,
    password: null,
    security: null,
    switch: false,
    text: null,
    textarea: null,
});
</script>
