import { ref, watch, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'
import debounce from '@/Utils/debounce'

export default function useDataSearch(
    routePath,
    columnsToSearch,
    aditionalParams = {}
) {
    const searchTerm = ref('')

    const debouncedSearch = debounce((value) => {
        const params = {
            page: 1,
            searchContext: columnsToSearch,
            searchTerm: value
        }

        Object.assign(params, aditionalParams)

        fetchData(params)
    }, 500)

    watch(searchTerm, (value, oldValue) => {
        //prevent new search request on paginated results and back button navigation combined
        if (oldValue === '' && value.length > 1) {
            return
        }

        debouncedSearch(value)
    })

    const fetchData = (params) => {
        router.visit(routePath, {
            data: params,
            replace: true,
            preserveState: true
        })
    }

    const clearSearch = () => {
        searchTerm.value = ''
        const params = { page: 1 }

        Object.assign(params, aditionalParams)
        fetchData(params)
    }

    // handle back button navigation
    onMounted(() => {
        const urlParams = new URLSearchParams(window.location.search)
        searchTerm.value = urlParams.get('searchTerm') || ''
    })

    return { searchTerm, clearSearch }
}
