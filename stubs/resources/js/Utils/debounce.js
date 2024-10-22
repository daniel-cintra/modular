function debounce(func, timeout = 300) {
    let timer
    return (...args) => {
        window.clearTimeout(timer)
        timer = window.setTimeout(() => {
            func.apply(this, args)
        }, timeout)
    }
}

export default debounce
