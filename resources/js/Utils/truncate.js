const truncate = (value, length, ending = '...') => {
    if (!value || value.length < length) {
        return value
    }

    return value.substring(0, length) + ending
}

export default truncate
