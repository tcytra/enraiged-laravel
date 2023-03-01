import { A as App, P as PageHeader } from "./PageHeader-f063c111.mjs";
import { P as PrimevueButton } from "./Button-8c19e69a.mjs";
import { P as PrimevueCard } from "./Card-fe8810d1.mjs";
import { ObjectUtils } from "primevue/utils";
import Paginator from "primevue/paginator";
import { resolveComponent, mergeProps, createSlots, withCtx, renderSlot, useSSRContext, resolveDirective, createVNode, createTextVNode, toDisplayString, withDirectives } from "vue";
import { ssrRenderAttrs, ssrRenderSlot, ssrRenderComponent, ssrRenderList, ssrRenderAttr, ssrRenderClass, ssrRenderStyle, ssrInterpolate, ssrGetDirectiveProps } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
import PrimevueTooltip from "primevue/tooltip/tooltip.cjs.js";
import "date-fns";
import "@inertiajs/vue3";
import "primevue/button";
import "primevue/confirmationeventbus";
import "primevue/dialog";
import "primevue/ripple";
const _sfc_main$2 = {
  name: "DataView",
  emits: ["update:first", "update:rows", "page"],
  props: {
    value: {
      type: Array,
      default: null
    },
    layout: {
      type: String,
      default: "list"
    },
    rows: {
      type: Number,
      default: 0
    },
    first: {
      type: Number,
      default: 0
    },
    totalRecords: {
      type: Number,
      default: 0
    },
    paginator: {
      type: Boolean,
      default: false
    },
    paginatorPosition: {
      type: String,
      default: "bottom"
    },
    alwaysShowPaginator: {
      type: Boolean,
      default: true
    },
    paginatorTemplate: {
      type: String,
      default: "FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink RowsPerPageDropdown"
    },
    pageLinkSize: {
      type: Number,
      default: 5
    },
    rowsPerPageOptions: {
      type: Array,
      default: null
    },
    currentPageReportTemplate: {
      type: String,
      default: "({currentPage} of {totalPages})"
    },
    sortField: {
      type: [String, Function],
      default: null
    },
    sortOrder: {
      type: Number,
      default: null
    },
    lazy: {
      type: Boolean,
      default: false
    },
    dataKey: {
      type: String,
      default: null
    }
  },
  data() {
    return {
      d_first: this.first,
      d_rows: this.rows
    };
  },
  watch: {
    first(newValue) {
      this.d_first = newValue;
    },
    rows(newValue) {
      this.d_rows = newValue;
    },
    sortField() {
      this.resetPage();
    },
    sortOrder() {
      this.resetPage();
    }
  },
  methods: {
    getKey(item, index) {
      return this.dataKey ? ObjectUtils.resolveFieldData(item, this.dataKey) : index;
    },
    onPage(event) {
      this.d_first = event.first;
      this.d_rows = event.rows;
      this.$emit("update:first", this.d_first);
      this.$emit("update:rows", this.d_rows);
      this.$emit("page", event);
    },
    sort() {
      if (this.value) {
        const value = [...this.value];
        value.sort((data1, data2) => {
          let value1 = ObjectUtils.resolveFieldData(data1, this.sortField);
          let value2 = ObjectUtils.resolveFieldData(data2, this.sortField);
          let result = null;
          if (value1 == null && value2 != null)
            result = -1;
          else if (value1 != null && value2 == null)
            result = 1;
          else if (value1 == null && value2 == null)
            result = 0;
          else if (typeof value1 === "string" && typeof value2 === "string")
            result = value1.localeCompare(value2, void 0, { numeric: true });
          else
            result = value1 < value2 ? -1 : value1 > value2 ? 1 : 0;
          return this.sortOrder * result;
        });
        return value;
      } else {
        return null;
      }
    },
    resetPage() {
      this.d_first = 0;
      this.$emit("update:first", this.d_first);
    }
  },
  computed: {
    containerClass() {
      return [
        "p-dataview p-component",
        {
          "p-dataview-list": this.layout === "list",
          "p-dataview-grid": this.layout === "grid"
        }
      ];
    },
    getTotalRecords() {
      if (this.totalRecords)
        return this.totalRecords;
      else
        return this.value ? this.value.length : 0;
    },
    empty() {
      return !this.value || this.value.length === 0;
    },
    paginatorTop() {
      return this.paginator && (this.paginatorPosition !== "bottom" || this.paginatorPosition === "both");
    },
    paginatorBottom() {
      return this.paginator && (this.paginatorPosition !== "top" || this.paginatorPosition === "both");
    },
    items() {
      if (this.value && this.value.length) {
        let data = this.value;
        if (data && data.length && this.sortField) {
          data = this.sort();
        }
        if (this.paginator) {
          const first = this.lazy ? 0 : this.d_first;
          return data.slice(first, first + this.d_rows);
        } else {
          return data;
        }
      } else {
        return null;
      }
    }
  },
  components: {
    DVPaginator: Paginator
  }
};
function _sfc_ssrRender$2(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_DVPaginator = resolveComponent("DVPaginator");
  _push(`<div${ssrRenderAttrs(mergeProps({ class: $options.containerClass }, _attrs))}>`);
  if (_ctx.$slots.header) {
    _push(`<div class="p-dataview-header">`);
    ssrRenderSlot(_ctx.$slots, "header", {}, null, _push, _parent);
    _push(`</div>`);
  } else {
    _push(`<!---->`);
  }
  if ($options.paginatorTop) {
    _push(ssrRenderComponent(_component_DVPaginator, {
      rows: $data.d_rows,
      first: $data.d_first,
      totalRecords: $options.getTotalRecords,
      pageLinkSize: $props.pageLinkSize,
      template: $props.paginatorTemplate,
      rowsPerPageOptions: $props.rowsPerPageOptions,
      currentPageReportTemplate: $props.currentPageReportTemplate,
      class: { "p-paginator-top": $options.paginatorTop },
      alwaysShow: $props.alwaysShowPaginator,
      onPage: ($event) => $options.onPage($event)
    }, createSlots({ _: 2 }, [
      _ctx.$slots.paginatorstart ? {
        name: "start",
        fn: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            ssrRenderSlot(_ctx.$slots, "paginatorstart", {}, null, _push2, _parent2, _scopeId);
          } else {
            return [
              renderSlot(_ctx.$slots, "paginatorstart")
            ];
          }
        }),
        key: "0"
      } : void 0,
      _ctx.$slots.paginatorend ? {
        name: "end",
        fn: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            ssrRenderSlot(_ctx.$slots, "paginatorend", {}, null, _push2, _parent2, _scopeId);
          } else {
            return [
              renderSlot(_ctx.$slots, "paginatorend")
            ];
          }
        }),
        key: "1"
      } : void 0
    ]), _parent));
  } else {
    _push(`<!---->`);
  }
  _push(`<div class="p-dataview-content"><div class="p-grid p-nogutter grid grid-nogutter"><!--[-->`);
  ssrRenderList($options.items, (item, index) => {
    _push(`<!--[-->`);
    if (_ctx.$slots.list && $props.layout === "list") {
      ssrRenderSlot(_ctx.$slots, "list", {
        data: item,
        index
      }, null, _push, _parent);
    } else {
      _push(`<!---->`);
    }
    if (_ctx.$slots.grid && $props.layout === "grid") {
      ssrRenderSlot(_ctx.$slots, "grid", {
        data: item,
        index
      }, null, _push, _parent);
    } else {
      _push(`<!---->`);
    }
    _push(`<!--]-->`);
  });
  _push(`<!--]-->`);
  if ($options.empty) {
    _push(`<div class="p-col col"><div class="p-dataview-emptymessage">`);
    ssrRenderSlot(_ctx.$slots, "empty", {}, null, _push, _parent);
    _push(`</div></div>`);
  } else {
    _push(`<!---->`);
  }
  _push(`</div></div>`);
  if ($options.paginatorBottom) {
    _push(ssrRenderComponent(_component_DVPaginator, {
      rows: $data.d_rows,
      first: $data.d_first,
      totalRecords: $options.getTotalRecords,
      pageLinkSize: $props.pageLinkSize,
      template: $props.paginatorTemplate,
      rowsPerPageOptions: $props.rowsPerPageOptions,
      currentPageReportTemplate: $props.currentPageReportTemplate,
      class: { "p-paginator-bottom": $options.paginatorBottom },
      alwaysShow: $props.alwaysShowPaginator,
      onPage: ($event) => $options.onPage($event)
    }, createSlots({ _: 2 }, [
      _ctx.$slots.paginatorstart ? {
        name: "start",
        fn: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            ssrRenderSlot(_ctx.$slots, "paginatorstart", {}, null, _push2, _parent2, _scopeId);
          } else {
            return [
              renderSlot(_ctx.$slots, "paginatorstart")
            ];
          }
        }),
        key: "0"
      } : void 0,
      _ctx.$slots.paginatorend ? {
        name: "end",
        fn: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            ssrRenderSlot(_ctx.$slots, "paginatorend", {}, null, _push2, _parent2, _scopeId);
          } else {
            return [
              renderSlot(_ctx.$slots, "paginatorend")
            ];
          }
        }),
        key: "1"
      } : void 0
    ]), _parent));
  } else {
    _push(`<!---->`);
  }
  if (_ctx.$slots.footer) {
    _push(`<div class="p-dataview-footer">`);
    ssrRenderSlot(_ctx.$slots, "footer", {}, null, _push, _parent);
    _push(`</div>`);
  } else {
    _push(`<!---->`);
  }
  _push(`</div>`);
}
const _sfc_setup$2 = _sfc_main$2.setup;
_sfc_main$2.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("node_modules/primevue/dataview/DataView.vue");
  return _sfc_setup$2 ? _sfc_setup$2(props, ctx) : void 0;
};
const PrimevueDataview = /* @__PURE__ */ _export_sfc(_sfc_main$2, [["ssrRender", _sfc_ssrRender$2]]);
const _sfc_main$1 = {
  name: "DataViewLayoutOptions",
  emits: ["update:modelValue"],
  props: {
    modelValue: String
  },
  data() {
    return {
      isListButtonPressed: false,
      isGridButtonPressed: false
    };
  },
  methods: {
    changeLayout(layout) {
      this.$emit("update:modelValue", layout);
      if (layout === "list") {
        this.isListButtonPressed = true;
        this.isGridButtonPressed = false;
      } else if (layout === "grid") {
        this.isGridButtonPressed = true;
        this.isListButtonPressed = false;
      }
    }
  },
  computed: {
    buttonListClass() {
      return ["p-button p-button-icon-only", { "p-highlight": this.modelValue === "list" }];
    },
    buttonGridClass() {
      return ["p-button p-button-icon-only", { "p-highlight": this.modelValue === "grid" }];
    },
    listViewAriaLabel() {
      return this.$primevue.config.locale.aria ? this.$primevue.config.locale.aria.listView : void 0;
    },
    gridViewAriaLabel() {
      return this.$primevue.config.locale.aria ? this.$primevue.config.locale.aria.gridView : void 0;
    }
  }
};
function _sfc_ssrRender$1(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  _push(`<div${ssrRenderAttrs(mergeProps({
    class: "p-dataview-layout-options p-selectbutton p-buttonset",
    role: "group"
  }, _attrs))}><button${ssrRenderAttr("aria-label", $options.listViewAriaLabel)} class="${ssrRenderClass($options.buttonListClass)}" type="button"${ssrRenderAttr("aria-pressed", $data.isListButtonPressed)}><i class="pi pi-bars"></i></button><button${ssrRenderAttr("aria-label", $options.gridViewAriaLabel)} class="${ssrRenderClass($options.buttonGridClass)}" type="button"${ssrRenderAttr("aria-pressed", $data.isGridButtonPressed)}><i class="pi pi-th-large"></i></button></div>`);
}
const _sfc_setup$1 = _sfc_main$1.setup;
_sfc_main$1.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("node_modules/primevue/dataviewlayoutoptions/DataViewLayoutOptions.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const PrimevueDataviewLayoutOptions = /* @__PURE__ */ _export_sfc(_sfc_main$1, [["ssrRender", _sfc_ssrRender$1]]);
const _sfc_main = {
  layout: App,
  components: {
    PageHeader,
    PrimevueButton,
    PrimevueCard,
    PrimevueDataview,
    PrimevueDataviewLayoutOptions
  },
  directives: {
    tooltip: PrimevueTooltip
  },
  inject: ["i18n"],
  props: {
    files: {
      type: Object,
      required: true
    }
  },
  data: () => ({
    layout: "grid"
  }),
  methods: {
    back() {
      window.history.go(-1);
    },
    destroy(file) {
      this.$inertia.visit(`/files/${file.id}`, { method: "delete" });
    },
    download(file) {
      window.location.href = `/files/${file.id}`;
    }
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_page_header = resolveComponent("page-header");
  const _component_primevue_dataview = resolveComponent("primevue-dataview");
  const _component_primevue_dataview_layout_options = resolveComponent("primevue-dataview-layout-options");
  const _component_primevue_button = resolveComponent("primevue-button");
  const _component_primevue_card = resolveComponent("primevue-card");
  const _directive_tooltip = resolveDirective("tooltip");
  _push(`<main${ssrRenderAttrs(mergeProps({ class: "content main" }, _attrs))}>`);
  _push(ssrRenderComponent(_component_page_header, { title: "My Files" }, null, _parent));
  _push(`<section class="container">`);
  if ($props.files.length) {
    _push(ssrRenderComponent(_component_primevue_dataview, {
      layout: _ctx.layout,
      value: $props.files
    }, {
      header: withCtx((_, _push2, _parent2, _scopeId) => {
        if (_push2) {
          _push2(ssrRenderComponent(_component_primevue_dataview_layout_options, {
            class: "mb-3",
            modelValue: _ctx.layout,
            "onUpdate:modelValue": ($event) => _ctx.layout = $event
          }, null, _parent2, _scopeId));
        } else {
          return [
            createVNode(_component_primevue_dataview_layout_options, {
              class: "mb-3",
              modelValue: _ctx.layout,
              "onUpdate:modelValue": ($event) => _ctx.layout = $event
            }, null, 8, ["modelValue", "onUpdate:modelValue"])
          ];
        }
      }),
      list: withCtx((props, _push2, _parent2, _scopeId) => {
        if (_push2) {
          _push2(`<div class="bg-white flex p-2 w-full"${_scopeId}><div class="file-name mb-2"${_scopeId}><i class="${ssrRenderClass(props.data.icon)}" style="${ssrRenderStyle({ "font-size": "2.5rem" })}"${_scopeId}></i></div><ul class="flex flex-column flex-grow-1 list-none"${_scopeId}><li class="mb-1"${_scopeId}>${ssrInterpolate($options.i18n("Name"))}: <strong${_scopeId}>${ssrInterpolate(props.data.name)}</strong></li><li class="mb-1"${_scopeId}>${ssrInterpolate($options.i18n("Created"))}: <strong${_scopeId}>${ssrInterpolate(`${props.data.created.date} ${props.data.created.time}`)}</strong></li></ul><ul class="flex list-none"${_scopeId}><li${_scopeId}>`);
          _push2(ssrRenderComponent(_component_primevue_button, mergeProps({
            class: "p-button-rounded p-button-text p-button-success",
            icon: "pi pi-download",
            onClick: ($event) => $options.download(props.data)
          }, ssrGetDirectiveProps(_ctx, _directive_tooltip, $options.i18n("Download"), void 0, { top: true })), null, _parent2, _scopeId));
          _push2(`</li><li${_scopeId}>`);
          _push2(ssrRenderComponent(_component_primevue_button, mergeProps({
            class: "p-button-rounded p-button-text p-button-danger",
            icon: "pi pi-times",
            onClick: ($event) => $options.destroy(props.data)
          }, ssrGetDirectiveProps(_ctx, _directive_tooltip, $options.i18n("Delete"), void 0, { top: true })), null, _parent2, _scopeId));
          _push2(`</li></ul></div>`);
        } else {
          return [
            createVNode("div", { class: "bg-white flex p-2 w-full" }, [
              createVNode("div", { class: "file-name mb-2" }, [
                createVNode("i", {
                  class: props.data.icon,
                  style: { "font-size": "2.5rem" }
                }, null, 2)
              ]),
              createVNode("ul", { class: "flex flex-column flex-grow-1 list-none" }, [
                createVNode("li", { class: "mb-1" }, [
                  createTextVNode(toDisplayString($options.i18n("Name")) + ": ", 1),
                  createVNode("strong", null, toDisplayString(props.data.name), 1)
                ]),
                createVNode("li", { class: "mb-1" }, [
                  createTextVNode(toDisplayString($options.i18n("Created")) + ": ", 1),
                  createVNode("strong", null, toDisplayString(`${props.data.created.date} ${props.data.created.time}`), 1)
                ])
              ]),
              createVNode("ul", { class: "flex list-none" }, [
                createVNode("li", null, [
                  withDirectives(createVNode(_component_primevue_button, {
                    class: "p-button-rounded p-button-text p-button-success",
                    icon: "pi pi-download",
                    onClick: ($event) => $options.download(props.data)
                  }, null, 8, ["onClick"]), [
                    [
                      _directive_tooltip,
                      $options.i18n("Download"),
                      void 0,
                      { top: true }
                    ]
                  ])
                ]),
                createVNode("li", null, [
                  withDirectives(createVNode(_component_primevue_button, {
                    class: "p-button-rounded p-button-text p-button-danger",
                    icon: "pi pi-times",
                    onClick: ($event) => $options.destroy(props.data)
                  }, null, 8, ["onClick"]), [
                    [
                      _directive_tooltip,
                      $options.i18n("Delete"),
                      void 0,
                      { top: true }
                    ]
                  ])
                ])
              ])
            ])
          ];
        }
      }),
      grid: withCtx((props, _push2, _parent2, _scopeId) => {
        if (_push2) {
          _push2(`<div class="col-4 md:col-3 lg:col-2 mx-1"${_scopeId}>`);
          _push2(ssrRenderComponent(_component_primevue_card, { class: "text-center" }, {
            title: withCtx((_, _push3, _parent3, _scopeId2) => {
              if (_push3) {
                _push3(`<div class="file-type mb-2"${_scopeId2}><strong${_scopeId2}>${ssrInterpolate(props.data.type)}</strong></div>`);
              } else {
                return [
                  createVNode("div", { class: "file-type mb-2" }, [
                    createVNode("strong", null, toDisplayString(props.data.type), 1)
                  ])
                ];
              }
            }),
            content: withCtx((_, _push3, _parent3, _scopeId2) => {
              if (_push3) {
                _push3(`<div class="file-name mb-2"${_scopeId2}><i class="${ssrRenderClass(props.data.icon)}" style="${ssrRenderStyle({ "font-size": "2.5rem" })}"${_scopeId2}></i></div><div class="file-name mb-2"${_scopeId2}><span${_scopeId2}>${ssrInterpolate(props.data.name)}</span></div><div class="file-date mb-2"${_scopeId2}><span${_scopeId2}>${ssrInterpolate(props.data.created.date)}</span></div><div class="file-time mb-2"${_scopeId2}><span${_scopeId2}>${ssrInterpolate(props.data.created.time)}</span></div>`);
              } else {
                return [
                  createVNode("div", { class: "file-name mb-2" }, [
                    createVNode("i", {
                      class: props.data.icon,
                      style: { "font-size": "2.5rem" }
                    }, null, 2)
                  ]),
                  createVNode("div", { class: "file-name mb-2" }, [
                    createVNode("span", null, toDisplayString(props.data.name), 1)
                  ]),
                  createVNode("div", { class: "file-date mb-2" }, [
                    createVNode("span", null, toDisplayString(props.data.created.date), 1)
                  ]),
                  createVNode("div", { class: "file-time mb-2" }, [
                    createVNode("span", null, toDisplayString(props.data.created.time), 1)
                  ])
                ];
              }
            }),
            footer: withCtx((_, _push3, _parent3, _scopeId2) => {
              if (_push3) {
                _push3(`<div class="flex justify-content-between"${_scopeId2}>`);
                _push3(ssrRenderComponent(_component_primevue_button, mergeProps({
                  class: "p-button-rounded p-button-text p-button-success",
                  icon: "pi pi-download",
                  onClick: ($event) => $options.download(props.data)
                }, ssrGetDirectiveProps(_ctx, _directive_tooltip, $options.i18n("Download"), void 0, { top: true })), null, _parent3, _scopeId2));
                _push3(ssrRenderComponent(_component_primevue_button, mergeProps({
                  class: "p-button-rounded p-button-text p-button-danger",
                  icon: "pi pi-times",
                  onClick: ($event) => $options.destroy(props.data)
                }, ssrGetDirectiveProps(_ctx, _directive_tooltip, $options.i18n("Delete"), void 0, { top: true })), null, _parent3, _scopeId2));
                _push3(`</div>`);
              } else {
                return [
                  createVNode("div", { class: "flex justify-content-between" }, [
                    withDirectives(createVNode(_component_primevue_button, {
                      class: "p-button-rounded p-button-text p-button-success",
                      icon: "pi pi-download",
                      onClick: ($event) => $options.download(props.data)
                    }, null, 8, ["onClick"]), [
                      [
                        _directive_tooltip,
                        $options.i18n("Download"),
                        void 0,
                        { top: true }
                      ]
                    ]),
                    withDirectives(createVNode(_component_primevue_button, {
                      class: "p-button-rounded p-button-text p-button-danger",
                      icon: "pi pi-times",
                      onClick: ($event) => $options.destroy(props.data)
                    }, null, 8, ["onClick"]), [
                      [
                        _directive_tooltip,
                        $options.i18n("Delete"),
                        void 0,
                        { top: true }
                      ]
                    ])
                  ])
                ];
              }
            }),
            _: 2
          }, _parent2, _scopeId));
          _push2(`</div>`);
        } else {
          return [
            createVNode("div", { class: "col-4 md:col-3 lg:col-2 mx-1" }, [
              createVNode(_component_primevue_card, { class: "text-center" }, {
                title: withCtx(() => [
                  createVNode("div", { class: "file-type mb-2" }, [
                    createVNode("strong", null, toDisplayString(props.data.type), 1)
                  ])
                ]),
                content: withCtx(() => [
                  createVNode("div", { class: "file-name mb-2" }, [
                    createVNode("i", {
                      class: props.data.icon,
                      style: { "font-size": "2.5rem" }
                    }, null, 2)
                  ]),
                  createVNode("div", { class: "file-name mb-2" }, [
                    createVNode("span", null, toDisplayString(props.data.name), 1)
                  ]),
                  createVNode("div", { class: "file-date mb-2" }, [
                    createVNode("span", null, toDisplayString(props.data.created.date), 1)
                  ]),
                  createVNode("div", { class: "file-time mb-2" }, [
                    createVNode("span", null, toDisplayString(props.data.created.time), 1)
                  ])
                ]),
                footer: withCtx(() => [
                  createVNode("div", { class: "flex justify-content-between" }, [
                    withDirectives(createVNode(_component_primevue_button, {
                      class: "p-button-rounded p-button-text p-button-success",
                      icon: "pi pi-download",
                      onClick: ($event) => $options.download(props.data)
                    }, null, 8, ["onClick"]), [
                      [
                        _directive_tooltip,
                        $options.i18n("Download"),
                        void 0,
                        { top: true }
                      ]
                    ]),
                    withDirectives(createVNode(_component_primevue_button, {
                      class: "p-button-rounded p-button-text p-button-danger",
                      icon: "pi pi-times",
                      onClick: ($event) => $options.destroy(props.data)
                    }, null, 8, ["onClick"]), [
                      [
                        _directive_tooltip,
                        $options.i18n("Delete"),
                        void 0,
                        { top: true }
                      ]
                    ])
                  ])
                ]),
                _: 2
              }, 1024)
            ])
          ];
        }
      }),
      _: 1
    }, _parent));
  } else {
    _push(`<div class="p-dataview-emptymessage"><span>${ssrInterpolate($options.i18n("You do not have any files."))}</span></div>`);
  }
  _push(`</section></main>`);
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/pages/users/files/Index.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const Index = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  Index as default
};
