import { useForm } from "@inertiajs/vue3";
import { P as PrimevueButton } from "./Button-8c19e69a.mjs";
import { useSSRContext, resolveComponent, mergeProps, resolveDirective, withCtx, createVNode, Transition, openBlock, createBlock, Fragment, renderList, renderSlot, withDirectives, vShow, toDisplayString, createCommentVNode, createTextVNode, withKeys, createSlots } from "vue";
import { ssrRenderAttrs, ssrRenderComponent, ssrRenderList, ssrRenderSlot, ssrGetDirectiveProps, ssrRenderClass, ssrIncludeBooleanAttr, ssrRenderAttr, ssrInterpolate, ssrRenderStyle } from "vue/server-renderer";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-cc2b3d55.mjs";
import { _ as _sfc_main$9 } from "./FormField-dafe0416.mjs";
import Button from "primevue/button";
import OverlayEventBus from "primevue/overlayeventbus";
import Portal from "primevue/portal";
import Ripple from "primevue/ripple";
import { DomHandler, ZIndexUtils, ConnectedOverlayScrollHandler, UniqueComponentId } from "primevue/utils";
import PrimevueTooltip from "primevue/tooltip/tooltip.cjs.js";
import { P as PrimevueDropdown } from "./Dropdown-1272b7b2.mjs";
import { P as PasswordField } from "./PasswordField-5c29a982.mjs";
import { S as SwitchField } from "./SwitchField-cfe5ecaa.mjs";
import { T as TextField } from "./TextField-9739c1e8.mjs";
import { P as PrimevueCard } from "./Card-fe8810d1.mjs";
const _sfc_main$8 = {
  components: {
    PrimevueButton
  },
  inject: ["i18n"],
  props: {
    actions: {
      type: Object,
      required: true
    },
    form: {
      type: Object,
      required: true
    }
  }
};
function _sfc_ssrRender$8(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_primevue_button = resolveComponent("primevue-button");
  if ($props.actions) {
    _push(`<div${ssrRenderAttrs(mergeProps({ class: "actions control" }, _attrs))}><div class="actions-left"></div><div class="actions-right">`);
    if ($props.actions.submit) {
      _push(ssrRenderComponent(_component_primevue_button, {
        class: "p-button-primary submit-button",
        disabled: !$props.form.isDirty,
        label: $options.i18n($props.actions.submit.label),
        onClick: ($event) => _ctx.$emit("submit")
      }, null, _parent));
    } else {
      _push(`<!---->`);
    }
    if ($props.actions.reset && $props.form.isDirty) {
      _push(ssrRenderComponent(_component_primevue_button, {
        class: ["p-button-warning reset-button", { "fadein": $props.form.isDirty }],
        label: $options.i18n($props.actions.reset.label),
        onClick: ($event) => _ctx.$emit("reset")
      }, null, _parent));
    } else {
      _push(`<!---->`);
    }
    if ($props.actions.clear && $props.form.hasErrors) {
      _push(ssrRenderComponent(_component_primevue_button, {
        class: ["p-button-danger error-button", { "fadein": $props.form.hasErrors }],
        label: $options.i18n($props.actions.clear.label),
        onClick: ($event) => _ctx.$emit("clear")
      }, null, _parent));
    } else {
      _push(`<!---->`);
    }
    _push(`</div></div>`);
  } else {
    _push(`<!---->`);
  }
}
const _sfc_setup$8 = _sfc_main$8.setup;
_sfc_main$8.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/forms/VueFormActions.vue");
  return _sfc_setup$8 ? _sfc_setup$8(props, ctx) : void 0;
};
const VueFormActions = /* @__PURE__ */ _export_sfc(_sfc_main$8, [["ssrRender", _sfc_ssrRender$8]]);
const Calendar_vue_vue_type_style_index_0_lang = "";
const _sfc_main$7 = {
  name: "Calendar",
  emits: ["show", "hide", "input", "month-change", "year-change", "date-select", "update:modelValue", "today-click", "clear-click", "focus", "blur", "keydown"],
  props: {
    modelValue: null,
    selectionMode: {
      type: String,
      default: "single"
    },
    dateFormat: {
      type: String,
      default: null
    },
    inline: {
      type: Boolean,
      default: false
    },
    showOtherMonths: {
      type: Boolean,
      default: true
    },
    selectOtherMonths: {
      type: Boolean,
      default: false
    },
    showIcon: {
      type: Boolean,
      default: false
    },
    icon: {
      type: String,
      default: "pi pi-calendar"
    },
    previousIcon: {
      type: String,
      default: "pi pi-chevron-left"
    },
    nextIcon: {
      type: String,
      default: "pi pi-chevron-right"
    },
    incrementIcon: {
      type: String,
      default: "pi pi-chevron-up"
    },
    decrementIcon: {
      type: String,
      default: "pi pi-chevron-down"
    },
    numberOfMonths: {
      type: Number,
      default: 1
    },
    responsiveOptions: Array,
    view: {
      type: String,
      default: "date"
    },
    touchUI: {
      type: Boolean,
      default: false
    },
    monthNavigator: {
      type: Boolean,
      default: false
    },
    yearNavigator: {
      type: Boolean,
      default: false
    },
    yearRange: {
      type: String,
      default: null
    },
    minDate: {
      type: Date,
      value: null
    },
    maxDate: {
      type: Date,
      value: null
    },
    disabledDates: {
      type: Array,
      value: null
    },
    disabledDays: {
      type: Array,
      value: null
    },
    maxDateCount: {
      type: Number,
      value: null
    },
    showOnFocus: {
      type: Boolean,
      default: true
    },
    autoZIndex: {
      type: Boolean,
      default: true
    },
    baseZIndex: {
      type: Number,
      default: 0
    },
    showButtonBar: {
      type: Boolean,
      default: false
    },
    shortYearCutoff: {
      type: String,
      default: "+10"
    },
    showTime: {
      type: Boolean,
      default: false
    },
    timeOnly: {
      type: Boolean,
      default: false
    },
    hourFormat: {
      type: String,
      default: "24"
    },
    stepHour: {
      type: Number,
      default: 1
    },
    stepMinute: {
      type: Number,
      default: 1
    },
    stepSecond: {
      type: Number,
      default: 1
    },
    showSeconds: {
      type: Boolean,
      default: false
    },
    hideOnDateTimeSelect: {
      type: Boolean,
      default: false
    },
    hideOnRangeSelection: {
      type: Boolean,
      default: false
    },
    timeSeparator: {
      type: String,
      default: ":"
    },
    showWeek: {
      type: Boolean,
      default: false
    },
    manualInput: {
      type: Boolean,
      default: true
    },
    appendTo: {
      type: String,
      default: "body"
    },
    disabled: {
      type: Boolean,
      default: false
    },
    readonly: {
      type: Boolean,
      default: false
    },
    placeholder: {
      type: String,
      default: null
    },
    id: {
      type: String,
      default: null
    },
    inputId: {
      type: String,
      default: null
    },
    inputClass: {
      type: String,
      default: null
    },
    inputStyle: {
      type: null,
      default: null
    },
    inputProps: {
      type: null,
      default: null
    },
    panelClass: {
      type: String,
      default: null
    },
    panelStyle: {
      type: null,
      default: null
    },
    panelProps: {
      type: null,
      default: null
    },
    "aria-labelledby": {
      type: String,
      default: null
    },
    "aria-label": {
      type: String,
      default: null
    }
  },
  navigationState: null,
  timePickerChange: false,
  scrollHandler: null,
  outsideClickListener: null,
  maskClickListener: null,
  resizeListener: null,
  overlay: null,
  input: null,
  mask: null,
  timePickerTimer: null,
  preventFocus: false,
  typeUpdate: false,
  data() {
    return {
      currentMonth: null,
      currentYear: null,
      currentHour: null,
      currentMinute: null,
      currentSecond: null,
      pm: null,
      focused: false,
      overlayVisible: false,
      currentView: this.view
    };
  },
  watch: {
    modelValue(newValue) {
      this.updateCurrentMetaData();
      if (!this.typeUpdate && !this.inline && this.input) {
        this.input.value = this.formatValue(newValue);
      }
      this.typeUpdate = false;
    },
    showTime() {
      this.updateCurrentMetaData();
    },
    months() {
      if (this.overlay) {
        if (!this.focused) {
          if (this.inline) {
            this.preventFocus = true;
          }
          setTimeout(this.updateFocus, 0);
        }
      }
    },
    numberOfMonths() {
      this.destroyResponsiveStyleElement();
      this.createResponsiveStyle();
    },
    responsiveOptions() {
      this.destroyResponsiveStyleElement();
      this.createResponsiveStyle();
    },
    currentView() {
      Promise.resolve(null).then(() => this.alignOverlay());
    }
  },
  created() {
    this.updateCurrentMetaData();
  },
  mounted() {
    this.createResponsiveStyle();
    if (this.inline) {
      this.overlay && this.overlay.setAttribute(this.attributeSelector, "");
      if (!this.disabled) {
        this.preventFocus = true;
        this.initFocusableCell();
        if (this.numberOfMonths === 1) {
          this.overlay.style.width = DomHandler.getOuterWidth(this.$el) + "px";
        }
      }
    } else {
      this.input.value = this.formatValue(this.modelValue);
    }
  },
  updated() {
    if (this.overlay) {
      this.preventFocus = true;
      this.updateFocus();
    }
    if (this.input && this.selectionStart != null && this.selectionEnd != null) {
      this.input.selectionStart = this.selectionStart;
      this.input.selectionEnd = this.selectionEnd;
      this.selectionStart = null;
      this.selectionEnd = null;
    }
  },
  beforeUnmount() {
    if (this.timePickerTimer) {
      clearTimeout(this.timePickerTimer);
    }
    if (this.mask) {
      this.destroyMask();
    }
    this.destroyResponsiveStyleElement();
    this.unbindOutsideClickListener();
    this.unbindResizeListener();
    if (this.scrollHandler) {
      this.scrollHandler.destroy();
      this.scrollHandler = null;
    }
    if (this.overlay && this.autoZIndex) {
      ZIndexUtils.clear(this.overlay);
    }
    this.overlay = null;
  },
  methods: {
    isComparable() {
      return this.modelValue != null && typeof this.modelValue !== "string";
    },
    isSelected(dateMeta) {
      if (!this.isComparable()) {
        return false;
      }
      if (this.modelValue) {
        if (this.isSingleSelection()) {
          return this.isDateEquals(this.modelValue, dateMeta);
        } else if (this.isMultipleSelection()) {
          let selected = false;
          for (let date of this.modelValue) {
            selected = this.isDateEquals(date, dateMeta);
            if (selected) {
              break;
            }
          }
          return selected;
        } else if (this.isRangeSelection()) {
          if (this.modelValue[1])
            return this.isDateEquals(this.modelValue[0], dateMeta) || this.isDateEquals(this.modelValue[1], dateMeta) || this.isDateBetween(this.modelValue[0], this.modelValue[1], dateMeta);
          else {
            return this.isDateEquals(this.modelValue[0], dateMeta);
          }
        }
      }
      return false;
    },
    isMonthSelected(month) {
      if (this.isComparable()) {
        let value = this.isRangeSelection() ? this.modelValue[0] : this.modelValue;
        return !this.isMultipleSelection() ? value.getMonth() === month && value.getFullYear() === this.currentYear : false;
      }
      return false;
    },
    isYearSelected(year) {
      if (this.isComparable()) {
        let value = this.isRangeSelection() ? this.modelValue[0] : this.modelValue;
        return !this.isMultipleSelection() && this.isComparable() ? value.getFullYear() === year : false;
      }
      return false;
    },
    isDateEquals(value, dateMeta) {
      if (value)
        return value.getDate() === dateMeta.day && value.getMonth() === dateMeta.month && value.getFullYear() === dateMeta.year;
      else
        return false;
    },
    isDateBetween(start, end, dateMeta) {
      let between = false;
      if (start && end) {
        let date = new Date(dateMeta.year, dateMeta.month, dateMeta.day);
        return start.getTime() <= date.getTime() && end.getTime() >= date.getTime();
      }
      return between;
    },
    getFirstDayOfMonthIndex(month, year) {
      let day = new Date();
      day.setDate(1);
      day.setMonth(month);
      day.setFullYear(year);
      let dayIndex = day.getDay() + this.sundayIndex;
      return dayIndex >= 7 ? dayIndex - 7 : dayIndex;
    },
    getDaysCountInMonth(month, year) {
      return 32 - this.daylightSavingAdjust(new Date(year, month, 32)).getDate();
    },
    getDaysCountInPrevMonth(month, year) {
      let prev = this.getPreviousMonthAndYear(month, year);
      return this.getDaysCountInMonth(prev.month, prev.year);
    },
    getPreviousMonthAndYear(month, year) {
      let m, y;
      if (month === 0) {
        m = 11;
        y = year - 1;
      } else {
        m = month - 1;
        y = year;
      }
      return { month: m, year: y };
    },
    getNextMonthAndYear(month, year) {
      let m, y;
      if (month === 11) {
        m = 0;
        y = year + 1;
      } else {
        m = month + 1;
        y = year;
      }
      return { month: m, year: y };
    },
    daylightSavingAdjust(date) {
      if (!date) {
        return null;
      }
      date.setHours(date.getHours() > 12 ? date.getHours() + 2 : 0);
      return date;
    },
    isToday(today, day, month, year) {
      return today.getDate() === day && today.getMonth() === month && today.getFullYear() === year;
    },
    isSelectable(day, month, year, otherMonth) {
      let validMin = true;
      let validMax = true;
      let validDate = true;
      let validDay = true;
      if (otherMonth && !this.selectOtherMonths) {
        return false;
      }
      if (this.minDate) {
        if (this.minDate.getFullYear() > year) {
          validMin = false;
        } else if (this.minDate.getFullYear() === year) {
          if (this.minDate.getMonth() > month) {
            validMin = false;
          } else if (this.minDate.getMonth() === month) {
            if (this.minDate.getDate() > day) {
              validMin = false;
            }
          }
        }
      }
      if (this.maxDate) {
        if (this.maxDate.getFullYear() < year) {
          validMax = false;
        } else if (this.maxDate.getFullYear() === year) {
          if (this.maxDate.getMonth() < month) {
            validMax = false;
          } else if (this.maxDate.getMonth() === month) {
            if (this.maxDate.getDate() < day) {
              validMax = false;
            }
          }
        }
      }
      if (this.disabledDates) {
        validDate = !this.isDateDisabled(day, month, year);
      }
      if (this.disabledDays) {
        validDay = !this.isDayDisabled(day, month, year);
      }
      return validMin && validMax && validDate && validDay;
    },
    onOverlayEnter(el) {
      el.setAttribute(this.attributeSelector, "");
      if (this.autoZIndex) {
        if (this.touchUI)
          ZIndexUtils.set("modal", el, this.baseZIndex || this.$primevue.config.zIndex.modal);
        else
          ZIndexUtils.set("overlay", el, this.baseZIndex || this.$primevue.config.zIndex.overlay);
      }
      this.alignOverlay();
      this.$emit("show");
    },
    onOverlayEnterComplete() {
      this.bindOutsideClickListener();
      this.bindScrollListener();
      this.bindResizeListener();
    },
    onOverlayAfterLeave(el) {
      if (this.autoZIndex) {
        ZIndexUtils.clear(el);
      }
    },
    onOverlayLeave() {
      this.currentView = this.view;
      this.unbindOutsideClickListener();
      this.unbindScrollListener();
      this.unbindResizeListener();
      this.$emit("hide");
      if (this.mask) {
        this.disableModality();
      }
      this.overlay = null;
    },
    onPrevButtonClick(event) {
      if (this.showOtherMonths) {
        this.navigationState = { backward: true, button: true };
        this.navBackward(event);
      }
    },
    onNextButtonClick(event) {
      if (this.showOtherMonths) {
        this.navigationState = { backward: false, button: true };
        this.navForward(event);
      }
    },
    navBackward(event) {
      event.preventDefault();
      if (!this.isEnabled()) {
        return;
      }
      if (this.currentView === "month") {
        this.decrementYear();
      } else if (this.currentView === "year") {
        this.decrementDecade();
      } else {
        if (event.shiftKey) {
          this.decrementYear();
        } else {
          if (this.currentMonth === 0) {
            this.currentMonth = 11;
            this.decrementYear();
          } else {
            this.currentMonth--;
          }
          this.$emit("month-change", { month: this.currentMonth + 1, year: this.currentYear });
        }
      }
    },
    navForward(event) {
      event.preventDefault();
      if (!this.isEnabled()) {
        return;
      }
      if (this.currentView === "month") {
        this.incrementYear();
      } else if (this.currentView === "year") {
        this.incrementDecade();
      } else {
        if (event.shiftKey) {
          this.incrementYear();
        } else {
          if (this.currentMonth === 11) {
            this.currentMonth = 0;
            this.incrementYear();
          } else {
            this.currentMonth++;
          }
          this.$emit("month-change", { month: this.currentMonth + 1, year: this.currentYear });
        }
      }
    },
    decrementYear() {
      this.currentYear--;
    },
    decrementDecade() {
      this.currentYear = this.currentYear - 10;
    },
    incrementYear() {
      this.currentYear++;
    },
    incrementDecade() {
      this.currentYear = this.currentYear + 10;
    },
    switchToMonthView(event) {
      this.currentView = "month";
      setTimeout(this.updateFocus, 0);
      event.preventDefault();
    },
    switchToYearView(event) {
      this.currentView = "year";
      setTimeout(this.updateFocus, 0);
      event.preventDefault();
    },
    isEnabled() {
      return !this.disabled && !this.readonly;
    },
    updateCurrentTimeMeta(date) {
      let currentHour = date.getHours();
      if (this.hourFormat === "12") {
        this.pm = currentHour > 11;
        if (currentHour >= 12)
          currentHour = currentHour == 12 ? 12 : currentHour - 12;
        else
          currentHour = currentHour == 0 ? 12 : currentHour;
      }
      this.currentHour = Math.floor(currentHour / this.stepHour) * this.stepHour;
      this.currentMinute = Math.floor(date.getMinutes() / this.stepMinute) * this.stepMinute;
      this.currentSecond = Math.floor(date.getSeconds() / this.stepSecond) * this.stepSecond;
    },
    bindOutsideClickListener() {
      if (!this.outsideClickListener) {
        this.outsideClickListener = (event) => {
          if (this.overlayVisible && this.isOutsideClicked(event)) {
            this.overlayVisible = false;
          }
        };
        document.addEventListener("mousedown", this.outsideClickListener);
      }
    },
    unbindOutsideClickListener() {
      if (this.outsideClickListener) {
        document.removeEventListener("mousedown", this.outsideClickListener);
        this.outsideClickListener = null;
      }
    },
    bindScrollListener() {
      if (!this.scrollHandler) {
        this.scrollHandler = new ConnectedOverlayScrollHandler(this.$refs.container, () => {
          if (this.overlayVisible) {
            this.overlayVisible = false;
          }
        });
      }
      this.scrollHandler.bindScrollListener();
    },
    unbindScrollListener() {
      if (this.scrollHandler) {
        this.scrollHandler.unbindScrollListener();
      }
    },
    bindResizeListener() {
      if (!this.resizeListener) {
        this.resizeListener = () => {
          if (this.overlayVisible && !DomHandler.isTouchDevice()) {
            this.overlayVisible = false;
          }
        };
        window.addEventListener("resize", this.resizeListener);
      }
    },
    unbindResizeListener() {
      if (this.resizeListener) {
        window.removeEventListener("resize", this.resizeListener);
        this.resizeListener = null;
      }
    },
    isOutsideClicked(event) {
      return !(this.$el.isSameNode(event.target) || this.isNavIconClicked(event) || this.$el.contains(event.target) || this.overlay && this.overlay.contains(event.target));
    },
    isNavIconClicked(event) {
      return DomHandler.hasClass(event.target, "p-datepicker-prev") || DomHandler.hasClass(event.target, "p-datepicker-prev-icon") || DomHandler.hasClass(event.target, "p-datepicker-next") || DomHandler.hasClass(event.target, "p-datepicker-next-icon");
    },
    alignOverlay() {
      if (this.touchUI) {
        this.enableModality();
      } else if (this.overlay) {
        if (this.appendTo === "self" || this.inline) {
          DomHandler.relativePosition(this.overlay, this.$el);
        } else {
          if (this.view === "date") {
            this.overlay.style.width = DomHandler.getOuterWidth(this.overlay) + "px";
            this.overlay.style.minWidth = DomHandler.getOuterWidth(this.$el) + "px";
          } else {
            this.overlay.style.width = DomHandler.getOuterWidth(this.$el) + "px";
          }
          DomHandler.absolutePosition(this.overlay, this.$el);
        }
      }
    },
    onButtonClick() {
      if (this.isEnabled()) {
        if (!this.overlayVisible) {
          this.input.focus();
          this.overlayVisible = true;
        } else {
          this.overlayVisible = false;
        }
      }
    },
    isDateDisabled(day, month, year) {
      if (this.disabledDates) {
        for (let disabledDate of this.disabledDates) {
          if (disabledDate.getFullYear() === year && disabledDate.getMonth() === month && disabledDate.getDate() === day) {
            return true;
          }
        }
      }
      return false;
    },
    isDayDisabled(day, month, year) {
      if (this.disabledDays) {
        let weekday = new Date(year, month, day);
        let weekdayNumber = weekday.getDay();
        return this.disabledDays.indexOf(weekdayNumber) !== -1;
      }
      return false;
    },
    onMonthDropdownChange(value) {
      this.currentMonth = parseInt(value);
      this.$emit("month-change", { month: this.currentMonth + 1, year: this.currentYear });
    },
    onYearDropdownChange(value) {
      this.currentYear = parseInt(value);
      this.$emit("year-change", { month: this.currentMonth + 1, year: this.currentYear });
    },
    onDateSelect(event, dateMeta) {
      if (this.disabled || !dateMeta.selectable) {
        return;
      }
      DomHandler.find(this.overlay, ".p-datepicker-calendar td span:not(.p-disabled)").forEach((cell) => cell.tabIndex = -1);
      if (event) {
        event.currentTarget.focus();
      }
      if (this.isMultipleSelection() && this.isSelected(dateMeta)) {
        let newValue = this.modelValue.filter((date) => !this.isDateEquals(date, dateMeta));
        this.updateModel(newValue);
      } else {
        if (this.shouldSelectDate(dateMeta)) {
          if (dateMeta.otherMonth) {
            this.currentMonth = dateMeta.month;
            this.currentYear = dateMeta.year;
            this.selectDate(dateMeta);
          } else {
            this.selectDate(dateMeta);
          }
        }
      }
      if (this.isSingleSelection() && (!this.showTime || this.hideOnDateTimeSelect)) {
        setTimeout(() => {
          if (this.input) {
            this.input.focus();
          }
          this.overlayVisible = false;
        }, 150);
      }
    },
    selectDate(dateMeta) {
      let date = new Date(dateMeta.year, dateMeta.month, dateMeta.day);
      if (this.showTime) {
        if (this.hourFormat === "12" && this.pm && this.currentHour != 12)
          date.setHours(this.currentHour + 12);
        else
          date.setHours(this.currentHour);
        date.setMinutes(this.currentMinute);
        date.setSeconds(this.currentSecond);
      }
      if (this.minDate && this.minDate > date) {
        date = this.minDate;
        this.currentHour = date.getHours();
        this.currentMinute = date.getMinutes();
        this.currentSecond = date.getSeconds();
      }
      if (this.maxDate && this.maxDate < date) {
        date = this.maxDate;
        this.currentHour = date.getHours();
        this.currentMinute = date.getMinutes();
        this.currentSecond = date.getSeconds();
      }
      let modelVal = null;
      if (this.isSingleSelection()) {
        modelVal = date;
      } else if (this.isMultipleSelection()) {
        modelVal = this.modelValue ? [...this.modelValue, date] : [date];
      } else if (this.isRangeSelection()) {
        if (this.modelValue && this.modelValue.length) {
          let startDate = this.modelValue[0];
          let endDate = this.modelValue[1];
          if (!endDate && date.getTime() >= startDate.getTime()) {
            endDate = date;
          } else {
            startDate = date;
            endDate = null;
          }
          modelVal = [startDate, endDate];
        } else {
          modelVal = [date, null];
        }
      }
      if (modelVal !== null) {
        this.updateModel(modelVal);
      }
      if (this.isRangeSelection() && this.hideOnRangeSelection && modelVal[1] !== null) {
        setTimeout(() => {
          this.overlayVisible = false;
        }, 150);
      }
      this.$emit("date-select", date);
    },
    updateModel(value) {
      this.$emit("update:modelValue", value);
    },
    shouldSelectDate() {
      if (this.isMultipleSelection())
        return this.maxDateCount != null ? this.maxDateCount > (this.modelValue ? this.modelValue.length : 0) : true;
      else
        return true;
    },
    isSingleSelection() {
      return this.selectionMode === "single";
    },
    isRangeSelection() {
      return this.selectionMode === "range";
    },
    isMultipleSelection() {
      return this.selectionMode === "multiple";
    },
    formatValue(value) {
      if (typeof value === "string") {
        return value;
      }
      let formattedValue = "";
      if (value) {
        try {
          if (this.isSingleSelection()) {
            formattedValue = this.formatDateTime(value);
          } else if (this.isMultipleSelection()) {
            for (let i = 0; i < value.length; i++) {
              let dateAsString = this.formatDateTime(value[i]);
              formattedValue += dateAsString;
              if (i !== value.length - 1) {
                formattedValue += ", ";
              }
            }
          } else if (this.isRangeSelection()) {
            if (value && value.length) {
              let startDate = value[0];
              let endDate = value[1];
              formattedValue = this.formatDateTime(startDate);
              if (endDate) {
                formattedValue += " - " + this.formatDateTime(endDate);
              }
            }
          }
        } catch (err) {
          formattedValue = value;
        }
      }
      return formattedValue;
    },
    formatDateTime(date) {
      let formattedValue = null;
      if (date) {
        if (this.timeOnly) {
          formattedValue = this.formatTime(date);
        } else {
          formattedValue = this.formatDate(date, this.datePattern);
          if (this.showTime) {
            formattedValue += " " + this.formatTime(date);
          }
        }
      }
      return formattedValue;
    },
    formatDate(date, format) {
      if (!date) {
        return "";
      }
      let iFormat;
      const lookAhead = (match) => {
        const matches = iFormat + 1 < format.length && format.charAt(iFormat + 1) === match;
        if (matches) {
          iFormat++;
        }
        return matches;
      }, formatNumber = (match, value, len) => {
        let num = "" + value;
        if (lookAhead(match)) {
          while (num.length < len) {
            num = "0" + num;
          }
        }
        return num;
      }, formatName = (match, value, shortNames, longNames) => {
        return lookAhead(match) ? longNames[value] : shortNames[value];
      };
      let output = "";
      let literal = false;
      if (date) {
        for (iFormat = 0; iFormat < format.length; iFormat++) {
          if (literal) {
            if (format.charAt(iFormat) === "'" && !lookAhead("'")) {
              literal = false;
            } else {
              output += format.charAt(iFormat);
            }
          } else {
            switch (format.charAt(iFormat)) {
              case "d":
                output += formatNumber("d", date.getDate(), 2);
                break;
              case "D":
                output += formatName("D", date.getDay(), this.$primevue.config.locale.dayNamesShort, this.$primevue.config.locale.dayNames);
                break;
              case "o":
                output += formatNumber("o", Math.round((new Date(date.getFullYear(), date.getMonth(), date.getDate()).getTime() - new Date(date.getFullYear(), 0, 0).getTime()) / 864e5), 3);
                break;
              case "m":
                output += formatNumber("m", date.getMonth() + 1, 2);
                break;
              case "M":
                output += formatName("M", date.getMonth(), this.$primevue.config.locale.monthNamesShort, this.$primevue.config.locale.monthNames);
                break;
              case "y":
                output += lookAhead("y") ? date.getFullYear() : (date.getFullYear() % 100 < 10 ? "0" : "") + date.getFullYear() % 100;
                break;
              case "@":
                output += date.getTime();
                break;
              case "!":
                output += date.getTime() * 1e4 + this.ticksTo1970;
                break;
              case "'":
                if (lookAhead("'")) {
                  output += "'";
                } else {
                  literal = true;
                }
                break;
              default:
                output += format.charAt(iFormat);
            }
          }
        }
      }
      return output;
    },
    formatTime(date) {
      if (!date) {
        return "";
      }
      let output = "";
      let hours = date.getHours();
      let minutes = date.getMinutes();
      let seconds = date.getSeconds();
      if (this.hourFormat === "12" && hours > 11 && hours !== 12) {
        hours -= 12;
      }
      if (this.hourFormat === "12") {
        output += hours === 0 ? 12 : hours < 10 ? "0" + hours : hours;
      } else {
        output += hours < 10 ? "0" + hours : hours;
      }
      output += ":";
      output += minutes < 10 ? "0" + minutes : minutes;
      if (this.showSeconds) {
        output += ":";
        output += seconds < 10 ? "0" + seconds : seconds;
      }
      if (this.hourFormat === "12") {
        output += date.getHours() > 11 ? ` ${this.$primevue.config.locale.pm}` : ` ${this.$primevue.config.locale.am}`;
      }
      return output;
    },
    onTodayButtonClick(event) {
      let date = new Date();
      let dateMeta = {
        day: date.getDate(),
        month: date.getMonth(),
        year: date.getFullYear(),
        otherMonth: date.getMonth() !== this.currentMonth || date.getFullYear() !== this.currentYear,
        today: true,
        selectable: true
      };
      this.onDateSelect(null, dateMeta);
      this.$emit("today-click", date);
      event.preventDefault();
    },
    onClearButtonClick(event) {
      this.updateModel(null);
      this.overlayVisible = false;
      this.$emit("clear-click", event);
      event.preventDefault();
    },
    onTimePickerElementMouseDown(event, type, direction) {
      if (this.isEnabled()) {
        this.repeat(event, null, type, direction);
        event.preventDefault();
      }
    },
    onTimePickerElementMouseUp(event) {
      if (this.isEnabled()) {
        this.clearTimePickerTimer();
        this.updateModelTime();
        event.preventDefault();
      }
    },
    onTimePickerElementMouseLeave() {
      this.clearTimePickerTimer();
    },
    repeat(event, interval, type, direction) {
      let i = interval || 500;
      this.clearTimePickerTimer();
      this.timePickerTimer = setTimeout(() => {
        this.repeat(event, 100, type, direction);
      }, i);
      switch (type) {
        case 0:
          if (direction === 1)
            this.incrementHour(event);
          else
            this.decrementHour(event);
          break;
        case 1:
          if (direction === 1)
            this.incrementMinute(event);
          else
            this.decrementMinute(event);
          break;
        case 2:
          if (direction === 1)
            this.incrementSecond(event);
          else
            this.decrementSecond(event);
          break;
      }
    },
    convertTo24Hour(hours, pm) {
      if (this.hourFormat == "12") {
        if (hours === 12) {
          return pm ? 12 : 0;
        } else {
          return pm ? hours + 12 : hours;
        }
      }
      return hours;
    },
    validateTime(hour, minute, second, pm) {
      let value = this.isComparable() ? this.modelValue : this.viewDate;
      const convertedHour = this.convertTo24Hour(hour, pm);
      if (this.isRangeSelection()) {
        value = this.modelValue[1] || this.modelValue[0];
      }
      if (this.isMultipleSelection()) {
        value = this.modelValue[this.modelValue.length - 1];
      }
      const valueDateString = value ? value.toDateString() : null;
      if (this.minDate && valueDateString && this.minDate.toDateString() === valueDateString) {
        if (this.minDate.getHours() > convertedHour) {
          return false;
        }
        if (this.minDate.getHours() === convertedHour) {
          if (this.minDate.getMinutes() > minute) {
            return false;
          }
          if (this.minDate.getMinutes() === minute) {
            if (this.minDate.getSeconds() > second) {
              return false;
            }
          }
        }
      }
      if (this.maxDate && valueDateString && this.maxDate.toDateString() === valueDateString) {
        if (this.maxDate.getHours() < convertedHour) {
          return false;
        }
        if (this.maxDate.getHours() === convertedHour) {
          if (this.maxDate.getMinutes() < minute) {
            return false;
          }
          if (this.maxDate.getMinutes() === minute) {
            if (this.maxDate.getSeconds() < second) {
              return false;
            }
          }
        }
      }
      return true;
    },
    incrementHour(event) {
      let prevHour = this.currentHour;
      let newHour = this.currentHour + this.stepHour;
      let newPM = this.pm;
      if (this.hourFormat == "24")
        newHour = newHour >= 24 ? newHour - 24 : newHour;
      else if (this.hourFormat == "12") {
        if (prevHour < 12 && newHour > 11) {
          newPM = !this.pm;
        }
        newHour = newHour >= 13 ? newHour - 12 : newHour;
      }
      if (this.validateTime(newHour, this.currentMinute, this.currentSecond, newPM)) {
        this.currentHour = newHour;
        this.pm = newPM;
      }
      event.preventDefault();
    },
    decrementHour(event) {
      let newHour = this.currentHour - this.stepHour;
      let newPM = this.pm;
      if (this.hourFormat == "24")
        newHour = newHour < 0 ? 24 + newHour : newHour;
      else if (this.hourFormat == "12") {
        if (this.currentHour === 12) {
          newPM = !this.pm;
        }
        newHour = newHour <= 0 ? 12 + newHour : newHour;
      }
      if (this.validateTime(newHour, this.currentMinute, this.currentSecond, newPM)) {
        this.currentHour = newHour;
        this.pm = newPM;
      }
      event.preventDefault();
    },
    incrementMinute(event) {
      let newMinute = this.currentMinute + this.stepMinute;
      if (this.validateTime(this.currentHour, newMinute, this.currentSecond, this.pm)) {
        this.currentMinute = newMinute > 59 ? newMinute - 60 : newMinute;
      }
      event.preventDefault();
    },
    decrementMinute(event) {
      let newMinute = this.currentMinute - this.stepMinute;
      newMinute = newMinute < 0 ? 60 + newMinute : newMinute;
      if (this.validateTime(this.currentHour, newMinute, this.currentSecond, this.pm)) {
        this.currentMinute = newMinute;
      }
      event.preventDefault();
    },
    incrementSecond(event) {
      let newSecond = this.currentSecond + this.stepSecond;
      if (this.validateTime(this.currentHour, this.currentMinute, newSecond, this.pm)) {
        this.currentSecond = newSecond > 59 ? newSecond - 60 : newSecond;
      }
      event.preventDefault();
    },
    decrementSecond(event) {
      let newSecond = this.currentSecond - this.stepSecond;
      newSecond = newSecond < 0 ? 60 + newSecond : newSecond;
      if (this.validateTime(this.currentHour, this.currentMinute, newSecond, this.pm)) {
        this.currentSecond = newSecond;
      }
      event.preventDefault();
    },
    updateModelTime() {
      this.timePickerChange = true;
      let value = this.isComparable() ? this.modelValue : this.viewDate;
      if (this.isRangeSelection()) {
        value = this.modelValue[1] || this.modelValue[0];
      }
      if (this.isMultipleSelection()) {
        value = this.modelValue[this.modelValue.length - 1];
      }
      value = value ? new Date(value.getTime()) : new Date();
      if (this.hourFormat == "12") {
        if (this.currentHour === 12)
          value.setHours(this.pm ? 12 : 0);
        else
          value.setHours(this.pm ? this.currentHour + 12 : this.currentHour);
      } else {
        value.setHours(this.currentHour);
      }
      value.setMinutes(this.currentMinute);
      value.setSeconds(this.currentSecond);
      if (this.isRangeSelection()) {
        if (this.modelValue[1])
          value = [this.modelValue[0], value];
        else
          value = [value, null];
      }
      if (this.isMultipleSelection()) {
        value = [...this.modelValue.slice(0, -1), value];
      }
      this.updateModel(value);
      this.$emit("date-select", value);
      setTimeout(() => this.timePickerChange = false, 0);
    },
    toggleAMPM(event) {
      const validHour = this.validateTime(this.currentHour, this.currentMinute, this.currentSecond, !this.pm);
      if (!validHour && (this.maxDate || this.minDate))
        return;
      this.pm = !this.pm;
      this.updateModelTime();
      event.preventDefault();
    },
    clearTimePickerTimer() {
      if (this.timePickerTimer) {
        clearInterval(this.timePickerTimer);
      }
    },
    onMonthSelect(event, index) {
      if (this.view === "month") {
        this.onDateSelect(event, { year: this.currentYear, month: index, day: 1, selectable: true });
      } else {
        this.currentMonth = index;
        this.currentView = "date";
        this.$emit("month-change", { month: this.currentMonth + 1, year: this.currentYear });
      }
      setTimeout(this.updateFocus, 0);
    },
    onYearSelect(event, year) {
      if (this.view === "year") {
        this.onDateSelect(event, { year, month: 0, day: 1, selectable: true });
      } else {
        this.currentYear = year;
        this.currentView = "month";
        this.$emit("year-change", { month: this.currentMonth + 1, year: this.currentYear });
      }
      setTimeout(this.updateFocus, 0);
    },
    enableModality() {
      if (!this.mask) {
        this.mask = document.createElement("div");
        this.mask.style.zIndex = String(parseInt(this.overlay.style.zIndex, 10) - 1);
        DomHandler.addMultipleClasses(this.mask, "p-datepicker-mask p-datepicker-mask-scrollblocker p-component-overlay p-component-overlay-enter");
        this.maskClickListener = () => {
          this.overlayVisible = false;
        };
        this.mask.addEventListener("click", this.maskClickListener);
        document.body.appendChild(this.mask);
        DomHandler.addClass(document.body, "p-overflow-hidden");
      }
    },
    disableModality() {
      if (this.mask) {
        DomHandler.addClass(this.mask, "p-component-overlay-leave");
        this.mask.addEventListener("animationend", () => {
          this.destroyMask();
        });
      }
    },
    destroyMask() {
      this.mask.removeEventListener("click", this.maskClickListener);
      this.maskClickListener = null;
      document.body.removeChild(this.mask);
      this.mask = null;
      let bodyChildren = document.body.children;
      let hasBlockerMasks;
      for (let i = 0; i < bodyChildren.length; i++) {
        let bodyChild = bodyChildren[i];
        if (DomHandler.hasClass(bodyChild, "p-datepicker-mask-scrollblocker")) {
          hasBlockerMasks = true;
          break;
        }
      }
      if (!hasBlockerMasks) {
        DomHandler.removeClass(document.body, "p-overflow-hidden");
      }
    },
    updateCurrentMetaData() {
      const viewDate = this.viewDate;
      this.currentMonth = viewDate.getMonth();
      this.currentYear = viewDate.getFullYear();
      if (this.showTime || this.timeOnly) {
        this.updateCurrentTimeMeta(viewDate);
      }
    },
    isValidSelection(value) {
      if (value == null) {
        return true;
      }
      let isValid = true;
      if (this.isSingleSelection()) {
        if (!this.isSelectable(value.getDate(), value.getMonth(), value.getFullYear(), false)) {
          isValid = false;
        }
      } else if (value.every((v) => this.isSelectable(v.getDate(), v.getMonth(), v.getFullYear(), false))) {
        if (this.isRangeSelection()) {
          isValid = value.length > 1 && value[1] > value[0] ? true : false;
        }
      }
      return isValid;
    },
    parseValue(text) {
      if (!text || text.trim().length === 0) {
        return null;
      }
      let value;
      if (this.isSingleSelection()) {
        value = this.parseDateTime(text);
      } else if (this.isMultipleSelection()) {
        let tokens = text.split(",");
        value = [];
        for (let token of tokens) {
          value.push(this.parseDateTime(token.trim()));
        }
      } else if (this.isRangeSelection()) {
        let tokens = text.split(" - ");
        value = [];
        for (let i = 0; i < tokens.length; i++) {
          value[i] = this.parseDateTime(tokens[i].trim());
        }
      }
      return value;
    },
    parseDateTime(text) {
      let date;
      let parts = text.split(" ");
      if (this.timeOnly) {
        date = new Date();
        this.populateTime(date, parts[0], parts[1]);
      } else {
        const dateFormat = this.datePattern;
        if (this.showTime) {
          date = this.parseDate(parts[0], dateFormat);
          this.populateTime(date, parts[1], parts[2]);
        } else {
          date = this.parseDate(text, dateFormat);
        }
      }
      return date;
    },
    populateTime(value, timeString, ampm) {
      if (this.hourFormat == "12" && !ampm) {
        throw "Invalid Time";
      }
      this.pm = ampm === this.$primevue.config.locale.pm || ampm === this.$primevue.config.locale.pm.toLowerCase();
      let time = this.parseTime(timeString);
      value.setHours(time.hour);
      value.setMinutes(time.minute);
      value.setSeconds(time.second);
    },
    parseTime(value) {
      let tokens = value.split(":");
      let validTokenLength = this.showSeconds ? 3 : 2;
      let regex = /^[0-9][0-9]$/;
      if (tokens.length !== validTokenLength || !tokens[0].match(regex) || !tokens[1].match(regex) || this.showSeconds && !tokens[2].match(regex)) {
        throw "Invalid time";
      }
      let h = parseInt(tokens[0]);
      let m = parseInt(tokens[1]);
      let s = this.showSeconds ? parseInt(tokens[2]) : null;
      if (isNaN(h) || isNaN(m) || h > 23 || m > 59 || this.hourFormat == "12" && h > 12 || this.showSeconds && (isNaN(s) || s > 59)) {
        throw "Invalid time";
      } else {
        if (this.hourFormat == "12" && h !== 12 && this.pm) {
          h += 12;
        }
        return { hour: h, minute: m, second: s };
      }
    },
    parseDate(value, format) {
      if (format == null || value == null) {
        throw "Invalid arguments";
      }
      value = typeof value === "object" ? value.toString() : value + "";
      if (value === "") {
        return null;
      }
      let iFormat, dim, extra, iValue = 0, shortYearCutoff = typeof this.shortYearCutoff !== "string" ? this.shortYearCutoff : new Date().getFullYear() % 100 + parseInt(this.shortYearCutoff, 10), year = -1, month = -1, day = -1, doy = -1, literal = false, date, lookAhead = (match) => {
        let matches = iFormat + 1 < format.length && format.charAt(iFormat + 1) === match;
        if (matches) {
          iFormat++;
        }
        return matches;
      }, getNumber = (match) => {
        let isDoubled = lookAhead(match), size = match === "@" ? 14 : match === "!" ? 20 : match === "y" && isDoubled ? 4 : match === "o" ? 3 : 2, minSize = match === "y" ? size : 1, digits = new RegExp("^\\d{" + minSize + "," + size + "}"), num = value.substring(iValue).match(digits);
        if (!num) {
          throw "Missing number at position " + iValue;
        }
        iValue += num[0].length;
        return parseInt(num[0], 10);
      }, getName = (match, shortNames, longNames) => {
        let index = -1;
        let arr = lookAhead(match) ? longNames : shortNames;
        let names = [];
        for (let i = 0; i < arr.length; i++) {
          names.push([i, arr[i]]);
        }
        names.sort((a, b) => {
          return -(a[1].length - b[1].length);
        });
        for (let i = 0; i < names.length; i++) {
          let name = names[i][1];
          if (value.substr(iValue, name.length).toLowerCase() === name.toLowerCase()) {
            index = names[i][0];
            iValue += name.length;
            break;
          }
        }
        if (index !== -1) {
          return index + 1;
        } else {
          throw "Unknown name at position " + iValue;
        }
      }, checkLiteral = () => {
        if (value.charAt(iValue) !== format.charAt(iFormat)) {
          throw "Unexpected literal at position " + iValue;
        }
        iValue++;
      };
      if (this.currentView === "month") {
        day = 1;
      }
      for (iFormat = 0; iFormat < format.length; iFormat++) {
        if (literal) {
          if (format.charAt(iFormat) === "'" && !lookAhead("'")) {
            literal = false;
          } else {
            checkLiteral();
          }
        } else {
          switch (format.charAt(iFormat)) {
            case "d":
              day = getNumber("d");
              break;
            case "D":
              getName("D", this.$primevue.config.locale.dayNamesShort, this.$primevue.config.locale.dayNames);
              break;
            case "o":
              doy = getNumber("o");
              break;
            case "m":
              month = getNumber("m");
              break;
            case "M":
              month = getName("M", this.$primevue.config.locale.monthNamesShort, this.$primevue.config.locale.monthNames);
              break;
            case "y":
              year = getNumber("y");
              break;
            case "@":
              date = new Date(getNumber("@"));
              year = date.getFullYear();
              month = date.getMonth() + 1;
              day = date.getDate();
              break;
            case "!":
              date = new Date((getNumber("!") - this.ticksTo1970) / 1e4);
              year = date.getFullYear();
              month = date.getMonth() + 1;
              day = date.getDate();
              break;
            case "'":
              if (lookAhead("'")) {
                checkLiteral();
              } else {
                literal = true;
              }
              break;
            default:
              checkLiteral();
          }
        }
      }
      if (iValue < value.length) {
        extra = value.substr(iValue);
        if (!/^\s+/.test(extra)) {
          throw "Extra/unparsed characters found in date: " + extra;
        }
      }
      if (year === -1) {
        year = new Date().getFullYear();
      } else if (year < 100) {
        year += new Date().getFullYear() - new Date().getFullYear() % 100 + (year <= shortYearCutoff ? 0 : -100);
      }
      if (doy > -1) {
        month = 1;
        day = doy;
        do {
          dim = this.getDaysCountInMonth(year, month - 1);
          if (day <= dim) {
            break;
          }
          month++;
          day -= dim;
        } while (true);
      }
      date = this.daylightSavingAdjust(new Date(year, month - 1, day));
      if (date.getFullYear() !== year || date.getMonth() + 1 !== month || date.getDate() !== day) {
        throw "Invalid date";
      }
      return date;
    },
    getWeekNumber(date) {
      let checkDate = new Date(date.getTime());
      checkDate.setDate(checkDate.getDate() + 4 - (checkDate.getDay() || 7));
      let time = checkDate.getTime();
      checkDate.setMonth(0);
      checkDate.setDate(1);
      return Math.floor(Math.round((time - checkDate.getTime()) / 864e5) / 7) + 1;
    },
    onDateCellKeydown(event, date, groupIndex) {
      const cellContent = event.currentTarget;
      const cell = cellContent.parentElement;
      const cellIndex = DomHandler.index(cell);
      switch (event.code) {
        case "ArrowDown": {
          cellContent.tabIndex = "-1";
          let nextRow = cell.parentElement.nextElementSibling;
          if (nextRow) {
            let tableRowIndex = DomHandler.index(cell.parentElement);
            const tableRows = Array.from(cell.parentElement.parentElement.children);
            const nextTableRows = tableRows.slice(tableRowIndex + 1);
            let hasNextFocusableDate = nextTableRows.find((el) => {
              let focusCell = el.children[cellIndex].children[0];
              return !DomHandler.hasClass(focusCell, "p-disabled");
            });
            if (hasNextFocusableDate) {
              let focusCell = hasNextFocusableDate.children[cellIndex].children[0];
              focusCell.tabIndex = "0";
              focusCell.focus();
            } else {
              this.navigationState = { backward: false };
              this.navForward(event);
            }
          } else {
            this.navigationState = { backward: false };
            this.navForward(event);
          }
          event.preventDefault();
          break;
        }
        case "ArrowUp": {
          cellContent.tabIndex = "-1";
          let prevRow = cell.parentElement.previousElementSibling;
          if (prevRow) {
            let tableRowIndex = DomHandler.index(cell.parentElement);
            const tableRows = Array.from(cell.parentElement.parentElement.children);
            const prevTableRows = tableRows.slice(0, tableRowIndex).reverse();
            let hasNextFocusableDate = prevTableRows.find((el) => {
              let focusCell = el.children[cellIndex].children[0];
              return !DomHandler.hasClass(focusCell, "p-disabled");
            });
            if (hasNextFocusableDate) {
              let focusCell = hasNextFocusableDate.children[cellIndex].children[0];
              focusCell.tabIndex = "0";
              focusCell.focus();
            } else {
              this.navigationState = { backward: true };
              this.navBackward(event);
            }
          } else {
            this.navigationState = { backward: true };
            this.navBackward(event);
          }
          event.preventDefault();
          break;
        }
        case "ArrowLeft": {
          cellContent.tabIndex = "-1";
          let prevCell = cell.previousElementSibling;
          if (prevCell) {
            const cells = Array.from(cell.parentElement.children);
            const prevCells = cells.slice(0, cellIndex).reverse();
            let hasNextFocusableDate = prevCells.find((el) => {
              let focusCell = el.children[0];
              return !DomHandler.hasClass(focusCell, "p-disabled");
            });
            if (hasNextFocusableDate) {
              let focusCell = hasNextFocusableDate.children[0];
              focusCell.tabIndex = "0";
              focusCell.focus();
            } else {
              this.navigateToMonth(event, true, groupIndex);
            }
          } else {
            this.navigateToMonth(event, true, groupIndex);
          }
          event.preventDefault();
          break;
        }
        case "ArrowRight": {
          cellContent.tabIndex = "-1";
          let nextCell = cell.nextElementSibling;
          if (nextCell) {
            const cells = Array.from(cell.parentElement.children);
            const nextCells = cells.slice(cellIndex + 1);
            let hasNextFocusableDate = nextCells.find((el) => {
              let focusCell = el.children[0];
              return !DomHandler.hasClass(focusCell, "p-disabled");
            });
            if (hasNextFocusableDate) {
              let focusCell = hasNextFocusableDate.children[0];
              focusCell.tabIndex = "0";
              focusCell.focus();
            } else {
              this.navigateToMonth(event, false, groupIndex);
            }
          } else {
            this.navigateToMonth(event, false, groupIndex);
          }
          event.preventDefault();
          break;
        }
        case "Enter":
        case "Space": {
          this.onDateSelect(event, date);
          event.preventDefault();
          break;
        }
        case "Escape": {
          this.overlayVisible = false;
          event.preventDefault();
          break;
        }
        case "Tab": {
          if (!this.inline) {
            this.trapFocus(event);
          }
          break;
        }
        case "Home": {
          cellContent.tabIndex = "-1";
          let currentRow = cell.parentElement;
          let focusCell = currentRow.children[0].children[0];
          if (DomHandler.hasClass(focusCell, "p-disabled")) {
            this.navigateToMonth(event, true, groupIndex);
          } else {
            focusCell.tabIndex = "0";
            focusCell.focus();
          }
          event.preventDefault();
          break;
        }
        case "End": {
          cellContent.tabIndex = "-1";
          let currentRow = cell.parentElement;
          let focusCell = currentRow.children[currentRow.children.length - 1].children[0];
          if (DomHandler.hasClass(focusCell, "p-disabled")) {
            this.navigateToMonth(event, false, groupIndex);
          } else {
            focusCell.tabIndex = "0";
            focusCell.focus();
          }
          event.preventDefault();
          break;
        }
        case "PageUp": {
          cellContent.tabIndex = "-1";
          if (event.shiftKey) {
            this.navigationState = { backward: true };
            this.navBackward(event);
          } else
            this.navigateToMonth(event, true, groupIndex);
          event.preventDefault();
          break;
        }
        case "PageDown": {
          cellContent.tabIndex = "-1";
          if (event.shiftKey) {
            this.navigationState = { backward: false };
            this.navForward(event);
          } else
            this.navigateToMonth(event, false, groupIndex);
          event.preventDefault();
          break;
        }
      }
    },
    navigateToMonth(event, prev, groupIndex) {
      if (prev) {
        if (this.numberOfMonths === 1 || groupIndex === 0) {
          this.navigationState = { backward: true };
          this.navBackward(event);
        } else {
          let prevMonthContainer = this.overlay.children[groupIndex - 1];
          let cells = DomHandler.find(prevMonthContainer, ".p-datepicker-calendar td span:not(.p-disabled):not(.p-ink)");
          let focusCell = cells[cells.length - 1];
          focusCell.tabIndex = "0";
          focusCell.focus();
        }
      } else {
        if (this.numberOfMonths === 1 || groupIndex === this.numberOfMonths - 1) {
          this.navigationState = { backward: false };
          this.navForward(event);
        } else {
          let nextMonthContainer = this.overlay.children[groupIndex + 1];
          let focusCell = DomHandler.findSingle(nextMonthContainer, ".p-datepicker-calendar td span:not(.p-disabled):not(.p-ink)");
          focusCell.tabIndex = "0";
          focusCell.focus();
        }
      }
    },
    onMonthCellKeydown(event, index) {
      const cell = event.currentTarget;
      switch (event.code) {
        case "ArrowUp":
        case "ArrowDown": {
          cell.tabIndex = "-1";
          var cells = cell.parentElement.children;
          var cellIndex = DomHandler.index(cell);
          let nextCell = cells[event.code === "ArrowDown" ? cellIndex + 3 : cellIndex - 3];
          if (nextCell) {
            nextCell.tabIndex = "0";
            nextCell.focus();
          }
          event.preventDefault();
          break;
        }
        case "ArrowLeft": {
          cell.tabIndex = "-1";
          let prevCell = cell.previousElementSibling;
          if (prevCell) {
            prevCell.tabIndex = "0";
            prevCell.focus();
          } else {
            this.navigationState = { backward: true };
            this.navBackward(event);
          }
          event.preventDefault();
          break;
        }
        case "ArrowRight": {
          cell.tabIndex = "-1";
          let nextCell = cell.nextElementSibling;
          if (nextCell) {
            nextCell.tabIndex = "0";
            nextCell.focus();
          } else {
            this.navigationState = { backward: false };
            this.navForward(event);
          }
          event.preventDefault();
          break;
        }
        case "PageUp": {
          if (event.shiftKey)
            return;
          this.navigationState = { backward: true };
          this.navBackward(event);
          break;
        }
        case "PageDown": {
          if (event.shiftKey)
            return;
          this.navigationState = { backward: false };
          this.navForward(event);
          break;
        }
        case "Enter":
        case "Space": {
          this.onMonthSelect(event, index);
          event.preventDefault();
          break;
        }
        case "Escape": {
          this.overlayVisible = false;
          event.preventDefault();
          break;
        }
        case "Tab": {
          this.trapFocus(event);
          break;
        }
      }
    },
    onYearCellKeydown(event, index) {
      const cell = event.currentTarget;
      switch (event.code) {
        case "ArrowUp":
        case "ArrowDown": {
          cell.tabIndex = "-1";
          var cells = cell.parentElement.children;
          var cellIndex = DomHandler.index(cell);
          let nextCell = cells[event.code === "ArrowDown" ? cellIndex + 2 : cellIndex - 2];
          if (nextCell) {
            nextCell.tabIndex = "0";
            nextCell.focus();
          }
          event.preventDefault();
          break;
        }
        case "ArrowLeft": {
          cell.tabIndex = "-1";
          let prevCell = cell.previousElementSibling;
          if (prevCell) {
            prevCell.tabIndex = "0";
            prevCell.focus();
          } else {
            this.navigationState = { backward: true };
            this.navBackward(event);
          }
          event.preventDefault();
          break;
        }
        case "ArrowRight": {
          cell.tabIndex = "-1";
          let nextCell = cell.nextElementSibling;
          if (nextCell) {
            nextCell.tabIndex = "0";
            nextCell.focus();
          } else {
            this.navigationState = { backward: false };
            this.navForward(event);
          }
          event.preventDefault();
          break;
        }
        case "PageUp": {
          if (event.shiftKey)
            return;
          this.navigationState = { backward: true };
          this.navBackward(event);
          break;
        }
        case "PageDown": {
          if (event.shiftKey)
            return;
          this.navigationState = { backward: false };
          this.navForward(event);
          break;
        }
        case "Enter":
        case "Space": {
          this.onYearSelect(event, index);
          event.preventDefault();
          break;
        }
        case "Escape": {
          this.overlayVisible = false;
          event.preventDefault();
          break;
        }
        case "Tab": {
          this.trapFocus(event);
          break;
        }
      }
    },
    updateFocus() {
      let cell;
      if (this.navigationState) {
        if (this.navigationState.button) {
          this.initFocusableCell();
          if (this.navigationState.backward)
            DomHandler.findSingle(this.overlay, ".p-datepicker-prev").focus();
          else
            DomHandler.findSingle(this.overlay, ".p-datepicker-next").focus();
        } else {
          if (this.navigationState.backward) {
            let cells;
            if (this.currentView === "month") {
              cells = DomHandler.find(this.overlay, ".p-monthpicker .p-monthpicker-month:not(.p-disabled)");
            } else if (this.currentView === "year") {
              cells = DomHandler.find(this.overlay, ".p-yearpicker .p-yearpicker-year:not(.p-disabled)");
            } else {
              cells = DomHandler.find(this.overlay, ".p-datepicker-calendar td span:not(.p-disabled):not(.p-ink)");
            }
            if (cells && cells.length > 0) {
              cell = cells[cells.length - 1];
            }
          } else {
            if (this.currentView === "month") {
              cell = DomHandler.findSingle(this.overlay, ".p-monthpicker .p-monthpicker-month:not(.p-disabled)");
            } else if (this.currentView === "year") {
              cell = DomHandler.findSingle(this.overlay, ".p-yearpicker .p-yearpicker-year:not(.p-disabled)");
            } else {
              cell = DomHandler.findSingle(this.overlay, ".p-datepicker-calendar td span:not(.p-disabled):not(.p-ink)");
            }
          }
          if (cell) {
            cell.tabIndex = "0";
            cell.focus();
          }
        }
        this.navigationState = null;
      } else {
        this.initFocusableCell();
      }
    },
    initFocusableCell() {
      let cell;
      if (this.currentView === "month") {
        let cells = DomHandler.find(this.overlay, ".p-monthpicker .p-monthpicker-month");
        let selectedCell = DomHandler.findSingle(this.overlay, ".p-monthpicker .p-monthpicker-month.p-highlight");
        cells.forEach((cell2) => cell2.tabIndex = -1);
        cell = selectedCell || cells[0];
      } else if (this.currentView === "year") {
        let cells = DomHandler.find(this.overlay, ".p-yearpicker .p-yearpicker-year");
        let selectedCell = DomHandler.findSingle(this.overlay, ".p-yearpicker .p-yearpicker-year.p-highlight");
        cells.forEach((cell2) => cell2.tabIndex = -1);
        cell = selectedCell || cells[0];
      } else {
        cell = DomHandler.findSingle(this.overlay, "span.p-highlight");
        if (!cell) {
          let todayCell = DomHandler.findSingle(this.overlay, "td.p-datepicker-today span:not(.p-disabled):not(.p-ink");
          if (todayCell)
            cell = todayCell;
          else
            cell = DomHandler.findSingle(this.overlay, ".p-datepicker-calendar td span:not(.p-disabled):not(.p-ink");
        }
      }
      if (cell) {
        cell.tabIndex = "0";
        if (!this.inline && (!this.navigationState || !this.navigationState.button) && !this.timePickerChange) {
          cell.focus();
        }
        this.preventFocus = false;
      }
    },
    trapFocus(event) {
      event.preventDefault();
      let focusableElements = DomHandler.getFocusableElements(this.overlay);
      if (focusableElements && focusableElements.length > 0) {
        if (!document.activeElement) {
          focusableElements[0].focus();
        } else {
          let focusedIndex = focusableElements.indexOf(document.activeElement);
          if (event.shiftKey) {
            if (focusedIndex === -1 || focusedIndex === 0)
              focusableElements[focusableElements.length - 1].focus();
            else
              focusableElements[focusedIndex - 1].focus();
          } else {
            if (focusedIndex === -1) {
              if (this.timeOnly) {
                focusableElements[0].focus();
              } else {
                let spanIndex = null;
                for (let i = 0; i < focusableElements.length; i++) {
                  if (focusableElements[i].tagName === "SPAN")
                    spanIndex = i;
                }
                focusableElements[spanIndex].focus();
              }
            } else if (focusedIndex === focusableElements.length - 1)
              focusableElements[0].focus();
            else
              focusableElements[focusedIndex + 1].focus();
          }
        }
      }
    },
    onContainerButtonKeydown(event) {
      switch (event.code) {
        case "Tab":
          this.trapFocus(event);
          break;
        case "Escape":
          this.overlayVisible = false;
          event.preventDefault();
          break;
      }
      this.$emit("keydown", event);
    },
    onInput(event) {
      try {
        this.selectionStart = this.input.selectionStart;
        this.selectionEnd = this.input.selectionEnd;
        let value = this.parseValue(event.target.value);
        if (this.isValidSelection(value)) {
          this.typeUpdate = true;
          this.updateModel(value);
        }
      } catch (err) {
      }
      this.$emit("input", event);
    },
    onInputClick() {
      if (this.showOnFocus && this.isEnabled() && !this.overlayVisible) {
        this.overlayVisible = true;
      }
    },
    onFocus(event) {
      if (this.showOnFocus && this.isEnabled()) {
        this.overlayVisible = true;
      }
      this.focused = true;
      this.$emit("focus", event);
    },
    onBlur(event) {
      this.$emit("blur", { originalEvent: event, value: event.target.value });
      this.focused = false;
      event.target.value = this.formatValue(this.modelValue);
    },
    onKeyDown(event) {
      if (event.code === "ArrowDown" && this.overlay) {
        this.trapFocus(event);
      } else if (event.code === "ArrowDown" && !this.overlay) {
        this.overlayVisible = true;
      } else if (event.code === "Escape") {
        if (this.overlayVisible) {
          this.overlayVisible = false;
          event.preventDefault();
        }
      } else if (event.code === "Tab") {
        if (this.overlay) {
          DomHandler.getFocusableElements(this.overlay).forEach((el) => el.tabIndex = "-1");
        }
        if (this.overlayVisible) {
          this.overlayVisible = false;
        }
      }
    },
    overlayRef(el) {
      this.overlay = el;
    },
    inputRef(el) {
      this.input = el;
    },
    getMonthName(index) {
      return this.$primevue.config.locale.monthNames[index];
    },
    getYear(month) {
      return this.currentView === "month" ? this.currentYear : month.year;
    },
    onOverlayClick(event) {
      if (!this.inline) {
        OverlayEventBus.emit("overlay-click", {
          originalEvent: event,
          target: this.$el
        });
      }
    },
    onOverlayKeyDown(event) {
      switch (event.code) {
        case "Escape":
          this.input.focus();
          this.overlayVisible = false;
          break;
      }
    },
    onOverlayMouseUp(event) {
      this.onOverlayClick(event);
    },
    createResponsiveStyle() {
      if (this.numberOfMonths > 1 && this.responsiveOptions) {
        if (!this.responsiveStyleElement) {
          this.responsiveStyleElement = document.createElement("style");
          this.responsiveStyleElement.type = "text/css";
          document.body.appendChild(this.responsiveStyleElement);
        }
        let innerHTML = "";
        if (this.responsiveOptions) {
          let responsiveOptions = [...this.responsiveOptions].filter((o) => !!(o.breakpoint && o.numMonths)).sort((o1, o2) => -1 * o1.breakpoint.localeCompare(o2.breakpoint, void 0, { numeric: true }));
          for (let i = 0; i < responsiveOptions.length; i++) {
            let { breakpoint, numMonths } = responsiveOptions[i];
            let styles = `
                            .p-datepicker[${this.attributeSelector}] .p-datepicker-group:nth-child(${numMonths}) .p-datepicker-next {
                                display: inline-flex !important;
                            }
                        `;
            for (let j = numMonths; j < this.numberOfMonths; j++) {
              styles += `
                                .p-datepicker[${this.attributeSelector}] .p-datepicker-group:nth-child(${j + 1}) {
                                    display: none !important;
                                }
                            `;
            }
            innerHTML += `
                            @media screen and (max-width: ${breakpoint}) {
                                ${styles}
                            }
                        `;
          }
        }
        this.responsiveStyleElement.innerHTML = innerHTML;
      }
    },
    destroyResponsiveStyleElement() {
      if (this.responsiveStyleElement) {
        this.responsiveStyleElement.remove();
        this.responsiveStyleElement = null;
      }
    }
  },
  computed: {
    viewDate() {
      let propValue = this.modelValue;
      if (propValue && Array.isArray(propValue)) {
        if (this.isRangeSelection()) {
          propValue = this.inline ? propValue[0] : propValue[1] || propValue[0];
        } else if (this.isMultipleSelection()) {
          propValue = propValue[propValue.length - 1];
        }
      }
      if (propValue && typeof propValue !== "string") {
        return propValue;
      } else {
        let today = new Date();
        if (this.maxDate && this.maxDate < today) {
          return this.maxDate;
        }
        if (this.minDate && this.minDate > today) {
          return this.minDate;
        }
        return today;
      }
    },
    inputFieldValue() {
      return this.formatValue(this.modelValue);
    },
    containerClass() {
      return [
        "p-calendar p-component p-inputwrapper",
        {
          "p-calendar-w-btn": this.showIcon,
          "p-calendar-timeonly": this.timeOnly,
          "p-calendar-disabled": this.disabled,
          "p-inputwrapper-filled": this.modelValue,
          "p-inputwrapper-focus": this.focused
        }
      ];
    },
    panelStyleClass() {
      return [
        "p-datepicker p-component",
        this.panelClass,
        {
          "p-datepicker-inline": this.inline,
          "p-disabled": this.disabled,
          "p-datepicker-timeonly": this.timeOnly,
          "p-datepicker-multiple-month": this.numberOfMonths > 1,
          "p-datepicker-monthpicker": this.currentView === "month",
          "p-datepicker-yearpicker": this.currentView === "year",
          "p-datepicker-touch-ui": this.touchUI,
          "p-input-filled": this.$primevue.config.inputStyle === "filled",
          "p-ripple-disabled": this.$primevue.config.ripple === false
        }
      ];
    },
    months() {
      let months = [];
      for (let i = 0; i < this.numberOfMonths; i++) {
        let month = this.currentMonth + i;
        let year = this.currentYear;
        if (month > 11) {
          month = month % 11 - 1;
          year = year + 1;
        }
        let dates = [];
        let firstDay = this.getFirstDayOfMonthIndex(month, year);
        let daysLength = this.getDaysCountInMonth(month, year);
        let prevMonthDaysLength = this.getDaysCountInPrevMonth(month, year);
        let dayNo = 1;
        let today = new Date();
        let weekNumbers = [];
        let monthRows = Math.ceil((daysLength + firstDay) / 7);
        for (let i2 = 0; i2 < monthRows; i2++) {
          let week = [];
          if (i2 == 0) {
            for (let j = prevMonthDaysLength - firstDay + 1; j <= prevMonthDaysLength; j++) {
              let prev = this.getPreviousMonthAndYear(month, year);
              week.push({ day: j, month: prev.month, year: prev.year, otherMonth: true, today: this.isToday(today, j, prev.month, prev.year), selectable: this.isSelectable(j, prev.month, prev.year, true) });
            }
            let remainingDaysLength = 7 - week.length;
            for (let j = 0; j < remainingDaysLength; j++) {
              week.push({ day: dayNo, month, year, today: this.isToday(today, dayNo, month, year), selectable: this.isSelectable(dayNo, month, year, false) });
              dayNo++;
            }
          } else {
            for (let j = 0; j < 7; j++) {
              if (dayNo > daysLength) {
                let next = this.getNextMonthAndYear(month, year);
                week.push({
                  day: dayNo - daysLength,
                  month: next.month,
                  year: next.year,
                  otherMonth: true,
                  today: this.isToday(today, dayNo - daysLength, next.month, next.year),
                  selectable: this.isSelectable(dayNo - daysLength, next.month, next.year, true)
                });
              } else {
                week.push({ day: dayNo, month, year, today: this.isToday(today, dayNo, month, year), selectable: this.isSelectable(dayNo, month, year, false) });
              }
              dayNo++;
            }
          }
          if (this.showWeek) {
            weekNumbers.push(this.getWeekNumber(new Date(week[0].year, week[0].month, week[0].day)));
          }
          dates.push(week);
        }
        months.push({
          month,
          year,
          dates,
          weekNumbers
        });
      }
      return months;
    },
    weekDays() {
      let weekDays = [];
      let dayIndex = this.$primevue.config.locale.firstDayOfWeek;
      for (let i = 0; i < 7; i++) {
        weekDays.push(this.$primevue.config.locale.dayNamesMin[dayIndex]);
        dayIndex = dayIndex == 6 ? 0 : ++dayIndex;
      }
      return weekDays;
    },
    ticksTo1970() {
      return ((1970 - 1) * 365 + Math.floor(1970 / 4) - Math.floor(1970 / 100) + Math.floor(1970 / 400)) * 24 * 60 * 60 * 1e7;
    },
    sundayIndex() {
      return this.$primevue.config.locale.firstDayOfWeek > 0 ? 7 - this.$primevue.config.locale.firstDayOfWeek : 0;
    },
    datePattern() {
      return this.dateFormat || this.$primevue.config.locale.dateFormat;
    },
    yearOptions() {
      if (this.yearRange) {
        let $vm = this;
        const years = this.yearRange.split(":");
        let yearStart = parseInt(years[0]);
        let yearEnd = parseInt(years[1]);
        let yearOptions = [];
        if (this.currentYear < yearStart) {
          $vm.currentYear = yearEnd;
        } else if (this.currentYear > yearEnd) {
          $vm.currentYear = yearStart;
        }
        for (let i = yearStart; i <= yearEnd; i++) {
          yearOptions.push(i);
        }
        return yearOptions;
      } else {
        return null;
      }
    },
    monthPickerValues() {
      let monthPickerValues = [];
      for (let i = 0; i <= 11; i++) {
        monthPickerValues.push(this.$primevue.config.locale.monthNamesShort[i]);
      }
      return monthPickerValues;
    },
    yearPickerValues() {
      let yearPickerValues = [];
      let base = this.currentYear - this.currentYear % 10;
      for (let i = 0; i < 10; i++) {
        yearPickerValues.push(base + i);
      }
      return yearPickerValues;
    },
    formattedCurrentHour() {
      return this.currentHour < 10 ? "0" + this.currentHour : this.currentHour;
    },
    formattedCurrentMinute() {
      return this.currentMinute < 10 ? "0" + this.currentMinute : this.currentMinute;
    },
    formattedCurrentSecond() {
      return this.currentSecond < 10 ? "0" + this.currentSecond : this.currentSecond;
    },
    todayLabel() {
      return this.$primevue.config.locale.today;
    },
    clearLabel() {
      return this.$primevue.config.locale.clear;
    },
    weekHeaderLabel() {
      return this.$primevue.config.locale.weekHeader;
    },
    monthNames() {
      return this.$primevue.config.locale.monthNames;
    },
    attributeSelector() {
      return UniqueComponentId();
    },
    switchViewButtonDisabled() {
      return this.numberOfMonths > 1 || this.disabled;
    },
    panelId() {
      return UniqueComponentId() + "_panel";
    }
  },
  components: {
    CalendarButton: Button,
    Portal
  },
  directives: {
    ripple: Ripple
  }
};
function _sfc_ssrRender$7(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_CalendarButton = resolveComponent("CalendarButton");
  const _component_Portal = resolveComponent("Portal");
  const _directive_ripple = resolveDirective("ripple");
  _push(`<span${ssrRenderAttrs(mergeProps({
    ref: "container",
    id: $props.id,
    class: $options.containerClass
  }, _attrs))}>`);
  if (!$props.inline) {
    _push(`<input${ssrRenderAttrs(mergeProps({
      ref: $options.inputRef,
      id: $props.inputId,
      type: "text",
      role: "combobox",
      class: ["p-inputtext p-component", $props.inputClass],
      style: $props.inputStyle,
      placeholder: $props.placeholder,
      autocomplete: "off",
      "aria-autocomplete": "none",
      "aria-haspopup": "dialog",
      "aria-expanded": $data.overlayVisible,
      "aria-controls": $options.panelId,
      "aria-labelledby": _ctx.ariaLabelledby,
      "aria-label": _ctx.ariaLabel,
      inputmode: "none",
      disabled: $props.disabled,
      readonly: !$props.manualInput || $props.readonly,
      tabindex: 0
    }, $props.inputProps))}>`);
  } else {
    _push(`<!---->`);
  }
  if ($props.showIcon) {
    _push(ssrRenderComponent(_component_CalendarButton, {
      icon: $props.icon,
      class: "p-datepicker-trigger",
      disabled: $props.disabled,
      onClick: $options.onButtonClick,
      type: "button",
      "aria-label": _ctx.$primevue.config.locale.chooseDate,
      "aria-haspopup": "dialog",
      "aria-expanded": $data.overlayVisible,
      "aria-controls": $options.panelId
    }, null, _parent));
  } else {
    _push(`<!---->`);
  }
  _push(ssrRenderComponent(_component_Portal, {
    appendTo: $props.appendTo,
    disabled: $props.inline
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(``);
        if ($props.inline || $data.overlayVisible) {
          _push2(`<div${ssrRenderAttrs(mergeProps({
            ref: $options.overlayRef,
            id: $options.panelId,
            class: $options.panelStyleClass,
            style: $props.panelStyle,
            role: $props.inline ? null : "dialog",
            "aria-modal": $props.inline ? null : "true",
            "aria-label": _ctx.$primevue.config.locale.chooseDate
          }, $props.panelProps))}${_scopeId}>`);
          if (!$props.timeOnly) {
            _push2(`<!--[--><div class="p-datepicker-group-container"${_scopeId}><!--[-->`);
            ssrRenderList($options.months, (month, groupIndex) => {
              _push2(`<div class="p-datepicker-group"${_scopeId}><div class="p-datepicker-header"${_scopeId}>`);
              ssrRenderSlot(_ctx.$slots, "header", {}, null, _push2, _parent2, _scopeId);
              _push2(`<button${ssrRenderAttrs(mergeProps({
                style: ($props.showOtherMonths ? groupIndex === 0 : false) ? null : { display: "none" },
                class: "p-datepicker-prev p-link",
                type: "button",
                disabled: $props.disabled,
                "aria-label": $data.currentView === "year" ? _ctx.$primevue.config.locale.prevDecade : $data.currentView === "month" ? _ctx.$primevue.config.locale.prevYear : _ctx.$primevue.config.locale.prevMonth
              }, ssrGetDirectiveProps(_ctx, _directive_ripple)))}${_scopeId}><span class="${ssrRenderClass(["p-datepicker-prev-icon", $props.previousIcon])}"${_scopeId}></span></button><div class="p-datepicker-title"${_scopeId}>`);
              if ($data.currentView === "date") {
                _push2(`<button type="button" class="p-datepicker-month p-link"${ssrIncludeBooleanAttr($options.switchViewButtonDisabled) ? " disabled" : ""}${ssrRenderAttr("aria-label", _ctx.$primevue.config.locale.chooseMonth)}${_scopeId}>${ssrInterpolate($options.getMonthName(month.month))}</button>`);
              } else {
                _push2(`<!---->`);
              }
              if ($data.currentView !== "year") {
                _push2(`<button type="button" class="p-datepicker-year p-link"${ssrIncludeBooleanAttr($options.switchViewButtonDisabled) ? " disabled" : ""}${ssrRenderAttr("aria-label", _ctx.$primevue.config.locale.chooseYear)}${_scopeId}>${ssrInterpolate($options.getYear(month))}</button>`);
              } else {
                _push2(`<!---->`);
              }
              if ($data.currentView === "year") {
                _push2(`<span class="p-datepicker-decade"${_scopeId}>`);
                ssrRenderSlot(_ctx.$slots, "decade", { years: $options.yearPickerValues }, () => {
                  _push2(`${ssrInterpolate($options.yearPickerValues[0])} - ${ssrInterpolate($options.yearPickerValues[$options.yearPickerValues.length - 1])}`);
                }, _push2, _parent2, _scopeId);
                _push2(`</span>`);
              } else {
                _push2(`<!---->`);
              }
              _push2(`</div><button${ssrRenderAttrs(mergeProps({
                style: ($props.showOtherMonths ? $props.numberOfMonths === 1 ? true : groupIndex === $props.numberOfMonths - 1 : false) ? null : { display: "none" },
                class: "p-datepicker-next p-link",
                type: "button",
                disabled: $props.disabled,
                "aria-label": $data.currentView === "year" ? _ctx.$primevue.config.locale.nextDecade : $data.currentView === "month" ? _ctx.$primevue.config.locale.nextYear : _ctx.$primevue.config.locale.nextMonth
              }, ssrGetDirectiveProps(_ctx, _directive_ripple)))}${_scopeId}><span class="${ssrRenderClass(["p-datepicker-next-icon", $props.nextIcon])}"${_scopeId}></span></button></div>`);
              if ($data.currentView === "date") {
                _push2(`<div class="p-datepicker-calendar-container"${_scopeId}><table class="p-datepicker-calendar" role="grid"${_scopeId}><thead${_scopeId}><tr${_scopeId}>`);
                if ($props.showWeek) {
                  _push2(`<th scope="col" class="p-datepicker-weekheader p-disabled"${_scopeId}><span${_scopeId}>${ssrInterpolate($options.weekHeaderLabel)}</span></th>`);
                } else {
                  _push2(`<!---->`);
                }
                _push2(`<!--[-->`);
                ssrRenderList($options.weekDays, (weekDay) => {
                  _push2(`<th scope="col"${ssrRenderAttr("abbr", weekDay)}${_scopeId}><span${_scopeId}>${ssrInterpolate(weekDay)}</span></th>`);
                });
                _push2(`<!--]--></tr></thead><tbody${_scopeId}><!--[-->`);
                ssrRenderList(month.dates, (week, i) => {
                  _push2(`<tr${_scopeId}>`);
                  if ($props.showWeek) {
                    _push2(`<td class="p-datepicker-weeknumber"${_scopeId}><span class="p-disabled"${_scopeId}>`);
                    if (month.weekNumbers[i] < 10) {
                      _push2(`<span style="${ssrRenderStyle({ "visibility": "hidden" })}"${_scopeId}>0</span>`);
                    } else {
                      _push2(`<!---->`);
                    }
                    _push2(` ${ssrInterpolate(month.weekNumbers[i])}</span></td>`);
                  } else {
                    _push2(`<!---->`);
                  }
                  _push2(`<!--[-->`);
                  ssrRenderList(week, (date) => {
                    _push2(`<td${ssrRenderAttr("aria-label", date.day)} class="${ssrRenderClass({ "p-datepicker-other-month": date.otherMonth, "p-datepicker-today": date.today })}"${_scopeId}><span${ssrRenderAttrs(mergeProps({
                      class: { "p-highlight": $options.isSelected(date), "p-disabled": !date.selectable },
                      draggable: "false",
                      "aria-selected": $options.isSelected(date)
                    }, ssrGetDirectiveProps(_ctx, _directive_ripple)))}${_scopeId}>`);
                    ssrRenderSlot(_ctx.$slots, "date", { date }, () => {
                      _push2(`${ssrInterpolate(date.day)}`);
                    }, _push2, _parent2, _scopeId);
                    _push2(`</span>`);
                    if ($options.isSelected(date)) {
                      _push2(`<div class="p-hidden-accessible" aria-live="polite"${_scopeId}>${ssrInterpolate(date.day)}</div>`);
                    } else {
                      _push2(`<!---->`);
                    }
                    _push2(`</td>`);
                  });
                  _push2(`<!--]--></tr>`);
                });
                _push2(`<!--]--></tbody></table></div>`);
              } else {
                _push2(`<!---->`);
              }
              _push2(`</div>`);
            });
            _push2(`<!--]--></div>`);
            if ($data.currentView === "month") {
              _push2(`<div class="p-monthpicker"${_scopeId}><!--[-->`);
              ssrRenderList($options.monthPickerValues, (m, i) => {
                _push2(`<span${ssrRenderAttrs(mergeProps({
                  key: m,
                  class: ["p-monthpicker-month", { "p-highlight": $options.isMonthSelected(i) }]
                }, ssrGetDirectiveProps(_ctx, _directive_ripple)))}${_scopeId}>${ssrInterpolate(m)} `);
                if ($options.isMonthSelected(i)) {
                  _push2(`<div class="p-hidden-accessible" aria-live="polite"${_scopeId}>${ssrInterpolate(m)}</div>`);
                } else {
                  _push2(`<!---->`);
                }
                _push2(`</span>`);
              });
              _push2(`<!--]--></div>`);
            } else {
              _push2(`<!---->`);
            }
            if ($data.currentView === "year") {
              _push2(`<div class="p-yearpicker"${_scopeId}><!--[-->`);
              ssrRenderList($options.yearPickerValues, (y) => {
                _push2(`<span${ssrRenderAttrs(mergeProps({
                  key: y,
                  class: ["p-yearpicker-year", { "p-highlight": $options.isYearSelected(y) }]
                }, ssrGetDirectiveProps(_ctx, _directive_ripple)))}${_scopeId}>${ssrInterpolate(y)} `);
                if ($options.isYearSelected(y)) {
                  _push2(`<div class="p-hidden-accessible" aria-live="polite"${_scopeId}>${ssrInterpolate(y)}</div>`);
                } else {
                  _push2(`<!---->`);
                }
                _push2(`</span>`);
              });
              _push2(`<!--]--></div>`);
            } else {
              _push2(`<!---->`);
            }
            _push2(`<!--]-->`);
          } else {
            _push2(`<!---->`);
          }
          if (($props.showTime || $props.timeOnly) && $data.currentView === "date") {
            _push2(`<div class="p-timepicker"${_scopeId}><div class="p-hour-picker"${_scopeId}><button${ssrRenderAttrs(mergeProps({
              class: "p-link",
              "aria-label": _ctx.$primevue.config.locale.nextHour,
              type: "button"
            }, ssrGetDirectiveProps(_ctx, _directive_ripple)))}${_scopeId}><span class="${ssrRenderClass($props.incrementIcon)}"${_scopeId}></span></button><span${_scopeId}>${ssrInterpolate($options.formattedCurrentHour)}</span><button${ssrRenderAttrs(mergeProps({
              class: "p-link",
              "aria-label": _ctx.$primevue.config.locale.prevHour,
              type: "button"
            }, ssrGetDirectiveProps(_ctx, _directive_ripple)))}${_scopeId}><span class="${ssrRenderClass($props.decrementIcon)}"${_scopeId}></span></button></div><div class="p-separator"${_scopeId}><span${_scopeId}>${ssrInterpolate($props.timeSeparator)}</span></div><div class="p-minute-picker"${_scopeId}><button${ssrRenderAttrs(mergeProps({
              class: "p-link",
              "aria-label": _ctx.$primevue.config.locale.nextMinute,
              disabled: $props.disabled,
              type: "button"
            }, ssrGetDirectiveProps(_ctx, _directive_ripple)))}${_scopeId}><span class="${ssrRenderClass($props.incrementIcon)}"${_scopeId}></span></button><span${_scopeId}>${ssrInterpolate($options.formattedCurrentMinute)}</span><button${ssrRenderAttrs(mergeProps({
              class: "p-link",
              "aria-label": _ctx.$primevue.config.locale.prevMinute,
              disabled: $props.disabled,
              type: "button"
            }, ssrGetDirectiveProps(_ctx, _directive_ripple)))}${_scopeId}><span class="${ssrRenderClass($props.decrementIcon)}"${_scopeId}></span></button></div>`);
            if ($props.showSeconds) {
              _push2(`<div class="p-separator"${_scopeId}><span${_scopeId}>${ssrInterpolate($props.timeSeparator)}</span></div>`);
            } else {
              _push2(`<!---->`);
            }
            if ($props.showSeconds) {
              _push2(`<div class="p-second-picker"${_scopeId}><button${ssrRenderAttrs(mergeProps({
                class: "p-link",
                "aria-label": _ctx.$primevue.config.locale.nextSecond,
                disabled: $props.disabled,
                type: "button"
              }, ssrGetDirectiveProps(_ctx, _directive_ripple)))}${_scopeId}><span class="${ssrRenderClass($props.incrementIcon)}"${_scopeId}></span></button><span${_scopeId}>${ssrInterpolate($options.formattedCurrentSecond)}</span><button${ssrRenderAttrs(mergeProps({
                class: "p-link",
                "aria-label": _ctx.$primevue.config.locale.prevSecond,
                disabled: $props.disabled,
                type: "button"
              }, ssrGetDirectiveProps(_ctx, _directive_ripple)))}${_scopeId}><span class="${ssrRenderClass($props.decrementIcon)}"${_scopeId}></span></button></div>`);
            } else {
              _push2(`<!---->`);
            }
            if ($props.hourFormat == "12") {
              _push2(`<div class="p-separator"${_scopeId}><span${_scopeId}>${ssrInterpolate($props.timeSeparator)}</span></div>`);
            } else {
              _push2(`<!---->`);
            }
            if ($props.hourFormat == "12") {
              _push2(`<div class="p-ampm-picker"${_scopeId}><button${ssrRenderAttrs(mergeProps({
                class: "p-link",
                "aria-label": _ctx.$primevue.config.locale.am,
                type: "button",
                disabled: $props.disabled
              }, ssrGetDirectiveProps(_ctx, _directive_ripple)))}${_scopeId}><span class="${ssrRenderClass($props.incrementIcon)}"${_scopeId}></span></button><span${_scopeId}>${ssrInterpolate($data.pm ? _ctx.$primevue.config.locale.pm : _ctx.$primevue.config.locale.am)}</span><button${ssrRenderAttrs(mergeProps({
                class: "p-link",
                "aria-label": _ctx.$primevue.config.locale.pm,
                type: "button",
                disabled: $props.disabled
              }, ssrGetDirectiveProps(_ctx, _directive_ripple)))}${_scopeId}><span class="${ssrRenderClass($props.decrementIcon)}"${_scopeId}></span></button></div>`);
            } else {
              _push2(`<!---->`);
            }
            _push2(`</div>`);
          } else {
            _push2(`<!---->`);
          }
          if ($props.showButtonBar) {
            _push2(`<div class="p-datepicker-buttonbar"${_scopeId}>`);
            _push2(ssrRenderComponent(_component_CalendarButton, {
              type: "button",
              label: $options.todayLabel,
              onClick: ($event) => $options.onTodayButtonClick($event),
              class: "p-button-text",
              onKeydown: $options.onContainerButtonKeydown
            }, null, _parent2, _scopeId));
            _push2(ssrRenderComponent(_component_CalendarButton, {
              type: "button",
              label: $options.clearLabel,
              onClick: ($event) => $options.onClearButtonClick($event),
              class: "p-button-text",
              onKeydown: $options.onContainerButtonKeydown
            }, null, _parent2, _scopeId));
            _push2(`</div>`);
          } else {
            _push2(`<!---->`);
          }
          ssrRenderSlot(_ctx.$slots, "footer", {}, null, _push2, _parent2, _scopeId);
          _push2(`</div>`);
        } else {
          _push2(`<!---->`);
        }
      } else {
        return [
          createVNode(Transition, {
            name: "p-connected-overlay",
            onEnter: ($event) => $options.onOverlayEnter($event),
            onAfterEnter: $options.onOverlayEnterComplete,
            onAfterLeave: $options.onOverlayAfterLeave,
            onLeave: $options.onOverlayLeave
          }, {
            default: withCtx(() => [
              $props.inline || $data.overlayVisible ? (openBlock(), createBlock("div", mergeProps({
                key: 0,
                ref: $options.overlayRef,
                id: $options.panelId,
                class: $options.panelStyleClass,
                style: $props.panelStyle,
                role: $props.inline ? null : "dialog",
                "aria-modal": $props.inline ? null : "true",
                "aria-label": _ctx.$primevue.config.locale.chooseDate,
                onClick: $options.onOverlayClick,
                onKeydown: $options.onOverlayKeyDown,
                onMouseup: $options.onOverlayMouseUp
              }, $props.panelProps), [
                !$props.timeOnly ? (openBlock(), createBlock(Fragment, { key: 0 }, [
                  createVNode("div", { class: "p-datepicker-group-container" }, [
                    (openBlock(true), createBlock(Fragment, null, renderList($options.months, (month, groupIndex) => {
                      return openBlock(), createBlock("div", {
                        key: month.month + month.year,
                        class: "p-datepicker-group"
                      }, [
                        createVNode("div", { class: "p-datepicker-header" }, [
                          renderSlot(_ctx.$slots, "header"),
                          withDirectives(createVNode("button", {
                            class: "p-datepicker-prev p-link",
                            onClick: $options.onPrevButtonClick,
                            type: "button",
                            onKeydown: $options.onContainerButtonKeydown,
                            disabled: $props.disabled,
                            "aria-label": $data.currentView === "year" ? _ctx.$primevue.config.locale.prevDecade : $data.currentView === "month" ? _ctx.$primevue.config.locale.prevYear : _ctx.$primevue.config.locale.prevMonth
                          }, [
                            createVNode("span", {
                              class: ["p-datepicker-prev-icon", $props.previousIcon]
                            }, null, 2)
                          ], 40, ["onClick", "onKeydown", "disabled", "aria-label"]), [
                            [vShow, $props.showOtherMonths ? groupIndex === 0 : false],
                            [_directive_ripple]
                          ]),
                          createVNode("div", { class: "p-datepicker-title" }, [
                            $data.currentView === "date" ? (openBlock(), createBlock("button", {
                              key: 0,
                              type: "button",
                              onClick: $options.switchToMonthView,
                              onKeydown: $options.onContainerButtonKeydown,
                              class: "p-datepicker-month p-link",
                              disabled: $options.switchViewButtonDisabled,
                              "aria-label": _ctx.$primevue.config.locale.chooseMonth
                            }, toDisplayString($options.getMonthName(month.month)), 41, ["onClick", "onKeydown", "disabled", "aria-label"])) : createCommentVNode("", true),
                            $data.currentView !== "year" ? (openBlock(), createBlock("button", {
                              key: 1,
                              type: "button",
                              onClick: $options.switchToYearView,
                              onKeydown: $options.onContainerButtonKeydown,
                              class: "p-datepicker-year p-link",
                              disabled: $options.switchViewButtonDisabled,
                              "aria-label": _ctx.$primevue.config.locale.chooseYear
                            }, toDisplayString($options.getYear(month)), 41, ["onClick", "onKeydown", "disabled", "aria-label"])) : createCommentVNode("", true),
                            $data.currentView === "year" ? (openBlock(), createBlock("span", {
                              key: 2,
                              class: "p-datepicker-decade"
                            }, [
                              renderSlot(_ctx.$slots, "decade", { years: $options.yearPickerValues }, () => [
                                createTextVNode(toDisplayString($options.yearPickerValues[0]) + " - " + toDisplayString($options.yearPickerValues[$options.yearPickerValues.length - 1]), 1)
                              ])
                            ])) : createCommentVNode("", true)
                          ]),
                          withDirectives(createVNode("button", {
                            class: "p-datepicker-next p-link",
                            onClick: $options.onNextButtonClick,
                            type: "button",
                            onKeydown: $options.onContainerButtonKeydown,
                            disabled: $props.disabled,
                            "aria-label": $data.currentView === "year" ? _ctx.$primevue.config.locale.nextDecade : $data.currentView === "month" ? _ctx.$primevue.config.locale.nextYear : _ctx.$primevue.config.locale.nextMonth
                          }, [
                            createVNode("span", {
                              class: ["p-datepicker-next-icon", $props.nextIcon]
                            }, null, 2)
                          ], 40, ["onClick", "onKeydown", "disabled", "aria-label"]), [
                            [vShow, $props.showOtherMonths ? $props.numberOfMonths === 1 ? true : groupIndex === $props.numberOfMonths - 1 : false],
                            [_directive_ripple]
                          ])
                        ]),
                        $data.currentView === "date" ? (openBlock(), createBlock("div", {
                          key: 0,
                          class: "p-datepicker-calendar-container"
                        }, [
                          createVNode("table", {
                            class: "p-datepicker-calendar",
                            role: "grid"
                          }, [
                            createVNode("thead", null, [
                              createVNode("tr", null, [
                                $props.showWeek ? (openBlock(), createBlock("th", {
                                  key: 0,
                                  scope: "col",
                                  class: "p-datepicker-weekheader p-disabled"
                                }, [
                                  createVNode("span", null, toDisplayString($options.weekHeaderLabel), 1)
                                ])) : createCommentVNode("", true),
                                (openBlock(true), createBlock(Fragment, null, renderList($options.weekDays, (weekDay) => {
                                  return openBlock(), createBlock("th", {
                                    key: weekDay,
                                    scope: "col",
                                    abbr: weekDay
                                  }, [
                                    createVNode("span", null, toDisplayString(weekDay), 1)
                                  ], 8, ["abbr"]);
                                }), 128))
                              ])
                            ]),
                            createVNode("tbody", null, [
                              (openBlock(true), createBlock(Fragment, null, renderList(month.dates, (week, i) => {
                                return openBlock(), createBlock("tr", {
                                  key: week[0].day + "" + week[0].month
                                }, [
                                  $props.showWeek ? (openBlock(), createBlock("td", {
                                    key: 0,
                                    class: "p-datepicker-weeknumber"
                                  }, [
                                    createVNode("span", { class: "p-disabled" }, [
                                      month.weekNumbers[i] < 10 ? (openBlock(), createBlock("span", {
                                        key: 0,
                                        style: { "visibility": "hidden" }
                                      }, "0")) : createCommentVNode("", true),
                                      createTextVNode(" " + toDisplayString(month.weekNumbers[i]), 1)
                                    ])
                                  ])) : createCommentVNode("", true),
                                  (openBlock(true), createBlock(Fragment, null, renderList(week, (date) => {
                                    return openBlock(), createBlock("td", {
                                      key: date.day + "" + date.month,
                                      "aria-label": date.day,
                                      class: { "p-datepicker-other-month": date.otherMonth, "p-datepicker-today": date.today }
                                    }, [
                                      withDirectives(createVNode("span", {
                                        class: { "p-highlight": $options.isSelected(date), "p-disabled": !date.selectable },
                                        onClick: ($event) => $options.onDateSelect($event, date),
                                        draggable: "false",
                                        onKeydown: ($event) => $options.onDateCellKeydown($event, date, groupIndex),
                                        "aria-selected": $options.isSelected(date)
                                      }, [
                                        renderSlot(_ctx.$slots, "date", { date }, () => [
                                          createTextVNode(toDisplayString(date.day), 1)
                                        ])
                                      ], 42, ["onClick", "onKeydown", "aria-selected"]), [
                                        [_directive_ripple]
                                      ]),
                                      $options.isSelected(date) ? (openBlock(), createBlock("div", {
                                        key: 0,
                                        class: "p-hidden-accessible",
                                        "aria-live": "polite"
                                      }, toDisplayString(date.day), 1)) : createCommentVNode("", true)
                                    ], 10, ["aria-label"]);
                                  }), 128))
                                ]);
                              }), 128))
                            ])
                          ])
                        ])) : createCommentVNode("", true)
                      ]);
                    }), 128))
                  ]),
                  $data.currentView === "month" ? (openBlock(), createBlock("div", {
                    key: 0,
                    class: "p-monthpicker"
                  }, [
                    (openBlock(true), createBlock(Fragment, null, renderList($options.monthPickerValues, (m, i) => {
                      return withDirectives((openBlock(), createBlock("span", {
                        key: m,
                        onClick: ($event) => $options.onMonthSelect($event, i),
                        onKeydown: ($event) => $options.onMonthCellKeydown($event, i),
                        class: ["p-monthpicker-month", { "p-highlight": $options.isMonthSelected(i) }]
                      }, [
                        createTextVNode(toDisplayString(m) + " ", 1),
                        $options.isMonthSelected(i) ? (openBlock(), createBlock("div", {
                          key: 0,
                          class: "p-hidden-accessible",
                          "aria-live": "polite"
                        }, toDisplayString(m), 1)) : createCommentVNode("", true)
                      ], 42, ["onClick", "onKeydown"])), [
                        [_directive_ripple]
                      ]);
                    }), 128))
                  ])) : createCommentVNode("", true),
                  $data.currentView === "year" ? (openBlock(), createBlock("div", {
                    key: 1,
                    class: "p-yearpicker"
                  }, [
                    (openBlock(true), createBlock(Fragment, null, renderList($options.yearPickerValues, (y) => {
                      return withDirectives((openBlock(), createBlock("span", {
                        key: y,
                        onClick: ($event) => $options.onYearSelect($event, y),
                        onKeydown: ($event) => $options.onYearCellKeydown($event, y),
                        class: ["p-yearpicker-year", { "p-highlight": $options.isYearSelected(y) }]
                      }, [
                        createTextVNode(toDisplayString(y) + " ", 1),
                        $options.isYearSelected(y) ? (openBlock(), createBlock("div", {
                          key: 0,
                          class: "p-hidden-accessible",
                          "aria-live": "polite"
                        }, toDisplayString(y), 1)) : createCommentVNode("", true)
                      ], 42, ["onClick", "onKeydown"])), [
                        [_directive_ripple]
                      ]);
                    }), 128))
                  ])) : createCommentVNode("", true)
                ], 64)) : createCommentVNode("", true),
                ($props.showTime || $props.timeOnly) && $data.currentView === "date" ? (openBlock(), createBlock("div", {
                  key: 1,
                  class: "p-timepicker"
                }, [
                  createVNode("div", { class: "p-hour-picker" }, [
                    withDirectives(createVNode("button", {
                      class: "p-link",
                      "aria-label": _ctx.$primevue.config.locale.nextHour,
                      onMousedown: ($event) => $options.onTimePickerElementMouseDown($event, 0, 1),
                      onMouseup: ($event) => $options.onTimePickerElementMouseUp($event),
                      onKeydown: [
                        $options.onContainerButtonKeydown,
                        withKeys(($event) => $options.onTimePickerElementMouseDown($event, 0, 1), ["enter"]),
                        withKeys(($event) => $options.onTimePickerElementMouseDown($event, 0, 1), ["space"])
                      ],
                      onMouseleave: ($event) => $options.onTimePickerElementMouseLeave(),
                      onKeyup: [
                        withKeys(($event) => $options.onTimePickerElementMouseUp($event), ["enter"]),
                        withKeys(($event) => $options.onTimePickerElementMouseUp($event), ["space"])
                      ],
                      type: "button"
                    }, [
                      createVNode("span", { class: $props.incrementIcon }, null, 2)
                    ], 40, ["aria-label", "onMousedown", "onMouseup", "onKeydown", "onMouseleave", "onKeyup"]), [
                      [_directive_ripple]
                    ]),
                    createVNode("span", null, toDisplayString($options.formattedCurrentHour), 1),
                    withDirectives(createVNode("button", {
                      class: "p-link",
                      "aria-label": _ctx.$primevue.config.locale.prevHour,
                      onMousedown: ($event) => $options.onTimePickerElementMouseDown($event, 0, -1),
                      onMouseup: ($event) => $options.onTimePickerElementMouseUp($event),
                      onKeydown: [
                        $options.onContainerButtonKeydown,
                        withKeys(($event) => $options.onTimePickerElementMouseDown($event, 0, -1), ["enter"]),
                        withKeys(($event) => $options.onTimePickerElementMouseDown($event, 0, -1), ["space"])
                      ],
                      onMouseleave: ($event) => $options.onTimePickerElementMouseLeave(),
                      onKeyup: [
                        withKeys(($event) => $options.onTimePickerElementMouseUp($event), ["enter"]),
                        withKeys(($event) => $options.onTimePickerElementMouseUp($event), ["space"])
                      ],
                      type: "button"
                    }, [
                      createVNode("span", { class: $props.decrementIcon }, null, 2)
                    ], 40, ["aria-label", "onMousedown", "onMouseup", "onKeydown", "onMouseleave", "onKeyup"]), [
                      [_directive_ripple]
                    ])
                  ]),
                  createVNode("div", { class: "p-separator" }, [
                    createVNode("span", null, toDisplayString($props.timeSeparator), 1)
                  ]),
                  createVNode("div", { class: "p-minute-picker" }, [
                    withDirectives(createVNode("button", {
                      class: "p-link",
                      "aria-label": _ctx.$primevue.config.locale.nextMinute,
                      onMousedown: ($event) => $options.onTimePickerElementMouseDown($event, 1, 1),
                      onMouseup: ($event) => $options.onTimePickerElementMouseUp($event),
                      onKeydown: [
                        $options.onContainerButtonKeydown,
                        withKeys(($event) => $options.onTimePickerElementMouseDown($event, 1, 1), ["enter"]),
                        withKeys(($event) => $options.onTimePickerElementMouseDown($event, 1, 1), ["space"])
                      ],
                      disabled: $props.disabled,
                      onMouseleave: ($event) => $options.onTimePickerElementMouseLeave(),
                      onKeyup: [
                        withKeys(($event) => $options.onTimePickerElementMouseUp($event), ["enter"]),
                        withKeys(($event) => $options.onTimePickerElementMouseUp($event), ["space"])
                      ],
                      type: "button"
                    }, [
                      createVNode("span", { class: $props.incrementIcon }, null, 2)
                    ], 40, ["aria-label", "onMousedown", "onMouseup", "onKeydown", "disabled", "onMouseleave", "onKeyup"]), [
                      [_directive_ripple]
                    ]),
                    createVNode("span", null, toDisplayString($options.formattedCurrentMinute), 1),
                    withDirectives(createVNode("button", {
                      class: "p-link",
                      "aria-label": _ctx.$primevue.config.locale.prevMinute,
                      onMousedown: ($event) => $options.onTimePickerElementMouseDown($event, 1, -1),
                      onMouseup: ($event) => $options.onTimePickerElementMouseUp($event),
                      onKeydown: [
                        $options.onContainerButtonKeydown,
                        withKeys(($event) => $options.onTimePickerElementMouseDown($event, 1, -1), ["enter"]),
                        withKeys(($event) => $options.onTimePickerElementMouseDown($event, 1, -1), ["space"])
                      ],
                      disabled: $props.disabled,
                      onMouseleave: ($event) => $options.onTimePickerElementMouseLeave(),
                      onKeyup: [
                        withKeys(($event) => $options.onTimePickerElementMouseUp($event), ["enter"]),
                        withKeys(($event) => $options.onTimePickerElementMouseUp($event), ["space"])
                      ],
                      type: "button"
                    }, [
                      createVNode("span", { class: $props.decrementIcon }, null, 2)
                    ], 40, ["aria-label", "onMousedown", "onMouseup", "onKeydown", "disabled", "onMouseleave", "onKeyup"]), [
                      [_directive_ripple]
                    ])
                  ]),
                  $props.showSeconds ? (openBlock(), createBlock("div", {
                    key: 0,
                    class: "p-separator"
                  }, [
                    createVNode("span", null, toDisplayString($props.timeSeparator), 1)
                  ])) : createCommentVNode("", true),
                  $props.showSeconds ? (openBlock(), createBlock("div", {
                    key: 1,
                    class: "p-second-picker"
                  }, [
                    withDirectives(createVNode("button", {
                      class: "p-link",
                      "aria-label": _ctx.$primevue.config.locale.nextSecond,
                      onMousedown: ($event) => $options.onTimePickerElementMouseDown($event, 2, 1),
                      onMouseup: ($event) => $options.onTimePickerElementMouseUp($event),
                      onKeydown: [
                        $options.onContainerButtonKeydown,
                        withKeys(($event) => $options.onTimePickerElementMouseDown($event, 2, 1), ["enter"]),
                        withKeys(($event) => $options.onTimePickerElementMouseDown($event, 2, 1), ["space"])
                      ],
                      disabled: $props.disabled,
                      onMouseleave: ($event) => $options.onTimePickerElementMouseLeave(),
                      onKeyup: [
                        withKeys(($event) => $options.onTimePickerElementMouseUp($event), ["enter"]),
                        withKeys(($event) => $options.onTimePickerElementMouseUp($event), ["space"])
                      ],
                      type: "button"
                    }, [
                      createVNode("span", { class: $props.incrementIcon }, null, 2)
                    ], 40, ["aria-label", "onMousedown", "onMouseup", "onKeydown", "disabled", "onMouseleave", "onKeyup"]), [
                      [_directive_ripple]
                    ]),
                    createVNode("span", null, toDisplayString($options.formattedCurrentSecond), 1),
                    withDirectives(createVNode("button", {
                      class: "p-link",
                      "aria-label": _ctx.$primevue.config.locale.prevSecond,
                      onMousedown: ($event) => $options.onTimePickerElementMouseDown($event, 2, -1),
                      onMouseup: ($event) => $options.onTimePickerElementMouseUp($event),
                      onKeydown: [
                        $options.onContainerButtonKeydown,
                        withKeys(($event) => $options.onTimePickerElementMouseDown($event, 2, -1), ["enter"]),
                        withKeys(($event) => $options.onTimePickerElementMouseDown($event, 2, -1), ["space"])
                      ],
                      disabled: $props.disabled,
                      onMouseleave: ($event) => $options.onTimePickerElementMouseLeave(),
                      onKeyup: [
                        withKeys(($event) => $options.onTimePickerElementMouseUp($event), ["enter"]),
                        withKeys(($event) => $options.onTimePickerElementMouseUp($event), ["space"])
                      ],
                      type: "button"
                    }, [
                      createVNode("span", { class: $props.decrementIcon }, null, 2)
                    ], 40, ["aria-label", "onMousedown", "onMouseup", "onKeydown", "disabled", "onMouseleave", "onKeyup"]), [
                      [_directive_ripple]
                    ])
                  ])) : createCommentVNode("", true),
                  $props.hourFormat == "12" ? (openBlock(), createBlock("div", {
                    key: 2,
                    class: "p-separator"
                  }, [
                    createVNode("span", null, toDisplayString($props.timeSeparator), 1)
                  ])) : createCommentVNode("", true),
                  $props.hourFormat == "12" ? (openBlock(), createBlock("div", {
                    key: 3,
                    class: "p-ampm-picker"
                  }, [
                    withDirectives(createVNode("button", {
                      class: "p-link",
                      "aria-label": _ctx.$primevue.config.locale.am,
                      onClick: ($event) => $options.toggleAMPM($event),
                      type: "button",
                      disabled: $props.disabled
                    }, [
                      createVNode("span", { class: $props.incrementIcon }, null, 2)
                    ], 8, ["aria-label", "onClick", "disabled"]), [
                      [_directive_ripple]
                    ]),
                    createVNode("span", null, toDisplayString($data.pm ? _ctx.$primevue.config.locale.pm : _ctx.$primevue.config.locale.am), 1),
                    withDirectives(createVNode("button", {
                      class: "p-link",
                      "aria-label": _ctx.$primevue.config.locale.pm,
                      onClick: ($event) => $options.toggleAMPM($event),
                      type: "button",
                      disabled: $props.disabled
                    }, [
                      createVNode("span", { class: $props.decrementIcon }, null, 2)
                    ], 8, ["aria-label", "onClick", "disabled"]), [
                      [_directive_ripple]
                    ])
                  ])) : createCommentVNode("", true)
                ])) : createCommentVNode("", true),
                $props.showButtonBar ? (openBlock(), createBlock("div", {
                  key: 2,
                  class: "p-datepicker-buttonbar"
                }, [
                  createVNode(_component_CalendarButton, {
                    type: "button",
                    label: $options.todayLabel,
                    onClick: ($event) => $options.onTodayButtonClick($event),
                    class: "p-button-text",
                    onKeydown: $options.onContainerButtonKeydown
                  }, null, 8, ["label", "onClick", "onKeydown"]),
                  createVNode(_component_CalendarButton, {
                    type: "button",
                    label: $options.clearLabel,
                    onClick: ($event) => $options.onClearButtonClick($event),
                    class: "p-button-text",
                    onKeydown: $options.onContainerButtonKeydown
                  }, null, 8, ["label", "onClick", "onKeydown"])
                ])) : createCommentVNode("", true),
                renderSlot(_ctx.$slots, "footer")
              ], 16, ["id", "role", "aria-modal", "aria-label", "onClick", "onKeydown", "onMouseup"])) : createCommentVNode("", true)
            ]),
            _: 3
          }, 8, ["onEnter", "onAfterEnter", "onAfterLeave", "onLeave"])
        ];
      }
    }),
    _: 3
  }, _parent));
  _push(`</span>`);
}
const _sfc_setup$7 = _sfc_main$7.setup;
_sfc_main$7.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("node_modules/primevue/calendar/Calendar.vue");
  return _sfc_setup$7 ? _sfc_setup$7(props, ctx) : void 0;
};
const PrimevueCalendar = /* @__PURE__ */ _export_sfc(_sfc_main$7, [["ssrRender", _sfc_ssrRender$7]]);
const _sfc_main$6 = {
  inheritAttrs: false,
  components: {
    HeadlessFormField: _sfc_main$9,
    PrimevueCalendar
  },
  directives: {
    tooltip: PrimevueTooltip
  },
  inject: ["isMobile", "isTablet", "newDate"],
  props: {
    creating: {
      type: Boolean,
      default: false
    },
    disabledDates: {
      type: Array,
      default: []
    },
    disabledDays: {
      type: Array,
      default: []
    },
    field: {
      type: Object,
      required: true
    },
    focus: {
      type: Boolean,
      default: false
    },
    form: {
      type: Object,
      required: true
    },
    id: {
      type: String,
      required: true
    },
    isLarge: {
      type: Boolean,
      default: false
    },
    isSmall: {
      type: Boolean,
      default: false
    },
    labels: {
      type: String,
      default: null
    },
    show: {
      type: Boolean,
      default: true
    },
    updating: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    dirty() {
      const field = this.field.value ? this.field.value.toString() : null;
      const form = this.form[this.id] ? this.form[this.id].toString() : null;
      return field !== form;
    },
    maxDate() {
      return this.field.maximum ? this.newDate(this.field.maximum) : null;
    },
    minDate() {
      return this.field.minimum ? this.newDate(this.field.minimum) : null;
    }
  }
};
function _sfc_ssrRender$6(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_headless_form_field = resolveComponent("headless-form-field");
  const _component_primevue_calendar = resolveComponent("primevue-calendar");
  const _directive_tooltip = resolveDirective("tooltip");
  _push(ssrRenderComponent(_component_headless_form_field, mergeProps(_ctx.$props, _attrs), {
    default: withCtx(({ disabled, error, label, placeholder, update }, _push2, _parent2, _scopeId) => {
      if (_push2) {
        if ($props.field.before) {
          _push2(`<div class="${ssrRenderClass($props.field.before)}"${_scopeId}></div>`);
        } else {
          _push2(`<!---->`);
        }
        _push2(`<div style="${ssrRenderStyle($props.show ? null : { display: "none" })}" class="${ssrRenderClass([[_ctx.$attrs.class, $props.field.class, $props.labels], "control field calendar"])}"${_scopeId}>`);
        if (label) {
          _push2(`<label class="label"${ssrRenderAttr("for", $props.id)}${_scopeId}>${ssrInterpolate(label)}</label>`);
        } else {
          _push2(`<!---->`);
        }
        _push2(ssrRenderComponent(_component_primevue_calendar, {
          class: ["w-full", {
            "is-creating": $options.dirty && $props.creating,
            "is-updating": $options.dirty && $props.updating,
            "p-inputtext-lg": $props.isLarge,
            "p-inputtext-sm": $props.isSmall,
            "p-invalid": error
          }],
          modelValue: $props.form[$props.id],
          "onUpdate:modelValue": [($event) => $props.form[$props.id] = $event, ($event) => {
            update();
            _ctx.$emit("update:modelValue", $event);
          }],
          "date-format": $props.field.format || "yy-mm-dd",
          disabled,
          "disabled-dates": $props.field.disabled_dates || $props.disabledDates,
          "disabled-days": $props.field.disabled_days || $props.disabledDays,
          id: $props.id,
          placeholder,
          maxDate: $options.maxDate,
          minDate: $options.minDate,
          touchUI: $options.isMobile || $options.isTablet
        }, null, _parent2, _scopeId));
        if (error) {
          _push2(`<div class="error p-error"${_scopeId}><i${ssrRenderAttrs(mergeProps({ class: "pi pi-exclamation-circle" }, ssrGetDirectiveProps(_ctx, _directive_tooltip, error, void 0, { top: true })))}${_scopeId}></i><span class="message"${_scopeId}>${ssrInterpolate(error)}</span></div>`);
        } else {
          _push2(`<!---->`);
        }
        _push2(`</div>`);
        if ($props.field.after) {
          _push2(`<div class="${ssrRenderClass($props.field.after)}"${_scopeId}></div>`);
        } else {
          _push2(`<!---->`);
        }
      } else {
        return [
          $props.field.before ? (openBlock(), createBlock("div", {
            key: 0,
            class: $props.field.before
          }, null, 2)) : createCommentVNode("", true),
          withDirectives(createVNode("div", {
            class: ["control field calendar", [_ctx.$attrs.class, $props.field.class, $props.labels]]
          }, [
            label ? (openBlock(), createBlock("label", {
              key: 0,
              class: "label",
              for: $props.id
            }, toDisplayString(label), 9, ["for"])) : createCommentVNode("", true),
            createVNode(_component_primevue_calendar, {
              class: ["w-full", {
                "is-creating": $options.dirty && $props.creating,
                "is-updating": $options.dirty && $props.updating,
                "p-inputtext-lg": $props.isLarge,
                "p-inputtext-sm": $props.isSmall,
                "p-invalid": error
              }],
              modelValue: $props.form[$props.id],
              "onUpdate:modelValue": [($event) => $props.form[$props.id] = $event, ($event) => {
                update();
                _ctx.$emit("update:modelValue", $event);
              }],
              "date-format": $props.field.format || "yy-mm-dd",
              disabled,
              "disabled-dates": $props.field.disabled_dates || $props.disabledDates,
              "disabled-days": $props.field.disabled_days || $props.disabledDays,
              id: $props.id,
              placeholder,
              maxDate: $options.maxDate,
              minDate: $options.minDate,
              touchUI: $options.isMobile || $options.isTablet
            }, null, 8, ["modelValue", "onUpdate:modelValue", "class", "date-format", "disabled", "disabled-dates", "disabled-days", "id", "placeholder", "maxDate", "minDate", "touchUI"]),
            error ? (openBlock(), createBlock("div", {
              key: 1,
              class: "error p-error"
            }, [
              withDirectives(createVNode("i", { class: "pi pi-exclamation-circle" }, null, 512), [
                [
                  _directive_tooltip,
                  error,
                  void 0,
                  { top: true }
                ]
              ]),
              createVNode("span", { class: "message" }, toDisplayString(error), 1)
            ])) : createCommentVNode("", true)
          ], 2), [
            [vShow, $props.show]
          ]),
          $props.field.after ? (openBlock(), createBlock("div", {
            key: 1,
            class: $props.field.after
          }, null, 2)) : createCommentVNode("", true)
        ];
      }
    }),
    _: 1
  }, _parent));
}
const _sfc_setup$6 = _sfc_main$6.setup;
_sfc_main$6.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/forms/fields/CalendarField.vue");
  return _sfc_setup$6 ? _sfc_setup$6(props, ctx) : void 0;
};
const CalendarField = /* @__PURE__ */ _export_sfc(_sfc_main$6, [["ssrRender", _sfc_ssrRender$6]]);
const _sfc_main$5 = {
  inheritAttrs: false,
  components: {
    HeadlessFormField: _sfc_main$9,
    PrimevueDropdown
  },
  directives: {
    tooltip: PrimevueTooltip
  },
  inject: ["errorHandler"],
  props: {
    clearable: {
      type: Boolean,
      default: false
    },
    creating: {
      type: Boolean,
      default: false
    },
    field: {
      type: Object,
      required: true
    },
    filterable: {
      type: Boolean,
      default: false
    },
    focus: {
      type: Boolean,
      default: false
    },
    form: {
      type: Object,
      required: true
    },
    id: {
      type: String,
      required: true
    },
    isLarge: {
      type: Boolean,
      default: false
    },
    isSmall: {
      type: Boolean,
      default: false
    },
    labels: {
      type: String,
      default: null
    },
    searchable: {
      type: Boolean,
      default: false
    },
    show: {
      type: Boolean,
      default: true
    },
    updating: {
      type: Boolean,
      default: false
    }
  },
  data: () => ({
    options: [],
    limit: null,
    loading: false,
    search: null,
    timer: null
  }),
  mounted() {
    if (this.field.options.source === "api") {
      if (this.field.options.limit) {
        this.limit = this.field.options.limit;
      }
      this.fetch();
    } else {
      this.options = this.field.options.values;
    }
  },
  methods: {
    fetch() {
      this.loading = true;
      return this.axios.get(this.field.options.uri, { params: this.params() }).then(({ data }) => {
        this.options = data;
        this.loading = false;
      }).catch((error) => this.errorHandler(error));
    },
    filter(payload) {
      this.field.options.values = [];
      this.search = payload.value;
    },
    params() {
      return {
        ...this.field.options.filters,
        limit: this.limit,
        search: this.search
      };
    }
  },
  watch: {
    search: {
      handler(value) {
        clearTimeout(this.timer);
        this.timer = setTimeout(this.fetch, 500);
      }
    }
  }
};
function _sfc_ssrRender$5(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_headless_form_field = resolveComponent("headless-form-field");
  const _component_primevue_dropdown = resolveComponent("primevue-dropdown");
  const _directive_tooltip = resolveDirective("tooltip");
  _push(ssrRenderComponent(_component_headless_form_field, mergeProps(_ctx.$props, _attrs), {
    default: withCtx(({ dirty, disabled, error, label, placeholder, update }, _push2, _parent2, _scopeId) => {
      if (_push2) {
        if ($props.field.before) {
          _push2(`<div class="${ssrRenderClass($props.field.before)}"${_scopeId}></div>`);
        } else {
          _push2(`<!---->`);
        }
        _push2(`<div style="${ssrRenderStyle($props.show ? null : { display: "none" })}" class="${ssrRenderClass([[_ctx.$attrs.class, $props.field.class, $props.labels], "control field dropdown"])}"${_scopeId}>`);
        if (label) {
          _push2(`<label class="label"${ssrRenderAttr("for", $props.id)}${_scopeId}>${ssrInterpolate(label)}</label>`);
        } else {
          _push2(`<!---->`);
        }
        _push2(ssrRenderComponent(_component_primevue_dropdown, {
          class: ["w-full", {
            "is-creating": dirty && $props.creating,
            "is-updating": dirty && $props.updating,
            "p-inputtext-lg": $props.isLarge,
            "p-inputtext-sm": $props.isSmall,
            "p-invalid": $props.form.errors[$props.id]
          }],
          optionLabel: "name",
          optionValue: "id",
          modelValue: $props.form[$props.id],
          "onUpdate:modelValue": [($event) => $props.form[$props.id] = $event, ($event) => {
            update();
            _ctx.$emit("update:modelValue", $event);
          }],
          disabled: _ctx.loading || disabled,
          filter: $props.field.searchable || $props.searchable,
          id: $props.id,
          loading: _ctx.loading,
          options: _ctx.options,
          placeholder,
          "show-clear": $props.field.clearable || $props.clearable,
          onFilter: $options.filter
        }, null, _parent2, _scopeId));
        if (error) {
          _push2(`<div class="error p-error"${_scopeId}><i${ssrRenderAttrs(mergeProps({ class: "pi pi-exclamation-circle" }, ssrGetDirectiveProps(_ctx, _directive_tooltip, error, void 0, { top: true })))}${_scopeId}></i><span class="message"${_scopeId}>${ssrInterpolate(error)}</span></div>`);
        } else {
          _push2(`<!---->`);
        }
        _push2(`</div>`);
        if ($props.field.after) {
          _push2(`<div class="${ssrRenderClass($props.field.after)}"${_scopeId}></div>`);
        } else {
          _push2(`<!---->`);
        }
      } else {
        return [
          $props.field.before ? (openBlock(), createBlock("div", {
            key: 0,
            class: $props.field.before
          }, null, 2)) : createCommentVNode("", true),
          withDirectives(createVNode("div", {
            class: ["control field dropdown", [_ctx.$attrs.class, $props.field.class, $props.labels]]
          }, [
            label ? (openBlock(), createBlock("label", {
              key: 0,
              class: "label",
              for: $props.id
            }, toDisplayString(label), 9, ["for"])) : createCommentVNode("", true),
            createVNode(_component_primevue_dropdown, {
              class: ["w-full", {
                "is-creating": dirty && $props.creating,
                "is-updating": dirty && $props.updating,
                "p-inputtext-lg": $props.isLarge,
                "p-inputtext-sm": $props.isSmall,
                "p-invalid": $props.form.errors[$props.id]
              }],
              optionLabel: "name",
              optionValue: "id",
              modelValue: $props.form[$props.id],
              "onUpdate:modelValue": [($event) => $props.form[$props.id] = $event, ($event) => {
                update();
                _ctx.$emit("update:modelValue", $event);
              }],
              disabled: _ctx.loading || disabled,
              filter: $props.field.searchable || $props.searchable,
              id: $props.id,
              loading: _ctx.loading,
              options: _ctx.options,
              placeholder,
              "show-clear": $props.field.clearable || $props.clearable,
              onFilter: $options.filter
            }, null, 8, ["modelValue", "onUpdate:modelValue", "class", "disabled", "filter", "id", "loading", "options", "placeholder", "show-clear", "onFilter"]),
            error ? (openBlock(), createBlock("div", {
              key: 1,
              class: "error p-error"
            }, [
              withDirectives(createVNode("i", { class: "pi pi-exclamation-circle" }, null, 512), [
                [
                  _directive_tooltip,
                  error,
                  void 0,
                  { top: true }
                ]
              ]),
              createVNode("span", { class: "message" }, toDisplayString(error), 1)
            ])) : createCommentVNode("", true)
          ], 2), [
            [vShow, $props.show]
          ]),
          $props.field.after ? (openBlock(), createBlock("div", {
            key: 1,
            class: $props.field.after
          }, null, 2)) : createCommentVNode("", true)
        ];
      }
    }),
    _: 1
  }, _parent));
}
const _sfc_setup$5 = _sfc_main$5.setup;
_sfc_main$5.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/forms/fields/DropdownField.vue");
  return _sfc_setup$5 ? _sfc_setup$5(props, ctx) : void 0;
};
const DropdownField = /* @__PURE__ */ _export_sfc(_sfc_main$5, [["ssrRender", _sfc_ssrRender$5]]);
const Textarea_vue_vue_type_style_index_0_lang = "";
const _sfc_main$4 = {
  name: "Textarea",
  emits: ["update:modelValue"],
  props: {
    modelValue: null,
    autoResize: Boolean
  },
  mounted() {
    if (this.$el.offsetParent && this.autoResize) {
      this.resize();
    }
  },
  updated() {
    if (this.$el.offsetParent && this.autoResize) {
      this.resize();
    }
  },
  methods: {
    resize() {
      const style = window.getComputedStyle(this.$el);
      this.$el.style.height = "auto";
      this.$el.style.height = `calc(${style.borderTopWidth} + ${style.borderBottomWidth} + ${this.$el.scrollHeight}px)`;
      if (parseFloat(this.$el.style.height) >= parseFloat(this.$el.style.maxHeight)) {
        this.$el.style.overflowY = "scroll";
        this.$el.style.height = this.$el.style.maxHeight;
      } else {
        this.$el.style.overflow = "hidden";
      }
    },
    onInput(event) {
      if (this.autoResize) {
        this.resize();
      }
      this.$emit("update:modelValue", event.target.value);
    }
  },
  computed: {
    filled() {
      return this.modelValue != null && this.modelValue.toString().length > 0;
    }
  }
};
function _sfc_ssrRender$4(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  let _temp0;
  _push(`<textarea${ssrRenderAttrs(_temp0 = mergeProps({
    class: ["p-inputtextarea p-inputtext p-component", { "p-filled": $options.filled, "p-inputtextarea-resizable ": $props.autoResize }],
    value: $props.modelValue
  }, _attrs), "textarea")}>${ssrInterpolate("value" in _temp0 ? _temp0.value : "")}</textarea>`);
}
const _sfc_setup$4 = _sfc_main$4.setup;
_sfc_main$4.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("node_modules/primevue/textarea/Textarea.vue");
  return _sfc_setup$4 ? _sfc_setup$4(props, ctx) : void 0;
};
const PrimevueTextarea = /* @__PURE__ */ _export_sfc(_sfc_main$4, [["ssrRender", _sfc_ssrRender$4]]);
const _sfc_main$3 = {
  inheritAttrs: false,
  components: {
    HeadlessFormField: _sfc_main$9,
    PrimevueTextarea
  },
  directives: {
    tooltip: PrimevueTooltip
  },
  props: {
    autoResize: {
      type: Boolean,
      default: false
    },
    creating: {
      type: Boolean,
      default: false
    },
    field: {
      type: Object,
      required: true
    },
    focus: {
      type: Boolean,
      default: false
    },
    form: {
      type: Object,
      required: true
    },
    id: {
      type: String,
      required: true
    },
    isLarge: {
      type: Boolean,
      default: false
    },
    isSmall: {
      type: Boolean,
      default: false
    },
    labels: {
      type: String,
      default: null
    },
    rows: {
      type: Number,
      default: 5
    },
    show: {
      type: Boolean,
      default: true
    },
    updating: {
      type: Boolean,
      default: false
    }
  }
};
function _sfc_ssrRender$3(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_headless_form_field = resolveComponent("headless-form-field");
  const _component_primevue_textarea = resolveComponent("primevue-textarea");
  const _directive_tooltip = resolveDirective("tooltip");
  _push(ssrRenderComponent(_component_headless_form_field, mergeProps(_ctx.$props, _attrs), {
    default: withCtx(({ dirty, disabled, error, label, placeholder, update }, _push2, _parent2, _scopeId) => {
      if (_push2) {
        if ($props.field.before) {
          _push2(`<div class="${ssrRenderClass($props.field.before)}"${_scopeId}></div>`);
        } else {
          _push2(`<!---->`);
        }
        _push2(`<div style="${ssrRenderStyle($props.show ? null : { display: "none" })}" class="${ssrRenderClass([[_ctx.$attrs.class, $props.field.class, $props.labels], "control field textarea"])}"${_scopeId}>`);
        if (label) {
          _push2(`<label class="label"${ssrRenderAttr("for", $props.id)}${_scopeId}>${ssrInterpolate(label)}</label>`);
        } else {
          _push2(`<!---->`);
        }
        _push2(ssrRenderComponent(_component_primevue_textarea, {
          class: ["w-full", {
            "is-creating": dirty && $props.creating,
            "is-updating": dirty && $props.updating,
            "p-invalid": error
          }],
          "auto-resize": "",
          modelValue: $props.form[$props.id],
          "onUpdate:modelValue": [($event) => $props.form[$props.id] = $event, ($event) => {
            update();
            _ctx.$emit("update:modelValue", $event);
          }],
          disabled,
          id: $props.id,
          placeholder,
          rows: $props.field.rows || $props.rows
        }, null, _parent2, _scopeId));
        if (error) {
          _push2(`<div class="error p-error"${_scopeId}><i${ssrRenderAttrs(mergeProps({ class: "pi pi-exclamation-circle" }, ssrGetDirectiveProps(_ctx, _directive_tooltip, error, void 0, { top: true })))}${_scopeId}></i><span class="message"${_scopeId}>${ssrInterpolate(error)}</span></div>`);
        } else {
          _push2(`<!---->`);
        }
        _push2(`</div>`);
        if ($props.field.after) {
          _push2(`<div class="${ssrRenderClass($props.field.after)}"${_scopeId}></div>`);
        } else {
          _push2(`<!---->`);
        }
      } else {
        return [
          $props.field.before ? (openBlock(), createBlock("div", {
            key: 0,
            class: $props.field.before
          }, null, 2)) : createCommentVNode("", true),
          withDirectives(createVNode("div", {
            class: ["control field textarea", [_ctx.$attrs.class, $props.field.class, $props.labels]]
          }, [
            label ? (openBlock(), createBlock("label", {
              key: 0,
              class: "label",
              for: $props.id
            }, toDisplayString(label), 9, ["for"])) : createCommentVNode("", true),
            createVNode(_component_primevue_textarea, {
              class: ["w-full", {
                "is-creating": dirty && $props.creating,
                "is-updating": dirty && $props.updating,
                "p-invalid": error
              }],
              "auto-resize": "",
              modelValue: $props.form[$props.id],
              "onUpdate:modelValue": [($event) => $props.form[$props.id] = $event, ($event) => {
                update();
                _ctx.$emit("update:modelValue", $event);
              }],
              disabled,
              id: $props.id,
              placeholder,
              rows: $props.field.rows || $props.rows
            }, null, 8, ["modelValue", "onUpdate:modelValue", "class", "disabled", "id", "placeholder", "rows"]),
            error ? (openBlock(), createBlock("div", {
              key: 1,
              class: "error p-error"
            }, [
              withDirectives(createVNode("i", { class: "pi pi-exclamation-circle" }, null, 512), [
                [
                  _directive_tooltip,
                  error,
                  void 0,
                  { top: true }
                ]
              ]),
              createVNode("span", { class: "message" }, toDisplayString(error), 1)
            ])) : createCommentVNode("", true)
          ], 2), [
            [vShow, $props.show]
          ]),
          $props.field.after ? (openBlock(), createBlock("div", {
            key: 1,
            class: $props.field.after
          }, null, 2)) : createCommentVNode("", true)
        ];
      }
    }),
    _: 1
  }, _parent));
}
const _sfc_setup$3 = _sfc_main$3.setup;
_sfc_main$3.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/forms/fields/TextareaField.vue");
  return _sfc_setup$3 ? _sfc_setup$3(props, ctx) : void 0;
};
const TextareaField = /* @__PURE__ */ _export_sfc(_sfc_main$3, [["ssrRender", _sfc_ssrRender$3]]);
const _sfc_main$2 = {
  components: {
    CalendarField,
    DropdownField,
    PasswordField,
    SwitchField,
    TextField,
    TextareaField
  },
  props: {
    creating: {
      type: Boolean,
      default: false
    },
    fields: {
      type: Object,
      required: true
    },
    form: {
      type: Object,
      required: true
    },
    updating: {
      type: Boolean,
      default: false
    }
  }
};
function _sfc_ssrRender$2(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_calendar_field = resolveComponent("calendar-field");
  const _component_password_field = resolveComponent("password-field");
  const _component_dropdown_field = resolveComponent("dropdown-field");
  const _component_switch_field = resolveComponent("switch-field");
  const _component_textarea_field = resolveComponent("textarea-field");
  const _component_text_field = resolveComponent("text-field");
  _push(`<div${ssrRenderAttrs(mergeProps({ class: "formgrid grid" }, _attrs))}><!--[-->`);
  ssrRenderList($props.fields, (item, key) => {
    _push(`<!--[-->`);
    if (item.custom) {
      ssrRenderSlot(_ctx.$slots, key, mergeProps(_ctx.$props, { id: key }), null, _push, _parent);
    } else if (item.type === "calendar") {
      _push(ssrRenderComponent(_component_calendar_field, mergeProps(_ctx.$props, {
        field: item,
        id: key
      }), null, _parent));
    } else if (item.type === "password") {
      _push(ssrRenderComponent(_component_password_field, mergeProps(_ctx.$props, {
        field: item,
        id: key
      }), null, _parent));
    } else if (item.type === "select") {
      _push(ssrRenderComponent(_component_dropdown_field, mergeProps(_ctx.$props, {
        field: item,
        id: key
      }), null, _parent));
    } else if (item.type === "switch") {
      _push(ssrRenderComponent(_component_switch_field, mergeProps(_ctx.$props, {
        field: item,
        id: key
      }), null, _parent));
    } else if (item.type === "textarea") {
      _push(ssrRenderComponent(_component_textarea_field, mergeProps(_ctx.$props, {
        field: item,
        id: key
      }), null, _parent));
    } else if (item.type !== "hidden") {
      _push(ssrRenderComponent(_component_text_field, mergeProps(_ctx.$props, {
        field: item,
        id: key
      }), null, _parent));
    } else {
      _push(`<!---->`);
    }
    _push(`<!--]-->`);
  });
  _push(`<!--]--></div>`);
}
const _sfc_setup$2 = _sfc_main$2.setup;
_sfc_main$2.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/forms/VueFormFields.vue");
  return _sfc_setup$2 ? _sfc_setup$2(props, ctx) : void 0;
};
const VueFormFields = /* @__PURE__ */ _export_sfc(_sfc_main$2, [["ssrRender", _sfc_ssrRender$2]]);
const _sfc_main$1 = {
  components: {
    PrimevueCard,
    VueFormFields
  },
  inject: ["i18n"],
  props: {
    creating: {
      type: Boolean,
      default: false
    },
    form: {
      type: Object,
      required: true
    },
    id: {
      type: String,
      required: true
    },
    section: {
      type: Object,
      required: true
    },
    updating: {
      type: Boolean,
      default: false
    }
  }
};
function _sfc_ssrRender$1(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_primevue_card = resolveComponent("primevue-card");
  const _component_vue_form_fields = resolveComponent("vue-form-fields");
  _push(`<section${ssrRenderAttrs(mergeProps({
    class: ["section", $props.section.class]
  }, _attrs))}>`);
  if ($props.section.custom) {
    ssrRenderSlot(_ctx.$slots, $props.id, {}, null, _push, _parent);
  } else {
    _push(ssrRenderComponent(_component_primevue_card, null, {
      header: withCtx((_, _push2, _parent2, _scopeId) => {
        if (_push2) {
          if ($props.section.heading) {
            _push2(`<header class="header"${_scopeId}><h3${_scopeId}>${ssrInterpolate($options.i18n($props.section.heading))}</h3></header>`);
          } else {
            _push2(`<!---->`);
          }
        } else {
          return [
            $props.section.heading ? (openBlock(), createBlock("header", {
              key: 0,
              class: "header"
            }, [
              createVNode("h3", null, toDisplayString($options.i18n($props.section.heading)), 1)
            ])) : createCommentVNode("", true)
          ];
        }
      }),
      content: withCtx((_, _push2, _parent2, _scopeId) => {
        if (_push2) {
          _push2(ssrRenderComponent(_component_vue_form_fields, {
            creating: $props.creating,
            fields: $props.section.fields,
            form: $props.form,
            updating: $props.updating
          }, null, _parent2, _scopeId));
        } else {
          return [
            createVNode(_component_vue_form_fields, {
              creating: $props.creating,
              fields: $props.section.fields,
              form: $props.form,
              updating: $props.updating
            }, null, 8, ["creating", "fields", "form", "updating"])
          ];
        }
      }),
      _: 1
    }, _parent));
  }
  _push(`</section>`);
}
const _sfc_setup$1 = _sfc_main$1.setup;
_sfc_main$1.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/forms/VueFormSection.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const VueFormSection = /* @__PURE__ */ _export_sfc(_sfc_main$1, [["ssrRender", _sfc_ssrRender$1]]);
const _sfc_main = {
  components: {
    VueFormActions,
    VueFormFields,
    VueFormSection
  },
  props: {
    creating: {
      type: Boolean,
      default: false
    },
    customActions: {
      type: Boolean,
      default: false
    },
    formGrid: {
      type: Boolean,
      default: false
    },
    template: {
      type: Object,
      required: true
    },
    toggleLabels: {
      type: Boolean,
      default: false
    },
    updating: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    labels() {
      return this.template.labels === false ? null : this.template.labels || "vertical";
    }
  },
  setup(props, { emit }) {
    let fields = {};
    function clear() {
      form.clearErrors();
      emit("form:clear");
    }
    function filter(template, type, custom) {
      let items = {};
      Object.keys(template).forEach((item) => {
        template[item].type || "text";
        const matchCustom = typeof custom === "undefined" || template[item].custom;
        const matchType = /^not:/.test(type) && template[item].type !== type.replace("not:", "") || !/^not:/.test(type) && template[item].type === type;
        if (matchType && matchCustom) {
          items[item] = template[item];
        }
      });
      return items;
    }
    function flatten(template) {
      Object.keys(template).forEach((item) => {
        const type = template[item].type || "text";
        if (type === "section") {
          flatten(template[item].fields);
        } else {
          if (template[item].type === "calendar" && template[item].value && template[item].value.toString().match(/^\d{4}-\d{2}-\d{2}$/)) {
            template[item].value = new Date(`${template[item].value} 00:00:00`);
          }
          fields[item] = template[item].type === "switch" ? template[item].value && template[item].value === true : template[item].value || null;
        }
      });
      return fields;
    }
    function reset() {
      form.clearErrors();
      form.reset();
      emit("form:reset");
    }
    function submit() {
      form[props.template.resource.method](props.template.uri, {
        onSuccess: () => emit("form:success", form)
      });
      emit("form:submit");
    }
    flatten(props.template.fields);
    const form = useForm(fields);
    emit("form:ready");
    return {
      clear,
      custom: {
        fields: filter(props.template.fields, "not:section", true),
        sections: filter(props.template.fields, "section", true)
      },
      fields: filter(props.template.fields, "not:section"),
      form,
      reset,
      sections: filter(props.template.fields, "section"),
      submit
    };
  }
};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs, $props, $setup, $data, $options) {
  const _component_vue_form_section = resolveComponent("vue-form-section");
  const _component_vue_form_fields = resolveComponent("vue-form-fields");
  const _component_vue_form_actions = resolveComponent("vue-form-actions");
  _push(`<div${ssrRenderAttrs(mergeProps({ class: "vue-form" }, _attrs))}><form class="${ssrRenderClass(["form", $props.template.class, $options.labels, { "custom-actions": $props.customActions, "formgrid grid": $props.formGrid }])}">`);
  ssrRenderSlot(_ctx.$slots, "default", { form: $setup.form }, () => {
    if ($setup.sections) {
      _push(`<!--[-->`);
      ssrRenderList($setup.sections, (section, key) => {
        _push(ssrRenderComponent(_component_vue_form_section, {
          creating: $props.creating,
          form: $setup.form,
          id: key,
          key,
          section,
          updating: $props.updating
        }, createSlots({ _: 2 }, [
          section.custom ? {
            name: key,
            fn: withCtx((props, _push2, _parent2, _scopeId) => {
              if (_push2) {
                ssrRenderSlot(_ctx.$slots, key, { creating: $props.creating, labels: $options.labels, section, form: $setup.form, key, updating: $props.updating }, null, _push2, _parent2, _scopeId);
              } else {
                return [
                  renderSlot(_ctx.$slots, key, { creating: $props.creating, labels: $options.labels, section, form: $setup.form, key, updating: $props.updating })
                ];
              }
            }),
            key: "0"
          } : void 0
        ]), _parent));
      });
      _push(`<!--]-->`);
    } else {
      _push(`<!---->`);
    }
    if ($setup.fields) {
      _push(ssrRenderComponent(_component_vue_form_fields, {
        creating: $props.creating,
        fields: $setup.fields,
        form: $setup.form,
        updating: $props.updating
      }, createSlots({ _: 2 }, [
        renderList($setup.custom.fields, (field, key) => {
          return {
            name: key,
            fn: withCtx((props, _push2, _parent2, _scopeId) => {
              if (_push2) {
                ssrRenderSlot(_ctx.$slots, key, { creating: $props.creating, field, form: $setup.form, key, updating: $props.updating }, null, _push2, _parent2, _scopeId);
              } else {
                return [
                  renderSlot(_ctx.$slots, _ctx.key, { creating: $props.creating, field: _ctx.field, form: $setup.form, key: _ctx.key, updating: $props.updating })
                ];
              }
            })
          };
        })
      ]), _parent));
    } else {
      _push(`<!---->`);
    }
  }, _push, _parent);
  if (!$props.customActions) {
    _push(ssrRenderComponent(_component_vue_form_actions, {
      actions: $props.template.actions,
      form: $setup.form,
      onClear: $setup.clear,
      onReset: $setup.reset,
      onSubmit: $setup.submit
    }, null, _parent));
  } else {
    _push(`<!---->`);
  }
  _push(`</form></div>`);
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/components/forms/VueForm.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const VueForm = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);
export {
  DropdownField as D,
  VueForm as V
};
