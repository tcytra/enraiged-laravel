import { A as App, P as PageHeader } from "./PageHeader-f063c111.mjs";
import { P as PrimevueButton } from "./Button-8c19e69a.mjs";
import { resolveComponent, mergeProps, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderComponent, ssrInterpolate } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
import "date-fns";
import "@inertiajs/vue3";
import "primevue/tooltip/tooltip.cjs.js";
import "primevue/button";
import "primevue/confirmationeventbus";
import "primevue/dialog";
import "primevue/ripple";
const _sfc_main = {
  layout: App,
  components: {
    PageHeader,
    PrimevueButton
  },
  inject: ["i18n"],
  props: {
    user: {
      type: Object,
      required: true
    }
  },
  computed: {
    title() {
      return this.user.is_myself ? "My Profile" : this.user.profile.name;
    }
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_page_header = resolveComponent("page-header");
  _push(`<main${ssrRenderAttrs(mergeProps({ class: "content main" }, _attrs))}>`);
  _push(ssrRenderComponent(_component_page_header, {
    "back-button": "",
    title: $options.title
  }, null, _parent));
  _push(`<section class="auto-margin container max-width-xl w-full"><div class="grid"><div class="col-12">${ssrInterpolate($options.i18n("Member Profile Page"))}</div></div></section></main>`);
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/pages/users/profiles/Show.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const Show = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  Show as default
};
