<template>
  <SelectField
    v-if="countries.length"
    :id="`form-${field.column_name}`"
    :fieldName="field.column_name"
    :errors="errors"
    v-model="selected"
  >
    <template v-slot:options>
      <option
        v-for="country in countries"
        :key="`option-${country}`"
        :value="country"
      >
        {{ country }}
      </option>
    </template>
  </SelectField>
</template>

<script>
import get from 'lodash.get'
import SelectField from '@/Adaptcms/Base/ui/components/Form/SelectField'
import CountriesList from '@/Adaptcms/FieldCountry/countries.json'

export default {
  props: [
    'value',
    'field',
    'errors',
    'formMeta',
    'model',
    'module',
    'action'
  ],

  components: {
    SelectField
  },

  watch: {
    value (newVal, oldVal) {
      if (newVal !== oldVal) {
        this.selected = newVal
      }
    },

    selected (newVal, oldVal) {
      if (newVal !== oldVal) {
        this.$emit('input', newVal)
      }
    }
  },

  computed: {
    countries () {
      return CountriesList
    }
  },

  data () {
    return {
      selected: null
    }
  },

  mounted () {
    if (!this.selected) {
      this.selected = this.value
    }
  }
}
</script>
