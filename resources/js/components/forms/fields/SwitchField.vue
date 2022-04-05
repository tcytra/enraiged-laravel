<template>
    <vue-form-field :form="form" :id="id" v-slot:default="{ error, update }">
        <div class="control switch" :class="$attrs.class">
            <label v-if="label" class="label" :for="id">
                {{ label }}
            </label>
            <div class="field switch mb-0">
                <primevue-switch v-model="model" :id="id"
                    @update:modelValue="update"/>
            </div>
            <div class="error" v-if="error">
                {{ error }}
            </div>
        </div>
    </vue-form-field>
</template>

<script>
import { v4 as uuid } from 'uuid';
import PrimevueSwitch from 'primevue/inputswitch';
import VueFormField from '@/components/forms/VueFormField';

export default {
    inheritAttrs: false,

    components: {
        PrimevueSwitch,
        VueFormField,
    },

    props: {
        form: {
            type: Object,
            required: true,
        },
        id: {
            type: String,
            required: true,
        },
        label: String,
        model: {
            type: Boolean,
            default: false,
        },
    },
};
</script>
