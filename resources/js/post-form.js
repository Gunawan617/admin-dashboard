import { createApp, h } from 'vue'
import ContentEditor from './components/ContentEditor.vue'

const el = document.getElementById('post-form-app')
if (el) {
	// Ambil value awal dari textarea lama jika ada
	const textarea = document.querySelector('textarea[name="content"]')
	const initialContent = textarea ? textarea.value : ''

	createApp({
		data() {
			return {
				content: initialContent,
			}
		},
		watch: {
			content(val) {
				if (textarea) textarea.value = val
			}
		},
		render() {
			return h(ContentEditor, {
				content: this.content,
				'onUpdate:content': val => this.content = val,
				syncToTextarea: 'content',
			})
		}
	}).mount('#post-form-app')
}
