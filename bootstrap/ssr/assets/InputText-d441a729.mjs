import { useSSRContext, mergeProps } from "vue";
import { ssrRenderAttrs } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
const _sfc_main = {
  name: "InputText",
  emits: ["update:modelValue"],
  props: {
    modelValue: null
  },
  methods: {
    onInput(event) {
      this.$emit("update:modelValue", event.target.value);
    }
  },
  computed: {
    filled() {
      return this.modelValue != null && this.modelValue.toString().length > 0;
    }
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  _push(`<input${ssrRenderAttrs(mergeProps({
    class: ["p-inputtext p-component", { "p-filled": $options.filled }],
    value: $props.modelValue
  }, _attrs))}>`);
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("node_modules/primevue/inputtext/InputText.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const PrimevueInputtext = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  PrimevueInputtext as P
};
