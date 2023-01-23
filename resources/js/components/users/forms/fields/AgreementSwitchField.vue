<template>
    <headless-form-field v-slot:default="{ error, label, update }"
        v-if="meta.must_agree_to_terms"
        :field="field"
        :form="form"
        :id="id">
        <div class="control agreement switch" :class="$attrs.class">
            <label class="label" :for="id">
                {{ label }}
            </label>
            <div class="field switch mb-0 flex-grow-0">
                <primevue-switch v-model="model" :id="id"
                    @update:modelValue="update"/>
            </div>
            <div class="text-right my-3">
                <span style="margin-left:1rem;" v-for="(type, index) in meta.must_agree_to_terms"
                    :key="index">
                    <strong v-if="type == 'EULA'">
                        <a href="/eula" target="_blank">
                            {{ i18n('End User License Agreement') }}
                        </a>
                    </strong>
                    <strong v-if="type == 'TOS'">
                        <a href="/tos" target="_blank">
                            {{ i18n('Terms Of Service') }}
                        </a>
                    </strong>
                </span>
            </div>
            <div class="error" v-if="error">
                {{ error }}
            </div>
        </div>
    </headless-form-field>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import HeadlessFormField from '@/components/forms/headless/FormField.vue';
import PrimevueSwitch from 'primevue/inputswitch/InputSwitch.vue';

export default {
    inheritAttrs: false,

    components: {
        Link,
        HeadlessFormField,
        PrimevueSwitch,
    },

    inject: ['meta', 'i18n'],

    props: {
        form: {
            type: Object,
            required: true,
        },
        id: {
            type: String,
            required: true,
        },
    },

    data: () => ({
        field: {
            label: 'I have read and agree to these terms',
            required: true,
        },
    }),

    computed: {
        model() {
            return this.form ? this.form[this.id] : null;
        },
    },
};
</script>
