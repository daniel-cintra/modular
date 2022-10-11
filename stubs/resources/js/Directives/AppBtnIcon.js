export default {
    mounted: (el, binding) => {
        let priority = 'secondary'

        if (binding.value === 'danger') {
            priority = 'help'
        }

        el.classList.add(
            'p-button-rounded',
            'p-button-icon-only',
            `p-button-${priority}`
        )
    }
}
