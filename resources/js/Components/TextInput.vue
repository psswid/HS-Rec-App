<template>
  <div>
    <input ref="input" v-bind="$attrs" class="form-input md:w-auto" :class="{ error: error }" :type="type" :value="value" :target="target" @input="emitData" />
    <div v-if="error" class="form-error">{{ error }}</div>
  </div>
</template>

<script>
export default {
  inheritAttrs: false,
  props: {
    type: {
      type: String,
      default: 'text',
    },
    value: String,
    label: String,
    error: String,
    target: String,
  },
  methods: {
    focus() {
      this.$refs.input.focus()
    },
    select() {
      this.$refs.input.select()
    },
    setSelectionRange(start, end) {
      this.$refs.input.setSelectionRange(start, end)
    },
    emitData($event){
        this.$emit('update:input', this.target, $event.target.value);
    }
  },
}
</script>
