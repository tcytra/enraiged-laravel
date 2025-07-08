<template>
    <form-field v-slot:default="field">
        <input :id="field.id" type="hidden" ref="input" v-model="field.form[field.id]" />
        <slot name="content" v-bind="field" />
    </form-field>
</template>

<script setup>
import FormField from './renderless/FormField.vue';
</script>
