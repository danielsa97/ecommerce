<template>
    <fieldset class="form-group" @input="clearError" ref="field">
        <legend v-if="label" :data-legend="fieldName" tabindex="-1" class="bv-no-focus-ring col-form-label pt-0">
            {{label}} <span v-if="required" class="text-danger">*</span>
        </legend>
        <slot/>
        <div class="text-danger font-weight-bold" :data-error="fieldName"></div>
    </fieldset>
</template>

<script>
    export default {
        name: "FormGroup",
        props: {
            label: {
                type: String,
                required: false
            },
            required: {
                type: Boolean,
                required: false,
                default: false
            },
            name: {
                type: String,
                required: false,
            }
        },
        data() {
            return {
                fieldName: null
            };
        },
        mounted() {
            this.fieldName = String(this.name ?? this.$refs['field'].elements[0]?.name ?? '').split('[')[0];
        },
        methods: {
            clearError() {
                let legend, errorElement;
                legend = this.$refs['field'].querySelector(`[data-legend=${this.fieldName}]`);
                errorElement = this.$refs['field'].querySelector(`[data-error=${this.fieldName}]`);
                if (legend) legend.classList.remove('text-danger');
                if (errorElement) errorElement.innerHTML = null;
            }
        }
    }
</script>
