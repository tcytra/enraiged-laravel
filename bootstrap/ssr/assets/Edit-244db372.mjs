import { A as App, P as PageHeader } from "./PageHeader-f063c111.mjs";
import { P as PageMessages } from "./PageMessages-191884bf.mjs";
import { P as PrimevueCard } from "./Card-fe8810d1.mjs";
import { D as DropdownField, V as VueForm } from "./VueForm-c5643d66.mjs";
import { T as TextField } from "./TextField-9739c1e8.mjs";
import { resolveComponent, withCtx, createVNode, toDisplayString, useSSRContext, mergeProps } from "vue";
import { ssrRenderComponent, ssrInterpolate, ssrRenderAttrs } from "vue/server-renderer";
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
import "./InputText-d441a729.mjs";
const _sfc_main$1 = {
  components: {
    PrimevueCard,
    DropdownField,
    TextField,
    VueForm
  },
  inject: ["i18n"],
  props: {
    template: {
      type: Object,
      required: true
    }
  }
};
function _sfc_ssrRender$1(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_primevue_card = resolveComponent("primevue-card");
  const _component_vue_form = resolveComponent("vue-form");
  _push(ssrRenderComponent(_component_primevue_card, _attrs, {
    header: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`<header class="header"${_scopeId}><h3${_scopeId}>${ssrInterpolate($options.i18n("This form will allow you to manage profile details."))}</h3></header>`);
      } else {
        return [
          createVNode("header", { class: "header" }, [
            createVNode("h3", null, toDisplayString($options.i18n("This form will allow you to manage profile details.")), 1)
          ])
        ];
      }
    }),
    content: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(ssrRenderComponent(_component_vue_form, { template: $props.template }, null, _parent2, _scopeId));
      } else {
        return [
          createVNode(_component_vue_form, { template: $props.template }, null, 8, ["template"])
        ];
      }
    }),
    _: 1
  }, _parent));
}
const _sfc_setup$1 = _sfc_main$1.setup;
_sfc_main$1.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/users/forms/ProfileForm.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const ProfileForm = /* @__PURE__ */ _export_sfc(_sfc_main$1, [["ssrRender", _sfc_ssrRender$1]]);
const _sfc_main = {
  layout: App,
  components: {
    PageHeader,
    PageMessages,
    ProfileForm
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
    title() {
      return this.user.is_myself ? "Update My Details" : "Update Profile";
    }
  },
  methods: {
    dismiss(index) {
      this.messages.splice(index, 1);
    }
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_page_header = resolveComponent("page-header");
  const _component_page_messages = resolveComponent("page-messages");
  const _component_profile_form = resolveComponent("profile-form");
  _push(`<main${ssrRenderAttrs(mergeProps({ class: "content main" }, _attrs))}>`);
  _push(ssrRenderComponent(_component_page_header, {
    "back-button": "",
    title: $options.title
  }, null, _parent));
  _push(`<section class="auto-margin container max-width-lg">`);
  _push(ssrRenderComponent(_component_page_messages, {
    messages: $props.messages,
    onDismiss: ($event) => $props.messages.splice($event, 1)
  }, null, _parent));
  _push(ssrRenderComponent(_component_profile_form, { template: $props.template }, null, _parent));
  _push(`</section></main>`);
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/pages/users/profiles/Edit.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const Edit = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  Edit as default
};
