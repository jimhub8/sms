export default {
    page_loader(state, payload) {
        state.page_loader = payload
    },
    loading(state, payload) {
        state.loading = payload
    },
    errors(state, payload) {
        state.errors = payload
    },
    alertEvent(state, payload) {
        state.alertEvent = payload
    },


    updateCalls(state, payload) {
        state.calls = payload
    },
}

