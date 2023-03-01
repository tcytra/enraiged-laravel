import { Link, useForm } from "@inertiajs/vue3";
import { A as App, P as PageHeader } from "./PageHeader-f063c111.mjs";
import { P as PrimevueButton } from "./Button-8c19e69a.mjs";
import { P as PasswordField } from "./PasswordField-5c29a982.mjs";
import { T as TextField } from "./TextField-9739c1e8.mjs";
import { resolveComponent, mergeProps, withCtx, createTextVNode, createVNode, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderComponent, ssrRenderClass } from "vue/server-renderer";
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
import "./InputText-d441a729.mjs";
const _sfc_main = {
  layout: App,
  components: {
    AppLayout: App,
    Link,
    PageHeader,
    PrimevueButton,
    VuePasswordField: PasswordField,
    VueTextField: TextField
  },
  props: {
    flash: Object,
    form: {
      type: Object,
      required: true
    }
  },
  computed: {
    success() {
      return this.flash && this.flash.status === 200;
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
  const _component_Link = resolveComponent("Link");
  const _component_vue_text_field = resolveComponent("vue-text-field");
  const _component_vue_password_field = resolveComponent("vue-password-field");
  const _component_primevue_button = resolveComponent("primevue-button");
  _push(`<div${ssrRenderAttrs(mergeProps({ class: "login panel" }, _attrs))}>`);
  _push(ssrRenderComponent(_component_page_header, { title: "Reset Password" }, null, _parent));
  if ($options.success) {
    _push(`<div class="body"><div class="container flex-column"><p class="text text-center text-xl">Your password has been reset.</p><div class="text-center my-5">`);
    _push(ssrRenderComponent(_component_Link, {
      as: "button",
      class: "p-button p-button-secondary",
      href: "/login",
      type: "button"
    }, {
      default: withCtx((_, _push2, _parent2, _scopeId) => {
        if (_push2) {
          _push2(` Return to login `);
        } else {
          return [
            createTextVNode(" Return to login ")
          ];
        }
      }),
      _: 1
    }, _parent));
    _push(`</div></div></div>`);
  } else {
    _push(`<div class="body"><form class="form relative">`);
    _push(ssrRenderComponent(_component_vue_text_field, {
      "is-large": "",
      class: "email",
      id: "email",
      field: { placeholder: "Email", required: true },
      form: $setup.form
    }, null, _parent));
    _push(ssrRenderComponent(_component_vue_password_field, {
      "is-large": "",
      feedback: "",
      id: "password",
      field: { placeholder: "Password", required: true },
      form: $setup.form
    }, null, _parent));
    _push(ssrRenderComponent(_component_vue_password_field, {
      "is-large": "",
      id: "password_confirmation",
      field: { placeholder: "Confirm Password", required: true },
      form: $setup.form
    }, null, _parent));
    _push(`</form></div>`);
  }
  _push(`<footer class="footer"><div class="${ssrRenderClass([{ "flex-row-reverse": !$options.success }, "submit container"])}">`);
  if (!$options.success) {
    _push(ssrRenderComponent(_component_primevue_button, {
      label: "Reset Password",
      class: "p-button-secondary",
      onClick: $setup.submit
    }, null, _parent));
  } else {
    _push(`<!---->`);
  }
  _push(ssrRenderComponent(_component_Link, {
    class: "flex align-items-center",
    href: "/login"
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`<span${_scopeId}>Login</span>`);
      } else {
        return [
          createVNode("span", null, "Login")
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</div></footer></div>`);
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/pages/auth/PasswordReset.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const PasswordReset = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  PasswordReset as default
};
