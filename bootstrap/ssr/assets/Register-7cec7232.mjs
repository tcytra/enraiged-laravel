import { Link, useForm } from "@inertiajs/vue3";
import { A as App, P as PageHeader } from "./PageHeader-f063c111.mjs";
import { P as PrimevueButton } from "./Button-8c19e69a.mjs";
import { P as PasswordField } from "./PasswordField-5c29a982.mjs";
import { T as TextField } from "./TextField-9739c1e8.mjs";
import { _ as _sfc_main$2 } from "./FormField-dafe0416.mjs";
import { P as PrimevueSwitch } from "./InputSwitch-c8ce2fca.mjs";
import { resolveComponent, mergeProps, withCtx, createVNode, toDisplayString, openBlock, createBlock, Fragment, renderList, createCommentVNode, useSSRContext } from "vue";
import { ssrRenderComponent, ssrRenderClass, ssrRenderAttr, ssrInterpolate, ssrRenderList, ssrRenderStyle, ssrRenderAttrs } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
import "date-fns";
import "primevue/tooltip/tooltip.cjs.js";
import "primevue/button";
import "primevue/confirmationeventbus";
import "primevue/dialog";
import "primevue/ripple";
import "primevue/inputtext";
import "primevue/overlayeventbus";
import "primevue/portal";
import "primevue/utils";
import "./InputText-d441a729.mjs";
const _sfc_main$1 = {
  inheritAttrs: false,
  components: {
    Link,
    HeadlessFormField: _sfc_main$2,
    PrimevueSwitch
  },
  inject: ["meta", "i18n"],
  props: {
    form: {
      type: Object,
      required: true
    },
    id: {
      type: String,
      required: true
    }
  },
  data: () => ({
    field: {
      label: "I have read and agree to these terms",
      required: true
    }
  }),
  computed: {
    model() {
      return this.form ? this.form[this.id] : null;
    }
  }
};
function _sfc_ssrRender$1(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_headless_form_field = resolveComponent("headless-form-field");
  const _component_primevue_switch = resolveComponent("primevue-switch");
  if ($options.meta.must_agree_to_terms) {
    _push(ssrRenderComponent(_component_headless_form_field, mergeProps({
      field: _ctx.field,
      form: $props.form,
      id: $props.id
    }, _attrs), {
      default: withCtx(({ error, label, update }, _push2, _parent2, _scopeId) => {
        if (_push2) {
          _push2(`<div class="${ssrRenderClass([_ctx.$attrs.class, "control agreement switch"])}"${_scopeId}><label class="label"${ssrRenderAttr("for", $props.id)}${_scopeId}>${ssrInterpolate(label)}</label><div class="field switch mb-0 flex-grow-0"${_scopeId}>`);
          _push2(ssrRenderComponent(_component_primevue_switch, {
            modelValue: $options.model,
            "onUpdate:modelValue": [($event) => $options.model = $event, update],
            id: $props.id
          }, null, _parent2, _scopeId));
          _push2(`</div><div class="text-right my-3"${_scopeId}><!--[-->`);
          ssrRenderList($options.meta.must_agree_to_terms, (type, index) => {
            _push2(`<span style="${ssrRenderStyle({ "margin-left": "1rem" })}"${_scopeId}>`);
            if (type == "EULA") {
              _push2(`<strong${_scopeId}><a href="/eula" target="_blank"${_scopeId}>${ssrInterpolate($options.i18n("End User License Agreement"))}</a></strong>`);
            } else {
              _push2(`<!---->`);
            }
            if (type == "TOS") {
              _push2(`<strong${_scopeId}><a href="/tos" target="_blank"${_scopeId}>${ssrInterpolate($options.i18n("Terms Of Service"))}</a></strong>`);
            } else {
              _push2(`<!---->`);
            }
            _push2(`</span>`);
          });
          _push2(`<!--]--></div>`);
          if (error) {
            _push2(`<div class="error"${_scopeId}>${ssrInterpolate(error)}</div>`);
          } else {
            _push2(`<!---->`);
          }
          _push2(`</div>`);
        } else {
          return [
            createVNode("div", {
              class: ["control agreement switch", _ctx.$attrs.class]
            }, [
              createVNode("label", {
                class: "label",
                for: $props.id
              }, toDisplayString(label), 9, ["for"]),
              createVNode("div", { class: "field switch mb-0 flex-grow-0" }, [
                createVNode(_component_primevue_switch, {
                  modelValue: $options.model,
                  "onUpdate:modelValue": [($event) => $options.model = $event, update],
                  id: $props.id
                }, null, 8, ["modelValue", "onUpdate:modelValue", "id"])
              ]),
              createVNode("div", { class: "text-right my-3" }, [
                (openBlock(true), createBlock(Fragment, null, renderList($options.meta.must_agree_to_terms, (type, index) => {
                  return openBlock(), createBlock("span", {
                    style: { "margin-left": "1rem" },
                    key: index
                  }, [
                    type == "EULA" ? (openBlock(), createBlock("strong", { key: 0 }, [
                      createVNode("a", {
                        href: "/eula",
                        target: "_blank"
                      }, toDisplayString($options.i18n("End User License Agreement")), 1)
                    ])) : createCommentVNode("", true),
                    type == "TOS" ? (openBlock(), createBlock("strong", { key: 1 }, [
                      createVNode("a", {
                        href: "/tos",
                        target: "_blank"
                      }, toDisplayString($options.i18n("Terms Of Service")), 1)
                    ])) : createCommentVNode("", true)
                  ]);
                }), 128))
              ]),
              error ? (openBlock(), createBlock("div", {
                key: 0,
                class: "error"
              }, toDisplayString(error), 1)) : createCommentVNode("", true)
            ], 2)
          ];
        }
      }),
      _: 1
    }, _parent));
  } else {
    _push(`<!---->`);
  }
}
const _sfc_setup$1 = _sfc_main$1.setup;
_sfc_main$1.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/users/forms/fields/AgreementSwitchField.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const AgreementSwitchField = /* @__PURE__ */ _export_sfc(_sfc_main$1, [["ssrRender", _sfc_ssrRender$1]]);
const _sfc_main = {
  layout: App,
  components: {
    Link,
    PageHeader,
    PrimevueButton,
    VuePasswordField: PasswordField,
    VueTextField: TextField,
    AgreementSwitchField
  },
  props: {
    flash: Object,
    form: Object
  },
  computed: {
    success() {
      return this.flash && this.flash.status === 201;
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
  const _component_vue_password_field = resolveComponent("vue-password-field");
  const _component_agreement_switch_field = resolveComponent("agreement-switch-field");
  const _component_primevue_button = resolveComponent("primevue-button");
  const _component_Link = resolveComponent("Link");
  _push(`<div${ssrRenderAttrs(mergeProps({ class: "login panel" }, _attrs))}>`);
  _push(ssrRenderComponent(_component_page_header, { title: "Register Account" }, null, _parent));
  if ($options.success) {
    _push(`<div class="body"><div class="container flex-column"><p class="text text-center text-xl">Your email address must be verified.</p><p class="text text-center text-xl">Please check your inbox for an email.</p></div></div>`);
  } else {
    _push(`<div class="body"><form class="form relative">`);
    _push(ssrRenderComponent(_component_vue_text_field, {
      class: "name",
      id: "name",
      "is-large": "",
      field: { placeholder: "Name", required: true },
      form: $setup.form
    }, null, _parent));
    _push(ssrRenderComponent(_component_vue_text_field, {
      class: "email",
      id: "email",
      "is-large": "",
      field: { placeholder: "Email", required: true },
      form: $setup.form
    }, null, _parent));
    _push(ssrRenderComponent(_component_vue_password_field, {
      id: "password",
      feedback: "",
      "is-large": "",
      field: { placeholder: "Password", required: true },
      form: $setup.form
    }, null, _parent));
    _push(ssrRenderComponent(_component_vue_password_field, {
      id: "password_confirmation",
      "is-large": "",
      field: { placeholder: "Confirm Password", required: true },
      form: $setup.form
    }, null, _parent));
    _push(ssrRenderComponent(_component_agreement_switch_field, {
      id: "agree",
      form: $setup.form
    }, null, _parent));
    _push(`</form></div>`);
  }
  _push(`<footer class="footer"><div class="${ssrRenderClass([{ "flex-row-reverse": !$options.success }, "submit container"])}">`);
  if (!$options.success) {
    _push(ssrRenderComponent(_component_primevue_button, {
      label: "Register",
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
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/pages/auth/Register.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const Register = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  Register as default
};
