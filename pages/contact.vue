<script setup lang="ts">
  import InputText from 'primevue/inputtext'
  import Textarea from 'primevue/textarea'
  import Message from 'primevue/message'
  import Button from 'primevue/button'
  import { ref, type Ref } from 'vue'
  import { useChallengeV3 } from 'vue-recaptcha'
  import type { ContactMessage, StatusMsg, ApiValidationError, ContactMessageResponse } from '~/types'
  import { sendMessage } from '@/services/api'
  import { getBlankContactMessage, hasFields, resetForm } from '@/utils/contact'

  const statusMsg: Ref<StatusMsg | null> = ref(null)
  const contactMsg: Ref<ContactMessage>  = ref(getBlankContactMessage())
  const { execute }                      = useChallengeV3('submit')

  const sendContactMsg = async () => {
    if (hasFields(contactMsg)) {
      const response: ContactMessageResponse | null = await sendMessage(toRaw(contactMsg.value))
      
      if (response?.success) {
        resetForm(contactMsg)
      }

      statusMsg.value = {
        type: response?.success ? 'success' : 'error',
        text: response?.message
      } as StatusMsg
    } else {
      statusMsg.value = {
        type: 'error',
        text: 'All fields are required'
      } as StatusMsg
    }
  }

  const onSubmit = async () => {
    if (statusMsg.value) {
      statusMsg.value = null
    }

    const token: string = await execute()
    console.log('Google ReCaptcha - execute', token)

    if (token) {
      contactMsg.value.token = token
      sendContactMsg()
    } else {
      statusMsg.value = { type: 'error', text: 'An error occurred validating submission. Please try again later.' } as StatusMsg
    }
    return
  }
</script>

<template>
  <div id="contact">
    <div>
      <h1>Let's Connect</h1>
      <div id="contact-message">
        <p>I'm always on the lookout for new opportunities so please send me a message and let's talk.</p>
        <p>I will try my best to get back to you as soon as possible.</p>
      </div>
    </div>
    <form @submit.prevent="onSubmit">
      <Message v-if="statusMsg" :severity="statusMsg.type">{{ statusMsg.text }}</Message>
      <div class="form-field">
        <label for="name" class="p-sr-only">Name</label>
        <InputText id="name" placeholder="Name" v-model="contactMsg.name" />
      </div>
      <div class="form-field">
        <label for="email" class="p-sr-only">Email</label>
        <InputText id="email" placeholder="Email" v-model="contactMsg.email" />
      </div>
      <div class="form-field">
        <label for="form-message-field" class="p-sr-only">Message</label>
        <Textarea id="form-message-field" rows="5" cols="30" placeholder="Message" v-model="contactMsg.message" />
      </div>
      <Button type="submit" label="Submit" rounded />
    </form>
  </div>
</template>

<style scoped>
#contact {
  display: flex;
  gap: 80px;
}

#contact-message {
  line-height: 36px;
  font-size: 25px;
}

.form-field {
  margin-bottom: 20px;
}

#form-message-field {
  width: 900px;
  height: 400px;
  resize: none;
}

p {
  line-height: 35px;
}

@media (max-width: 1440px) {
  #form-message-field {
    max-width: 700px;
  }
}

@media (max-width: 1075px) {
  #contact {
    flex-direction: column;
    gap: 20px;
  }

  #form-message-field {
    width: 100%;
  }
}
</style>
