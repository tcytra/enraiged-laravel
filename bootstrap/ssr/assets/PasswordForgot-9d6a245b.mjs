import { Link, useForm } from "@inertiajs/vue3";
import { A as App, P as PageHeader } from "./PageHeader-f063c111.mjs";
import { P as PrimevueButton } from "./Button-8c19e69a.mjs";
import { T as TextField } from "./TextField-9739c1e8.mjs";
import { resolveComponent, mergeProps, withCtx, createVNode, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderComponent, ssrRenderClass } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
import "date-fns";
import "primevue/tooltip/tooltip.cjs.js";
import "primevue/button";
import "primevue/confirmationeventbus";
import "primevue/dialog";
import "primevue/ripple";
import "./FormField-dafe0416.mjs";
import "./InputText-d441a729.mjs";
const _sfc_main = {
  layout: App,
  components: {
    AppLayout: App,
    Link,
    PageHeader,
    PrimevueButton,
    VueTextField: TextField
  },
  props: {
    flash: Object,
    form: Object
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
    function update(field) {
      form.clearErrors(field.id);
      form[field.id] = field.value;
    }
    return { form, submit, update };
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_page_header = resolveComponent("page-header");
  const _component_vue_text_field = resolveComponent("vue-text-field");
  const _component_primevue_button = resolveComponent("primevue-button");
  const _component_Link = resolveComponent("Link");
  _push(`<div${ssrRenderAttrs(mergeProps({ class: "forgot panel" }, _attrs))}>`);
  _push(ssrRenderComponent(_component_page_header, { title: "Forgot Password" }, null, _parent));
  if ($options.success) {
    _push(`<div class="body"><div class="container flex-column"><p class="text text-center text-xl">An email has been sent to your address.</p><p class="text text-center text-xl">Follow the instructions to reset your password.</p></div></div>`);
  } else {
    _push(`<div class="body"><form class="form relative">`);
    _push(ssrRenderComponent(_component_vue_text_field, {
      class: "email",
      id: "email",
      focus: "",
      "is-large": "",
      field: { placeholder: "Email", required: true },
      form: $setup.form
    }, null, _parent));
    _push(`</form></div>`);
  }
  _push(`<footer class="footer"><div class="${ssrRenderClass([{ "flex-row-reverse": !$options.success }, "submit container"])}">`);
  if (!$options.success) {
    _push(ssrRenderComponent(_component_primevue_button, {
      label: "Submit",
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
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/pages/auth/PasswordForgot.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const PasswordForgot = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  PasswordForgot as default
};
