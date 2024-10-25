const chunk = (array, size = 1) => {
    const length = array?.length || 0
    if (!length || size < 1) return []
    const result = []
    for (let index = 0; index < length; index += size) {
        result.push(array.slice(index, index + size))
    }
    return result
}

export default chunk
