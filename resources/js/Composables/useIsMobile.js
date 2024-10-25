import { ref } from 'vue'

export default function useIsMobile() {
    const isMobile = ref(false)
    const width = window.innerWidth

    if (width <= 1024) {
        isMobile.value = true
    }

    return { isMobile }
}
