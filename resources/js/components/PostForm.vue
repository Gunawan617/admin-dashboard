<template>
  <form @submit.prevent="submitPost">
    <div>
      <label>Judul</label>
      <input v-model="form.title" type="text" class="input" required />
    </div>
    <div class="mt-4">
      <label>Summary</label>
      <textarea v-model="form.summary" class="input" required></textarea>
    </div>
    <div class="mt-4">
      <label>Konten</label>
      <content-editor v-model:content="form.content" />
    </div>
    <div class="mt-4">
      <button type="submit" class="btn">Simpan</button>
    </div>
    <div v-if="success" class="mt-2 text-green-600">Berhasil disimpan!</div>
    <div v-if="error" class="mt-2 text-red-600">{{ error }}</div>
  </form>
</template>

<script setup>
import { ref } from 'vue'
import ContentEditor from './ContentEditor.vue'

const form = ref({
  title: '',
  summary: '',
  content: '',
})

const success = ref(false)
const error = ref('')

async function submitPost() {
  success.value = false
  error.value = ''
  try {
    const res = await fetch('/api/admin/posts', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
      body: JSON.stringify(form.value),
    })
    if (!res.ok) throw new Error('Gagal simpan')
    success.value = true
    form.value.title = ''
    form.value.summary = ''
    form.value.content = ''
  } catch (e) {
    error.value = e.message
  }
}
</script>

<style scoped>
.input {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}
.btn {
  background: #6366f1;
  color: #fff;
  padding: 8px 16px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
</style>
