<template>
  <div class="container-fluid">
    <form @submit.prevent="submitForm">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">add</i>
              </div>
              <h4 class="card-title">
                {{ $t('global.create') }}
                <strong>{{ $t('cruds.jouren.title_singular') }}</strong>
              </h4>
            </div>
            <div class="card-body">
              <back-button></back-button>
            </div>
            <div class="card-body">
              <bootstrap-alert />
              <div class="row">
                <div class="col-md-12">
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.title,
                      'is-focused': activeField == 'title'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.jouren.fields.title')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.title"
                      @input="updateTitle"
                      @focus="focusField('title')"
                      @blur="clearFocus"
                      required
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.start_time,
                      'is-focused': activeField == 'start_time'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.jouren.fields.start_time')
                    }}</label>
                    <datetime-picker
                      class="form-control"
                      type="text"
                      picker="time"
                      :value="entry.start_time"
                      @input="updateStartTime"
                      @focus="focusField('start_time')"
                      @blur="clearFocus"
                      required
                    >
                    </datetime-picker>
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.end_time,
                      'is-focused': activeField == 'end_time'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.jouren.fields.end_time')
                    }}</label>
                    <datetime-picker
                      class="form-control"
                      type="text"
                      picker="time"
                      :value="entry.end_time"
                      @input="updateEndTime"
                      @focus="focusField('end_time')"
                      @blur="clearFocus"
                      required
                    >
                    </datetime-picker>
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.phone_number,
                      'is-focused': activeField == 'phone_number'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.jouren.fields.phone_number')
                    }}</label>
                    <input
                      class="form-control"
                      type="number"
                      step="1"
                      :value="entry.phone_number"
                      @input="updatePhoneNumber"
                      @focus="focusField('phone_number')"
                      @blur="clearFocus"
                      required
                    />
                  </div>
                  <div class="form-group">
                    <label class="required">{{
                      $t('cruds.jouren.fields.image')
                    }}</label>
                    <attachment
                      :route="getRoute('jourens')"
                      :collection-name="'jouren_image'"
                      :media="entry.image"
                      :max-file-size="20"
                      :component="'pictures'"
                      :accept="'image/*'"
                      @file-uploaded="insertImageFile"
                      @file-removed="removeImageFile"
                      :max-files="1"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <vue-button-spinner
                class="btn-primary"
                :status="status"
                :isLoading="loading"
                :disabled="loading"
              >
                {{ $t('global.save') }}
              </vue-button-spinner>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import Attachment from '@components/Attachments/Attachment'

export default {
  components: {
    Attachment
  },
  data() {
    return {
      status: '',
      activeField: ''
    }
  },
  computed: {
    ...mapGetters('JourensSingle', ['entry', 'loading'])
  },
  beforeDestroy() {
    this.resetState()
  },
  methods: {
    ...mapActions('JourensSingle', [
      'storeData',
      'resetState',
      'setTitle',
      'setStartTime',
      'setEndTime',
      'setPhoneNumber',
      'insertImageFile',
      'removeImageFile'
    ]),
    updateTitle(e) {
      this.setTitle(e.target.value)
    },
    updateStartTime(e) {
      this.setStartTime(e.target.value)
    },
    updateEndTime(e) {
      this.setEndTime(e.target.value)
    },
    updatePhoneNumber(e) {
      this.setPhoneNumber(e.target.value)
    },
    getRoute(name) {
      return `${axios.defaults.baseURL}${name}/media`
    },
    submitForm() {
      this.storeData()
        .then(() => {
          this.$router.push({ name: 'jourens.index' })
          this.$eventHub.$emit('create-success')
        })
        .catch(error => {
          this.status = 'failed'
          _.delay(() => {
            this.status = ''
          }, 3000)
        })
    },
    focusField(name) {
      this.activeField = name
    },
    clearFocus() {
      this.activeField = ''
    }
  }
}
</script>
