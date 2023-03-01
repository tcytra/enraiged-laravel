import { Link, useForm } from "@inertiajs/vue3";
import { A as App, P as PageHeader } from "./PageHeader-f063c111.mjs";
import { P as PrimevueButton } from "./Button-8c19e69a.mjs";
import { P as PasswordField } from "./PasswordField-5c29a982.mjs";
import { S as SwitchField } from "./SwitchField-cfe5ecaa.mjs";
import { T as TextField } from "./TextField-9739c1e8.mjs";
import { resolveComponent, mergeProps, withCtx, createVNode, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderComponent } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
import "date-fns";
import "primevue/tooltip/tooltip.cjs.js";
import "primevue/button";
import "primevue/confirmationeventbus";
import "primevue/dialog";
import "primevue/ripple";
import "./FormField-dafe0416.mjs";
import "primevue/inputtext";
import "primevue/overlayeventbus";
import "primevue/portal";
import "primevue/utils";
import "./InputSwitch-c8ce2fca.mjs";
import "./InputText-d441a729.mjs";
const _sfc_main = {
  layout: App,
  components: {
    Link,
    PageHeader,
    PrimevueButton,
    VuePasswordField: PasswordField,
    VueSwitchField: SwitchField,
    VueTextField: TextField
  },
  inject: ["meta"],
  props: {
    form: {
      type: Object,
      required: true
    }
  },
  setup(props) {
    const form = useForm(props.form.fields);
    function submit() {
      form.post(props.form.uri);
    }
    return { form, submit };
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_page_header = resolveComponent("page-header");
  const _component_vue_text_field = resolveComponent("vue-text-field");
  const _component_vue_password_field = resolveComponent("vue-password-field");
  const _component_vue_switch_field = resolveComponent("vue-switch-field");
  const _component_primevue_button = resolveComponent("primevue-button");
  const _component_Link = resolveComponent("Link");
  _push(`<div${ssrRenderAttrs(mergeProps({ class: "login panel" }, _attrs))}>`);
  _push(ssrRenderComponent(_component_page_header, { title: "User Login" }, null, _parent));
  _push(`<div class="body"><form class="form relative">`);
  _push(ssrRenderComponent(_component_vue_text_field, {
    class: "email",
    id: "email",
    "is-large": "",
    field: { placeholder: "Email", required: true },
    form: $setup.form
  }, null, _parent));
  _push(ssrRenderComponent(_component_vue_password_field, {
    id: "password",
    "is-large": "",
    field: { placeholder: "Password", required: true },
    form: $setup.form
  }, null, _parent));
  _push(ssrRenderComponent(_component_vue_switch_field, {
    id: "remember",
    field: { label: "Remember Me" },
    form: $setup.form
  }, null, _parent));
  _push(`</form></div><footer class="footer"><div class="submit container flex-row-reverse">`);
  _push(ssrRenderComponent(_component_primevue_button, {
    label: "Login",
    class: "p-button-secondary",
    onClick: $setup.submit
  }, null, _parent));
  _push(`<div class="flex">`);
  if ($options.meta.allow_registration) {
    _push(`<span>`);
    _push(ssrRenderComponent(_component_Link, { href: "/register" }, {
      default: withCtx((_, _push2, _parent2, _scopeId) => {
        if (_push2) {
          _push2(`<span${_scopeId}>Register</span>`);
        } else {
          return [
            createVNode("span", null, "Register")
          ];
        }
      }),
      _: 1
    }, _parent));
    _push(`   •   </span>`);
  } else {
    _push(`<!---->`);
  }
  _push(`<span>`);
  _push(ssrRenderComponent(_component_Link, { href: "/forgot-password" }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`<span${_scopeId}>Forgot Password</span>`);
      } else {
        return [
          createVNode("span", null, "Forgot Password")
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</span></div></div></footer></div>`);
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/pages/auth/Login.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const Login = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  Login as default
};
