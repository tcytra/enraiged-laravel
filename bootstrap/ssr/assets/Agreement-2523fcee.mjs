import { Head } from "@inertiajs/vue3";
import { P as PrimevueButton } from "./Button-8c19e69a.mjs";
import { resolveComponent, mergeProps, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderComponent } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
import "primevue/ripple";
const _sfc_main = {
  components: {
    Head,
    PrimevueButton
  },
  props: {
    agreement: {
      type: Object,
      required: true
    }
  },
  computed: {
    type() {
      return this.agreement.type;
    }
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_Head = resolveComponent("Head");
  _push(`<div${ssrRenderAttrs(mergeProps({ class: "guest layout" }, _attrs))}>`);
  _push(ssrRenderComponent(_component_Head, { title: $options.type }, null, _parent));
  _push(`<div class="container bg-bluegray-800"><div class="agreement panel"><div class="text-100">${$props.agreement.content}</div></div></div></div>`);
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/pages/auth/Agreement.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const Agreement = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  Agreement as default
};
