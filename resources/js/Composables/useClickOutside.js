import { onBeforeUnmount, onMounted, ref } from 'vue'

export default function useClickOutside(elementRef) {
    const isClickOutside = ref(false)

    const handler = (e) => {
        if (elementRef.value && !elementRef.value.contains(e.target)) {
            isClickOutside.value = true
        } else {
            isClickOutside.value = false
        }
    }

    onMounted(() => {
        document.addEventListener('click', handler)
    })

    onBeforeUnmount(() => {
        document.removeEventListener('click', handler)
    })

    return { isClickOutside }
}
