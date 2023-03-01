import { A as App, P as PageHeader } from "./PageHeader-f063c111.mjs";
import { P as PageMessages } from "./PageMessages-191884bf.mjs";
import { V as VueForm } from "./VueForm-c5643d66.mjs";
import { resolveComponent, mergeProps, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderComponent } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
import "date-fns";
import "@inertiajs/vue3";
import "./Button-8c19e69a.mjs";
import "primevue/ripple";
import "primevue/tooltip/tooltip.cjs.js";
import "primevue/button";
import "primevue/confirmationeventbus";
import "primevue/dialog";
import "./FormField-dafe0416.mjs";
import "primevue/overlayeventbus";
import "primevue/portal";
import "primevue/utils";
import "./Dropdown-1272b7b2.mjs";
import "primevue/api";
import "primevue/virtualscroller";
import "./PasswordField-5c29a982.mjs";
import "primevue/inputtext";
import "./SwitchField-cfe5ecaa.mjs";
import "./InputSwitch-c8ce2fca.mjs";
import "./TextField-9739c1e8.mjs";
import "./InputText-d441a729.mjs";
import "./Card-fe8810d1.mjs";
const _sfc_main = {
  layout: App,
  components: {
    PageHeader,
    PageMessages,
    VueForm
  },
  inject: ["i18n"],
  props: {
    messages: {
      type: Array,
      default: []
    },
    template: {
      type: Object,
      required: true
    },
    user: {
      type: Object,
      required: true
    }
  },
  computed: {
    heading() {
      return `${this.i18n("Update User")}: ${this.user.profile.name}`;
    },
    title() {
      return this.i18n("Update User");
    }
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_page_header = resolveComponent("page-header");
  const _component_page_messages = resolveComponent("page-messages");
  const _component_vue_form = resolveComponent("vue-form");
  _push(`<main${ssrRenderAttrs(mergeProps({ class: "content main" }, _attrs))}>`);
  _push(ssrRenderComponent(_component_page_header, {
    "back-button": "",
    heading: $options.heading,
    title: $options.title
  }, null, _parent));
  _push(`<section class="auto-margin container max-width-md">`);
  _push(ssrRenderComponent(_component_page_messages, {
    messages: $props.messages,
    onDismiss: ($event) => $props.messages.splice($event, 1)
  }, null, _parent));
  _push(ssrRenderComponent(_component_vue_form, {
    template: $props.template,
    updating: ""
  }, null, _parent));
  _push(`</section></main>`);
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/pages/users/Edit.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const Edit = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  Edit as default
};
